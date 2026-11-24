<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#DE0171">
    <title inertia>{{ config('app.name', 'Nirwana Tour Lampung') }} - Admin Portal</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/Logo-Nirwana.png') }}">

    <!-- Google Fonts & Font Awesome 6 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    @inertiaHead
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800 selection:bg-[#DE0171] selection:text-white">
    @if(app()->isDownForMaintenance())
        <!-- Alert Banner Sticky Top jika Mode Maintenance Sedang Aktif -->
        <div id="maintenance-alert-banner" style="position: sticky; top: 0; z-index: 999999; background: linear-gradient(90deg, #DC2626 0%, #B91C1C 100%); color: #FFFFFF; padding: 10px 20px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 700; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; box-shadow: 0 4px 15px rgba(220, 38, 38, 0.35);">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: #FEF08A; box-shadow: 0 0 10px #FEF08A;"></span>
                <span>PERINGATAN: Website saat ini sedang dalam <u>MODE MAINTENANCE</u> (Pengunjung umum dialihkan ke halaman 503).</span>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="{{ route('admin.maintenance.index') }}" style="background: rgba(255,255,255,0.2); color: #FFFFFF; padding: 5px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 700;">
                    <i class="fa-solid fa-sliders"></i> Atur Maintenance
                </a>
                <form action="{{ route('admin.maintenance.toggle') }}" method="POST" style="margin: 0;" onsubmit="return confirm('Kembalikan website menjadi ONLINE normal untuk semua pengunjung?');">
                    @csrf
                    <input type="hidden" name="action" value="disable">
                    <button type="submit" style="background: #FFFFFF; color: #DC2626; border: none; border-radius: 6px; padding: 5px 14px; font-size: 12px; font-weight: 800; cursor: pointer;">
                        <i class="fa-solid fa-power-off"></i> MATIKAN SEKARANG
                    </button>
                </form>
            </div>
        </div>
    @endif

    @inertia

    <!-- Tombol Mengambang Pintasan Mode Maintenance (Akses Cepat Admin) -->
    <a href="{{ route('admin.maintenance.index') }}" title="Kelola Mode Maintenance Website" style="position: fixed; bottom: 20px; right: 20px; z-index: 99998; background: #0F172A; color: #FFFFFF; border: 1px solid #334155; padding: 8px 16px; border-radius: 999px; font-family: 'Plus Jakarta Sans', system-ui, sans-serif; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.35); text-decoration: none; transition: transform 0.2s ease;">
        @if(app()->isDownForMaintenance())
            <span style="width: 8px; height: 8px; border-radius: 50%; background: #EF4444; box-shadow: 0 0 6px #EF4444;"></span>
            <span>Maintenance: <strong style="color: #F87171;">Aktif</strong></span>
        @else
            <span style="width: 8px; height: 8px; border-radius: 50%; background: #10B981; box-shadow: 0 0 6px #10B981;"></span>
            <span>Web: <strong style="color: #34D399;">Online</strong></span>
        @endif
        <span style="background: rgba(255,255,255,0.18); padding: 2px 8px; border-radius: 999px; font-size: 11px; font-weight: 600;">
            <i class="fa-solid fa-screwdriver-wrench"></i> Tombol Kontrol
        </span>
    </a>
</body>
</html>
