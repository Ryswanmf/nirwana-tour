import Alpine from 'alpinejs';

window.Alpine = Alpine;

// ========================================================
// Helper Global: Build WhatsApp URL
// ========================================================
window.buildWhatsAppUrl = function (message) {
  const number = (window.NIRWANA_CONFIG && window.NIRWANA_CONFIG.whatsappNumber) || '6282269616188';
  const defaultMsg = (window.NIRWANA_CONFIG && window.NIRWANA_CONFIG.defaultWaMessage) || 'Halo Nirwana Tour, saya ingin konsultasi perjalanan.';
  return `https://wa.me/${number}?text=${encodeURIComponent(message || defaultMsg)}`;
};

// ========================================================
// Alpine Component: Navigasi & Sticky Header
// ========================================================
Alpine.data('navigation', () => ({
  scrolled: false,
  showBackToTop: false,
  mobileOpen: false,

  init() {
    this.updateScroll();
  },

  updateScroll() {
    const scrollPos = window.scrollY || window.pageYOffset;
    this.scrolled = scrollPos > 40;
    this.showBackToTop = scrollPos > 400;
  },

  scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  },

  toggleMobile() {
    this.mobileOpen = !this.mobileOpen;
  },

  closeMobile() {
    this.mobileOpen = false;
  }
}));

// ========================================================
// Alpine Component: Floating WhatsApp Concierge Widget
// ========================================================
Alpine.data('floatingWhatsApp', () => ({
  open: false,

  toggle() {
    this.open = !this.open;
  },

  close() {
    this.open = false;
  }
}));

// ========================================================
// Alpine Component: Filter Kategori Destinasi
// ========================================================
Alpine.data('destinationFilter', () => ({
  activeFilter: 'all',

  setFilter(filter) {
    this.activeFilter = filter;
    const cards = document.querySelectorAll('.dest-card');
    cards.forEach(card => {
      const categories = (card.getAttribute('data-category') || '').split(' ');
      const matches = (filter === 'all' || categories.includes(filter));
      if (matches) {
        card.classList.remove('hide');
      } else {
        card.classList.add('hide');
      }
    });
  }
}));

// ========================================================
// Alpine Component: Modal Detail Itinerary & Rundown
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

Alpine.data('itineraryModal', () => ({
  isOpen: false,
  data: null,

  open(destId) {
    const item = ITINERARY_DATABASE[destId];
    if (item) {
      this.data = item;
      this.isOpen = true;
      document.body.style.overflow = 'hidden';
    }
  },

  close() {
    this.isOpen = false;
    document.body.style.overflow = '';
  },

  get waUrl() {
    return this.data ? window.buildWhatsAppUrl(this.data.waMessage) : '#';
  }
}));

// ========================================================
// Alpine Component: Kalkulator Estimasi Budget Wisata
// ========================================================
Alpine.data('budgetEstimator', () => ({
  destination: '175000',
  destName: 'Pulau Pahawang & Kelagian (1 Hari Snorkeling)',
  participants: 15,
  transportOption: 'include',
  addonDrone: false,
  addonShirt: false,
  addonDinner: false,

  formatIDR(val) {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      maximumFractionDigits: 0
    }).format(val).replace('IDR', 'Rp').trim();
  },

  onDestChange(event) {
    const select = event.target;
    const opt = select.options[select.selectedIndex];
    this.destination = opt.value;
    this.destName = opt.getAttribute('data-name') || opt.text;
  },

  get isLongDistance() {
    return parseInt(this.destination, 10) >= 1000000;
  },

  get transportCalculation() {
    const pax = parseInt(this.participants, 10);
    const included = this.transportOption === 'include';

    if (this.isLongDistance) {
      if (included) {
        const name = pax <= 14 ? 'Toyota HiAce Premio VIP' : (pax <= 32 ? 'Medium Bus Pariwisata' : 'Big Bus Executive (Tol & Ferry All-In)');
        return { name, cost: 0, tourDiscount: 0 };
      } else {
        return { name: 'Tanpa Armada (Meeting Point di Kota Tujuan)', cost: 0, tourDiscount: 300000 * pax };
      }
    } else {
      if (included) {
        if (pax <= 14) {
          return { name: 'Toyota HiAce Premio AC', cost: 1400000, tourDiscount: 0 };
        } else if (pax <= 32) {
          return { name: 'Medium Bus Pariwisata (31 Seat)', cost: 2500000, tourDiscount: 0 };
        } else {
          const busCount = Math.ceil(pax / 48);
          return { name: `Big Bus Executive HD/SHD (${busCount} Unit)`, cost: busCount * 3800000, tourDiscount: 0 };
        }
      } else {
        return { name: 'Tanpa Armada (Paket Tour Only)', cost: 0, tourDiscount: 0 };
      }
    }
  },

  get addonTotal() {
    let total = 0;
    const pax = parseInt(this.participants, 10);
    if (this.addonDrone) total += 750000;
    if (this.addonShirt) total += (65000 * pax);
    if (this.addonDinner) total += (75000 * pax);
    return total;
  },

  get grandTotal() {
    const pax = parseInt(this.participants, 10);
    const base = parseInt(this.destination, 10);
    const tourCost = Math.max(0, (base * pax) - this.transportCalculation.tourDiscount);
    return tourCost + this.transportCalculation.cost + this.addonTotal;
  },

  get perPax() {
    const pax = parseInt(this.participants, 10);
    return pax > 0 ? Math.round(this.grandTotal / pax) : 0;
  },

  get waEstimateUrl() {
    const pax = parseInt(this.participants, 10);
    const addons = [];
    if (this.addonDrone) addons.push('Drone & Sinematik');
    if (this.addonShirt) addons.push(`Kaos Trip (${pax} pcs)`);
    if (this.addonDinner) addons.push('BBQ Seafood / Gala Dinner');
    const addonsText = addons.length > 0 ? addons.join(', ') : 'Tidak ada';

    const msg = `Halo Nirwana Tour Lampung, saya membuat simulasi estimasi paket wisata melalui website:

• *Pilihan Destinasi*: ${this.destName}
• *Jumlah Peserta*: ${pax} Orang
• *Opsi Armada*: ${this.transportOption === 'include' ? 'Termasuk ' + this.transportCalculation.name : 'Tanpa Kendaraan'}
• *Fasilitas Tambahan*: ${addonsText}
• *Estimasi Total*: ${this.formatIDR(this.grandTotal)} (~${this.formatIDR(this.perPax)}/orang)

Mohon informasi ketersediaan tanggal dan negosiasi penawaran terbaiknya. Terima kasih!`;

    return window.buildWhatsAppUrl(msg);
  }
}));

// ========================================================
// Alpine Component: Modal Ulasan / Testimoni
// ========================================================
Alpine.data('reviewModal', () => ({
  isOpen: false,
  rating: 5,
  labels: {
    1: '1 / 5 - Perlu Peningkatan',
    2: '2 / 5 - Cukup Baik',
    3: '3 / 5 - Baik & Memuaskan',
    4: '4 / 5 - Sangat Baik & Nyaman',
    5: '5 / 5 - Luar Biasa Sangat Puas!'
  },

  open() {
    this.isOpen = true;
  },

  close() {
    this.isOpen = false;
  },

  setRating(val) {
    this.rating = val;
  },

  get ratingLabel() {
    return this.labels[this.rating] || `${this.rating} / 5`;
  }
}));

// ========================================================
// Inisialisasi Prefetcher Cepat untuk Kecepatan Halaman & Event Handler Global
// ========================================================
document.addEventListener('DOMContentLoaded', () => {
  // 1. WhatsApp Button Links
  const waButtons = document.querySelectorAll('.wa-link-btn');
  waButtons.forEach(btn => {
    const customMsg = btn.getAttribute('data-wa-msg') || 'Halo Nirwana Tour, saya ingin konsultasi perjalanan.';
    btn.setAttribute('href', window.buildWhatsAppUrl(customMsg));
    btn.setAttribute('target', '_blank');
    btn.setAttribute('rel', 'noopener noreferrer');
  });

  // 2. Contact Form to WhatsApp
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

      window.open(window.buildWhatsAppUrl(waMessage), '_blank', 'noopener,noreferrer');
    });
  }

  // 3. Prefetcher Cepat
  const prefetched = new Set();
  function prefetch(url) {
    if (!url || prefetched.has(url)) return;
    if (url.startsWith('#') || url.startsWith('mailto:') || url.startsWith('tel:') || url.includes('wa.me')) return;
    try {
      const parsed = new URL(url, window.location.origin);
      if (parsed.origin !== window.location.origin) return;
      if (parsed.pathname === window.location.pathname) return;
      if (parsed.pathname.startsWith('/admin') || parsed.pathname.startsWith('/login')) return;

      prefetched.add(url);
      const link = document.createElement('link');
      link.rel = 'prefetch';
      link.href = parsed.href;
      document.head.appendChild(link);
    } catch (e) {}
  }

  document.querySelectorAll('a[href]').forEach(a => {
    a.addEventListener('mouseenter', () => prefetch(a.getAttribute('href')), { passive: true });
    a.addEventListener('touchstart', () => prefetch(a.getAttribute('href')), { passive: true });
  });
});

// Mulai Alpine.js
Alpine.start();
