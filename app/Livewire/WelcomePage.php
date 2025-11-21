<?php

namespace App\Livewire;

use App\Models\Tamu;
use App\Models\JenisPengunjung;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class WelcomePage extends Component
{
    use WithFileUploads;

    #[Rule('nullable|mimes:jpg,jpeg,png,webp|max:4096')]
    public $nama, $nomor, $instansi, $keperluan, $janji, $foto, $foto_tampil;

    public $tanggal, $waktu_masuk, $waktu_keluar;
    public $flag = false;
    public $update = false;
    public $id_tamu;

    // 🔹 tambah properti jenis_pengunjung_id
    public $jenis_pengunjung_id;

    public function render()
    {
        // ambil master jenis pengunjung yang aktif
        $jenisPengunjungs = JenisPengunjung::where('is_active', true)
            ->orderBy('nama')
            ->get();

        return view('livewire.welcome-page', [
            'jenisPengunjungs' => $jenisPengunjungs,
        ]);
    }

    public function prosesNomor()
    {
        if (!$this->nomor) {
            return session()->flash('message', 'Nomor wajib diisi.');
        }

        $tamu = Tamu::where('nomor', $this->nomor)
            ->whereNull('waktu_keluar')
            ->where('tanggal', date('Y-m-d'))
            ->first();

        $this->flag = true;

        if ($tamu) {
            // mode update (kunjungan keluar)
            $this->update = true;
            $this->id_tamu = $tamu->id;

            $this->nama = $tamu->nama;
            $this->nomor = $tamu->nomor;
            $this->instansi = $tamu->instansi;
            $this->keperluan = $tamu->keperluan;
            $this->janji = $tamu->janji;
            $this->foto_tampil = $tamu->foto;
            $this->tanggal = $tamu->tanggal;
            $this->waktu_masuk = $tamu->waktu_masuk;
            $this->waktu_keluar = $tamu->waktu_keluar;
            $this->jenis_pengunjung_id = $tamu->jenis_pengunjung_id;
        } else {
            // mode create kunjungan baru
            $this->reset([
                'update',
                'id_tamu',
                'nama',
                'instansi',
                'keperluan',
                'janji',
                'foto_tampil',
                'foto',
                'tanggal',
                'waktu_masuk',
                'waktu_keluar',
                'jenis_pengunjung_id',
            ]);
            // nomor sengaja tidak di-reset supaya tetap terisi
        }
    }

    public function save()
    {
        if ($this->foto) {
            $path = $this->foto->store('foto', ['disk' => 'public']);
            $this->foto = $path;
        }

        if ($this->id_tamu) {
            // update (kunjungan keluar)
            Tamu::where('id', $this->id_tamu)->update([
                'waktu_keluar' => date('H:i:s'),
            ]);
        } else {
            // create kunjungan masuk
            Tamu::create([
                'nomor' => $this->nomor,
                'nama' => $this->nama,
                'instansi' => $this->instansi,
                'keperluan' => $this->keperluan,
                'janji' => $this->janji,
                'foto' => $this->foto,
                'tanggal' => date('Y-m-d'),
                'waktu_masuk' => date('H:i:s'),
                'jenis_pengunjung_id' => $this->jenis_pengunjung_id,
            ]);
        }

        session()->flash('message', 'Berhasil disubmit');

        $this->reset();
    }
}
