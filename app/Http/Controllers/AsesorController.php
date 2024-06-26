<?php

namespace App\Http\Controllers;

use App\Models\Rencana;
use Illuminate\Http\Request;

class AsesorController extends Controller
{
    public function getAllDosen()
    {
        try {
            $res = Rencana::where('flag_save_permananent_fed', 1)
                ->select('id_dosen')
                ->distinct()
                ->get();
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            return response()->json($res, 400);
        }
    }

    public function reviewEvaluasi(Request $request)
    {
        $id_rencana = $request->get('id_rencana');
        $komentar = $request->get('komentar');
        $role = $request->get('role');
        $rencana = Rencana::where('id_rencana', $id_rencana)->first();

        if ($role == '1') {
            $rencana->asesor1_fed = $komentar;
        } else if ($role == '2') {
            $rencana->asesor2_fed = $komentar;
        }

        $res = [
            "rencana" => $rencana,
            "message" => "Successfully give approval for fed"
        ];

        $rencana->save();

        return response()->json($res, 200);
    }

    public function getAllCompleteDosen($role)
    {
        try {
            if ($role == 'asesor1') {
                $condition = 'COUNT(*) = SUM(CASE WHEN asesor1_fed = "setuju" THEN 1 ELSE 0 END)';
            } else {
                $condition = 'COUNT(*) = SUM(CASE WHEN asesor2_fed = "setuju" THEN 1 ELSE 0 END)';
            }
            $res = Rencana::select('id_dosen')
                ->groupBy('id_dosen')
                ->havingRaw($condition)
                ->pluck('id_dosen');

            return response()->json($res, 200);
        } catch (\Throwable $th) {
            return response()->json($res, 400);
        }
    }

    public function getAllPendidikan($id)
    {
        // BAGIAN A
        $teori = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelas', 'detail_pendidikan.jumlah_evaluasi', 'detail_pendidikan.sks_matakuliah', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'teori')
            ->get();

        // BAGIAN B
        $praktikum = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelas', 'detail_pendidikan.sks_matakuliah', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'praktikum')
            ->get();

        // BAGIAN C
        $bimbingan = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'bimbingan')
            ->get();

        // BAGIAN D
        $seminar = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelompok', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'seminar')
            ->get();

        // BAGIAN E
        $tugasAkhir = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelompok', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'tugasAkhir')
            ->get();

        // BAGIAN F
        $proposal = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'proposal')
            ->get();

        // BAGIAN G
        $rendah = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_sap', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'rendah')
            ->get();

        // BAGIAN H
        $kembang = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_sap', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'pengembangan')
            ->get();

        // BAGIAN I
        $cangkok = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_dosen', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'cangkok')
            ->get();

        // BAGIAN J
        $koordinator = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
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
    public function getAllPenelitian($id)
    {
        // Ambil semua data dari masing-masing tabel rencana

        // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A
        $penelitian_kelompok = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_kelompok')
            ->get();

        // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B
        $penelitian_mandiri = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_mandiri')
            ->get();

        // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C
        $buku_terbit = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'buku_terbit')
            ->get();

        // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D
        $buku_internasional = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'buku_internasional')
            ->get();

        // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E
        $menyadur = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', "detail_penelitian.posisi", 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'menyadur')
            ->get();

        // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F
        $menyunting = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.posisi', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'menyunting')
            ->get();

        // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G
        $penelitian_modul = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_modul')
            ->get();

        // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H
        $penelitian_pekerti = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_pekerti')
            ->get();

        // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I
        $penelitian_tridharma = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.jumlah_bkd', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
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
                'rencana.asesor1_fed',
                'rencana.asesor2_fed',
                'rencana.lampiran'
            )
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'jurnal_ilmiah')
            ->get();

        // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K
        $hak_paten = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.lingkup_wilayah', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'hak_paten')
            ->get();

        // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L
        $media_massa = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'media_massa')
            ->get();

        // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M
        $pembicara_seminar = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.lingkup_wilayah', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'pembicara_seminar')
            ->get();

        // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N
        $penyajian_makalah = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.lingkup_wilayah', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
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
    public function getAllPengabdian($id)
    {

        // Ambil semua data dari masing-masing tabel rencana

        // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A
        $kegiatan = Rencana::join('detail_pengabdian', 'rencana.id_rencana', '=', 'detail_pengabdian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pengabdian.jumlah_durasi', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'kegiatan')
            ->get();


        // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B
        $penyuluhan = Rencana::join('detail_pengabdian', 'rencana.id_rencana', '=', 'detail_pengabdian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pengabdian.jumlah_durasi', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'penyuluhan')
            ->get();

        // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C
        $konsultan = Rencana::join('detail_pengabdian', 'rencana.id_rencana', '=', 'detail_pengabdian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pengabdian.posisi', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'konsultan')
            ->get();

        // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D
        $karya = Rencana::join('detail_pengabdian', 'rencana.id_rencana', '=', 'detail_pengabdian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pengabdian.jenis_terbit', 'detail_pengabdian.status_tahapan', 'detail_pengabdian.jenis_pengerjaan', 'detail_pengabdian.peran', 'detail_pengabdian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'karya')
            ->get();

        // Kembalikan data dalam bentuk yang sesuai untuk ditampilkan di halaman
        return response()->json([
            //Data Kegiatan
            'kegiatan' => $kegiatan,
            //Data Penyuluhan
            'penyuluhan' => $penyuluhan,

            //Data Konsultan
            'konsultan' => $konsultan,
            //Data Karya
            'karya' => $karya
        ], 200);
    }
    public function getAllPenunjang($id)
    {
        // BAGIAN A
        $akademik = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jumlah_mahasiswa', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'akademik')
            ->get();

        // BAGIAN B
        $bimbingan = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jumlah_mahasiswa', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'bimbingan')
            ->get();

        // BAGIAN C
        $ukm = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penunjang.jumlah_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'ukm')
            ->get();

        // BAGIAN D
        $sosial = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'sosial')
            ->get();

        // BAGIAN E
        $struktural = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'detail_penunjang.jenis_jabatan_struktural', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'struktural')
            ->get();

        // BAGIAN F
        $nonstruktural = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'detail_penunjang.jenis_jabatan_nonstruktural', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'nonstruktural')
            ->get();

        // BAGIAN G
        $redaksi = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'redaksi')
            ->get();

        // BAGIAN H
        $adhoc = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'adhoc')
            ->get();

        // BAGIAN I
        $ketuapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'ketua_panitia')
            ->get();

        // BAGIAN J
        $anggotapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'anggota_panitia')
            ->get();

        // BAGIAN K
        $pengurusyayasan = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'pengurus_yayasan')
            ->get();

        // BAGIAN L
        $asosiasi = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jenis_tingkatan', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'asosiasi')
            ->get();

        // BAGIAN M
        $seminar = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
            ->where('rencana.sub_rencana', 'seminar')
            ->get();

        // BAGIAN N
        $reviewer = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->whereNotNull("lampiran")
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
}
