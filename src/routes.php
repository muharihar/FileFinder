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

Route::get('file-finder/api/docs', 'Muharihar\FileFinder\Controller\SwaggerController@ui');
Route::get('file-finder/api/docs/openapi.json', 'Muharihar\FileFinder\Controller\SwaggerController@openapi');
Route::get('file-finder/api/v1.0/default/list-dir-and-files', 'Muharihar\FileFinder\Controller\FileFinderController@listDirAndFiles');
Route::get('file-finder/api/v1.0/search/by-name', 'Muharihar\FileFinder\Controller\FileFinderController@searchByName');
Route::get('file-finder/api/v1.0/search/by-content', 'Muharihar\FileFinder\Controller\FileFinderController@searchByContent');