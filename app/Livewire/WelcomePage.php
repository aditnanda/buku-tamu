<?php

namespace App\Livewire;

use App\Models\Tamu;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class WelcomePage extends Component
{
    use WithFileUploads;

    #[Rule('image|max:4086')]

    public $nama, $nomor, $instansi, $keperluan, $janji, $foto,$foto_tampil;
    public $tanggal, $waktu_masuk, $waktu_keluar;
    public $flag = false;
    public $update = false;
    public $id_tamu;

    public function render()
    {
        return view('livewire.welcome-page');
    }

    public function prosesNomor(){

        if (!$this->nomor) {
            # code...
            return session()->flash('message', 'Nomor wajib diisi.');
        }
        $tamu = Tamu::where('nomor',$this->nomor)->whereNull('waktu_keluar')->where('tanggal',date('Y-m-d'))->first();

        $this->flag = true;
        if ($tamu) {
            # code...

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
        }else{
            $this->reset(['update','id_tamu','nama','instansi','keperluan','janji','foto_tampil','foto','tanggal','waktu_masuk','waktu_keluar']);

        }
    }

    public function save(){

        if ($this->foto) {
            $path = $this->foto->store('foto', ['disk' => 'public']);
            $this->foto = '' . $path;
        }
        if ($this->id_tamu) {
            # code...
            $tamu = Tamu::where('id',$this->id_tamu)->update([

                'waktu_keluar' => date('H:i:s'),
            ]);
        }else{
            $tamu = Tamu::create([
                'nomor' => $this->nomor,
                'nama' => $this->nama,
                'instansi' => $this->instansi,
                'keperluan' => $this->keperluan,
                'janji' => $this->janji,
                'foto' => $this->foto,
                'tanggal' => date('Y-m-d'),
                'waktu_masuk' => date('H:i:s'),
            ]);
        }

        session()->flash('message', 'Berhasil disubmit');

        $this->reset();


    }
}
