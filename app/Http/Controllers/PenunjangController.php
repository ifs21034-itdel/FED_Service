<?php

namespace App\Http\Controllers;

use App\Models\Rencana;
use App\Models\DetailPenunjang;
use Illuminate\Http\Request;

class PenunjangController extends Controller
{
  public function getAll()
    {
        // BAGIAN A
        $akademik = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jumlah_mahasiswa')
            ->where('rencana.sub_rencana', 'akademik')
            ->get();

        // BAGIAN B
        $bimbingan = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jumlah_mahasiswa')
            ->where('rencana.sub_rencana', 'bimbingan')
            ->get();

        // BAGIAN C
        $ukm = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penunjang.jumlah_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'ukm')
            ->get();

        // BAGIAN D
        $sosial = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'sosial')
            ->get();

        // BAGIAN E
        $struktural = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_jabatan_struktural', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'struktural')
            ->get();

        // BAGIAN F
        $nonstruktural = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_jabatan_nonstruktural', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'nonstruktural')
            ->get();

        // BAGIAN G
        $redaksi = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'redaksi')
            ->get();

        // BAGIAN H
        $adhoc = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'adhoc')
            ->get();

        // BAGIAN I
        $ketuapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'ketua_panitia')
            ->get();

        // BAGIAN J
        $anggotapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'anggota_panitia')
            ->get();

        // BAGIAN K
        $pengurusyayasan = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'pengurus_yayasan')
            ->get();

        // BAGIAN L
        $asosiasi = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'asosiasi')
            ->get();

        // BAGIAN M
        $seminar = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'seminar')
            ->get();

        // BAGIAN N
        $reviewer = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'reviewer')
            ->get();

        // Kembalikan data dalam bentuk yang sesuai untuk ditampilkan di halaman
        return response()->json([
            'akademik' => $akademik,
            'bimbingan' => $bimbingan,
            'ukm' => $ukm,
            'sosial' => $sosial,
            'struktural' => $struktural,
            'nonstruktural' => $nonstruktural,
            'redaksi' => $redaksi,
            'adhoc' => $adhoc,
            'ketuapanitia' => $ketuapanitia,
            'anggotapanitia' => $anggotapanitia,
            'pengurusyayasan' => $pengurusyayasan,
            'asosiasi' => $asosiasi,
            'seminar' => $seminar,
            'reviewer' => $reviewer
        ], 200);
    }

    //HANDLER UPLOAD LAMPIRAN
    public function postLampiran(Request $request){
        // Retrieve the id_rencana from the request payload
        $id_rencana = $request->get('id_rencana');
        $jenis_penunjang = $request->get("jenis_penunjang");

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
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . $id_dosen . '_' . $jenis_penunjang . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/penunjang'), $filename);
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
        $filePath = storage_path('documents/penunjang/' . $file);

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

        unlink(storage_path("documents/penunjang/" . $fileName));

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


    //Handler A. Bimbingan Akademik
    public function getAkademik($id)
    {
        $akademik = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jumlah_mahasiswa', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'akademik')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($akademik, 200);
    }
    
    public function getBimbingan($id)
    {
        $bimbingan = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jumlah_mahasiswa', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'bimbingan')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($bimbingan, 200);
    }
    
    public function getUkm($id)
    {
        $ukm = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penunjang.jumlah_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'ukm')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($ukm, 200);
    }

    
    public function getSosial($id)
    {
        $sosial = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'sosial')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($sosial, 200);
    }

    //Handler E. Jabatan Struktural
    public function getStruktural($id)
    {
        $struktural = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_jabatan_struktural', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'struktural')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($struktural, 200);
    }


    //Handler F. Jabatan non struktural
    public function getNonstruktural($id)
    {
        $nonstruktural = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_jabatan_nonstruktural', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'nonstruktural')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($nonstruktural, 200);
    }

    //Handler G. Ketua Redaksi Jurnal
    public function getRedaksi($id)
    {
        $redaksi = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jabatan', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'redaksi')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($redaksi, 200);
    }

    // }
    //Handler H. Ketua Ad Hoc
    public function getAdhoc($id)
    {
        $adhoc = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jabatan', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'adhoc')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($adhoc, 200);
    }


    //Handler I. Ketua Panitia Tetap
    public function getKetuaPanitia($id)
    {
        $ketuapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'ketua_panitia')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($ketuapanitia, 200);
    }

    //Handler J. Anggota Panitia Tetap
    public function getAnggotaPanitia($id)
    {
        $anggotapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'anggota_panitia')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($anggotapanitia, 200);
    }

    //Handler K. Menjadi Pengurus Yayasan
    public function getPengurusYayasan($id)
    {
        $anggotapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jabatan', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'pengurus_yayasan')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($anggotapanitia, 200);
    }

    //Handler L. Menjadi Pengurus/Anggota Asosiasi Profesi
    public function getAsosiasi($id)
    {
        $asosiasi = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'detail_penunjang.jabatan', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'asosiasi')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($asosiasi, 200);
    }

    //Handler M. Peserta seminar/workshop/kursus berdasar penugasan pimpinan
    public function getSeminar($id)
    {
        $seminar = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'seminar')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($seminar, 200);
    }

    //Handler N. Reviewer jurnal ilmiah , proposal Hibah dll
    public function getReviewer($id)
    {
        $reviewer = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'rencana.lampiran','rencana.asesor2_frk', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where('rencana.sub_rencana', 'reviewer')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($reviewer, 200);
    }

}