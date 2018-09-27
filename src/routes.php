<?php
/*
 * This file is part of the Local File Finder package.
 *
 * (c) Muhamamad Hari S <hi.muhammad.hari@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::get('file-finder', function(){
	return redirect('file-finder/api/docs');
});

Route::get('file-finder/api/docs', 'Muharihar\FileFinder\Controllers\SwaggerController@ui');
Route::get('file-finder/api/docs/openapi.json', 'Muharihar\FileFinder\Controllers\SwaggerController@openapi');
Route::get('file-finder/api/v1.0/default/list-dir-and-files', 'Muharihar\FileFinder\Controllers\FileFinderController@listDirAndFiles');
Route::get('file-finder/api/v1.0/search/by-name', 'Muharihar\FileFinder\Controllers\FileFinderController@searchByName');
Route::get('file-finder/api/v1.0/search/by-content', 'Muharihar\FileFinder\Controllers\FileFinderController@searchByContent');