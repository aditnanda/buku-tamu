<div class="w-full">
    {{-- Do your work, then step back. --}}

    @if (session()->has('message'))
        <div class="alert alert-info">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="stroke-current shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span> {{ session('message') }}
            </span>
        </div>
    @endif

    <div class="form-control  w-full max-w-lg">
        <label for="" class="label">Masukkan Nomor Tamu</label>
        <input type="number" class="input input-bordered w-full max-w-lg" wire:model='nomor' required>
        <button class="btn btn-sm" wire:click='prosesNomor()'>Proses</button>
    </div>

    @if ($flag)
        @if ($update)
            {{-- MODE UPDATE: KUNJUNGAN KELUAR --}}
            <form wire:submit="save">

                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Tanggal</label>
                    <input type="date" class="input input-bordered w-full max-w-lg" wire:model='tanggal' disabled>
                </div>

                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Waktu Masuk</label>
                    <input type="time" class="input input-bordered w-full max-w-lg" wire:model='waktu_masuk'
                        disabled>
                </div>

                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Nama Lengkap</label>
                    <input type="text" class="input input-bordered w-full max-w-lg" wire:model='nama' disabled>
                </div>

                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Instansi</label>
                    <input type="text" class="input input-bordered w-full max-w-lg" wire:model='instansi' disabled>
                </div>

                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Keperluan</label>
                    <input type="text" class="input input-bordered w-full max-w-lg" wire:model='keperluan' disabled>
                </div>

                {{-- 🔹 Jenis Pengunjung (read only) --}}
                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Jenis Pengunjung</label>
                    <select class="select select-bordered w-full max-w-lg" wire:model='jenis_pengunjung_id' disabled>
                        <option value="">Pilih Jenis Pengunjung</option>
                        @foreach ($jenisPengunjungs as $jp)
                            <option value="{{ $jp->id }}">{{ $jp->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Foto Selfie</label>
                    @if ($foto_tampil)
                        <img src="{{ url('/storage/'.$foto_tampil) }}">
                    @endif
                </div>

                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Janji</label>
                    <select type="text" class="select select-bordered w-full max-w-lg" wire:model='janji' disabled>
                        <option value="">Pilih</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>

                <p><br></p>
                <div class="form-control  w-full max-w-lg">
                    <button class="btn btn-sm"
                        type="submit" wire:loading.attr="disabled">
                        {{ $update ? 'Submit Kunjungan Keluar' : 'Submit Kunjungan Masuk' }}
                    </button>
                </div>
            </form>
        @else
            {{-- MODE CREATE: KUNJUNGAN MASUK --}}
            <form wire:submit="save">
                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Nama Lengkap</label>
                    <input type="text" class="input input-bordered w-full max-w-lg" wire:model='nama' required>
                </div>

                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Instansi</label>
                    <input type="text" class="input input-bordered w-full max-w-lg" wire:model='instansi' required>
                </div>

                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Keperluan</label>
                    <input type="text" class="input input-bordered w-full max-w-lg" wire:model='keperluan' required>
                </div>

                {{-- 🔹 Jenis Pengunjung (select dari master) --}}
                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Jenis Pengunjung</label>
                    <select class="select select-bordered w-full max-w-lg"
                        wire:model='jenis_pengunjung_id' required>
                        <option value="">Pilih Jenis Pengunjung</option>
                        @foreach ($jenisPengunjungs as $jp)
                            <option value="{{ $jp->id }}">{{ $jp->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Foto Selfie</label>
                    @if ($foto)
                        <img src="{{ $foto->temporaryUrl() }}">
                    @endif
                    <input type="file" class="input input-bordered w-full max-w-lg" wire:model='foto' capture required accept="image/*">
                </div>

                <div class="form-control  w-full max-w-lg">
                    <label for="" class="label">Janji</label>
                    <select type="text" class="select select-bordered w-full max-w-lg" wire:model='janji' required>
                        <option value="">Pilih</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>

                <p><br></p>
                <div class="form-control  w-full max-w-lg">
                    <button class="btn btn-sm"
                        type="submit" wire:loading.attr="disabled">
                        {{ $update ? 'Submit Kunjungan Keluar' : 'Submit Kunjungan Masuk' }}
                    </button>
                </div>
            </form>
        @endif
    @endif
</div>
