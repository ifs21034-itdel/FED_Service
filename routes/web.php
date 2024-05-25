<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PenunjangController;
use App\Http\Controllers\PenelitianController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    //PENDIDIKAN START
    $router->get('/pendidikan', 'PendidikanController@getAll');

    //START ROUTE FOR PENDIDIKAN
    $router->group(['prefix' => 'pendidikan'], function () use ($router) {
        // //teori
        $router->get('/teori/{id}', 'PendidikanController@getTeori');
        // $router->post('/teori', 'PendidikanController@postTeori');
        // $router->delete('/teori/{id}', 'PendidikanController@deleteTeori');
        // $router->post('/edit/teori', 'PendidikanController@editTeori');

        // //praktikum
        $router->get('/praktikum/{id}', 'PendidikanController@getPraktikum');
        // $router->post('/praktikum', 'PendidikanController@postPraktikum');
        // $router->delete('/praktikum/{id}', 'PendidikanController@deletePraktikum');
        // $router->post('/edit/praktikum', 'PendidikanController@editPraktikum');

        // //bimbingan
        $router->get('/bimbingan/{id}', 'PendidikanController@getBimbingan');
        // $router->post('/bimbingan', 'PendidikanController@postBimbingan');
        // $router->delete('/bimbingan/{id}', 'PendidikanController@deleteBimbingan');
        // $router->post('/edit/bimbingan', 'PendidikanController@editBimbingan');

        // //seminar
        $router->get('/seminar/{id}', 'PendidikanController@getSeminar');
        // $router->post('/seminar', 'PendidikanController@postSeminar');
        // $router->delete('/seminar/{id}', 'PendidikanController@deleteSeminar');
        // $router->post('/edit/seminar', 'PendidikanController@editSeminar');

        // //Tugas Akhir
        $router->get('/tugasAkhir/{id}', 'PendidikanController@getTugasakhir');
        // $router->post('/tugasAkhir', 'PendidikanController@postTugasakhir');
        // $router->delete('/tugasAkhir/{id}', 'PendidikanController@deleteTugasakhir');
        // $router->post('/edit/tugasAkhir', 'PendidikanController@editTugasakhir');

        // //proposal
        $router->get('/proposal/{id}', 'PendidikanController@getProposal');
        // $router->post('/proposal', 'PendidikanController@postProposal');
        // $router->delete('/proposal/{id}', 'PendidikanController@deleteProposal');
        // $router->post('/edit/proposal', 'PendidikanController@editProposal');

        // // rendah
        $router->get('/rendah/{id}', 'PendidikanController@getRendah');
        // $router->post('/rendah', 'PendidikanController@postRendah');
        // $router->delete('/rendah/{id}', 'PendidikanController@deleteRendah');
        // $router->post('/edit/rendah', 'PendidikanController@editRendah');

        // // kembang
        $router->get('/kembang/{id}', 'PendidikanController@getKembang');
        // $router->post('/kembang', 'PendidikanController@postKembang');
        // $router->delete('/kembang/{id}', 'PendidikanController@deleteKembang');
        // $router->post('/edit/kembang', 'PendidikanController@editKembang');

        // //cangkok
        $router->get('/cangkok/{id}', 'PendidikanController@getCangkok');
        // $router->post('/cangkok', 'PendidikanController@postCangkok');
        // $router->delete('/cangkok/{id}', 'PendidikanController@deleteCangkok');
        // $router->post('/edit/cangkok', 'PendidikanController@editCangkok');

        // //koordinator
        $router->get('/koordinator/{id}', 'PendidikanController@getKoordinator');
        // $router->post('/koordinator', 'PendidikanController@postKoordinator');
        // $router->delete('/koordinator/{id}', 'PendidikanController@deleteKoordinator');
        // $router->post('/edit/koordinator', 'PendidikanController@editKoordinator');

        //UPLOAD LAMPIRAN
        $router->post('/upload-lampiran', 'PendidikanController@postLampiran');
    });
    //END ROUTE FOR PENDIDIKAN

    //START ROUTE FOR PENUNJANG
    $router->get('/penunjang', 'PenunjangController@getAll');

    $router->group(['prefix' => 'penunjang'], function () use ($router) {
        // Bagian A
        $router->get('/akademik/{id}', 'PenunjangController@getAkademik');
        // $router->post('/akademik', 'PenunjangController@postAkademik');
        // $router->post('/edit/akademik', 'PenunjangController@editAkademik');
        // $router->delete('/akademik/{id}', 'PenunjangController@deleteAkademik');
        // // END OF BAGIAN A

        //BAGIAN B
        $router->get('/bimbingan/{id}', 'PenunjangController@getBimbingan');
        // $router->post('/bimbingan', 'PenunjangController@postBimbingan');
        // $router->post('/edit/bimbingan', 'PenunjangController@editBimbingan');
        // $router->delete('/bimbingan/{id}', 'PenunjangController@deleteBimbingan');
        // //END OF BAGIAN B

        //BAGIAN C
        $router->get('/ukm/{id}', 'PenunjangController@getUkm');
        // $router->post('/ukm', 'PenunjangController@postUkm');
        // $router->post('/edit/ukm/', 'PenunjangController@editUkm');
        // $router->delete('/ukm/{id}', 'PenunjangController@deleteUkm');
        // //END OF BAGIAN C

        //BAGIAN D
        $router->get('/sosial/{id}', 'PenunjangController@getSosial');
        // $router->post('/sosial', 'PenunjangController@postSosial');
        // $router->post('/edit/sosial/', 'PenunjangController@editSosial');
        // $router->delete('/sosial/{id}', 'PenunjangController@deleteSosial');
        // //END OF BAGIAN D

        // BAGIAN E
        $router->get('/struktural/{id}', 'PenunjangController@getStruktural');
        // $router->post('/struktural', 'PenunjangController@postStruktural');
        // $router->post('/edit/struktural/', 'PenunjangController@editStruktural');
        // $router->delete('/struktural/{id}', 'PenunjangController@deleteStruktural');
        // // END OF BAGIAN E

        // BAGIAN F
        $router->get('/nonstruktural/{id}', 'PenunjangController@getNonstruktural');
        // $router->post('/nonstruktural', 'PenunjangController@postNonstruktural');
        // $router->post('/edit/nonstruktural/', 'PenunjangController@editNonstruktural');
        // $router->delete('/nonstruktural/{id}', 'PenunjangController@deleteNonstruktural');
        // // END OF BAGIAN F

        // BAGIAN G
        $router->get('/redaksi/{id}', 'PenunjangController@getRedaksi');
        // $router->post('/redaksi', 'PenunjangController@postRedaksi');
        // $router->post('/edit/redaksi/', 'PenunjangController@editRedaksi');
        // $router->delete('/redaksi/{id}', 'PenunjangController@deleteRedaksi');
        // // END OF BAGIAN G

        // BAGIAN H
        $router->get('/adhoc/{id}', 'PenunjangController@getAdhoc');
        // $router->post('/adhoc', 'PenunjangController@postAdhoc');
        // $router->post('/edit/adhoc/', 'PenunjangController@editAdhoc');
        // $router->delete('/adhoc/{id}', 'PenunjangController@deleteAdhoc');
        // // END OF BAGIAN H

        // BAGIAN I
        $router->get('/ketuapanitia/{id}', 'PenunjangController@getKetuaPanitia');
        // $router->post('/ketuapanitia', 'PenunjangController@postKetuaPanitia');
        // $router->post('/edit/ketuapanitia', 'PenunjangController@editKetuaPanitia');
        // $router->delete('/ketuapanitia/{id}', 'PenunjangController@deleteKetuaPanitia');

        // BAGIAN J
        $router->get('/anggotapanitia/{id}', 'PenunjangController@getAnggotaPanitia');
        // $router->post('/anggotapanitia', 'PenunjangController@postAnggotaPanitia');
        // $router->post('/edit/anggotapanitia', 'PenunjangController@editAnggotaPanitia');
        // $router->delete('/anggotapanitia/{id}', 'PenunjangController@deleteAnggotaPanitia');

        // BAGIAN K
        $router->get('/pengurusyayasan/{id}', 'PenunjangController@getPengurusYayasan');
        // $router->post('/pengurusyayasan', 'PenunjangController@postPengurusYayasan');
        // $router->post('/edit/pengurusyayasan', 'PenunjangController@editPengurusYayasan');
        // $router->delete('/pengurusyayasan/{id}', 'PenunjangController@deletePengurusYayasan');

        //BAGIAN L
        $router->get('/asosiasi/{id}', 'PenunjangController@getAsosiasi');
        // $router->post('/asosiasi', 'PenunjangController@postAsosiasi');
        // $router->post('/edit/asosiasi', 'PenunjangController@editAsosiasi');
        // $router->delete('/asosiasi/{id}', 'PenunjangController@deleteAsosiasi');
        // //END OF BAGIAN L


        //BAGIAN M
        $router->get('/seminar/{id}', 'PenunjangController@getSeminar');
        // $router->post('/seminar', 'PenunjangController@postSeminar');
        // $router->post('/edit/seminar', 'PenunjangController@editSeminar');
        // $router->delete('/seminar/{id}', 'PenunjangController@deleteSeminar');
        //END OF BAGIAN M


        //BAGIAN N
        $router->get('/reviewer/{id}', 'PenunjangController@getReviewer');
        // $router->post('/reviewer', 'PenunjangController@postReviewer');
        // $router->post('/edit/reviewer', 'PenunjangController@editReviewer');
        // $router->delete('/reviewer/{id}', 'PenunjangController@deleteReviewer');
        // //END OF BAGIAN N

        //UPLOAD LAMPIRAN
        $router->post('/upload-lampiran', 'PenunjangController@postLampiran');
    });

    //END ROUTE FOR PENUNJANG

    // START ROUTE FOR PENELITIAN
    $router->group(['prefix' => 'penelitian'], function () use ($router) {
        //UPLOAD LAMPIRAN
        $router->post('/upload-lampiran', 'PenelitianController@postLampiran');

        //GET FILE LAMPIRAN
        $router->get('/get-lampiran/{fileName}', 'PenelitianController@getFileLampiran');
        $router->delete('/delete-lampiran/{fileName}', 'PenelitianController@deleteFileLampiran');

        //BAGIAN A
        $router->get('/penelitan-kelompok/{id}', 'PenelitianController@getPenelitianKelompok($id)');

        //BAGIAN B
        $router->get('/penelitian-mandiri/{id}', 'PeneltianController@getPenelitianMandiri($id)');

        //BAGIAN D
        $router->get('/buku-internasional/{id}', 'PenelitianController@getBukuInternasional');

        //BAGIAN M
        $router->get('/pembicara-seminar/{id}', 'PenelitianController@getPembicaraSeminar');

        //BAGIAN N
        $router->get('/penyajian-makalah/{id}', 'PenelitianController@getPenyajianMakalah');
    });

    $router->group(['prefix' => 'pengabdian'], function() use ($router){

        //UPLOAD LAMPIRAN
        $router->post('/upload-lampiran', 'PengabdianController@postLampiran');
    });


});
