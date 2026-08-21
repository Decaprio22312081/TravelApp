<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PushToMysql extends Command
{
    protected $signature = 'db:push-to-mysql {--out=database/export-mysql.sql}';

    protected $description = 'Export seluruh data SQLite lokal menjadi dump SQL kompatibel MySQL';

    private const RUNTIME_TABLES = [
        'sessions',
        'cache',
        'cache_locks',
        'jobs',
        'job_batches',
        'failed_jobs',
        'password_reset_tokens',
    ];

    private const TABLE_ORDER = [
        'ulasan',
        'pembayaran',
        'pemesanan',
        'paket',
        'mitra',
        'mobil',
        'destinasi',
        'bank_accounts',
        'settings',
        'promo_banners',
        'users',
        'migrations',
    ];

    public function handle(): int
    {
        $allTables = array_map(
            fn ($t) => preg_replace('/^[a-zA-Z0-9_]+\./', '', $t),
            Schema::connection('sqlite')->getTableListing()
        );

        $ordered = array_values(array_intersect(self::TABLE_ORDER, $allTables));
        $extra = array_values(array_diff(
            $allTables,
            self::TABLE_ORDER,
            self::RUNTIME_TABLES,
            $ordered
        ));
        $tables = array_merge($ordered, $extra);

        if (empty($tables)) {
            $this->error('Tidak ada tabel data yang ditemukan di SQLite.');

            return self::FAILURE;
        }

        $path = base_path($this->option('out'));
        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $lines = [
            '-- Dump dibuat oleh db:push-to-mysql pada '.now()->toDateTimeString(),
            '-- Sumber: SQLite lokal | Target: MySQL hosting',
            '',
            'SET NAMES utf8mb4;',
            'SET FOREIGN_KEY_CHECKS=0;',
            '',
        ];

        $report = [];

        foreach ($tables as $table) {
            $columns = Schema::connection('sqlite')->getColumnListing($table);

            $lines[] = 'DELETE FROM `'.$table.'`;';

            $query = DB::connection('sqlite')->table($table);
            if (Schema::connection('sqlite')->hasColumn($table, 'id')) {
                $query->orderBy('id');
            }

            $count = 0;
            $buffer = [];

            $flush = function () use (&$buffer, &$lines, $table, $columns) {
                if ($buffer === []) {
                    return;
                }
                $cols = implode(', ', array_map(fn ($c) => '`'.$c.'`', $columns));
                $lines[] = 'INSERT INTO `'.$table.'` ('.$cols.") VALUES\n  "
                    .implode(",\n  ", $buffer).';';
                $lines[] = '';
                $buffer = [];
            };

            foreach ($query->cursor() as $row) {
                $buffer[] = '('.implode(', ', array_map(
                    fn ($v) => $this->sqlValue($v),
                    array_values((array) $row)
                )).')';
                $count++;

                if (count($buffer) >= 100) {
                    $flush();
                }
            }
            $flush();

            if (Schema::connection('sqlite')->hasColumn($table, 'id')) {
                $lines[] = 'ALTER TABLE `'.$table.'` AUTO_INCREMENT = 1;';
            }

            $lines[] = '';
            $report[$table] = $count;
        }

        $lines[] = 'SET FOREIGN_KEY_CHECKS=1;';
        $lines[] = '';

        file_put_contents($path, implode("\n", $lines));

        $rows = array_map(fn ($t, $c) => [$t, $c], array_keys($report), $report);
        $this->table(['Tabel', 'Baris'], $rows);
        $total = array_sum($report);
        $this->info("Total {$total} baris dari ".count($tables)." tabel ditulis ke: {$path}");

        return self::SUCCESS;
    }

    private function sqlValue(mixed $value): string
    {
        if (is_null($value)) {
            return 'NULL';
        }

        if (is_int($value) || is_float($value)) {
            return (string) $value;
        }

        return "'".str_replace(
            ['\\', "\0", "\n", "\r", "'", "\x1a"],
            ['\\\\', '\\0', '\\n', '\\r', "\\'", '\\Z'],
            (string) $value
        )."'";
    }
}
