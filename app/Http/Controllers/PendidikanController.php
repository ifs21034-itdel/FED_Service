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
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelas', 'detail_pendidikan.jumlah_evaluasi', 'detail_pendidikan.sks_matakuliah', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'teori')
            ->get();

        // BAGIAN C
        $bimbingan = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'bimbingan')
            ->get();

        // BAGIAN D
        $rendah = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_dosen', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'bimbing_rendah')
            ->get();

        // BAGIAN E
        $tugasAkhir = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'tugasAkhir')
            ->get();

        // BAGIAN F
        $proposal = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'proposal')
            ->get();

        // BAGIAN G
        $kembang = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_sap', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'bimbing_rendah')
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
            'bimbingan' => $bimbingan,
            'rendah' => $rendah,
            'kembang' => $kembang,
            'cangkok' => $cangkok,
            'koordinator' => $koordinator,
            'tugasAkhir' => $tugasAkhir,
            'proposal' => $proposal
        ], 200);
    }

    // START OF METHOD A
    public function getTeori($id)
    {
        $teori = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelas', 'detail_pendidikan.jumlah_evaluasi', 'detail_pendidikan.sks_matakuliah', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'teori')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($teori, 200);
    }

    public function postTeori(Request $request)
    {
        
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
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung')
            ->where('rencana.sub_rencana', 'tugasAkhir')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($tugasAkhir, 200);
    }

    public function postTugasAkhir(Request $request)
    {
        
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
        
    }

    public function editKoordinator(Request $request)
    {
        
    }

    public function deleteKoordinator($id)
    {
        
    }
    // END OF METHOD J

}
