<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;

class GuestbookController extends Controller
{
    /**
     * Cek nomor tamu: jika ada kunjungan hari ini yang belum checkout,
     * maka mode = update (kunjungan keluar). Jika tidak ada, mode = create (kunjungan masuk).
     */
    public function prosesNomor(Request $request)
    {
        $data = $request->validate([
            // pakai string supaya aman untuk nomor dengan awalan 0
            'nomor' => ['required', 'string', 'max:50'],
            'jenis_pengunjung_id' => ['required'],
        ]);

        $tamu = Tamu::query()
            ->where('nomor', $data['nomor'])
            ->where('jenis_pengunjung_id', $data['jenis_pengunjung_id'])
            ->whereNull('waktu_keluar')
            ->where('tanggal', date('Y-m-d'))
            ->first();

        if (!$tamu) {
            return response()->json([
                'flag' => true,
                'update' => false,
                'tamu' => null,
            ]);
        }

        return response()->json([
            'flag' => true,
            'update' => true,
            'tamu' => [
                'id' => $tamu->id,
                'nomor' => $tamu->nomor,
                'nama' => $tamu->nama,
                'instansi' => $tamu->instansi,
                'keperluan' => $tamu->keperluan,
                'janji' => $tamu->janji,
                'jenis_pengunjung_id' => $tamu->jenis_pengunjung_id,
                'tanggal' => $tamu->tanggal,
                'waktu_masuk' => $tamu->waktu_masuk,
                'waktu_keluar' => $tamu->waktu_keluar,
                'foto_url' => $tamu->foto ? url('/storage/' . $tamu->foto) : null,
            ],
        ]);
    }

    /**
     * Simpan kunjungan masuk / keluar.
     * - mode=create: insert kunjungan masuk
     * - mode=exit: update waktu_keluar
     */
    public function submit(Request $request)
    {
        $mode = $request->input('mode');

        if ($mode === 'exit') {
            $data = $request->validate([
                'id_tamu' => ['nullable', 'integer'],
                'nomor' => ['required', 'string', 'max:50'],
                'jenis_pengunjung_id' => ['required'],
            ]);

            $tamu = null;
            if (!empty($data['id_tamu'])) {
                $tamu = Tamu::where('id', $data['id_tamu'])->first();
            }
            if (!$tamu) {
                $tamu = Tamu::query()
                    ->where('nomor', $data['nomor'])
                    ->where('jenis_pengunjung_id', $data['jenis_pengunjung_id'])
                    ->whereNull('waktu_keluar')
                    ->where('tanggal', date('Y-m-d'))
                    ->first();
            }

            if (!$tamu) {
                return $this->respond($request, 'Data kunjungan tidak ditemukan atau sudah checkout.');
            }

            Tamu::where('id', $tamu->id)->update([
                'waktu_keluar' => date('H:i:s'),
            ]);

            return $this->respond($request, 'Berhasil disubmit (kunjungan keluar).');
        }

        // default: create
        $data = $request->validate([
            'nomor' => ['required', 'string', 'max:50'],
            'nama' => ['required', 'string', 'max:150'],
            'instansi' => ['required', 'string', 'max:150'],
            'keperluan' => ['required', 'string', 'max:255'],
            'janji' => ['required', 'in:Ya,Tidak'],
            'jenis_pengunjung_id' => ['required', 'integer', 'exists:jenis_pengunjungs,id'],
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8096'],
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto', ['disk' => 'public']);
        }

        Tamu::create([
            'nomor' => $data['nomor'],
            'nama' => $data['nama'],
            'instansi' => $data['instansi'],
            'keperluan' => $data['keperluan'],
            'janji' => $data['janji'],
            'foto' => $fotoPath,
            'tanggal' => date('Y-m-d'),
            'waktu_masuk' => date('H:i:s'),
            'jenis_pengunjung_id' => $data['jenis_pengunjung_id'],
        ]);

        return $this->respond($request, 'Berhasil disubmit (kunjungan masuk).');
    }

    private function respond(Request $request, string $message)
    {
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'message' => $message]);
        }

        return back()->with('message', $message);
    }
}
