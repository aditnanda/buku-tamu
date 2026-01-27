<!--
    // created by Aditya Nanda Utama, S.Kom
    // have any project? you can contact me at https://nand.my.id
    // instagram : @adit.nanda
    // PLEASE DO NOT DELETE THIS COPYRIGHT IF YOU ARE A HUMAN.
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <style>
        :root {
            --brand-950: #0b2f1f;
            --brand-900: #0f3d2a;
            --brand-800: #14543b;
            --brand-700: #166a48;
            --brand-600: #1b7a53;
            --brand-500: #1f8f61;
            --accent-amber: #f59e0b;
            --bg: #f6f7f5;
            --card: #ffffff;
            --ink: #0f172a;
            --muted: #64748b;
            --border: rgba(15, 23, 42, .14);
            --shadow: 0 30px 80px rgba(2, 6, 23, .16);
            --radius: 22px;
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
            color: var(--ink);
            background:
                radial-gradient(1200px 600px at 15% 0%, rgba(31, 143, 97, .18), transparent 60%),
                radial-gradient(900px 500px at 95% 20%, rgba(245, 158, 11, .12), transparent 55%),
                linear-gradient(180deg, #ffffff 0%, var(--bg) 55%, #ffffff 100%);
        }

        .pattern {
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .7;
            background-image: radial-gradient(rgba(15, 61, 42, .07) 1px, transparent 1px);
            background-size: 22px 22px;
        }

        .wrap {
            min-height: 100%;
            display: grid;
            place-items: center;
            padding: 28px 16px;
        }

        .shell {
            width: min(980px, 100%);
            background: rgba(255, 255, 255, .72);
            border: 1px solid rgba(15, 23, 42, .10);
            border-radius: calc(var(--radius) + 6px);
            box-shadow: var(--shadow);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            background: linear-gradient(90deg, rgba(15, 61, 42, .10), rgba(255, 255, 255, .10));
            border-bottom: 1px solid rgba(15, 23, 42, .08);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--brand-900), var(--brand-600));
            display: grid;
            place-items: center;
            box-shadow: 0 12px 26px rgba(15, 61, 42, .22);
            overflow: hidden;
        }

        .logo img { width: 100%; height: 100%; object-fit: cover; }

        .brand h1 {
            margin: 0;
            font-size: 16px;
            line-height: 1.2;
            font-weight: 750;
            letter-spacing: .2px;
        }
        .brand p {
            margin: 2px 0 0;
            font-size: 12px;
            color: var(--muted);
        }

        .badge {
            font-size: 12px;
            color: var(--brand-900);
            background: rgba(31, 143, 97, .10);
            border: 1px solid rgba(31, 143, 97, .18);
            padding: 8px 12px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .badge svg { width: 16px; height: 16px; }

        .content {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
        }

        @media (max-width: 900px) {
            .content { grid-template-columns: 1fr; }
        }

        .left {
            padding: 22px;
            border-right: 1px solid rgba(15, 23, 42, .08);
            background: linear-gradient(180deg, rgba(15, 61, 42, .06), transparent 38%);
        }
        @media (max-width: 900px) {
            .left { border-right: none; border-bottom: 1px solid rgba(15, 23, 42, .08); }
        }

        .right { padding: 22px; background: var(--card); }

        .sub {
            margin: 0 0 16px;
            color: var(--muted);
            line-height: 1.55;
        }

        .steps {
            margin: 16px 0 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .steps li {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.45;
        }

        .steps .dot {
            width: 22px;
            height: 22px;
            border-radius: 8px;
            background: rgba(15, 61, 42, .08);
            display: grid;
            place-items: center;
            flex: 0 0 auto;
        }

        .steps svg { width: 14px; height: 14px; }

        .alert {
            display: none;
            gap: 10px;
            align-items: flex-start;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid rgba(15, 23, 42, .12);
            background: rgba(2, 6, 23, .02);
            margin-bottom: 14px;
            font-size: 13px;
            line-height: 1.45;
        }
        .alert.show { display: flex; }
        .alert.success { border-color: rgba(31, 143, 97, .25); background: rgba(31, 143, 97, .08); color: var(--brand-900); }
        .alert.error { border-color: rgba(220, 38, 38, .25); background: rgba(220, 38, 38, .08); color: #7f1d1d; }
        .alert .icon { width: 18px; height: 18px; margin-top: 1px; flex: 0 0 auto; }

        .field { display: grid; gap: 7px; margin-bottom: 12px; }
        label { font-size: 12px; color: var(--muted); }

        input, select, textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 11px 12px;
            font-size: 14px;
            outline: none;
            background: #fff;
            transition: box-shadow .15s ease, border-color .15s ease, transform .05s ease;
        }
        textarea { min-height: 92px; resize: vertical; }
        input:focus, select:focus, textarea:focus {
            border-color: rgba(31, 143, 97, .45);
            box-shadow: 0 0 0 5px rgba(31, 143, 97, .14);
        }
        input:disabled, select:disabled, textarea:disabled {
            background: rgba(2, 6, 23, .03);
            color: rgba(2, 6, 23, .6);
        }

        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        @media (max-width: 520px) { .row { grid-template-columns: 1fr; } }

        .actions {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 6px;
        }

        .btn {
            border: none;
            border-radius: 16px;
            padding: 12px 14px;
            font-weight: 700;
            letter-spacing: .2px;
            cursor: pointer;
            transition: transform .08s ease, box-shadow .15s ease, opacity .15s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }
        .btn:active { transform: scale(.99); }
        .btn.primary {
            color: #fff;
            background: linear-gradient(135deg, var(--brand-900), var(--brand-600));
            box-shadow: 0 16px 34px rgba(15, 61, 42, .22);
        }
        .btn.ghost {
            color: var(--brand-900);
            background: rgba(31, 143, 97, .10);
            border: 1px solid rgba(31, 143, 97, .18);
        }
        .btn[disabled] { opacity: .6; cursor: not-allowed; }

        .divider {
            height: 1px;
            background: rgba(15, 23, 42, .08);
            margin: 14px 0;
        }

        .photo {
            width: 100%;
            border-radius: 16px;
            border: 1px solid rgba(15, 23, 42, .10);
            overflow: hidden;
            background: rgba(2, 6, 23, .02);
        }
        .photo img { width: 100%; height: 220px; object-fit: cover; display: block; }

        .foot {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 14px 22px;
            border-top: 1px solid rgba(15, 23, 42, .08);
            color: var(--muted);
            font-size: 12px;
        }

        .muted { color: var(--muted); }
        .hidden { display: none !important; }
    </style>
</head>

<body>
<div class="pattern"></div>

<div class="wrap">
    <main class="shell" aria-label="Buku Tamu">
        <header class="topbar">
            <div class="brand">
                <div class="logo" aria-hidden="true">
                    <img src="{{ url('logo.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <div>
                    <h1>{{ env('APP_NAME') }}</h1>
                    <p>Portal Buku Tamu • Regional 5</p>
                </div>
            </div>

            <div class="badge" title="Ringan (tanpa Livewire)">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M12 2l2.2 6.7H21l-5.6 4 2.1 6.6L12 15.7 6.5 19.3 8.6 12.7 3 8.7h6.8L12 2z" stroke="currentColor" stroke-width="1.5" />
                </svg>
                Selamat Datang
            </div>
        </header>

        <section class="content">
            <aside class="left">
                <p class="sub">
                    Pilih <b>Jenis Pengunjung</b> & input <b>Nomor Tamu</b> →
                    sistem mendeteksi Anda sedang <b>check-in</b> atau <b>check-out</b>.
                </p>

                <ul class="steps">
                    <li>
                        <span class="dot" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 7h16M4 12h16M4 17h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </span>
                        Pilih Jenis Pengunjung & isi Nomor Tamu lalu klik Proses.
                    </li>
                    <li>
                        <span class="dot" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 12l3 3 7-7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        Lengkapi data (kunjungan masuk) / konfirmasi (kunjungan keluar).
                    </li>
                    <li>
                        <span class="dot" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 21s8-4.5 8-10V6l-8-3-8 3v5c0 5.5 8 10 8 10z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        Data tersimpan otomatis.
                    </li>
                </ul>
            </aside>

            <section class="right">
                <div id="alert" class="alert" role="status" aria-live="polite">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M12 7v6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M12 17h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                    <div id="alertText"></div>
                </div>

                @if (session()->has('message'))
                    <div class="alert success show" role="status" aria-live="polite">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div>{{ session('message') }}</div>
                    </div>
                @endif

                <!-- FORM PROSES (AWAL) -->
                <form id="formProses" novalidate>
                    <div class="row">
                        <div class="field">
                            <label for="jenis_pengunjung_id_proses">Jenis Pengunjung</label>
                            <select id="jenis_pengunjung_id_proses" required>
                                <option value="">Pilih Jenis Pengunjung</option>
                                @foreach ($jenisPengunjungs as $jp)
                                    <option value="{{ $jp->id }}">{{ $jp->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="field">
                            <label for="nomor">Nomor Tamu</label>
                            <input id="nomor" name="nomor" inputmode="numeric" autocomplete="off" placeholder="Contoh: 02" required>
                        </div>
                    </div>

                    <div class="actions">
                        <button id="btnProses" class="btn primary" type="submit">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="18" height="18">
                                <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                <path d="M11 19a8 8 0 1 1 0-16 8 8 0 0 1 0 16z" stroke="currentColor" stroke-width="1.7"/>
                            </svg>
                            Proses
                        </button>
                        <button id="btnReset" class="btn ghost" type="button">Reset</button>
                    </div>
                    <div class="divider"></div>
                </form>

                <!-- FORM SUBMIT -->
                <form id="formSubmit" method="POST" action="{{ route('buku-tamu.submit', [], false) }}" enctype="multipart/form-data" class="hidden">
                    @csrf
                    <input type="hidden" name="mode" id="mode" value="create">
                    <input type="hidden" name="id_tamu" id="id_tamu" value="">
                    <input type="hidden" name="nomor" id="nomorHidden" value="">
                    <input type="hidden" name="jenis_pengunjung_id" id="jenisHidden" value="">

                    <!-- Display saja (tidak ikut submit) -->
                    <div class="field">
                        <label for="jenis_pengunjung_id_display">Jenis Pengunjung (dari langkah awal)</label>
                        <select id="jenis_pengunjung_id_display" disabled>
                            <option value="">-</option>
                            @foreach ($jenisPengunjungs as $jp)
                                <option value="{{ $jp->id }}">{{ $jp->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="field">
                            <label for="nama">Nama Lengkap</label>
                            <input id="nama" name="nama" placeholder="Nama sesuai identitas">
                        </div>
                        <div class="field">
                            <label for="instansi">Instansi</label>
                            <input id="instansi" name="instansi" placeholder="Perusahaan / Instansi">
                        </div>
                    </div>

                    <div class="field">
                        <label for="keperluan">Keperluan</label>
                        <textarea id="keperluan" name="keperluan" placeholder="Contoh: Meeting, audit, kunjungan kerja..."></textarea>
                    </div>

                    <div class="row">
                        <div class="field">
                            <label for="janji">Janji</label>
                            <select id="janji" name="janji">
                                <option value="">Pilih</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="field"></div>
                    </div>

                    <div class="field" id="photoField">
                        <label for="foto">Foto Selfie</label>
                        <div class="photo hidden" id="photoPreviewWrap">
                            <img id="photoPreview" alt="Foto selfie">
                        </div>
                        <input id="foto" name="foto" type="file" accept="image/*" capture="environment">
                    </div>

                    <div class="actions">
                        <button id="btnSubmit" class="btn primary" type="submit">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="18" height="18">
                                <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span id="btnSubmitText">Submit Kunjungan Masuk</span>
                        </button>
                    </div>
                </form>
            </section>
        </section>

        <footer class="foot">
            <div>Copyright © {{ date('Y') }} {{ env('APP_NAME') }}.</div>
            <div>Powered by <a href="https://fittechinova.com" class="muted" style="text-decoration: underline;">FTI & NAND</a></div>
        </footer>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    (function () {
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const endpointProses = @json(route('buku-tamu.proses', [], false));
        const endpointSubmit = @json(route('buku-tamu.submit', [], false));

        const alertEl = document.getElementById('alert');
        const alertText = document.getElementById('alertText');

        const formProses = document.getElementById('formProses');
        const btnProses = document.getElementById('btnProses');
        const btnReset = document.getElementById('btnReset');
        const nomorInput = document.getElementById('nomor');
        const jenisProses = document.getElementById('jenis_pengunjung_id_proses');

        const formSubmit = document.getElementById('formSubmit');
        const mode = document.getElementById('mode');
        const idTamu = document.getElementById('id_tamu');
        const nomorHidden = document.getElementById('nomorHidden');
        const jenisHidden = document.getElementById('jenisHidden');
        const jenisDisplay = document.getElementById('jenis_pengunjung_id_display');

        const btnSubmit = document.getElementById('btnSubmit');
        const btnSubmitText = document.getElementById('btnSubmitText');

        const nama = document.getElementById('nama');
        const instansi = document.getElementById('instansi');
        const keperluan = document.getElementById('keperluan');
        const janji = document.getElementById('janji');
        const foto = document.getElementById('foto');
        const photoField = document.getElementById('photoField');
        const photoPreviewWrap = document.getElementById('photoPreviewWrap');
        const photoPreview = document.getElementById('photoPreview');

        function showAlert(type, message) {
            alertEl.className = 'alert show ' + (type || '');
            alertText.textContent = message;

            const icon = (type === 'success') ? 'success' : (type === 'error' ? 'error' : 'info');
            return Swal.fire({
                icon,
                title: (icon === 'success') ? 'Berhasil' : (icon === 'error' ? 'Gagal' : 'Info'),
                text: message || '',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
        }

        function hideAlert() {
            alertEl.className = 'alert';
            alertText.textContent = '';
            if (window.Swal) Swal.close();
        }

        function setLoading(button, loading) {
            button.disabled = !!loading;
            button.style.opacity = loading ? '.85' : '1';
        }

        function lockProsesFields(lock) {
            nomorInput.disabled = !!lock;
            jenisProses.disabled = !!lock;
            btnProses.disabled = !!lock;
        }

        function resetAll() {
            hideAlert();
            formProses.reset();
            formSubmit.reset();
            formSubmit.classList.add('hidden');

            mode.value = 'create';
            idTamu.value = '';
            nomorHidden.value = '';
            jenisHidden.value = '';

            if (jenisDisplay) jenisDisplay.value = '';
            btnSubmitText.textContent = 'Submit Kunjungan Masuk';

            lockProsesFields(false);
            setCreateMode();

            photoPreviewWrap.classList.add('hidden');
            photoPreview.removeAttribute('src');
        }

        function setCreateMode() {
            mode.value = 'create';

            [nama, instansi, keperluan, janji].forEach(el => el.disabled = false);

            nama.required = true;
            instansi.required = true;
            keperluan.required = true;
            janji.required = true;
            foto.required = true;

            foto.classList.remove('hidden');
            photoField.classList.remove('hidden');
        }

        function setExitMode() {
            mode.value = 'exit';

            [nama, instansi, keperluan, janji].forEach(el => el.disabled = true);

            nama.required = false;
            instansi.required = false;
            keperluan.required = false;
            janji.required = false;
            foto.required = false;

            foto.value = '';
            foto.classList.add('hidden');
        }

        foto.addEventListener('change', () => {
            const f = foto.files && foto.files[0];
            if (!f) {
                photoPreviewWrap.classList.add('hidden');
                photoPreview.removeAttribute('src');
                return;
            }
            const url = URL.createObjectURL(f);
            photoPreview.src = url;
            photoPreviewWrap.classList.remove('hidden');
        });

        btnReset.addEventListener('click', resetAll);

        formProses.addEventListener('submit', async (e) => {
            e.preventDefault();
            hideAlert();

            const nomor = (nomorInput.value || '').trim();
            const jenisVal = (jenisProses.value || '').trim();

            if (!jenisVal) {
                showAlert('error', 'Jenis Pengunjung wajib dipilih.');
                jenisProses.focus();
                return;
            }
            if (!nomor) {
                showAlert('error', 'Nomor wajib diisi.');
                nomorInput.focus();
                return;
            }

            setLoading(btnProses, true);
            btnReset.disabled = true;

            try {
                const res = await fetch(endpointProses, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                    },
                    body: JSON.stringify({
                        nomor,
                        jenis_pengunjung_id: parseInt(jenisVal, 10),
                    }),
                });

                const payload = await res.json().catch(() => ({}));
                if (!res.ok) {
                    if (res.status === 422 && payload.errors) {
                        const firstKey = Object.keys(payload.errors)[0];
                        const firstMsg = payload.errors[firstKey]?.[0] || 'Validasi gagal.';
                        throw new Error(firstMsg);
                    }
                    throw new Error(payload?.message || 'Gagal memproses nomor.');
                }

                // kunci pilihan awal + simpan ke hidden submit
                nomorHidden.value = nomor;
                jenisHidden.value = jenisVal;
                if (jenisDisplay) jenisDisplay.value = jenisVal;

                formSubmit.classList.remove('hidden');
                lockProsesFields(true);

                if (payload.update && payload.tamu) {
                    setExitMode();
                    idTamu.value = payload.tamu.id || '';

                    nama.value = payload.tamu.nama || '';
                    instansi.value = payload.tamu.instansi || '';
                    keperluan.value = payload.tamu.keperluan || '';
                    janji.value = payload.tamu.janji || '';

                    // sync jenis (safety)
                    const jenisDb = String(payload.tamu.jenis_pengunjung_id || '');
                    if (jenisDb) {
                        jenisHidden.value = jenisDb;
                        if (jenisDisplay) jenisDisplay.value = jenisDb;
                    }

                    btnSubmitText.textContent = 'Submit Kunjungan Keluar';
                    // showAlert('success', 'Data ditemukan. Silakan submit untuk kunjungan keluar.');

                    if (payload.tamu.foto_url) {
                        photoPreview.src = payload.tamu.foto_url;
                        photoPreviewWrap.classList.remove('hidden');
                    } else {
                        photoPreviewWrap.classList.add('hidden');
                        photoPreview.removeAttribute('src');
                    }
                } else {
                    setCreateMode();
                    idTamu.value = '';

                    [nama, instansi, keperluan].forEach(el => el.value = '');
                    janji.value = '';
                    foto.value = '';
                    photoPreviewWrap.classList.add('hidden');
                    photoPreview.removeAttribute('src');

                    btnSubmitText.textContent = 'Submit Kunjungan Masuk';
                    // showAlert('success', 'Nomor belum check-in hari ini. Silakan lengkapi data kunjungan masuk.');
                }
            } catch (err) {
                showAlert('error', err?.message || 'Terjadi kesalahan.');
            } finally {
                setLoading(btnProses, false);
                btnReset.disabled = false;
            }
        });

        formSubmit.addEventListener('submit', async (e) => {
            e.preventDefault();
            hideAlert();

            setLoading(btnSubmit, true);

            try {
                const fd = new FormData(formSubmit);
                const res = await fetch(endpointSubmit, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                    },
                    body: fd,
                });

                const payload = await res.json().catch(() => ({}));
                if (!res.ok) {
                    if (res.status === 422 && payload.errors) {
                        const firstKey = Object.keys(payload.errors)[0];
                        const firstMsg = payload.errors[firstKey]?.[0] || 'Validasi gagal.';
                        throw new Error(firstMsg);
                    }
                    throw new Error(payload?.message || 'Gagal menyimpan data.');
                }

                resetAll();
                await showAlert('success', payload.message || 'Berhasil disubmit.');
            } catch (err) {
                await showAlert('error', err?.message || 'Terjadi kesalahan saat submit.');
            } finally {
                setLoading(btnSubmit, false);
            }
        });

        resetAll();
    })();
</script>
</body>
</html>
