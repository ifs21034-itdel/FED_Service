<?php

namespace App\Http\Controllers;

use App\Models\Rencana;
use Illuminate\Http\Request;

class RiwayatKegiatanController extends Controller
{
    public function getAllPendidikan($id, $id_ta)
    {
        // BAGIAN A
        $teori = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelas', 'detail_pendidikan.jumlah_evaluasi', 'detail_pendidikan.sks_matakuliah', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'teori')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN B
        $praktikum = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelas', 'detail_pendidikan.sks_matakuliah', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'praktikum')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN C
        $bimbingan = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'bimbingan')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN D
        $seminar = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelompok', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'seminar')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN E
        $tugasAkhir = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_kelompok', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'tugasAkhir')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN F
        $proposal = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_mahasiswa', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'proposal')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN G
        $rendah = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_sap', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'rendah')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN H
        $kembang = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_sap', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'pengembangan')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN I
        $cangkok = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.jumlah_dosen', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'cangkok')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN J
        $koordinator = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.lampiran', 'rencana.asesor1_fed', 'rencana.asesor2_fed')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'koordinator')
            ->where('id_tanggal_fed', $id_ta)
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
    public function getAllPenelitian($id, $id_ta)
    {
        // Ambil semua data dari masing-masing tabel rencana

        // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A
        $penelitian_kelompok = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_kelompok')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B
        $penelitian_mandiri = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_mandiri')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C
        $buku_terbit = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'buku_terbit')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D
        $buku_internasional = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'buku_internasional')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E // BAGIAN E
        $menyadur = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', "detail_penelitian.posisi", 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'menyadur')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F // BAGIAN F
        $menyunting = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.posisi', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'menyunting')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G // BAGIAN G
        $penelitian_modul = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.status_tahapan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.peran', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_modul')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H // BAGIAN H
        $penelitian_pekerti = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_pekerti')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I // BAGIAN I
        $penelitian_tridharma = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.jumlah_bkd', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penelitian_tridharma')
            ->where('id_tanggal_fed', $id_ta)
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
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'jurnal_ilmiah')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K // BAGIAN K
        $hak_paten = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.lingkup_wilayah', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'hak_paten')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L // BAGIAN L
        $media_massa = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'media_massa')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M // BAGIAN M
        $pembicara_seminar = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.lingkup_wilayah', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'pembicara_seminar')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N // BAGIAN N
        $penyajian_makalah = Rencana::join('detail_penelitian', 'rencana.id_rencana', '=', 'detail_penelitian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penelitian.jenis_pengerjaan', 'detail_penelitian.lingkup_wilayah', 'detail_penelitian.posisi', 'detail_penelitian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            // ->where("rencana.asesor1_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            // ->where("rencana.asesor2_frk", 1) //uncomment ketika implementasi save berdasarkan periode betul betul selesai
            ->where('rencana.sub_rencana', 'penyajian_makalah')
            ->where('id_tanggal_fed', $id_ta)
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
    public function getAllPengabdian($id, $id_ta)
    {

        // Ambil semua data dari masing-masing tabel rencana

        // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A // BAGIAN A
        $kegiatan = Rencana::join('detail_pengabdian', 'rencana.id_rencana', '=', 'detail_pengabdian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pengabdian.jumlah_durasi', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'kegiatan')
            ->where('id_tanggal_fed', $id_ta)
            ->get();


        // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B // BAGIAN B
        $penyuluhan = Rencana::join('detail_pengabdian', 'rencana.id_rencana', '=', 'detail_pengabdian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pengabdian.jumlah_durasi', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'penyuluhan')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C // BAGIAN C
        $konsultan = Rencana::join('detail_pengabdian', 'rencana.id_rencana', '=', 'detail_pengabdian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pengabdian.posisi', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'konsultan')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D // BAGIAN D
        $karya = Rencana::join('detail_pengabdian', 'rencana.id_rencana', '=', 'detail_pengabdian.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pengabdian.jenis_terbit', 'detail_pengabdian.status_tahapan', 'detail_pengabdian.jenis_pengerjaan', 'detail_pengabdian.peran', 'detail_pengabdian.jumlah_anggota', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'karya')
            ->where('id_tanggal_fed', $id_ta)
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
    public function getAllPenunjang($id, $id_ta)
    {
        // BAGIAN A
        $akademik = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jumlah_mahasiswa', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'akademik')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN B
        $bimbingan = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jumlah_mahasiswa', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'bimbingan')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN C
        $ukm = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penunjang.jumlah_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'ukm')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN D
        $sosial = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'sosial')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN E
        $struktural = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'detail_penunjang.jenis_jabatan_struktural', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'struktural')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN F
        $nonstruktural = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'detail_penunjang.jenis_jabatan_nonstruktural', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'nonstruktural')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN G
        $redaksi = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'redaksi')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN H
        $adhoc = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.asesor2_frk', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'adhoc')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN I
        $ketuapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'ketua_panitia')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN J
        $anggotapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'anggota_panitia')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN K
        $pengurusyayasan = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'pengurus_yayasan')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN L
        $asosiasi = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jenis_tingkatan', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'asosiasi')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN M
        $seminar = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'seminar')
            ->where('id_tanggal_fed', $id_ta)
            ->get();

        // BAGIAN N
        $reviewer = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_fed', 'rencana.asesor2_fed', 'rencana.lampiran')
            ->where("id_dosen", $id)
            ->where('rencana.sub_rencana', 'reviewer')
            ->where('id_tanggal_fed', $id_ta)
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

    public function getSimpulan($id, $id_ta)
    {
        try {
            $totalSksPendidikan = Rencana::where('id_dosen', $id)->where("jenis_rencana", "pendidikan")->whereNotNull("lampiran")->where('id_tanggal_fed', $id_ta)->sum("sks_terhitung");
            $totalSksPenelitian = Rencana::where('id_dosen', $id)->where("jenis_rencana", "penelitian")->whereNotNull("lampiran")->where('id_tanggal_fed', $id_ta)->sum("sks_terhitung");
            $totalSksPengabdian = Rencana::where('id_dosen', $id)->where("jenis_rencana", "pengabdian")->whereNotNull("lampiran")->where('id_tanggal_fed', $id_ta)->sum("sks_terhitung");
            $totalSksPenunjang = Rencana::where('id_dosen', $id)->where("jenis_rencana", "penunjang")->whereNotNull("lampiran")->where('id_tanggal_fed', $id_ta)->sum("sks_terhitung");
            $sksTotal = $totalSksPendidikan + $totalSksPenelitian + $totalSksPengabdian + $totalSksPenunjang;

            $res = [
                "sks_pendidikan" => $totalSksPendidikan,
                "sks_penelitian" => $totalSksPenelitian,
                "sks_pengabdian" => $totalSksPengabdian,
                "sks_penunjang" => $totalSksPenunjang,
                "sks_total" => $sksTotal
            ];

            return response()->json($res, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to retrieve data from database'], 500);
        }
    }
}
