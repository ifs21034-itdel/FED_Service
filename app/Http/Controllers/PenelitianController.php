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

        if(sizeof(array_values($result)) == sizeof($lampiran)){
            return response()->json(["error_message" => "file not found"], 404);
        }

        $lampiran = array_values($result);

        unlink(storage_path("documents/penelitian/" . $fileName));

        if(sizeof($lampiran) == 0){
            $rencana->lampiran = null;
        } else {
            // Encode the array back to JSON if needed
            $rencana->lampiran = json_encode($lampiran);
        }

        // Save the changes to the database if $rencana is an Eloquent model
        $rencana->save();

        return response()->json($lampiran, 200);
    }

    // HANDLER A
    public function getPenelitianKelompok($id)
    {
        $penelitian_kelompok = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'penelitian_kelompok')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($penelitian_kelompok, 200);
    }
    // END OF HANDLER A

    // HANDLER B
    public function getPenelitianMandiri($id)
    {
        $penelitian_mandiri = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'penelitian_mandiri')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($penelitian_mandiri, 200);
    }
    //END OF HANDLER B

    //HANDLER C
    public function getBukuTerbit($id)
    {
        $buku_terbit = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'buku_terbit')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($buku_terbit, 200);
    }
    //END OF HANDLER C

    //HANDLER D
    public function getBukuInternasional($id)
    {
        $buku_internasional = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'buku_internasional')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($buku_internasional, 200);
    }
    //END OF HANDLER D

    //HANDLER M
    public function getPembicaraSeminar($id)
    {
        $pembicara_seminar = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.lingkup_wilayah', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'pembicara_seminar')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($pembicara_seminar, 200);
    }
    //END OF HANDLER M

    //HANDLER N
    public function getPenyajianMakalah($id)
    {
        $penyajian_makalah = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.lingkup_wilayah', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_frk')
            ->where('rencana.sub_rencana', 'penyajian_makalah')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($penyajian_makalah, 200);
    }
    //END OF HANDLER N
}
