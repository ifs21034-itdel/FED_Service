<?php

namespace App\Http\Controllers;

use App\Models\Rencana;
use App\Models\DetailPendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{

    public function getAll()
    {
         // BAGIAN A
        $teori = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelas', 'detail_pendidikan.jumlah_evaluasi', 'detail_pendidikan.sks_matakuliah', 'rencana.sks_terhitung', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'teori')
            ->get();

        // BAGIAN B
        $praktikum = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelas', 'detail_pendidikan.sks_matakuliah', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'praktikum')
            ->get();

        // BAGIAN C
        $bimbingan = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'bimbingan')
            ->get();

        // BAGIAN D
        $seminar = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_dosen', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'seminar')
            ->get();

        // BAGIAN E
        $tugasAkhir = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelompok', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'tugasAkhir')
            ->get();

        // BAGIAN F
        $proposal = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'proposal')
            ->get();

        // BAGIAN G
        $rendah = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_sap', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'rendah')
            ->get();

        // BAGIAN H
        $kembang = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_sap', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'pengembangan')
            ->get();

        // BAGIAN I
        $cangkok = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_dosen', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'cangkok')
            ->get();

        // BAGIAN J
        $koordinator = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'koordinator')
            ->get();

        // Kembalikan data dalam bentuk yang sesuai untuk ditampilkan di halaman
        return response()->json([
            'teori' => $teori,
            'praktikum' => $praktikum,
            'bimbingan' => $bimbingan,
            'rendah' => $rendah,
            'kembang' => $kembang,
            'cangkok' => $cangkok,
            'seminar' => $seminar,
            'koordinator' => $koordinator,
            'tugasAkhir' => $tugasAkhir,
            'proposal' => $proposal
        ], 200);
    }

    // START OF METHOD A
    public function getTeori($id)
    {
        $teori = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelas', 'detail_pendidikan.jumlah_evaluasi', 'detail_pendidikan.sks_matakuliah', 'rencana.sks_terhitung', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'teori')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($teori, 200);
    }

    public function postTeori(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        // $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->file('fileInput')) {

            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_pendidikan_' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pendidikan'), $filename);
                    $filenames[] = $filename;
                } else {
                    continue;
                }
            }
        } else {
            return 'Tidak ada file yang dipilih.';
        }

        $rencana->lampiran = $filenames;
        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 200);
    }

    public function editTeori(Request $request)
    {
        
    }

    public function deleteTeori($id)
    {
        
    }
    //END OF METHOD A

    //START OF METHOD B
    public function getPraktikum($id)
    {
        $praktikum = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelas', 'detail_pendidikan.sks_matakuliah', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'praktikum')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($praktikum, 200);
    }
    public function postPraktikum(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->file()) {

            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_praktikum_' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pendidikan'), $filename);
                    $filenames[] = $filename;
                } else {
                    continue;
                }
            }
        } else {
            return 'Tidak ada file yang dipilih.';
        }

        $rencana->lampiran = $filenames;
        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 200);
    }
    public function editPraktikum(Request $request)
    {
        
    }
    public function deletePraktikum($id)
    {
        
    }
    //END OF METHOD B

    // START OF METHOD C
    public function getBimbingan($id)
    {
        $bimbingan = Rencana::join('detail_pendidikan', 'rencana.id_rencana', "=", 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'bimbingan')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($bimbingan, 200);
    }

    public function postBimbingan(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->file()) {

            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_bimbingan_' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pendidikan'), $filename);
                    $filenames[] = $filename;
                } else {
                    continue;
                }
            }
        } else {
            return 'Tidak ada file yang dipilih.';
        }

        $rencana->lampiran = $filenames;
        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 200);
    }

    public function editBimbingan(Request $request)
    {
        
    }

    public function deleteBimbingan($id)
    {
        
    }
    // END OF METHOD C

    // START OF METHOD D
    public function getSeminar($id)
    {
        $seminar = Rencana::join('detail_pendidikan', 'rencana.id_rencana', "=", 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelompok', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'seminar')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($seminar, 200);
    }

    public function postSeminar(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->file()) {

            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_seminar_' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pendidikan'), $filename);
                    $filenames[] = $filename;
                } else {
                    continue;
                }
            }
        } else {
            return 'Tidak ada file yang dipilih.';
        }

        $rencana->lampiran = $filenames;
        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 200);
    }

    public function editSeminar(Request $request)
    {
        
    }

    public function deleteSeminar($id)
    {
        
    }
    // END OF METHOD D

    // START OF METHOD E
    public function getTugasAkhir($id)
    {
        $tugasAkhir = Rencana::join('detail_pendidikan', 'rencana.id_rencana', "=", 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelompok', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'tugasAkhir')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($tugasAkhir, 200);
    }

    public function postTugasAkhir(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->file()) {

            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_tugasAkhir_' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pendidikan'), $filename);
                    $filenames[] = $filename;
                } else {
                    continue;
                }
            }
        } else {
            return 'Tidak ada file yang dipilih.';
        }

        $rencana->lampiran = $filenames;
        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 200);
    }


    public function editTugasAkhir(Request $request)
    {
        
    }

    public function deleteTugasAkhir($id)
    {
        
    }
    // END OF METHOD E

    // START OF METHOD F
    public function getProposal($id)
    {
        $proposal = Rencana::join('detail_pendidikan', 'rencana.id_rencana', "=", 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'proposal')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($proposal, 200);
    }

    public function postProposal(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->file()) {

            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_proposal_' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pendidikan'), $filename);
                    $filenames[] = $filename;
                } else {
                    continue;
                }
            }
        } else {
            return 'Tidak ada file yang dipilih.';
        }

        $rencana->lampiran = $filenames;
        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 200);
    }


    public function editProposal(Request $request)
    {
        
    }

    public function deleteProposal($id)
    {
        
    }
    // END OF METHOD F

    // START OF METHOD G
    public function getRendah($id)
    {
        $rencana = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_dosen', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'bimbing_rendah')
            ->where('id_dosen', $id)
            ->get();
        return response()->json($rencana, 200);
    }

    public function postRendah(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->file()) {

            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_rendah_' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pendidikan'), $filename);
                    $filenames[] = $filename;
                } else {
                    continue;
                }
            }
        } else {
            return 'Tidak ada file yang dipilih.';
        }

        $rencana->lampiran = $filenames;
        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 200);
    }

    public function editRendah(Request $request)
    {
        
    }

    public function deleteRendah($id)
    {
        
    }
    // END OF METHOD G

    // START OF METHOD H
    public function getKembang($id)
    {
        $rencana = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_sap', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'pengembangan')
            ->where('id_dosen', $id)
            ->get();
        return response()->json($rencana, 200);
    }

    public function postKembang(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->file()) {

            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_kembang_' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pendidikan'), $filename);
                    $filenames[] = $filename;
                } else {
                    continue;
                }
            }
        } else {
            return 'Tidak ada file yang dipilih.';
        }

        $rencana->lampiran = $filenames;
        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 200);
    }

    public function editKembang(Request $request)
    {
        
    }

    public function deleteKembang($id)
    {
        
    }
    // END OF METHOD H

    // START OF METHOD I

    public function getCangkok($id)
    {
        $cangkok = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_dosen', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'cangkok')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($cangkok, 200);
    }

    public function postCangkok(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->file()) {

            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_cangkok_' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pendidikan'), $filename);
                    $filenames[] = $filename;
                } else {
                    continue;
                }
            }
        } else {
            return 'Tidak ada file yang dipilih.';
        }

        $rencana->lampiran = $filenames;
        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 200);
    }

    public function deleteCangkok($id)
    {
        
    }

    public function editCangkok(Request $request)
    {
        
    }
    // END OF METHOD I


    // START OF METHOD J
    public function getKoordinator($id)
    {
        $koordinator = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'koordinator')
            ->where('id_dosen', $id)
            ->get();
        return response()->json($koordinator, 200);
    }

    public function postKoordinator(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->file()) {

            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_koordinator_' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pendidikan'), $filename);
                    $filenames[] = $filename;
                } else {
                    continue;
                }
            }
        } else {
            return 'Tidak ada file yang dipilih.';
        }

        $rencana->lampiran = $filenames;
        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 200);
    }

    public function editKoordinator(Request $request)
    {
        
    }

    public function deleteKoordinator($id)
    {
        
    }
    // END OF METHOD J

}
