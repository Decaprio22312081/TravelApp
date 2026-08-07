ID,Tanggal,Paket/Mobil,Pemesan,User,Tujuan,Total,Status
@foreach($laporan as $item)
{{ $item->id }},{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') : '-' }},{{ $item->paket->nama ?? $item->mobil->nama ?? '-' }},{{ $item->nama_penumpang }},{{ $item->user->name ?? '-' }},{{ Str::limit($item->alamat_tujuan, 30) }},{{ number_format($item->total_harga, 0, ',', '.') }},{{ $item->status }}
@endforeach
