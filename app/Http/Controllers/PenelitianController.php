<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPenelitian;
use App\Models\Rencana;
use Illuminate\Support\Facades\Response;


class PenelitianController extends Controller
{
    //HANDLER UPLOAD LAMPIRAN
    public function postLampiran(Request $request)
    {
        // Retrieve the id_rencana from the request payload
        $id_rencana = $request->get('id_rencana');
        $jenis_penelitian = $request->get("jenis_penelitian");

        // Check if Rencana exists with the provided id_rencana
        $rencana = Rencana::where('id_rencana', $id_rencana)->first();

        if (!$rencana) {
            return response()->json(['error' => 'Rencana not found'], 404);
        }

        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->hasFile('fileInput')) {
            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . $id_dosen . '_' . $jenis_penelitian . time() . '.' . $extension;
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
        if ($rencana->lampiran == null) {
            $rencana->lampiran = [];
        } else {
            $rencana->lampiran = json_decode($rencana->lampiran);
        }

        $rencana->lampiran = json_encode(array_merge($rencana->lampiran, $filenames));

        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 202);
    }
    //END OF HANDLER POST LAMPIRAN

    //HANDLER GET LAMPIRAN (DOWNLOAD LAMPIRAN WITH ENCODED BASE64 URL)
    public function getFileLampiran($fileName)
    {
        $file = base64_decode($fileName);
        $filePath = storage_path('documents/penelitian/' . $file);

        $name = basename($filePath);
        $mimeType = mime_content_type($filePath);

        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $name . '"'
        ]);
    }

    //HANDLER DELETE LAMPIRAN (DELETE LAMPIRAN WITH ENCODED BASE64 URL)
    public function deleteFileLampiran($idRencana, $fileName)
    {
        $rencana = Rencana::where('id_rencana', $idRencana)->first();
        $fileName = base64_decode($fileName);

        $lampiran = json_decode($rencana->lampiran);

        $result = array_filter($lampiran, function ($value) use ($fileName) {
            return $value !== $fileName;
        });

        if (sizeof(array_values($result)) == sizeof($lampiran)) {
            return response()->json(["error_message" => "file not found"], 404);
        }

        $lampiran = array_values($result);

        unlink(storage_path("documents/penelitian/" . $fileName));

        if (sizeof($lampiran) == 0) {
            $rencana->lampiran = null;
        } else {
            // Encode the array back to JSON if needed
            $rencana->lampiran = json_encode($lampiran);
        }

        // Save the changes to the database if $rencana is an Eloquent model
        $rencana->save();

        return response()->json($lampiran, 200);
    }

    public function getAll($id)
    {
        // Ambil semua data dari masing-masing tabel rencana

        // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A
        $penelitian_kelompok = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_kelompok')
            ->get();

        // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B
        $penelitian_mandiri = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_mandiri')
            ->get();

        // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C
        $buku_terbit = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'buku_terbit')
            ->get();

        // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D
        $buku_internasional = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'buku_internasional')
            ->get();

        // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E
        $menyadur = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', "detail_penelitian.posisi", 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'menyadur')
            ->get();

        // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F
        $menyunting = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.posisi', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'menyunting')
            ->get();

        // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G
        $penelitian_modul = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_modul')
            ->get();

        // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H
        $penelitian_pekerti = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_pekerti')
            ->get();

        // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I
        $penelitian_tridharma = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.jumlah_bkd', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_tridharma')
            ->get();

        // BAGIAN J // BAGIAN J // BAGIAN J // BAGIAN J // BAGIAN J // BAGIAN J
        $jurnal_ilmiah = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select(
                'rencana.id_rencana',
                'rencana.nama_kegiatan',
                'detail_penelitian.jenis_pengerjaan',
                'detail_penelitian.lingkup_penerbit',
                'detail_penelitian.peran',
                'rencana.sks_terhitung',
                'rencana.asesor1_frk',
                'rencana.asesor2_frk',
                'rencana.asesor1_fed',
                'rencana.asesor2_fed',
                'rencana.lampiran'
            )
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'jurnal_ilmiah')
            ->get();

        // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K
        $hak_paten = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.lingkup_wilayah', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'hak_paten')
            ->get();

        // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L
        $media_massa = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'media_massa')
            ->get();

        // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M
        $pembicara_seminar = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.lingkup_wilayah', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'pembicara_seminar')
            ->get();

        // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N
        $penyajian_makalah = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.lingkup_wilayah', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penyajian_makalah')
            ->get();


        // Kembalikan data dalam bentuk yang sesuai untuk ditampilkan di halaman
        return response()->json([
            'penelitian_kelompok' => $penelitian_kelompok,
            'penelitian_mandiri' => $penelitian_mandiri,
            'buku_terbit' => $buku_terbit,
            'buku_internasional' => $buku_internasional,
            'menyadur' => $menyadur,
            'menyunting' => $menyunting,
            'penelitian_modul' => $penelitian_modul,
            'penelitian_pekerti' => $penelitian_pekerti,
            'penelitian_tridharma' => $penelitian_tridharma,
            'jurnal_ilmiah' => $jurnal_ilmiah,
            'hak_paten' => $hak_paten,
            'media_massa' => $media_massa,
            'pembicara_seminar' => $pembicara_seminar,
            'penyajian_makalah' => $penyajian_makalah
        ], 200);
    }
}
