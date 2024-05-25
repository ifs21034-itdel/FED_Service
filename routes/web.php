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
        //GET FILE LAMPIRAN
        $router->get('/get-lampiran/{fileName}', 'PenunjangController@getFileLampiran');
        $router->delete('/lampiran/{idRencana}/delete/{fileName}', 'PenunjangController@deleteFileLampiran');

        // Bagian A
        $router->get('/akademik/{id}', 'PenunjangController@getAkademik');
        // // END OF BAGIAN A

        //BAGIAN B
        $router->get('/bimbingan/{id}', 'PenunjangController@getBimbingan');
        // //END OF BAGIAN B

        //BAGIAN C
        $router->get('/ukm/{id}', 'PenunjangController@getUkm');

        //BAGIAN D
        $router->get('/sosial/{id}', 'PenunjangController@getSosial');

        // BAGIAN E
        $router->get('/struktural/{id}', 'PenunjangController@getStruktural');

        // BAGIAN F
        $router->get('/nonstruktural/{id}', 'PenunjangController@getNonstruktural');

        // BAGIAN G
        $router->get('/redaksi/{id}', 'PenunjangController@getRedaksi');

        // BAGIAN H
        $router->get('/adhoc/{id}', 'PenunjangController@getAdhoc');

        // BAGIAN I
        $router->get('/ketuapanitia/{id}', 'PenunjangController@getKetuaPanitia');

        // BAGIAN J
        $router->get('/anggotapanitia/{id}', 'PenunjangController@getAnggotaPanitia');

        // BAGIAN K
        $router->get('/pengurusyayasan/{id}', 'PenunjangController@getPengurusYayasan');

        //BAGIAN L
        $router->get('/asosiasi/{id}', 'PenunjangController@getAsosiasi');

        //BAGIAN M
        $router->get('/seminar/{id}', 'PenunjangController@getSeminar');


        //BAGIAN N
        $router->get('/reviewer/{id}', 'PenunjangController@getReviewer');

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
        $router->delete('/lampiran/{idRencana}/delete/{fileName}', 'PenelitianController@deleteFileLampiran');

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
