<x-mail::message>
# Reservasi / Pertanyaan Baru Masuk

Halo Tim Nirwana Tour Lampung,

Terdapat calon wisatawan yang baru saja mengisi formulir pemesanan/konsultasi di website:

**Detail Calon Wisatawan:**
- **Nama / Instansi:** {{ $inquiry->name }}
- **Nomor WhatsApp:** {{ $inquiry->phone }}
- **Email:** {{ $inquiry->email ?? '-' }}
- **Paket / Layanan:** {{ $inquiry->package_name ?? ($inquiry->tourPackage->title ?? 'Konsultasi Umum') }}
- **Jumlah Peserta:** {{ $inquiry->participants }} Orang
- **Pilihan Armada:** {{ $inquiry->fleet_type ?? '-' }}
- **Estimasi Biaya:** {{ $inquiry->estimated_price ? 'Rp ' . number_format($inquiry->estimated_price, 0, ',', '.') : '-' }}
- **Halaman Sumber:** {{ ucfirst($inquiry->source) }}

**Catatan / Pesan:**
> {{ $inquiry->message ?? 'Tidak ada catatan khusus.' }}

<x-mail::button :url="config('app.url') . '/admin/inquiries'">
Kelola Leads di Panel Admin
</x-mail::button>

Terima kasih,<br>
{{ config('app.name', 'Nirwana Tour Lampung') }}
</x-mail::message>
