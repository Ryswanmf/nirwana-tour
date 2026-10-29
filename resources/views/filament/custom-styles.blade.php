<style>
  /* Kustomisasi & Perapihan Tampilan Panel Admin & Login */
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

  /* Brand Logo & Heading Login */
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

  /* Tombol Submit */
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

  /* Sidebar Admin */
  .fi-sidebar-nav {
    font-size: 0.9rem !important;
  }

  .fi-sidebar-item-active .fi-sidebar-item-button {
    background-color: var(--primary-maroon-light) !important;
    color: var(--primary-maroon) !important;
    border-left: 3px solid var(--primary-maroon) !important;
    border-radius: 8px !important;
  }

  /* Form Inputs */
  .fi-input-wrp {
    border-radius: 10px !important;
  }
</style>
