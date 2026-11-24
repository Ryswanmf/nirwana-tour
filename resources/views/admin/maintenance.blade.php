<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="#DE0171">
  <title>Kontrol Mode Maintenance | Nirwana Tour Lampung Admin</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/Logo-Nirwana.png') }}">

  <!-- Google Fonts: Plus Jakarta Sans & Font Awesome 6 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">

  <style>
    :root {
      --primary: #DE0171;
      --primary-hover: #c40163;
      --slate-50: #F8FAFC;
      --slate-100: #F1F5F9;
      --slate-200: #E2E8F0;
      --slate-300: #CBD5E1;
      --slate-600: #475569;
      --slate-700: #334155;
      --slate-800: #1E293B;
      --slate-900: #0F172A;
      --emerald: #10B981;
      --emerald-dark: #059669;
      --rose: #EF4444;
      --rose-dark: #DC2626;
      --amber: #F59E0B;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
      background-color: var(--slate-50);
      color: var(--slate-800);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      line-height: 1.5;
    }

    /* Topbar */
    header {
      background: #FFFFFF;
      border-bottom: 1px solid var(--slate-200);
      padding: 16px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 50;
      box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }

    .brand-wrap {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .brand-logo {
      width: 38px;
      height: 38px;
      object-fit: contain;
    }

    .brand-title {
      font-size: 1.05rem;
      font-weight: 800;
      color: var(--slate-900);
      letter-spacing: -0.3px;
    }
    .brand-title span {
      color: var(--primary);
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .btn-nav {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 16px;
      border-radius: 10px;
      font-size: 0.85rem;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
      border: 1px solid var(--slate-200);
      color: var(--slate-700);
      background: #FFFFFF;
    }
    .btn-nav:hover {
      border-color: var(--slate-300);
      background: var(--slate-100);
    }

    /* Main Container */
    main {
      flex: 1;
      max-width: 920px;
      width: 100%;
      margin: 36px auto;
      padding: 0 20px;
    }

    /* Breadcrumbs & Title */
    .page-header {
      margin-bottom: 28px;
    }

    .breadcrumbs {
      font-size: 0.85rem;
      color: var(--slate-600);
      margin-bottom: 8px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .breadcrumbs a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
    }

    h1 {
      font-size: 1.75rem;
      font-weight: 800;
      color: var(--slate-900);
      letter-spacing: -0.5px;
    }

    .subtitle {
      color: var(--slate-600);
      font-size: 0.95rem;
      margin-top: 4px;
    }

    /* Flash Message */
    .alert-box {
      border-radius: 14px;
      padding: 16px 20px;
      margin-bottom: 24px;
      display: flex;
      align-items: flex-start;
      gap: 14px;
      font-size: 0.92rem;
      font-weight: 600;
      box-shadow: 0 2px 6px rgba(0,0,0,0.03);
    }

    .alert-success {
      background: #ECFDF5;
      border: 1px solid #A7F3D0;
      color: #065F46;
    }
    .alert-success i {
      color: var(--emerald);
      font-size: 1.3rem;
      margin-top: 2px;
    }

    .alert-error {
      background: #FEF2F2;
      border: 1px solid #FECACA;
      color: #991B1B;
    }
    .alert-error i {
      color: var(--rose);
      font-size: 1.3rem;
      margin-top: 2px;
    }

    /* Main Card */
    .card {
      background: #FFFFFF;
      border: 1px solid var(--slate-200);
      border-radius: 20px;
      padding: 32px;
      box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
      margin-bottom: 28px;
    }

    /* Status Header Badge */
    .status-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
      padding-bottom: 24px;
      border-bottom: 1px solid var(--slate-200);
      margin-bottom: 28px;
    }

    .status-indicator {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-size: 0.95rem;
      font-weight: 700;
      padding: 8px 18px;
      border-radius: 999px;
    }

    .status-online {
      background: #ECFDF5;
      color: var(--emerald-dark);
      border: 1px solid #A7F3D0;
    }

    .status-down {
      background: #FEF2F2;
      color: var(--rose-dark);
      border: 1px solid #FECACA;
    }

    .pulse-dot-green {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--emerald);
      box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.6);
      animation: pulse-green 1.8s infinite;
    }

    .pulse-dot-red {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--rose);
      box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.6);
      animation: pulse-red 1.8s infinite;
    }

    @keyframes pulse-green {
      0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
      70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
      100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    @keyframes pulse-red {
      0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
      70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
      100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }

    /* Form & Controls */
    .form-group {
      margin-bottom: 22px;
    }

    .form-label {
      display: block;
      font-size: 0.9rem;
      font-weight: 700;
      color: var(--slate-900);
      margin-bottom: 8px;
    }

    .form-desc {
      font-size: 0.82rem;
      color: var(--slate-600);
      margin-top: 5px;
    }

    .form-input {
      width: 100%;
      padding: 12px 16px;
      border: 1.5px solid var(--slate-200);
      border-radius: 12px;
      font-size: 0.92rem;
      font-family: inherit;
      color: var(--slate-900);
      outline: none;
      transition: border-color 0.2s ease;
      background: #FFFFFF;
    }
    .form-input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(222, 1, 113, 0.1);
    }

    /* Action Buttons */
    .btn-toggle-down {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);
      color: #FFFFFF;
      border: none;
      padding: 14px 28px;
      border-radius: 14px;
      font-size: 1rem;
      font-weight: 800;
      cursor: pointer;
      box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
      transition: all 0.25s ease;
      font-family: inherit;
    }
    .btn-toggle-down:hover {
      background: linear-gradient(135deg, #B91C1C 0%, #991B1B 100%);
      transform: translateY(-2px);
      box-shadow: 0 12px 24px rgba(220, 38, 38, 0.4);
    }

    .btn-toggle-up {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      background: linear-gradient(135deg, #10B981 0%, #059669 100%);
      color: #FFFFFF;
      border: none;
      padding: 14px 28px;
      border-radius: 14px;
      font-size: 1rem;
      font-weight: 800;
      cursor: pointer;
      box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
      transition: all 0.25s ease;
      font-family: inherit;
    }
    .btn-toggle-up:hover {
      background: linear-gradient(135deg, #059669 0%, #047857 100%);
      transform: translateY(-2px);
      box-shadow: 0 12px 24px rgba(16, 185, 129, 0.4);
    }

    /* Info Highlights */
    .info-callout {
      background: var(--slate-50);
      border: 1px solid var(--slate-200);
      border-radius: 14px;
      padding: 18px 20px;
      margin-top: 24px;
      font-size: 0.88rem;
      color: var(--slate-700);
    }
    .info-callout h4 {
      font-size: 0.92rem;
      font-weight: 700;
      color: var(--slate-900);
      margin-bottom: 6px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .info-callout ul {
      padding-left: 20px;
      margin-top: 8px;
    }
    .info-callout li {
      margin-bottom: 4px;
    }

    .secret-box {
      background: #FFFFFF;
      border: 1px dashed var(--slate-300);
      border-radius: 10px;
      padding: 10px 14px;
      font-family: monospace;
      font-size: 0.95rem;
      color: var(--primary);
      font-weight: 700;
      display: inline-block;
      margin-top: 6px;
      word-break: break-all;
    }
  </style>
</head>
<body>

  <!-- Topbar Header -->
  <header>
    <div class="brand-wrap">
      <img src="{{ asset('assets/logo/Logo-Nirwana.png') }}" alt="Logo Nirwana Tour" class="brand-logo">
      <div class="brand-title">NIRWANA <span>ADMIN</span></div>
    </div>
    <div class="nav-actions">
      <a href="{{ route('maintenance.preview') }}" target="_blank" class="btn-nav">
        <i class="fa-solid fa-eye text-[#DE0171]"></i>
        <span>Preview Halaman 503</span>
      </a>
      <a href="/" target="_blank" class="btn-nav">
        <i class="fa-solid fa-globe"></i>
        <span>Lihat Web Publik</span>
      </a>
      <a href="/admin" class="btn-nav" style="background: var(--primary); color: #FFFFFF; border-color: var(--primary);">
        <i class="fa-solid fa-gauge"></i>
        <span>Kembali ke Dashboard</span>
      </a>
    </div>
  </header>

  <!-- Main Content Area -->
  <main>
    <div class="page-header">
      <div class="breadcrumbs">
        <a href="/admin"><i class="fa-solid fa-house"></i> Dashboard</a>
        <span>/</span>
        <span>Mode Maintenance</span>
      </div>
      <h1>Tombol & Kontrol Mode Maintenance</h1>
      <p class="subtitle">Gunakan tombol ini untuk mengalihkan website ke halaman perbaikan (503) dengan 1 kali klik.</p>
    </div>

    <!-- Flash Notification -->
    @if(session('success'))
      <div class="alert-box alert-success">
        <i class="fa-solid fa-circle-check"></i>
        <div>{{ session('success') }}</div>
      </div>
    @endif

    @if(session('error'))
      <div class="alert-box alert-error">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <div>{{ session('error') }}</div>
      </div>
    @endif

    <!-- Card Status & Action -->
    <div class="card">
      <div class="status-container">
        <div>
          <div style="font-size: 0.85rem; color: var(--slate-600); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Status Saat Ini</div>
          @if(!$isDown)
            <div class="status-indicator status-online">
              <span class="pulse-dot-green"></span>
              <span>WEBSITE ONLINE NORMAL</span>
            </div>
          @else
            <div class="status-indicator status-down">
              <span class="pulse-dot-red"></span>
              <span>MODE MAINTENANCE AKTIF (PENGUNJUNG MELIHAT 503)</span>
            </div>
          @endif
        </div>

        <a href="{{ route('maintenance.preview') }}" target="_blank" style="font-size: 0.85rem; font-weight: 700; color: var(--primary); text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
          <i class="fa-solid fa-arrow-up-right-from-square"></i> Cek Tampilan Halaman Maintenance
        </a>
      </div>

      <!-- Action Form -->
      @if(!$isDown)
        <!-- Form untuk Mengaktifkan Maintenance -->
        <form action="{{ route('admin.maintenance.toggle') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengaktifkan MODE MAINTENANCE? Pengunjung umum akan melihat halaman pemeliharaan sementara Anda tetap dapat membuka dashboard admin.');">
          @csrf
          <input type="hidden" name="action" value="enable">

          <div class="form-group">
            <label class="form-label" for="secret">Kunci Rahasia Bypass (Bypass Secret Token):</label>
            <input type="text" id="secret" name="secret" value="nirwana2026" class="form-input" placeholder="misal: nirwana2026" required>
            <p class="form-desc">
              Token ini memungkinkan Anda atau tim internal melihat tampilan frontend seperti biasa saat maintenance aktif dengan membuka alamat: 
              <code>{{ url('/') }}/<strong>[kunci-rahasia]</strong></code>.
            </p>
          </div>

          <div style="margin-top: 28px;">
            <button type="submit" class="btn-toggle-down">
              <i class="fa-solid fa-power-off"></i>
              <span>AKTIFKAN MODE MAINTENANCE SEKARANG</span>
            </button>
          </div>
        </form>
      @else
        <!-- Form untuk Mematikan Maintenance (Kembali Online) -->
        <div style="background: #FEF2F2; border: 1px dashed #FCA5A5; border-radius: 14px; padding: 20px; margin-bottom: 24px;">
          <h3 style="color: #991B1B; font-size: 1.1rem; font-weight: 800; margin-bottom: 8px;">
            <i class="fa-solid fa-triangle-exclamation"></i> Website Sedang Dalam Pemeliharaan
          </h3>
          <p style="color: #7F1D1D; font-size: 0.92rem; line-height: 1.6;">
            Seluruh pengunjung umum saat ini melihat halaman pemeliharaan (503). Halaman admin tetap aman dan bisa Anda akses karena telah dikecualikan secara otomatis.
          </p>

          @php
            $secret = $maintenanceData['secret'] ?? null;
          @endphp
          @if(!empty($secret))
            <div style="margin-top: 14px;">
              <span style="font-size: 0.82rem; font-weight: 700; color: #991B1B; display: block;">Tautan Bypass Khusus Tim Internal:</span>
              <div class="secret-box">{{ url('/' . $secret) }}</div>
            </div>
          @endif
        </div>

        <form action="{{ route('admin.maintenance.toggle') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin MEMATIKAN mode maintenance? Website akan kembali ONLINE dan bisa diakses publik.');">
          @csrf
          <input type="hidden" name="action" value="disable">

          <div>
            <button type="submit" class="btn-toggle-up">
              <i class="fa-solid fa-globe"></i>
              <span>MATIKAN MAINTENANCE & ONLINE-KAN WEBSITE</span>
            </button>
          </div>
        </form>
      @endif

      <!-- Info Callout -->
      <div class="info-callout">
        <h4><i class="fa-solid fa-shield-halved text-[#DE0171]"></i> Informasi Penting & Keamanan:</h4>
        <ul>
          <li><strong>Panel Admin Tidak Terkunci:</strong> Rute <code>/admin</code> dan seluruh fitur admin telah dikecualikan di middleware Laravel, sehingga Anda tetap bisa menambah paket wisata, mengedit profil, dan mematikan maintenance kapan saja.</li>
          <li><strong>Koneksi Reservasi CS Tetap Aktif:</strong> Halaman maintenance yang tampil di hadapan pengunjung memiliki tombol WhatsApp Customer Service, telepon, dan sosial media resmi Nirwana Tour.</li>
          <li><strong>SEO Terjaga:</strong> Laravel mengirimkan kode status resmi <code>HTTP 503 Service Unavailable</code> yang memberi sinyal kepada Google/mesin pencari untuk tidak menurunkan ranking SEO website selama pemeliharaan.</li>
        </ul>
      </div>

    </div>
  </main>

</body>
</html>
