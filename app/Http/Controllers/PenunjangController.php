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

    //Handler A. Bimbingan Akademik
    public function getAkademik($id)
    {
        $akademik = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jumlah_mahasiswa', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'akademik')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($akademik, 200);
    }
    public function postAkademik(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        $id_dosen = $rencana->id_dosen;

        $filenames = [];
        
        if ($request->file()) { 
            $file = $request->file('fileInput');
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen  . '_' . time() . '.' . $extension;
            $file->move(app()->basePath('storage/documents/penunjang/akademik'), $filename);
            $filenames[] = $filename; 
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
    public function editAkademik(Request $request)
    {
        
    }
    public function deleteAkademik($id)
    {
        
    }


    //Handler B. Bimbingan dan Konseling
    public function getBimbingan($id)
    {
        $bimbingan = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jumlah_mahasiswa', 'rencana.lampiran')
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
            $file = $request->file('fileInput');
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_' . time() . '.' . $extension;
            $file->move(app()->basePath('storage/documents/penunjang/bimbingan'), $filename);
            $filenames[] = $filename; 
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

    //Handler C. Pimpinan Pembinaan UKM
    public function getUkm($id)
    {
        $ukm = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_penunjang.jumlah_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'ukm')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($ukm, 200);
    }

    public function postUkm(Request $request)
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang/ukm'), $filename);
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

    public function editUkm(Request $request)
    {
        
    }
    public function deleteUkm($id)
    {
        
    }

    //Handler D. Pimpinan organisasi sosial intern
    public function getSosial($id)
    {
        $sosial = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'sosial')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($sosial, 200);
    }

    public function postSosial(Request $request)
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang/sosial'), $filename);
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

    public function editSosial(Request $request)
    {
        
    }

    public function deleteSosial($id)
    {
        
    }

    //Handler E. Jabatan Struktural
    public function getStruktural($id)
    {
        $struktural = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_jabatan_struktural', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'struktural')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($struktural, 200);
    }

    public function postStruktural(Request $request)
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang/struktural'), $filename);
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

    public function editStruktural(Request $request)
    {
        
    }

    public function deleteStruktural($id)
    {
        
    }


    //Handler F. Jabatan non struktural
    public function getNonstruktural($id)
    {
        $nonstruktural = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_jabatan_nonstruktural', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'nonstruktural')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($nonstruktural, 200);
    }

    public function postNonstruktural(Request $request)
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang/nonstruktural'), $filename);
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

    public function editNonstruktural(Request $request)
    {
        
    }

    public function deleteNonstruktural($id)
    {
        
    }

    //Handler G. Ketua Redaksi Jurnal
    public function getRedaksi($id)
    {
        $redaksi = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'redaksi')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($redaksi, 200);
    }

    public function postRedaksi(Request $request)
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang/redaksi'), $filename);
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

    public function editRedaksi(Request $request)
    {
        
    }

    public function deleteRedaksi($id)
    {
        
    }
    //Handler H. Ketua Ad Hoc
    public function getAdhoc($id)
    {
        $adhoc = Rencana::join('detail_penunjang', 'rencana.id_rencana', "=", "detail_penunjang.id_rencana")
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'adhoc')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($adhoc, 200);
    }

    public function postAdhoc(Request $request)
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang/adhoc'), $filename);
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

    public function editAdhoc(Request $request)
    {
        
    }

    public function deleteAdhoc($id)
    {
        
    }


    //Handler I. Ketua Panitia Tetap
    public function getKetuaPanitia($id)
    {
        $ketuapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'ketua_panitia')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($ketuapanitia, 200);
    }
    public function postKetuaPanitia(Request $request)
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_penunjang_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang'), $filename);
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
    public function editKetuaPanitia(Request $request)
    {
        
    }
    public function deleteKetuaPanitia($id)
    {
        
    }

    //Handler J. Anggota Panitia Tetap
    public function getAnggotaPanitia($id)
    {
        $anggotapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'anggota_panitia')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($anggotapanitia, 200);
    }
    public function postAnggotaPanitia(Request $request)
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_penunjang_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang'), $filename);
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
    public function editAnggotaPanitia(Request $request)
    {
        
    }
    public function deleteAnggotaPanitia($id)
    {
        
    }

    //Handler K. Menjadi Pengurus Yayasan
    public function getPengurusYayasan($id)
    {
        $anggotapanitia = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'pengurus_yayasan')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($anggotapanitia, 200);
    }
    public function postPengurusYayasan(Request $request)
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_penunjang_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang'), $filename);
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
    public function editPengurusYayasan(Request $request)
    {
        
    }
    public function deletePengurusYayasan($id)
    {
        
    }

    //Handler L. Menjadi Pengurus/Anggota Asosiasi Profesi
    public function getAsosiasi($id)
    {
        $asosiasi = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'detail_penunjang.jabatan', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'asosiasi')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($asosiasi, 200);
    }
    public function postAsosiasi(Request $request)
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_penunjang_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang'), $filename);
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

    public function editAsosiasi(Request $request)
    {
        
    }
    public function deleteAsosiasi($id)
    {
        
    }

    //Handler M. Peserta seminar/workshop/kursus berdasar penugasan pimpinan
    public function getSeminar($id)
    {
        $seminar = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'detail_penunjang.jenis_tingkatan', 'rencana.lampiran')
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_penunjang_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang'), $filename);
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

    //Handler N. Reviewer jurnal ilmiah , proposal Hibah dll
    public function getReviewer($id)
    {
        $reviewer = Rencana::join('detail_penunjang', 'rencana.id_rencana', '=', 'detail_penunjang.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'rencana.sks_terhitung', 'rencana.asesor1_frk', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'reviewer')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($reviewer, 200);
    }
    public function postReviewer(Request $request)
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
                  $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_penunjang_' . time() . '.' . $extension;
                  $file->move(app()->basePath('storage/documents/penunjang'), $filename);
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
    public function editReviewer(Request $request)
    {
        
    }

    public function deleteReviewer($id)
    {
        
    }
}