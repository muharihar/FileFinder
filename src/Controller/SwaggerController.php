<?php
/*
 * This file is part of the Local File Finder package.
 *
 * (c) Muhamamad Hari S <hi.muhammad.hari@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Muharihar\FileFinder\Controller;

use App\Http\Controllers\Controller;

/**
 * SwaggerController class
 */
class SwaggerController extends Controller
{

    /**
     * Swagger UI method
     *
     * @return void
     */
    public function ui()
    {
        return view('FileFinder::swagger-ui', compact('result'));
    }

    /**
     * Openapi (json) specification method
     *
     * @return void
     */
    public function openapi()
    {
        $viewParameter = "";
        
        $openapi = view('FileFinder::openapi', compact('viewParameter'));
        
        $response = response($openapi)
            ->header('Content-Type', 'application/json');

        return $response;
    }
}
