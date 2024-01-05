<?php

/**
 * Switch between the included languages
 */
require(__DIR__ . "/Routes/Global/Lang.php");

/**
 * Frontend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Frontend'], function () use ($router)
{
	require(__DIR__ . "/Routes/Frontend/Frontend.php");
	require(__DIR__ . "/Routes/Frontend/Access.php");
});

/**
 * Backend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Backend'], function () use ($router)
{
	$router->group(['prefix' => 'admin', 'middleware' => 'auth'], function () use ($router)
	{
		/**
		 * These routes need view-backend permission (good if you want to allow more than one group in the backend, then limit the backend features by different roles or permissions)
		 *
		 * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
		 */
		$router->group(['middleware' => 'access.routeNeedsPermission:view-backend'], function () use ($router)
		{
			require(__DIR__ . "/Routes/Backend/Dashboard.php");
			require(__DIR__ . "/Routes/Backend/Access.php");
		});
	});
});
/** Universidades */
Route::get('/universidades', 'UniversidadController@index');
Route::get('/editar_universidad/{id}', 'UniversidadController@edit');
Route::get('/eliminar_universidad/{id}', 'UniversidadController@delete');

Route::post('/store_universidad', [
    'uses' => 'UniversidadController@store',
    'as' => 'store_universidad'
]);
Route::post('/update_universidad', [
    'uses' => 'UniversidadController@update',
    'as' => 'update_universidad'
]);

Route::get('/universidades_frontend', 'UniversidadController@universidades');


/** Escuelas */
Route::get('/escuelas/{facultad_id}', 'EscuelaController@index');

Route::get('/escuelas_frontend/{facultad_id}', 'EscuelaController@escuelas');


Route::get('/eliminar_escuela/{id}', 'EscuelaController@delete');
Route::get('/editar_escuela/{id}', 'EscuelaController@edit');
Route::post('/store_escuela', [
    'uses' => 'EscuelaController@store',
    'as' => 'store_escuela'
]);


Route::post('/update_escuela', [
    'uses' => 'EscuelaController@update',
    'as' => 'update_escuela'
]);
/** Mapas */

Route::get('/edusys', 'MapaController@edusys');
Route::get('/mapas', 'MapaController@index');
Route::get('/mapa_oferta', 'MapaController@index_frontend');


Route::post('/buscar_tema', [
    'uses' => 'MapaController@buscar_tema',
    'as' => 'buscar_tema'
]);

Route::post('/buscar_tema_frontend', [
    'uses' => 'MapaController@buscar_tema_frontend',
    'as' => 'buscar_tema_frontend'
]);



/**Posgrado y tema */
Route::get('/posgrado_tema/{posgrado_id}', 'PosgradoTemasController@index');
Route::post('/store_plan_posgrado', [
    'uses' => 'PosgradoTemasController@store',
    'as' => 'store_plan_posgrado'
]);
Route::get('/eliminar_temaPosgrado/{posgrado_id}', 'PosgradoTemasController@delete');
Route::get('/editar_temaPosgrado/{posgrado_id}', 'PosgradoTemasController@edit');

Route::post('/update_plan_posgrado', [
    'uses' => 'PosgradoTemasController@update',
    'as' => 'update_plan_posgrado'
]);


/** Planes y Temas */
Route::get('/planes_temas/{escuela_id}', 'PlanesPregradoController@index');
Route::get('/editar_plan/{id}', 'PlanesPregradoController@edit');
Route::get('/eliminar_plan/{id}', 'PlanesPregradoController@delete');


Route::post('/update_plan', [
    'uses' => 'PlanesPregradoController@update',
    'as' => 'update_plan'
]);
Route::post('/store_plan', [
    'uses' => 'PlanesPregradoController@store',
    'as' => 'store_plan'
]);
/** Posgrados */
Route::get('/posgrados/{universidad_id}', 'PosgradoController@index');
Route::get('/posgrados_frontend/{universidad_id}', 'PosgradoTemasController@posgrados');


Route::get('/editar_posgrado/{id}', 'PosgradoController@edit');

Route::get('/eliminar_posgrado/{id}', 'PosgradoController@delete');
Route::post('/store_posgrado', [
    'uses' => 'PosgradoController@store',
    'as' => 'store_posgrado'
]);

Route::post('/update_posgrado', [
    'uses' => 'PosgradoController@update',
    'as' => 'update_posgrado'
]);


/** Facultades */
Route::get('/facultades/{universidad_id}', 'FacultadController@index');
Route::get('/facultades_frontend/{universidad_id}', 'FacultadController@facultades');


Route::get('/editar_facultad/{id}', 'FacultadController@edit');
Route::get('/eliminar_facultad/{id}', 'FacultadController@delete');
Route::post('/store_facultad', [
    'uses' => 'FacultadController@store',
    'as' => 'store_facultad'
]);

Route::post('/update_facultad', [
    'uses' => 'FacultadController@update',
    'as' => 'update_facultad'
]);



/** tema */
Route::get('/temas', 'TemaController@index');
Route::get('/editar_tema/{id}', 'TemaController@edit');
Route::get('/eliminar_tema/{id}', 'TemaController@delete');

Route::post('/store_tema', [
    'uses' => 'TemaController@store',
    'as' => 'store_tema'
]);
Route::post('/update_tema', [
    'uses' => 'TemaController@update',
    'as' => 'update_tema'
]);



