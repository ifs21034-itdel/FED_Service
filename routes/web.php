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
        //teori
        $router->get('/teori/{id}', 'PendidikanController@getTeori');
        $router->post('/teori', 'PendidikanController@postTeori');
        $router->delete('/teori/{id}', 'PendidikanController@deleteTeori');
        $router->post('/edit/teori', 'PendidikanController@editTeori');

        //praktikum
        $router->get('/praktikum/{id}', 'PendidikanController@getPraktikum');
        $router->post('/praktikum', 'PendidikanController@postPraktikum');
        $router->delete('/praktikum/{id}', 'PendidikanController@deletePraktikum');
        $router->post('/edit/praktikum', 'PendidikanController@editPraktikum');
        
        //bimbingan
        $router->get('/bimbingan/{id}', 'PendidikanController@getBimbingan');
        $router->post('/bimbingan', 'PendidikanController@postBimbingan');
        $router->delete('/bimbingan/{id}', 'PendidikanController@deleteBimbingan');
        $router->post('/edit/bimbingan', 'PendidikanController@editBimbingan');
        
        //seminar
        $router->get('/seminar/{id}', 'PendidikanController@getSeminar');
        $router->post('/seminar', 'PendidikanController@postSeminar');
        $router->delete('/seminar/{id}', 'PendidikanController@deleteSeminar');
        $router->post('/edit/seminar', 'PendidikanController@editSeminar');
        
        //Tugas Akhir
        $router->get('/tugasAkhir/{id}', 'PendidikanController@getTugasakhir');
        $router->post('/tugasAkhir', 'PendidikanController@postTugasakhir');
        $router->delete('/tugasAkhir/{id}', 'PendidikanController@deleteTugasakhir');
        $router->post('/edit/tugasAkhir', 'PendidikanController@editTugasakhir');
        
        //Proposal

        // rendah

        // Kembang

        // CANGKOK

        //KOORDINATOR
    });
    //END ROUTE FOR PENDIDIKAN

    //

});