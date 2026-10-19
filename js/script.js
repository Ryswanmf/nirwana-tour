/**
 * NIRWANA TOUR LAMPUNG - OFFICIAL SCRIPT
 * Single Page Navigation, Lightbox Gallery, Destination Filter,
 * Itinerary Rundown Modal, Interactive Budget Estimator, FAQ Accordion, and WhatsApp Conversions.
 */

document.addEventListener('DOMContentLoaded', () => {
  // ========================================================
  // 1. CONFIGURATION
  // ========================================================
  const CONFIG = {
    whatsappNumber: '6282178901234',
    defaultWaMessage: 'Halo Nirwana Tour, saya ingin konsultasi perjalanan.',
    headerOffset: 75
  };

  /**
   * Helper untuk membuat URL WhatsApp resmi
   */
  function buildWhatsAppUrl(message) {
    const text = encodeURIComponent(message || CONFIG.defaultWaMessage);
    return `https://wa.me/${CONFIG.whatsappNumber}?text=${text}`;
  }

  // ========================================================
  // 2. WHATSAPP CONVERSION LINKS
  // ========================================================
  function initWhatsAppButtons() {
    const waButtons = document.querySelectorAll('.wa-link-btn');
    waButtons.forEach(btn => {
      const customMsg = btn.getAttribute('data-wa-msg') || CONFIG.defaultWaMessage;
      const waUrl = buildWhatsAppUrl(customMsg);
      btn.setAttribute('href', waUrl);
      btn.setAttribute('target', '_blank');
      btn.setAttribute('rel', 'noopener noreferrer');
    });
  }
  initWhatsAppButtons();

  // Handle Contact Form to WhatsApp
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const name = document.getElementById('formName')?.value.trim() || '-';
      const phone = document.getElementById('formPhone')?.value.trim() || '-';
      const service = document.getElementById('formService')?.value || '-';
      const details = document.getElementById('formParticipants')?.value.trim() || '-';
      const notes = document.getElementById('formNotes')?.value.trim() || '-';

      const waMessage = 
`Halo Nirwana Tour Lampung, saya ingin mengajukan penawaran/konsultasi perjalanan:

• *Nama/Instansi*: ${name}
• *Nomor Kontak*: ${phone}
• *Pilihan Layanan*: ${service}
• *Jumlah Peserta & Tanggal*: ${details}
• *Catatan Tambahan*: ${notes}

Mohon informasi ketersediaan jadwal dan estimasi biayanya. Terima kasih!`;

      const targetUrl = buildWhatsAppUrl(waMessage);
      window.open(targetUrl, '_blank', 'noopener,noreferrer');
    });
  }

  // ========================================================
  // 3. STICKY NAVBAR & ACTIVE SCROLL HIGHLIGHT
  // ========================================================
  const header = document.getElementById('header');
  const backToTopBtn = document.getElementById('backToTop');
  const navLinks = document.querySelectorAll('.nav-link');
  const sections = document.querySelectorAll('section[id], header[id]');

  function handleScroll() {
    const scrollPos = window.scrollY || window.pageYOffset;

    if (scrollPos > 40) {
      header?.classList.add('scrolled');
    } else {
      header?.classList.remove('scrolled');
    }

    if (scrollPos > 400) {
      backToTopBtn?.classList.add('show');
    } else {
      backToTopBtn?.classList.remove('show');
    }

    let currentSectionId = '';
    sections.forEach(section => {
      const sectionTop = section.offsetTop - CONFIG.headerOffset - 50;
      const sectionHeight = section.offsetHeight;
      if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
        currentSectionId = section.getAttribute('id');
      }
    });

    if (currentSectionId) {
      navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && href.startsWith('#')) {
          if (href === `#${currentSectionId}`) {
            link.classList.add('active');
          } else {
            link.classList.remove('active');
          }
        }
      });
    }
  }

  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll();

  if (backToTopBtn) {
    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

  // ========================================================
  // 4. MOBILE HAMBURGER MENU
  // ========================================================
  const navToggle = document.getElementById('navToggle');
  const navMenu = document.getElementById('navMenu');

  if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
      const isOpen = navMenu.classList.contains('open');
      if (isOpen) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
    });

    function openMobileMenu() {
      navMenu.classList.add('open');
      navToggle.classList.add('active');
      navToggle.setAttribute('aria-expanded', 'true');
    }

    function closeMobileMenu() {
      navMenu.classList.remove('open');
      navToggle.classList.remove('active');
      navToggle.setAttribute('aria-expanded', 'false');
    }

    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        closeMobileMenu();
      });
    });

    document.addEventListener('click', (e) => {
      if (!navMenu.contains(e.target) && !navToggle.contains(e.target) && navMenu.classList.contains('open')) {
        closeMobileMenu();
      }
    });
  }

  // ========================================================
  // 5. SMOOTH SCROLL FOR ANCHOR LINKS
  // ========================================================
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#' || targetId === '') return;

      const targetEl = document.querySelector(targetId);
      if (targetEl) {
        e.preventDefault();
        const elementPosition = targetEl.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - CONFIG.headerOffset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

  // ========================================================
  // 6. FILTER KATEGORI DESTINASI (TAB FILTER)
  // ========================================================
  const filterBtns = document.querySelectorAll('.dest-filter-btn');
  const destCards = document.querySelectorAll('.dest-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-selected', 'false');
      });
      btn.classList.add('active');
      btn.setAttribute('aria-selected', 'true');

      const filterValue = btn.getAttribute('data-filter');

      destCards.forEach(card => {
        const categories = (card.getAttribute('data-category') || '').split(' ');
        if (filterValue === 'all' || categories.includes(filterValue)) {
          card.classList.remove('hide');
        } else {
          card.classList.add('hide');
        }
      });
    });
  });

  // ========================================================
  // 7. MODAL DETAIL ITINERARY & RUNDOWN PERJALANAN
  // ========================================================
  const ITINERARY_DATABASE = {
    'pahawang': {
      title: 'Paket Wisata Pulau Pahawang & Kelagian',
      category: 'Wisata Bahari & Snorkeling',
      duration: '1 Hari (One Day Tour) / 2 Hari 1 Malam',
      priceDisplay: 'Rp175.000 / pax',
      waMessage: 'Halo Nirwana Tour, saya ingin konsultasi dan pesan Paket Wisata Pulau Pahawang.',
      timeline: [
        { time: '06.30 - 07.30', desc: 'Meeting point di Dermaga Ketapang Pesawaran (atau penjemputan Bandar Lampung)' },
        { time: '07.30 - 08.15', desc: 'Briefing keselamatan, pembagian pelampung (life jacket), berlayar ke Pulau Kelagian Kecil' },
        { time: '08.15 - 09.30', desc: 'Sesi foto pantai pasir putih & pemanasan snorkeling di perairan jernih Kelagian' },
        { time: '09.30 - 11.30', desc: 'Snorkeling di Cukuh Bedil & Taman Nemo (foto underwater eksklusif bersama ikan badut)' },
        { time: '11.30 - 13.00', desc: 'Makan siang prasmanan masakan laut khas di Pulau Pahawang Besar & ibadah' },
        { time: '13.00 - 14.30', desc: 'Snorkeling di Gosong Bekri (spot transplantasi terumbu karang dan candi mini)' },
        { time: '14.30 - 15.30', desc: 'Menikmati fenomena Pasir Timbul Pahawang Kecil dan relaksasi kelapa muda' },
        { time: '15.30 - 16.30', desc: 'Perjalanan kembali ke Dermaga Ketapang, bilas air tawar, dan trip selesai dengan kesan manis' }
      ],
      includes: [
        'Sewa kapal jelajah pulau private/gabungan',
        'Pelampung (life jacket) berstandar',
        'Set alat snorkeling (kacamata & snorkel)',
        'Makan siang prasmanan & air mineral',
        'Tiket retribusi pulau & spot snorkeling',
        'Tour Leader & pemandu lokal berlisensi',
        'Dokumentasi kamera underwater & darat',
        'Kotak P3K & asuransi perjalanan pelayaran'
      ],
      excludes: [
        'Transportasi PP ke meeting point Dermaga (tersedia opsi add-on)',
        'Water sport opsional seperti banana boat / donat boat',
        'Pengeluaran pribadi wisatawan & tips sukarela'
      ]
    },
    'kiluan': {
      title: 'Safari Lumba-Lumba Teluk Kiluan & Laguna Gayau',
      category: 'Dolphin Safari & Bahari',
      duration: '2 Hari 1 Malam',
      priceDisplay: 'Rp450.000 / pax',
      waMessage: 'Halo Nirwana Tour, saya tertarik dengan Paket Dolphin Safari Teluk Kiluan 2H1M.',
      timeline: [
        { time: 'Hari 1 (12.00 - 16.00)', desc: 'Penjemputan di Bandar Lampung, perjalanan melintasi perbukitan asri Tanggamus menuju Teluk Kiluan' },
        { time: 'Hari 1 (16.00 - 18.00)', desc: 'Check-in homestay tepi pantai, trekking santai dan berenang di kolam alami Laguna Gayau' },
        { time: 'Hari 1 (19.00 - 21.00)', desc: 'Makan malam santap ikan bakar segar bersama rombongan, ramah tamah, dan istirahat' },
        { time: 'Hari 2 (05.30 - 09.00)', desc: 'Sunrise dolphin hunting: berlayar menggunakan jukung tradisional menyapa kawanan lumba-lumba liar di laut lepas' },
        { time: 'Hari 2 (09.00 - 11.00)', desc: 'Singgah di Pulau Kelapa, sarapan pagi, bersih-bersih dan persiapan check-out homestay' },
        { time: 'Hari 2 (11.00 - 15.00)', desc: 'Perjalanan kembali ke Bandar Lampung, mampir belanja oleh-oleh khas Lampung' }
      ],
      includes: [
        'Transportasi AC PP Bandar Lampung - Kiluan',
        'Akomodasi homestay bersih dan nyaman view pantai',
        'Sewa jukung tradisional dolphin tour',
        'Life jacket keselamatan pelayaran',
        'Makan 3 kali prasmanan + air mineral',
        'Tiket masuk Laguna Gayau & Pulau Kelapa',
        'Tour Leader pendamping berpengalaman',
        'Dokumentasi perjalanan foto kamera'
      ],
      excludes: [
        'Pengeluaran pribadi di luar paket',
        'Tips pemandu jukung & kru seikhlasnya'
      ]
    },
    'gigi-hiu': {
      title: 'Geowisata Sunrise Pantai Gigi Hiu (Pegadungan)',
      category: 'Geowisata & Petualangan',
      duration: '1 Hari (Sunrise Expedition)',
      priceDisplay: 'Rp375.000 / pax',
      waMessage: 'Halo Nirwana Tour, saya ingin booking Paket Geowisata Pantai Gigi Hiu.',
      timeline: [
        { time: '00.30 - 04.30', desc: 'Penjemputan tengah malam di Bandar Lampung, perjalanan darat menuju Kelumbayan Tanggamus' },
        { time: '04.30 - 05.00', desc: 'Transit pos ojek lokal / shuttle 4x4 untuk akses medan menuju pantai' },
        { time: '05.00 - 07.30', desc: 'Menyaksikan golden sunrise di antara gugusan tebing karang runcing tajam yang ikonik di bibir Samudera Hindia' },
        { time: '07.30 - 09.00', desc: 'Sarapan pagi boks, bersantai di gazebo, sesi foto kreatif sudut tebing' },
        { time: '09.00 - 13.00', desc: 'Perjalanan pulang ke Bandar Lampung, singgah makan siang lokal & beli kripik pisang khas Lampung' }
      ],
      includes: [
        'Kendaraan pariwisata AC PP Bandar Lampung',
        'Ojek lokal / shuttle pengantar ke bibir pantai',
        'Tiket masuk objek wisata Pantai Gigi Hiu',
        'Sarapan pagi boks & air mineral',
        'Tour guide pendamping bersertifikat',
        'Dokumentasi foto kamera DSLR landscape',
        'P3K darurat'
      ],
      excludes: [
        'Pengeluaran pribadi & jajan tambahan',
        'Alat dokumentasi drone pribadi (opsional add-on)'
      ]
    },
    'way-kambas': {
      title: 'Ekowisata & Konservasi TN Way Kambas',
      category: 'Edukasi & Konservasi',
      duration: '1 Hari Tour Edukasi',
      priceDisplay: 'Rp250.000 / pax',
      waMessage: 'Halo Nirwana Tour, saya ingin informasi Paket Edukasi TN Way Kambas.',
      timeline: [
        { time: '07.00 - 09.00', desc: 'Penjemputan di sekolah/kantor Bandar Lampung, meluncur ke Labuhan Ratu Lampung Timur' },
        { time: '09.00 - 10.30', desc: 'Tiba di Pusat Pelatihan Gajah (PLG), sesi edukasi bersama mahout (pawang gajah)' },
        { time: '10.30 - 12.00', desc: 'Interaksi memandikan gajah di sungai, memberi makan buah segar, dan berfoto bersama' },
        { time: '12.00 - 13.30', desc: 'Makan siang prasmanan khas daerah & istirahat salat' },
        { time: '13.30 - 15.00', desc: 'Safari hutan / jungle track mengamati keanekaragaman hayati ekosistem Way Kambas' },
        { time: '15.00 - 17.00', desc: 'Perjalanan kembali menuju Bandar Lampung dengan selamat' }
      ],
      includes: [
        'Armada bus pariwisata / HiAce AC PP',
        'Tiket SIMAKSI masuk Taman Nasional Way Kambas',
        'Retribusi atraksi interaksi & edukasi gajah',
        'Fasilitator edukasi & guide taman nasional',
        'Makan siang prasmanan & snack box',
        'Banner kegiatan rombongan',
        'P3K & asuransi keselamatan perjalanan'
      ],
      excludes: [
        'Makanan gajah pribadi (bisa beli di lokasi)',
        'Pengeluaran pribadi di luar paket'
      ]
    },
    'krakatau': {
      title: 'Ekspedisi Vulkanik Krakatau & Pulau Sebesi',
      category: 'Ekspedisi Geologi & Bahari',
      duration: '2 Hari 1 Malam',
      priceDisplay: 'Rp520.000 / pax',
      waMessage: 'Halo Nirwana Tour, saya ingin mendaftar Paket Ekspedisi Anak Krakatau 2H1M.',
      timeline: [
        { time: 'Hari 1 (07.30 - 11.00)', desc: 'Meeting point Dermaga Canti Kalianda, berlayar melintasi Selat Sunda menuju Pulau Sebesi' },
        { time: 'Hari 1 (11.00 - 16.30)', desc: 'Check-in homestay, makan siang, snorkeling di Spot Geligi & Pulau Umang-Umang' },
        { time: 'Hari 1 (17.00 - 20.30)', desc: 'Sunset Pulau Sebesi, makan malam, briefing persiapan ekspedisi dini hari' },
        { time: 'Hari 2 (03.30 - 08.00)', desc: 'Berlayar ke kawasan Gunung Anak Krakatau, menikmati sunrise dengan latar siluet gunung api vulkanik legendaris' },
        { time: 'Hari 2 (08.00 - 11.00)', desc: 'Snorkeling di Laguna Cabe (terumbu karang bawah laut krakatau), sarapan di kapal' },
        { time: 'Hari 2 (11.00 - 14.30)', desc: 'Kembali ke Pulau Sebesi, bersih-bersih, check-out dan pelayaran menuju Dermaga Canti' }
      ],
      includes: [
        'Kapal charter penyeberangan Krakatau & Sebesi',
        'Surat Izin Masuk Kawasan Konservasi BKSDA (SIMAKSI)',
        'Homestay nyaman di Pulau Sebesi',
        'Makan 4 kali + air mineral selama trip',
        'Alat snorkeling lengkap & pelampung',
        'Tour Leader & guide lokal',
        'Dokumentasi foto kamera underwater'
      ],
      excludes: [
        'Transportasi ke Dermaga Canti Kalianda (opsional antar-jemput)',
        'Tips kru kapal & pengeluaran pribadi'
      ]
    },
    'krui': {
      title: 'Eksplorasi Pesisir Barat (Krui & Pulau Pisang)',
      category: 'Pantai Tropis & Surfing',
      duration: '3 Hari 2 Malam',
      priceDisplay: 'Rp650.000 / pax',
      waMessage: 'Halo Nirwana Tour, saya ingin informasi Paket Wisata Krui & Pulau Pisang 3H2M.',
      timeline: [
        { time: 'Hari 1', desc: 'Perjalanan melintasi pegunungan Bukit Barisan Selatan, tiba di Krui, check-in resort tepi laut, sunset di Pantai Labuhan Jukung, santap malam kuliner ikan Tuhuk bakar' },
        { time: 'Hari 2', desc: 'Penyeberangan perahu menuju Pulau Pisang, keliling pulau melihat arsitektur kuno dan pantai pasir putih halus, sore hari santai di Pantai Tanjung Setia (spot selancar dunia)' },
        { time: 'Hari 3', desc: 'Hunting cinderamata kain Tapis khas Pesisir Barat, perjalanan kembali ke Bandar Lampung dengan singgah kuliner' }
      ],
      includes: [
        'Transportasi pariwisata private AC PP Bandar Lampung - Krui',
        'Akomodasi resort/hotel 2 malam di Krui',
        'Perahu penyeberangan Pulau Pisang PP',
        'Tiket semua objek wisata pantai',
        'Makan sesuai jadwal + air mineral',
        'Driver berpengalaman & tour guide pendamping',
        'Dokumentasi perjalanan'
      ],
      excludes: [
        'Sewa papan selancar & instruktur surf (opsional)',
        'Pengeluaran pribadi di luar fasilitas'
      ]
    },
    'jakarta-bandung': {
      title: 'Jakarta & Bandung Smart Tour (Kunjungan Industri & Lembang)',
      category: 'Kunjungan Industri & Wisata',
      duration: '3 Hari 2 Malam (Overland dari Lampung)',
      priceDisplay: 'Rp1.250.000 / pax',
      waMessage: 'Halo Nirwana Tour, saya ingin konsultasi Paket Jakarta - Bandung 3H2M.',
      timeline: [
        { time: 'Hari 1 (Dini Hari)', desc: 'Penjemputan rombongan di Bandar Lampung, perjalanan melintasi Tol Bakauheni, penyeberangan kapal ferry express eksekutif Selat Sunda menuju Merak, berlanjut ke DKI Jakarta' },
        { time: 'Hari 1 (Siang - Malam)', desc: 'Kunjungan edukasi/industri (opsi: Monas / TVRI / Pabrik BUMN terkemuka), makan siang, perjalanan tol layang MBZ menuju Bandung, check-in hotel bintang di Bandung, santap malam dan istirahat' },
        { time: 'Hari 2 (Pagi - Sore)', desc: 'Sarapan di hotel, eksplorasi alam Kawah Gunung Tangkuban Perahu yang legendaris, lanjut berwisata kuliner & wahana Floating Market Lembang' },
        { time: 'Hari 2 (Sore - Malam)', desc: 'Jalan santai menikmati nuansa kota tua Jalan Braga & Asia Afrika, belanja fashion di Cihampelas / Pasar Baru Bandung, makan malam' },
        { time: 'Hari 3', desc: 'Check-out hotel, belanja oleh-oleh khas Bandung (kartika sari / brownies amanda), perjalanan kembali menuju Lampung via tol dan penyeberangan ferry eksekutif, tiba di Bandar Lampung' }
      ],
      includes: [
        'Bus Pariwisata Eksekutif VIP (AC, TV/Audio Karaoke, Charger, Reclining Seat)',
        'Tiket Kapal Ferry Express Bakauheni - Merak PP',
        'Tiket Tol Trans-Jawa / Tol Trans-Sumatera PP',
        'Akomodasi Hotel Bintang 3 di Bandung (2 malam, Twin/Triple share)',
        'Makan 7 kali sesuai jadwal + air mineral harian',
        'Tiket masuk objek wisata (Tangkuban Perahu, Floating Market Lembang)',
        'Bantuan perizinan resmi kunjungan industri/instansi',
        'Tour Leader profesional & kru ramah',
        'Banner spanduk rombongan, P3K & asuransi perjalanan'
      ],
      excludes: [
        'Pengeluaran belanja pribadi',
        'Wahana opsional berbayar di luar paket'
      ]
    },
    'jogja': {
      title: 'Eksotika Pelajar & Budaya Yogyakarta',
      category: 'Study Tour & Budaya',
      duration: '4 Hari 3 Malam (Overland dari Lampung)',
      priceDisplay: 'Rp1.450.000 / pax',
      waMessage: 'Halo Nirwana Tour, saya tertarik dengan Paket Wisata Yogyakarta 4H3M Study Tour.',
      timeline: [
        { time: 'Hari 1', desc: 'Berangkat dari Lampung pagi hari, penyeberangan kapal cepat Selat Sunda, melintasi Tol Trans-Jawa langsung menuju Jawa Tengah, istirahat malam di hotel Yogyakarta' },
        { time: 'Hari 2', desc: 'Sarapan pagi hotel, kunjungan budaya ke Candi Borobudur / Prambanan, eksplorasi edukasi Keraton Yogyakarta, dilanjutkan uji nyali seru Lava Tour Jeep Merapi (bunker kaliadem & museum sisa hartaku)' },
        { time: 'Hari 3', desc: 'Menikmati keindahan Tebing Breksi & panorama bukit HeHa Sky View Patuk, hunting sunset di Pantai Parangtritis / Gumuk Pasir, malamnya belanja oleh-oleh dan angkringan khas Malioboro' },
        { time: 'Hari 4', desc: 'Check out hotel, borong bakpia pathok kukus & gudeg kaleng khas Jogja, perjalanan kembali melintasi tol menuju Lampung dengan selamat dan berkesan' }
      ],
      includes: [
        'Big Bus Pariwisata Executive HD/SHD seat 2-2 prima',
        'Tiket Penyeberangan Ferry Express PP & Tol Trans-Jawa Full PP',
        'Hotel Bintang 3 di kawasan strategis Kota Jogja (2 malam menginap)',
        'Sewa Jeep 4x4 Offroad Lava Tour Merapi',
        'Tiket masuk Candi, Tebing Breksi, HeHa Sky View, Keraton',
        'Makan lengkap prasmanan/boks selama tour + snack',
        'Tour Leader berpengalaman khusus rombongan pelajar/kantor',
        'Gratis seat guru pendamping (khusus sekolah), spanduk rombongan, obat P3K'
      ],
      excludes: [
        'Belanja pribadi oleh-oleh & cinderamata',
        'Pengeluaran di luar rundown'
      ]
    },
    'bromo': {
      title: 'Malang & Bromo Sunrise Adventure',
      category: 'Petualangan & Gathering',
      duration: '4 Hari 3 Malam (Overland dari Lampung)',
      priceDisplay: 'Rp1.850.000 / pax',
      waMessage: 'Halo Nirwana Tour, saya ingin booking Paket Wisata Malang - Bromo Sunrise 4H3M.',
      timeline: [
        { time: 'Hari 1', desc: 'Pemberangkatan rombongan dari Lampung via tol & ferry express Merak, perjalanan overland menuju Kota Malang / Batu' },
        { time: 'Hari 2', desc: 'Tiba di Kota Wisata Batu, check-in hotel istirahat sejenak, siang hari berkunjung ke Wisata Petik Apel segar langsung di kebun petani, sore hari eksplorasi spektakuler Museum Angkut & Pasar Apung Batu' },
        { time: 'Hari 3 (Dini Hari)', desc: 'Pukul 00.30 midnight tour: berganti armada Jeep Hardtop 4x4 menuju Penanjakan 1 Bromo untuk menyaksikan Golden Sunrise terindah di Indonesia' },
        { time: 'Hari 3 (Pagi - Malam)', desc: 'Eksplorasi Kawah Bromo, Pura Poten, Pasir Berbisik, dan Bukit Teletubbies Savana Bromo, siang hari kembali ke hotel istirahat, malam hari gala dinner santai di Alun-Alun Batu' },
        { time: 'Hari 4', desc: 'Check-out hotel, borong oleh-oleh khas apel & keripik tempe Sanan Malang, perjalanan kembali menuju Bandar Lampung' }
      ],
      includes: [
        'Big Bus Pariwisata Eksekutif fasilitas lengkap (AC, Audio Karaoke, Rec Seat)',
        'Tiket Kapal Ferry Cepat Express & Tol Trans-Jawa PP',
        'Hotel Bintang 3/4 di Kota Batu / Malang (2 malam menginap)',
        'Sewa Jeep Hardtop 4x4 Bromo (Penanjakan, Kawah, Pasir Berbisik, Savana)',
        'Tiket Taman Nasional Bromo Tengger Semeru (TNBTS)',
        'Tiket Museum Angkut & Wisata Petik Apel Batu',
        'Makan sesuai jadwal + air mineral & snack',
        'Tour Leader & pemandu lokal Bromo',
        'Dokumentasi foto kamera, Banner & P3K'
      ],
      excludes: [
        'Sewa kuda di lautan pasir Bromo (opsional)',
        'Jaket / sarung tangan sewa di Bromo'
      ]
    }
  };

  const itineraryModal = document.getElementById('itineraryModal');
  const itineraryBackdrop = document.getElementById('itineraryBackdrop');
  const itineraryClose = document.getElementById('itineraryClose');
  const itineraryCategory = document.getElementById('itineraryCategory');
  const itineraryModalTitle = document.getElementById('itineraryModalTitle');
  const itineraryDuration = document.getElementById('itineraryDuration');
  const itineraryTimeline = document.getElementById('itineraryTimeline');
  const itineraryIncludes = document.getElementById('itineraryIncludes');
  const itineraryExcludes = document.getElementById('itineraryExcludes');
  const itineraryPriceDisplay = document.getElementById('itineraryPriceDisplay');
  const itineraryWaBtn = document.getElementById('itineraryWaBtn');

  function openItineraryModal(destId) {
    const data = ITINERARY_DATABASE[destId];
    if (!data || !itineraryModal) return;

    if (itineraryCategory) itineraryCategory.textContent = data.category;
    if (itineraryModalTitle) itineraryModalTitle.textContent = data.title;
    if (itineraryDuration) itineraryDuration.innerHTML = `<i class="fa-solid fa-clock"></i> ${data.duration}`;
    if (itineraryPriceDisplay) itineraryPriceDisplay.textContent = data.priceDisplay;

    // Timeline
    if (itineraryTimeline) {
      itineraryTimeline.innerHTML = data.timeline.map(item => `
        <div class="timeline-item">
          <span class="timeline-time">${item.time}</span>
          <p class="timeline-desc">${item.desc}</p>
        </div>
      `).join('');
    }

    // Includes
    if (itineraryIncludes) {
      itineraryIncludes.innerHTML = data.includes.map(inc => `
        <li><i class="fa-solid fa-circle-check"></i> ${inc}</li>
      `).join('');
    }

    // Excludes
    if (itineraryExcludes) {
      itineraryExcludes.innerHTML = data.excludes.map(exc => `
        <li><i class="fa-solid fa-circle-xmark"></i> ${exc}</li>
      `).join('');
    }

    // WA Button
    if (itineraryWaBtn) {
      itineraryWaBtn.href = buildWhatsAppUrl(data.waMessage);
    }

    itineraryModal.removeAttribute('hidden');
    void itineraryModal.offsetWidth;
    itineraryModal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeItineraryModal() {
    if (!itineraryModal) return;
    itineraryModal.classList.remove('active');
    document.body.style.overflow = '';
    setTimeout(() => {
      if (!itineraryModal.classList.contains('active')) {
        itineraryModal.setAttribute('hidden', '');
      }
    }, 300);
  }

  document.querySelectorAll('.btn-itinerary').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const destId = btn.getAttribute('data-dest-id');
      openItineraryModal(destId);
    });
  });

  itineraryClose?.addEventListener('click', closeItineraryModal);
  itineraryBackdrop?.addEventListener('click', closeItineraryModal);

  // ========================================================
  // 8. KALKULATOR ESTIMASI BUDGET WISATA INTERAKTIF
  // ========================================================
  const estDestination = document.getElementById('estDestination');
  const estParticipants = document.getElementById('estParticipants');
  const estParticipantsDisplay = document.getElementById('estParticipantsDisplay');
  const estTransportRadios = document.querySelectorAll('input[name="estTransport"]');
  const addDrone = document.getElementById('addDrone');
  const addShirt = document.getElementById('addShirt');
  const addDinner = document.getElementById('addDinner');

  const summaryDestName = document.getElementById('summaryDestName');
  const summaryGroupInfo = document.getElementById('summaryGroupInfo');
  const summaryPerPax = document.getElementById('summaryPerPax');
  const summaryTotal = document.getElementById('summaryTotal');
  const estimatorWaBtn = document.getElementById('estimatorWaBtn');

  function formatIDR(amount) {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      maximumFractionDigits: 0
    }).format(amount).replace('IDR', 'Rp').trim();
  }

  function calculateEstimator() {
    if (!estDestination || !estParticipants) return;

    const selectedOption = estDestination.options[estDestination.selectedIndex];
    const basePrice = parseInt(selectedOption.getAttribute('data-price') || '175000', 10);
    const destName = selectedOption.getAttribute('data-name') || selectedOption.text;
    const pax = parseInt(estParticipants.value, 10);

    if (estParticipantsDisplay) {
      estParticipantsDisplay.textContent = `${pax} Orang`;
    }

    let transportIncluded = true;
    estTransportRadios.forEach(radio => {
      if (radio.checked && radio.value === 'exclude') {
        transportIncluded = false;
      }
    });

    // Perhitungan Armada Transportasi & Tour Cost
    let transportTotal = 0;
    let tourCost = basePrice * pax;
    let transportName = 'Tanpa Armada (Paket Tour Only)';

    const isLongDistance = basePrice >= 1000000;

    if (isLongDistance) {
      if (transportIncluded) {
        transportName = pax <= 14 ? 'Toyota HiAce Premio VIP' : (pax <= 32 ? 'Medium Bus Pariwisata' : 'Big Bus Executive (Tol & Ferry All-In)');
        transportTotal = 0; // Sudah all-in dalam paket overland
      } else {
        transportName = 'Tanpa Armada (Meeting Point di Kota Tujuan)';
        tourCost = Math.max(0, (basePrice - 300000) * pax); // Potongan tanpa bus
      }
    } else {
      if (transportIncluded) {
        if (pax <= 14) {
          transportTotal = 1400000;
          transportName = 'Toyota HiAce Premio AC';
        } else if (pax <= 32) {
          transportTotal = 2500000;
          transportName = 'Medium Bus Pariwisata (31 Seat)';
        } else {
          const busCount = Math.ceil(pax / 48);
          transportTotal = busCount * 3800000;
          transportName = `Big Bus Executive HD/SHD (${busCount} Unit)`;
        }
      }
    }

    // Add-on
    let addonTotal = 0;
    const selectedAddons = [];

    if (addDrone && addDrone.checked) {
      addonTotal += 750000;
      selectedAddons.push('Drone & Sinematik');
    }
    if (addShirt && addShirt.checked) {
      addonTotal += (65000 * pax);
      selectedAddons.push(`Kaos Trip (${pax} pcs)`);
    }
    if (addDinner && addDinner.checked) {
      addonTotal += (75000 * pax);
      selectedAddons.push('BBQ Seafood / Gala Dinner');
    }

    const grandTotal = tourCost + transportTotal + addonTotal;
    const perPaxCost = Math.round(grandTotal / pax);

    // Update Output
    if (summaryDestName) summaryDestName.textContent = destName;
    if (summaryGroupInfo) {
      summaryGroupInfo.innerHTML = `<i class="fa-solid fa-users"></i> Estimasi untuk <strong>${pax} Peserta</strong> (${transportName})`;
    }
    if (summaryPerPax) summaryPerPax.textContent = formatIDR(perPaxCost);
    if (summaryTotal) summaryTotal.textContent = formatIDR(grandTotal);

    // Update WA CTA Link
    if (estimatorWaBtn) {
      const addonsText = selectedAddons.length > 0 ? selectedAddons.join(', ') : 'Tidak ada';
      const waMsg = 
`Halo Nirwana Tour Lampung, saya membuat simulasi estimasi paket wisata melalui website:

• *Pilihan Destinasi*: ${destName}
• *Jumlah Peserta*: ${pax} Orang
• *Opsi Armada*: ${transportIncluded ? 'Termasuk ' + transportName : 'Tanpa Kendaraan'}
• *Fasilitas Tambahan*: ${addonsText}
• *Estimasi Total*: ${formatIDR(grandTotal)} (~${formatIDR(perPaxCost)}/orang)

Mohon informasi ketersediaan tanggal dan negosiasi penawaran terbaiknya. Terima kasih!`;

      estimatorWaBtn.href = buildWhatsAppUrl(waMsg);
    }
  }

  if (estDestination && estParticipants) {
    estDestination.addEventListener('change', calculateEstimator);
    estParticipants.addEventListener('input', calculateEstimator);
    estTransportRadios.forEach(radio => radio.addEventListener('change', calculateEstimator));
    addDrone?.addEventListener('change', calculateEstimator);
    addShirt?.addEventListener('change', calculateEstimator);
    addDinner?.addEventListener('change', calculateEstimator);
    calculateEstimator(); // Initial calculation
  }

  // ========================================================
  // 9. FAQ ACCORDION
  // ========================================================
  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(item => {
    const btn = item.querySelector('.faq-question-btn');
    const panel = item.querySelector('.faq-answer-panel');

    btn?.addEventListener('click', () => {
      const isActive = item.classList.contains('active');

      // Close other items
      faqItems.forEach(otherItem => {
        if (otherItem !== item && otherItem.classList.contains('active')) {
          otherItem.classList.remove('active');
          otherItem.querySelector('.faq-question-btn')?.setAttribute('aria-expanded', 'false');
          const otherPanel = otherItem.querySelector('.faq-answer-panel');
          if (otherPanel) otherPanel.style.maxHeight = null;
        }
      });

      if (isActive) {
        item.classList.remove('active');
        btn.setAttribute('aria-expanded', 'false');
        if (panel) panel.style.maxHeight = null;
      } else {
        item.classList.add('active');
        btn.setAttribute('aria-expanded', 'true');
        if (panel) panel.style.maxHeight = panel.scrollHeight + 'px';
      }
    });
  });

  // ========================================================
  // 10. LIGHTBOX MODAL UNTUK GALERI KEGIATAN
  // ========================================================
  const galleryItems = Array.from(document.querySelectorAll('.gallery-item'));
  const lightboxModal = document.getElementById('lightboxModal');
  const lightboxBackdrop = document.getElementById('lightboxBackdrop');
  const lightboxImg = document.getElementById('lightboxImg');
  const lightboxTitle = document.getElementById('lightboxTitle');
  const lightboxCaption = document.getElementById('lightboxCaption');
  const lightboxCounter = document.getElementById('lightboxCounter');
  const lightboxClose = document.getElementById('lightboxClose');
  const lightboxPrev = document.getElementById('lightboxPrev');
  const lightboxNext = document.getElementById('lightboxNext');

  let currentGalleryIndex = 0;

  if (galleryItems.length > 0 && lightboxModal) {
    function openLightbox(index) {
      currentGalleryIndex = index;
      updateLightboxContent();
      lightboxModal.removeAttribute('hidden');
      void lightboxModal.offsetWidth;
      lightboxModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      lightboxModal.classList.remove('active');
      document.body.style.overflow = '';
      setTimeout(() => {
        if (!lightboxModal.classList.contains('active')) {
          lightboxModal.setAttribute('hidden', '');
        }
      }, 300);
    }

    function updateLightboxContent() {
      const item = galleryItems[currentGalleryIndex];
      if (!item) return;

      const imgSrc = item.getAttribute('data-src');
      const title = item.getAttribute('data-title') || '';
      const caption = item.getAttribute('data-caption') || '';

      if (lightboxImg) {
        lightboxImg.style.opacity = '0';
        setTimeout(() => {
          lightboxImg.src = imgSrc;
          lightboxImg.alt = title;
          lightboxImg.style.opacity = '1';
        }, 150);
      }

      if (lightboxTitle) lightboxTitle.textContent = title;
      if (lightboxCaption) lightboxCaption.textContent = caption;
      if (lightboxCounter) {
        lightboxCounter.textContent = `${currentGalleryIndex + 1} / ${galleryItems.length}`;
      }
    }

    function showNextImage() {
      currentGalleryIndex = (currentGalleryIndex + 1) % galleryItems.length;
      updateLightboxContent();
    }

    function showPrevImage() {
      currentGalleryIndex = (currentGalleryIndex - 1 + galleryItems.length) % galleryItems.length;
      updateLightboxContent();
    }

    galleryItems.forEach((item, index) => {
      item.addEventListener('click', () => {
        openLightbox(index);
      });
    });

    lightboxClose?.addEventListener('click', closeLightbox);
    lightboxBackdrop?.addEventListener('click', closeLightbox);
    lightboxNext?.addEventListener('click', (e) => {
      e.stopPropagation();
      showNextImage();
    });
    lightboxPrev?.addEventListener('click', (e) => {
      e.stopPropagation();
      showPrevImage();
    });

    document.addEventListener('keydown', (e) => {
      if (lightboxModal.classList.contains('active')) {
        if (e.key === 'Escape') {
          closeLightbox();
        } else if (e.key === 'ArrowRight') {
          showNextImage();
        } else if (e.key === 'ArrowLeft') {
          showPrevImage();
        }
      } else if (itineraryModal && itineraryModal.classList.contains('active')) {
        if (e.key === 'Escape') {
          closeItineraryModal();
        }
      }
    });
  }

  // ========================================================
  // 11. CURRENT YEAR DYNAMIC UPDATE
  // ========================================================
  const currentYearSpan = document.getElementById('currentYear');
  if (currentYearSpan) {
    currentYearSpan.textContent = new Date().getFullYear();
  }
});
