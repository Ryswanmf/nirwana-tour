<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sedang Dalam Pemeliharaan | {{ $settings['site_name'] ?? 'Nirwana Tour & Travel Lampung' }}</title>
  <meta name="description" content="Website Nirwana Tour Lampung sedang dalam pemeliharaan sistem berkala. Untuk pemesanan paket wisata dan informasi darurat, silakan hubungi CS WhatsApp kami.">
  <meta name="robots" content="noindex, nofollow">
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/Logo-Nirwana.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('assets/logo/Logo-Nirwana.png') }}">
  <meta name="theme-color" content="#DE0171">

  <!-- Font Google Plus Jakarta Sans & FontAwesome Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">

  <style>
    :root {
      --primary: #DE0171;
      --primary-hover: #be0160;
      --primary-light: rgba(222, 1, 113, 0.08);
      --primary-border: rgba(222, 1, 113, 0.2);
      --secondary: #0F172A;
      --slate-500: #64748B;
      --slate-600: #475569;
      --slate-700: #334155;
      --slate-800: #1E293B;
      --slate-100: #F1F5F9;
      --slate-200: #E2E8F0;
      --whatsapp: #25D366;
      --whatsapp-hover: #1eb857;
      --amber: #F59E0B;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: #F8FAFC;
      color: var(--secondary);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
      overflow-x: hidden;
      line-height: 1.6;
    }

    /* Background Dekorasi Ambient */
    .ambient-bg {
      position: fixed;
      inset: 0;
      pointer-events: none;
      z-index: 0;
      overflow: hidden;
    }

    .circle-1 {
      position: absolute;
      top: -10vw;
      right: -10vw;
      width: 45vw;
      height: 45vw;
      max-width: 600px;
      max-height: 600px;
      background: radial-gradient(circle, rgba(222, 1, 113, 0.12) 0%, rgba(222, 1, 113, 0) 70%);
      border-radius: 50%;
      filter: blur(40px);
    }

    .circle-2 {
      position: absolute;
      bottom: -10vw;
      left: -10vw;
      width: 50vw;
      height: 50vw;
      max-width: 650px;
      max-height: 650px;
      background: radial-gradient(circle, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0) 70%);
      border-radius: 50%;
      filter: blur(50px);
    }

    .grid-pattern {
      position: absolute;
      inset: 0;
      background-image: radial-gradient(rgba(148, 163, 184, 0.2) 1px, transparent 1px);
      background-size: 24px 24px;
      opacity: 0.7;
    }

    /* Container */
    .main-wrapper {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 860px;
      margin: 0 auto;
      padding: 40px 24px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      flex: 1;
      text-align: center;
    }

    /* Brand Header */
    .brand-logo-container {
      margin-bottom: 28px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .brand-logo {
      height: 60px;
      width: auto;
      object-fit: contain;
      filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.05));
    }

    .brand-fallback {
      font-size: 1.5rem;
      font-weight: 800;
      color: var(--secondary);
      letter-spacing: -0.5px;
    }
    .brand-fallback span {
      color: var(--primary);
    }

    /* Card Box */
    .card-container {
      background: #FFFFFF;
      border: 1px solid rgba(226, 232, 240, 0.9);
      border-radius: 28px;
      padding: 44px 36px;
      box-shadow: 0 20px 45px -15px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(255, 255, 255, 0.8) inset;
      backdrop-filter: blur(10px);
      width: 100%;
    }

    /* Icon Maintenance & Animations */
    .icon-wrapper {
      position: relative;
      display: inline-block;
      margin-bottom: 24px;
    }

    .icon-circle {
      width: 104px;
      height: 104px;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(222, 1, 113, 0.12) 0%, rgba(245, 158, 11, 0.15) 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
      border: 2px dashed rgba(222, 1, 113, 0.35);
      position: relative;
      animation: pulse-ring 3s infinite ease-in-out;
    }

    .icon-circle i {
      font-size: 2.8rem;
      color: var(--primary);
      animation: rotate-wrench 4s ease-in-out infinite alternate;
    }

    @keyframes rotate-wrench {
      0% { transform: rotate(-10deg); }
      100% { transform: rotate(15deg); }
    }

    @keyframes pulse-ring {
      0%, 100% {
        box-shadow: 0 0 0 0 rgba(222, 1, 113, 0.2);
        transform: scale(1);
      }
      50% {
        box-shadow: 0 0 0 16px rgba(222, 1, 113, 0);
        transform: scale(1.02);
      }
    }

    /* Status Badge */
    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #FFFBEB;
      color: #B45309;
      border: 1px solid #FDE68A;
      font-size: 0.84rem;
      font-weight: 700;
      padding: 6px 16px;
      border-radius: 999px;
      margin-bottom: 20px;
      letter-spacing: 0.3px;
    }

    .pulse-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background-color: #F59E0B;
      box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
      animation: dot-pulse 1.8s infinite;
    }

    @keyframes dot-pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
      }
      70% {
        box-shadow: 0 0 0 8px rgba(245, 158, 11, 0);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
      }
    }

    /* Headings & Texts */
    h1 {
      font-size: clamp(1.6rem, 3.8vw, 2.3rem);
      font-weight: 800;
      color: var(--secondary);
      line-height: 1.28;
      margin-bottom: 14px;
      letter-spacing: -0.5px;
    }

    .description {
      font-size: clamp(0.95rem, 1.8vw, 1.08rem);
      color: var(--slate-500);
      max-width: 620px;
      margin: 0 auto 28px;
      line-height: 1.65;
    }

    /* Custom Message Box (from artisan down --message) */
    .custom-message-box {
      background: var(--slate-100);
      border-left: 4px solid var(--primary);
      border-radius: 8px;
      padding: 14px 18px;
      max-width: 620px;
      margin: 0 auto 28px;
      text-align: left;
      font-size: 0.92rem;
      color: var(--slate-700);
      display: flex;
      align-items: flex-start;
      gap: 12px;
    }

    .custom-message-box i {
      color: var(--primary);
      margin-top: 3px;
      font-size: 1.1rem;
    }

    /* Quick Info Cards */
    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 16px;
      max-width: 720px;
      margin: 0 auto 36px;
      text-align: left;
    }

    .info-card {
      background: #F8FAFC;
      border: 1px solid var(--slate-200);
      border-radius: 16px;
      padding: 16px 18px;
      display: flex;
      align-items: center;
      gap: 14px;
      transition: all 0.2s ease;
    }

    .info-card:hover {
      border-color: var(--primary-border);
      background: #FFFFFF;
      box-shadow: 0 6px 16px rgba(15, 23, 42, 0.05);
    }

    .info-card-icon {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: var(--primary-light);
      color: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      flex-shrink: 0;
    }

    .info-card-title {
      font-size: 0.82rem;
      color: var(--slate-500);
      font-weight: 600;
      margin-bottom: 2px;
    }

    .info-card-value {
      font-size: 0.95rem;
      color: var(--secondary);
      font-weight: 700;
      text-decoration: none;
    }

    /* Action Buttons */
    .actions-container {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 14px;
      flex-wrap: wrap;
      margin-bottom: 12px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      font-size: 0.95rem;
      font-weight: 700;
      padding: 13px 26px;
      border-radius: 14px;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.25s ease;
      border: none;
      font-family: inherit;
    }

    .btn-whatsapp {
      background: var(--whatsapp);
      color: #FFFFFF;
      box-shadow: 0 8px 20px rgba(37, 211, 102, 0.3);
    }
    .btn-whatsapp:hover {
      background: var(--whatsapp-hover);
      transform: translateY(-2px);
      box-shadow: 0 12px 24px rgba(37, 211, 102, 0.4);
    }

    .btn-refresh {
      background: var(--slate-100);
      color: var(--slate-800);
      border: 1px solid var(--slate-200);
    }
    .btn-refresh:hover {
      background: var(--slate-200);
      transform: translateY(-2px);
    }

    /* Auto Reload Indicator */
    .reload-note {
      font-size: 0.82rem;
      color: var(--slate-500);
      margin-top: 14px;
    }

    /* Footer */
    footer {
      position: relative;
      z-index: 10;
      text-align: center;
      padding: 24px 20px;
      font-size: 0.85rem;
      color: var(--slate-500);
      border-top: 1px solid rgba(226, 232, 240, 0.8);
    }

    .social-links {
      display: flex;
      justify-content: center;
      gap: 16px;
      margin-bottom: 12px;
    }

    .social-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #FFFFFF;
      border: 1px solid var(--slate-200);
      color: var(--slate-600);
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      font-size: 0.95rem;
      transition: all 0.2s ease;
    }

    .social-icon:hover {
      background: var(--primary);
      color: #FFFFFF;
      border-color: var(--primary);
      transform: translateY(-2px);
    }

    @media (max-width: 640px) {
      .card-container {
        padding: 32px 20px;
        border-radius: 20px;
      }
      .actions-container {
        flex-direction: column;
        width: 100%;
      }
      .btn {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <!-- Ambient decorative background -->
  <div class="ambient-bg">
    <div class="grid-pattern"></div>
    <div class="circle-1"></div>
    <div class="circle-2"></div>
  </div>

  <!-- Main Content Wrapper -->
  <main class="main-wrapper">

    <!-- Logo / Brand Header -->
    <div class="brand-logo-container">
      @if(file_exists(public_path('assets/logo/Logo-Nirwana.png')))
        <img src="{{ asset('assets/logo/Logo-Nirwana.png') }}" alt="Logo Nirwana Tour Lampung" class="brand-logo">
      @else
        <div class="brand-fallback">NIRWANA <span>TOUR LAMPUNG</span></div>
      @endif
    </div>

    <!-- Card Container -->
    <div class="card-container">
      
      <!-- Icon Graphic -->
      <div class="icon-wrapper">
        <div class="icon-circle">
          <i class="fa-solid fa-compass-drafting"></i>
        </div>
      </div>

      <!-- Badge Status -->
      <div>
        <span class="status-badge">
          <span class="pulse-dot"></span>
          Pemeliharaan Sistem Sedang Berlangsung
        </span>
      </div>

      <!-- Title & Main Description -->
      <h1>Kami Sedang Mempersiapkan Pengalaman Wisata yang Lebih Baik</h1>
      <p class="description">
        Website <strong>Nirwana Tour & Travel Lampung</strong> sedang melakukan pembaruan berkala untuk peningkatan kecepatan, kenyamanan reservasi paket wisata, dan stabilitas server. Kami akan segera kembali online!
      </p>

      @php
        $customMsg = null;
        if (isset($exception) && is_object($exception) && method_exists($exception, 'getMessage')) {
          $customMsg = trim($exception->getMessage());
        }
      @endphp

      @if(!empty($customMsg))
        <div class="custom-message-box">
          <i class="fa-solid fa-circle-info"></i>
          <div>
            <strong>Catatan Tim Teknis:</strong><br>
            <span>{{ $customMsg }}</span>
          </div>
        </div>
      @endif

      <!-- Fast Contact Info Cards -->
      @php
        $rawWa = $settings['whatsapp_number'] ?? '082269616188';
        $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);
        if (str_starts_with($cleanWa, '0')) {
          $cleanWa = '62' . substr($cleanWa, 1);
        }
        $contactPhone = $settings['phone'] ?? '0822-6961-6188';
        $contactEmail = $settings['email'] ?? 'info@nirwanatourlampung.com';
      @endphp

      <div class="info-grid">
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fa-solid fa-clock"></i>
          </div>
          <div>
            <div class="info-card-title">Status Pemeliharaan</div>
            <div class="info-card-value">Tahap Optimasi Server</div>
          </div>
        </div>

        <div class="info-card">
          <div class="info-card-icon">
            <i class="fa-solid fa-headset"></i>
          </div>
          <div>
            <div class="info-card-title">Layanan Reservasi & CS</div>
            <div class="info-card-value" style="color: #16A34A;">Tetap Aktif 24 Jam</div>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="actions-container">
        <!-- WhatsApp CTA -->
        <a href="https://wa.me/{{ $cleanWa }}?text={{ rawurlencode('Halo CS Nirwana Tour Lampung, saya ingin menanyakan informasi & reservasi paket wisata selama website sedang dalam pemeliharaan.') }}" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="btn btn-whatsapp">
          <i class="fa-brands fa-whatsapp" style="font-size: 1.25rem;"></i>
          <span>Konsultasi / Booking via WhatsApp</span>
        </a>

        <!-- Reload Button -->
        <button type="button" class="btn btn-refresh" onclick="refreshPage()">
          <i class="fa-solid fa-rotate-right" id="refresh-icon"></i>
          <span id="refresh-text">Cek Status Website</span>
        </button>
      </div>

      <div class="reload-note">
        Halaman akan otomatis memeriksa status kembali dalam <span id="countdown-timer" style="font-weight: 700; color: var(--primary);">60</span> detik.
      </div>

    </div>

  </main>

  <!-- Footer -->
  <footer>
    <div class="social-links">
      <a href="{{ $settings['instagram'] ?? 'https://www.instagram.com/nirwana_tourlampung/' }}" target="_blank" rel="noopener noreferrer" class="social-icon" title="Instagram Nirwana Tour">
        <i class="fa-brands fa-instagram"></i>
      </a>
      <a href="{{ $settings['tiktok'] ?? 'https://www.tiktok.com/@nirwana_tour_travel' }}" target="_blank" rel="noopener noreferrer" class="social-icon" title="TikTok Nirwana Tour">
        <i class="fa-brands fa-tiktok"></i>
      </a>
      <a href="https://wa.me/{{ $cleanWa }}" target="_blank" rel="noopener noreferrer" class="social-icon" title="WhatsApp Nirwana Tour">
        <i class="fa-brands fa-whatsapp"></i>
      </a>
      <a href="mailto:{{ $contactEmail }}" class="social-icon" title="Email Resmi Nirwana Tour">
        <i class="fa-solid fa-envelope"></i>
      </a>
    </div>
    <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Nirwana Tour & Travel Lampung' }}. All rights reserved.</p>
  </footer>

  <script>
    // Countdown Timer & Auto-Reload
    let secondsLeft = 60;
    const timerElement = document.getElementById('countdown-timer');
    const refreshIcon = document.getElementById('refresh-icon');

    const countdownInterval = setInterval(() => {
      secondsLeft--;
      if (timerElement) {
        timerElement.innerText = secondsLeft;
      }
      if (secondsLeft <= 0) {
        clearInterval(countdownInterval);
        refreshPage();
      }
    }, 1000);

    function refreshPage() {
      if (refreshIcon) {
        refreshIcon.classList.add('fa-spin');
      }
      const refreshText = document.getElementById('refresh-text');
      if (refreshText) {
        refreshText.innerText = 'Memeriksa...';
      }
      setTimeout(() => {
        window.location.reload();
      }, 500);
    }
  </script>
</body>
</html>
