<style>
  /* Kustomisasi & Perapihan Tampilan Panel Admin */
  :root {
    --primary-maroon: #800020;
    --primary-maroon-dark: #630018;
    --primary-maroon-light: #FFF5F7;
  }

  /* Card Login Bersih & Rapi */
  .fi-simple-page {
    background: radial-gradient(circle at 10% 20%, rgba(128, 0, 32, 0.04) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(128, 0, 32, 0.03) 0%, transparent 40%),
                #F8FAFC !important;
  }

  .fi-simple-main {
    border-radius: 20px !important;
    border: 1px solid rgba(226, 232, 240, 0.95) !important;
    box-shadow: 0 16px 36px -4px rgba(15, 23, 42, 0.08), 0 4px 12px rgba(128, 0, 32, 0.04) !important;
    background: #FFFFFF !important;
  }

  .fi-simple-header .fi-logo {
    margin-bottom: 8px;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.06));
  }

  .fi-simple-header h1 {
    font-size: 1.45rem !important;
    font-weight: 800 !important;
    letter-spacing: -0.3px !important;
    color: #0F172A !important;
  }

  .fi-simple-header p {
    font-size: 0.88rem !important;
    color: #64748B !important;
  }

  .fi-btn-primary {
    background-color: var(--primary-maroon) !important;
    border-radius: 10px !important;
    font-weight: 700 !important;
    transition: all 0.2s ease !important;
  }

  .fi-btn-primary:hover {
    background-color: var(--primary-maroon-dark) !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(128, 0, 32, 0.25) !important;
  }

  /* ========================================================
     PERAPIHAN SIDEBAR & HEADER PANEL ADMIN FILAMENT
     ======================================================== */
  /* Sidebar Border & Background */
  .fi-sidebar {
    border-right: 1px solid #E2E8F0 !important;
  }

  .dark .fi-sidebar {
    border-right-color: #1E293B !important;
  }

  /* Header Brand di Sidebar */
  .fi-sidebar-header {
    border-bottom: 1px solid #F1F5F9 !important;
  }

  .fi-sidebar-header .fi-logo {
    display: flex !important;
    align-items: center !important;
    height: 100% !important;
  }

  .nirwana-brand-logo-container {
    display: flex !important;
    align-items: center !important;
    gap: 0.65rem !important;
    white-space: nowrap !important;
    user-select: none !important;
    height: 100% !important;
  }

  .nirwana-brand-logo-img {
    height: 2.15rem !important;
    width: auto !important;
    object-fit: contain !important;
    flex-shrink: 0 !important;
    display: block !important;
  }

  .nirwana-brand-logo-text {
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.35rem !important;
    line-height: 1 !important;
  }

  .nirwana-brand-logo-text .brand-main {
    color: #0F172A !important;
    font-weight: 800 !important;
  }

  .dark .nirwana-brand-logo-text .brand-main {
    color: #FFFFFF !important;
  }

  .nirwana-brand-logo-text .brand-accent {
    color: #800020 !important;
    font-weight: 800 !important;
  }

  .dark .nirwana-brand-logo-text .brand-accent {
    color: #FFA3B2 !important;
  }

  .dark .fi-sidebar-header {
    border-bottom-color: #1E293B !important;
  }

  /* Judul Kategori / Group Navigasi yang Bersih & Rapi */
  .fi-sidebar-group-label {
    font-size: 0.7rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.06em !important;
    text-transform: uppercase !important;
    color: #64748B !important;
  }

  .dark .fi-sidebar-group-label {
    color: #94A3B8 !important;
  }

  /* Garis Pemisah Halus Antar Grup */
  .fi-sidebar-group + .fi-sidebar-group {
    margin-top: 1.25rem !important;
    padding-top: 0.85rem !important;
    border-top: 1px solid #F1F5F9 !important;
  }

  .dark .fi-sidebar-group + .fi-sidebar-group {
    border-top-color: #1E293B !important;
  }

  /* Menu Items Hover & Active */
  .fi-sidebar-item-button {
    border-radius: 8px !important;
    font-size: 0.88rem !important;
    font-weight: 500 !important;
    transition: background-color 0.15s ease, color 0.15s ease !important;
  }

  .fi-sidebar-item-active .fi-sidebar-item-button {
    background-color: rgba(128, 0, 32, 0.08) !important;
    color: var(--primary-maroon) !important;
    font-weight: 700 !important;
  }

  .dark .fi-sidebar-item-active .fi-sidebar-item-button {
    background-color: rgba(128, 0, 32, 0.25) !important;
    color: #FFA3B2 !important;
  }

  .fi-sidebar-item-active .fi-sidebar-item-icon {
    color: var(--primary-maroon) !important;
  }

  .dark .fi-sidebar-item-active .fi-sidebar-item-icon {
    color: #FFA3B2 !important;
  }

  /* Topbar Header */
  .fi-topbar {
    border-bottom: 1px solid #E2E8F0 !important;
  }

  .dark .fi-topbar {
    border-bottom-color: #1E293B !important;
  }

  /* Form Inputs */
  .fi-input-wrp {
    border-radius: 10px !important;
  }

  /* ========================================================
     KUSTOMISASI WIDGET WELCOME DASHBOARD
     ======================================================== */
  .nirwana-welcome-card {
    background: linear-gradient(135deg, #800020 0%, #5B0016 55%, #3B000E 100%) !important;
    color: #FFFFFF !important;
    border-radius: 1rem !important;
    padding: 1.5rem !important;
    position: relative !important;
    overflow: hidden !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    box-shadow: 0 12px 28px -6px rgba(128, 0, 32, 0.35) !important;
  }

  .nirwana-welcome-card * {
    -webkit-font-smoothing: antialiased;
  }

  .nirwana-badge-status {
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.4rem !important;
    padding: 0.25rem 0.75rem !important;
    border-radius: 9999px !important;
    background: rgba(255, 255, 255, 0.18) !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    color: #FEF08A !important; /* Gold / Amber terang */
    font-size: 0.75rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.02em !important;
  }

  .nirwana-date-text {
    color: #FFFFFF !important; /* Putih terang solid */
    font-size: 0.8rem !important;
    font-weight: 600 !important;
    opacity: 0.95 !important;
    letter-spacing: 0.01em !important;
  }

  .nirwana-pulse-dot {
    width: 0.5rem !important;
    height: 0.5rem !important;
    border-radius: 9999px !important;
    background-color: #34D399 !important; /* Hijau emerald aktif */
    box-shadow: 0 0 8px #34D399 !important;
    display: inline-block !important;
  }
</style>
