@props(['packages'])

<section class="section estimator-section" id="kalkulator" style="padding: 70px 0; background: linear-gradient(135deg, #0b1f3a 0%, #173865 100%); color: #fff;">
  <div class="container">
    <div class="section-header text-center" style="margin-bottom: 40px;">
      <div class="section-tag" style="border-left: 3px solid var(--accent-gold); color: var(--accent-gold);">
        <i class="fa-solid fa-calculator"></i> Simulasi Cepat
      </div>
      <h2 class="section-title" style="color: #fff; margin-top: 12px; font-size: 2.2rem;">Kalkulator Estimasi Biaya Wisata</h2>
      <p class="section-subtitle" style="color: #cbd5e1; max-width: 650px; margin: 0 auto;">
        Dapatkan perkiraan biaya perjalanan wisata rombongan Anda secara instan dan transparan sebelum berkonsultasi dengan tim kami.
      </p>
    </div>

    <div class="estimator-card" style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 20px; padding: 35px; backdrop-filter: blur(10px); max-width: 960px; margin: 0 auto;">
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 35px;">
        
        <!-- Kolom Kiri: Input Parameter -->
        <div>
          <!-- Pilihan Destinasi -->
          <div style="margin-bottom: 22px;">
            <label for="estDestination" style="display: block; font-weight: 600; margin-bottom: 8px; color: #f1f5f9;">
              <i class="fa-solid fa-map-pin" style="color: #f59e0b; margin-right: 6px;"></i> Pilih Paket / Destinasi:
            </label>
            <select id="estDestination" class="form-control" style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.2); background: #0f2c59; color: #fff; font-size: 0.95rem;">
              @foreach($packages as $pkg)
                <option value="{{ $pkg->id }}"
                        data-price="{{ $pkg->price_from }}"
                        data-name="{{ $pkg->title }}"
                        {{ $loop->first ? 'selected' : '' }}>
                  {{ $pkg->title }} (Mulai Rp {{ number_format($pkg->price_from, 0, ',', '.') }})
                </option>
              @endforeach
            </select>
          </div>

          <!-- Slider Peserta -->
          <div style="margin-bottom: 22px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
              <label for="estParticipants" style="font-weight: 600; color: #f1f5f9;">
                <i class="fa-solid fa-users" style="color: #f59e0b; margin-right: 6px;"></i> Jumlah Peserta:
              </label>
              <span id="estParticipantsDisplay" style="background: #f59e0b; color: #000; font-weight: 700; padding: 2px 12px; border-radius: 12px; font-size: 0.85rem;">
                10 Orang
              </span>
            </div>
            <input type="range" id="estParticipants" min="2" max="150" value="10" step="1"
                   style="width: 100%; accent-color: #f59e0b; cursor: pointer;">
            <div style="display: flex; justify-content: space-between; font-size: 0.8rem; color: #94a3b8; margin-top: 4px;">
              <span>Min. 2 Orang</span>
              <span>50 Orang</span>
              <span>150+ Rombongan Bus</span>
            </div>
          </div>

          <!-- Opsi Transportasi -->
          <div style="margin-bottom: 22px;">
            <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #f1f5f9;">
              <i class="fa-solid fa-bus" style="color: #f59e0b; margin-right: 6px;"></i> Opsi Transportasi:
            </label>
            <div style="display: flex; gap: 15px;">
              <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; background: rgba(255,255,255,0.06); padding: 8px 14px; border-radius: 8px; font-size: 0.9rem;">
                <input type="radio" name="estTransport" value="include" checked style="accent-color: #f59e0b;">
                <span>Termasuk Armada Nirwana</span>
              </label>
              <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; background: rgba(255,255,255,0.06); padding: 8px 14px; border-radius: 8px; font-size: 0.9rem;">
                <input type="radio" name="estTransport" value="exclude" style="accent-color: #f59e0b;">
                <span>Tanpa Armada (Bawa Sendiri)</span>
              </label>
            </div>
          </div>

          <!-- Fasilitas Tambahan (Add-on) -->
          <div>
            <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #f1f5f9;">
              <i class="fa-solid fa-puzzle-piece" style="color: #f59e0b; margin-right: 6px;"></i> Fasilitas Tambahan (Opsional):
            </label>
            <div style="display: flex; flex-direction: column; gap: 10px;">
              <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 0.9rem;">
                <input type="checkbox" id="addDrone" style="accent-color: #f59e0b; width: 17px; height: 17px;">
                <span>Dokumentasi Drone & Video Teaser Sinematik (+Rp 750k)</span>
              </label>
              <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 0.9rem;">
                <input type="checkbox" id="addShirt" style="accent-color: #f59e0b; width: 17px; height: 17px;">
                <span>Kaos Seragam Trip Combed 30s (+Rp 65k/peserta)</span>
              </label>
              <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 0.9rem;">
                <input type="checkbox" id="addDinner" style="accent-color: #f59e0b; width: 17px; height: 17px;">
                <span>Gala Dinner / BBQ Seafood Pantai (+Rp 75k/peserta)</span>
              </label>
            </div>
          </div>
        </div>

        <!-- Kolom Kanan: Rincian Hasil & CTA WhatsApp -->
        <div style="background: rgba(15, 44, 89, 0.8); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 16px; padding: 25px; display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; font-weight: 700;">
              Rincian Estimasi Biaya
            </span>
            <h3 id="summaryDestName" style="color: #f59e0b; margin: 8px 0 4px; font-size: 1.3rem;">
              {{ $packages->first()->title ?? 'Pilihan Paket' }}
            </h3>
            <p id="summaryGroupInfo" style="color: #cbd5e1; font-size: 0.85rem; margin-bottom: 20px;">
              <i class="fa-solid fa-users"></i> Estimasi untuk <strong>10 Peserta</strong>
            </p>

            <div style="background: rgba(255,255,255,0.05); padding: 16px; border-radius: 12px; margin-bottom: 15px;">
              <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 6px;">
                <span style="color: #94a3b8; font-size: 0.85rem;">Perkiraan Biaya / Orang:</span>
                <span id="summaryPerPax" style="font-size: 1.5rem; font-weight: 800; color: #38bdf8;">
                  Rp 175.000
                </span>
              </div>
              <div style="display: flex; justify-content: space-between; align-items: baseline; border-top: 1px dashed rgba(255,255,255,0.15); padding-top: 8px;">
                <span style="color: #94a3b8; font-size: 0.85rem;">Total Estimasi Rombongan:</span>
                <span id="summaryTotal" style="font-size: 1.25rem; font-weight: 700; color: #4ade80;">
                  Rp 1.750.000
                </span>
              </div>
            </div>

            <p style="font-size: 0.78rem; color: #94a3b8; line-height: 1.4; margin-bottom: 20px;">
              *Estimasi bersifat perkiraan awal dan dapat disesuaikan kembali sesuai kebutuhan khusus, pilihan hotel, dan negosiasi rombongan Anda.
            </p>
          </div>

          <!-- Tombol CTA -->
          <div>
            <a id="estimatorWaBtn"
               href="#"
               target="_blank"
               rel="noopener noreferrer"
               class="btn btn-primary"
               style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px; padding: 14px 20px; font-weight: 700; font-size: 1rem; border-radius: 10px; background: #25D366; border-color: #25D366; color: #fff; text-decoration: none;">
              <i class="fa-brands fa-whatsapp" style="font-size: 1.3rem;"></i> Konsultasikan Hasil Ini ke WA
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
