<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPenelitian;
use App\Models\Rencana;


class PenelitianController extends Controller
{
    public function getAll()
    {
        // Ambil semua data dari masing-masing tabel rencana

        // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A
        $penelitian_kelompok = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'penelitian_kelompok')
            ->get();

        // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B
        $penelitian_mandiri = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'penelitian_mandiri')
            ->get();

        // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C
        $buku_terbit = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan','detail_penelitian.peran','rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'buku_terbit')
            ->get();

        // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D
        $buku_internasional = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan','detail_penelitian.peran','rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'buku_internasional')
            ->get();

        // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E
        $menyadur = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', "detail_penelitian.posisi",'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'menyadur')
            ->get();

        // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F
        $menyunting = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan','detail_penelitian.posisi', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'menyunting')
            ->get();

        // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G
        $penelitian_modul = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'penelitian_modul')
            ->get();

        // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H
        $penelitian_pekerti = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'penelitian_pekerti')
            ->get();

        // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I
        $penelitian_tridharma = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.jumlah_bkd', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'penelitian_tridharma')
            ->get();

        // BAGIAN J // BAGIAN J // BAGIAN J // BAGIAN J // BAGIAN J // BAGIAN J
        $jurnal_ilmiah = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.lingkup_penerbit',
            'detail_penelitian.peran','rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'jurnal_ilmiah')
            ->get();

        // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K
        $hak_paten = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.lingkup_wilayah', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'hak_paten')
            ->get();

        // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L
        $media_massa = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'media_massa')
            ->get();

        // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M
        $pembicara_seminar = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.lingkup_wilayah', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'pembicara_seminar')
            ->get();

        // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N
        $penyajian_makalah = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
        ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.lingkup_wilayah', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
        ->where('rencana.sub_rencana', 'penyajian_makalah')
        ->get();


        // Kembalikan data dalam bentuk yang sesuai untuk ditampilkan di halaman
        return response()->json([
            'penelitian_kelompok' => $penelitian_kelompok,
            'penelitian_mandiri' => $penelitian_mandiri,
            'buku_terbit' => $buku_terbit,
            'buku_internasional' => $buku_internasional,
            'menyadur'=>$menyadur,
            'menyunting'=>$menyunting,
            'penelitian_modul' => $penelitian_modul,
            'penelitian_pekerti' => $penelitian_pekerti,
            'penelitian_tridharma' => $penelitian_tridharma,
            'jurnal_ilmiah' => $jurnal_ilmiah,
            'hak_paten' => $hak_paten,
            'media_massa' => $media_massa,
            'pembicara_seminar' => $pembicara_seminar,
            'penyajian_makalah'=> $penyajian_makalah
        ], 200);
    }

    // Method A
    public function getPenelitianKelompok($id)
    {
        $penelitian_kelompok = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'penelitian_kelompok')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($penelitian_kelompok, 200);
    }

    public function postPenelitianKelompok(Request $request)
    {
        $id_rencana = $request->input('id_rencana');
        $rencana = Rencana::where('id_rencana', $id_rencana)->first();

        if(!$rencana){
            return response()->json(['error' => 'Rencana not found'], 404);
        }

        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->hasFile('fileInputA')){
            $files = $request->file('fileInputA');
            foreach($files as $file){
                if ($file->isValid()){
                    $extension = $file->getClientOriginalExtension();
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '' . $id_dosen . 'Penelitian_KElompok' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/penelitian'), $filename);
                    $filenames[] = $filename;
                } else {
                    return response()->json(['error' => 'Something went wrong'], 401);
                }
            }
        } else {
            return response()->json(['error' => 'No files selected'], 400);
        }

        $rencana->lampiran = is_array($rencana->lampiran) ? $rencana->lampiran : [];
        $rencana->lampiran = array_merge($rencana->lampiran, $filenames);

        $rencana->save();

        $res  = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 202);
    }

    // Method B
    public function getPenelitianMandiri($id)
    {
        $penelitian_mandiri = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'penelitian_mandiri')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($penelitian_mandiri, 200);
    }

    // Method C
    public function getBukuTerbit($id)
    {
        $buku_terbit = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan','detail_penelitian.peran','rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'buku_terbit')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($buku_terbit, 200);
    }

    // Method D
    public function getBukuInternasional($id)
    {
        $buku_internasional = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan','detail_penelitian.peran','rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'buku_internasional')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($buku_internasional, 200);
    }

    public function postBukuInternasional(Request $request)
    {
        // Retrieve the id_rencana from the request payload
        $id_rencana = $request->input('id_rencana');

        // Check if Rencana exists with the provided id_rencana
        $rencana = Rencana::where('id_rencana', $id_rencana)->first();

        if (!$rencana) {
            return response()->json(['error' => 'Rencana not found'], 404);
        }

        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->hasFile('fileInputD')) {
            $files = $request->file('fileInputD');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '' . $id_dosen . '_Buku_Internasional' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/penelitian'), $filename);
                    $filenames[] = $filename;
                } else {
                    return response()->json(['error' => 'Something went wrong'], 401);
                }
            }
        } else {
            return response()->json(['error' => 'No files selected'], 400);
        }

        // Update $rencana->lampiran with new filenames
        $rencana->lampiran = is_array($rencana->lampiran) ? $rencana->lampiran : [];
        $rencana->lampiran = array_merge($rencana->lampiran, $filenames);

        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 202);
    }

    //method M
    public function getPembicaraSeminar($id)
        {
            $pembicara_seminar = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
                ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.lingkup_wilayah', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
                ->where('rencana.sub_rencana', 'pembicara_seminar')
                ->where('id_dosen', $id)
                ->get();

            return response()->json($pembicara_seminar, 200);
        }

        public function postPembicaraSeminar(Request $request)
    {
        // Retrieve the id_rencana from the request payload
        $id_rencana = $request->input('id_rencana');

        // Check if Rencana exists with the provided id_rencana
        $rencana = Rencana::where('id_rencana', $id_rencana)->first();

        if (!$rencana) {
            return response()->json(['error' => 'Rencana not found'], 404);
        }

        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->hasFile('fileInputM')) {
            $files = $request->file('fileInputM');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '' . $id_dosen . '_Buku_Internasional' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/penelitian'), $filename);
                    $filenames[] = $filename;
                } else {
                    return response()->json(['error' => 'Something went wrong'], 401);
                }
            }
        } else {
            return response()->json(['error' => 'No files selected'], 400);
        }

        // Update $rencana->lampiran with new filenames
        $rencana->lampiran = is_array($rencana->lampiran) ? $rencana->lampiran : [];
        $rencana->lampiran = array_merge($rencana->lampiran, $filenames);

        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 202);
    }

    //method N
    public function getPenyajianMakalah($id)
        {
            $penyajian_makalah = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
                ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.lingkup_wilayah', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
                ->where('rencana.sub_rencana', 'penyajian_makalah')
                ->where('id_dosen', $id)
                ->get();

            return response()->json($penyajian_makalah, 200);
        }

        public function postPenyajianMakalah(Request $request)
    {
        // Retrieve the id_rencana from the request payload
        $id_rencana = $request->input('id_rencana');

        // Check if Rencana exists with the provided id_rencana
        $rencana = Rencana::where('id_rencana', $id_rencana)->first();

        if (!$rencana) {
            return response()->json(['error' => 'Rencana not found'], 404);
        }

        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->hasFile('fileInputN')) {
            $files = $request->file('fileInputN');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '' . $id_dosen . '_Penyajian_Makalah' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/penelitian'), $filename);
                    $filenames[] = $filename;
                } else {
                    return response()->json(['error' => 'Something went wrong'], 401);
                }
            }
        } else {
            return response()->json(['error' => 'No files selected'], 400);
        }

        // Update $rencana->lampiran with new filenames
        $rencana->lampiran = is_array($rencana->lampiran) ? $rencana->lampiran : [];
        $rencana->lampiran = array_merge($rencana->lampiran, $filenames);

        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 202);
    }

}
