<?php
/*
 * This file is part of the Local File Finder package.
 *
 * (c) Muhamamad Hari S <hi.muhammad.hari@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Muharihar\FileFinder\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Muharihar\FileFinder\FileFinder;

/**
 * FileFinderController class
 */
class FileFinderController extends Controller
{
    /**
     * listDirAndFiles method
     *
     * @return void
     */
    public function listDirAndFiles()
    {
        // Init FileFinder Library
        $fFinder = new FileFinder();
        $directory = 'public/file-finder';

        // list all directories and files
        $directory = storage_path("app/" . $directory);
        $result = $fFinder->listDirAndFiles($directory);

        // Make a Response
        $response = $this->makeResponse($result);

        // Send Response
        return $response;
    }

    /**
     * searchByName method
     *
     * @param Request $request
     * @return void
     */
    public function searchByName(Request $request)
    {
        // Get KeySearch from Query String
        $searchKey = "";
        if ($request->has('s')) {
            $searchKey = $request->input('s');
        }

        // Make empty response if searchKey is not defined
        $found = array();
        if (trim($searchKey) == "") {
            // Make a Response
            $response = $this->makeResponse($found, $searchKey);

            // Send Response
            return $response;
        }

        // Init FileFinder Library
        $fFinder = new FileFinder();
        $directory = 'public/file-finder';

        // Search By Name
        $found = $fFinder->findAllDirAndFileByName($directory, $searchKey);

        // Make a Response
        $response = $this->makeResponse($found, $searchKey);

        // Send Response
        return $response;
    }

    /**
     * searchByContent method
     *
     * @param Request $request
     * @return void
     */
    public function searchByContent(Request $request)
    {
        // Get KeySearch from Query String
        $searchKey = "";
        if ($request->has('s')) {
            $searchKey = $request->input('s');
        }

        // Make empty response if searchKey is not defined
        $found = array();
        if (trim($searchKey) == "") {
            // Make a Response
            $response = $this->makeResponse($found, $searchKey);

            // Send Response
            return $response;
        }

        // Init FileFinder Library
        $fFinder = new FileFinder();
        $directory = 'public/file-finder';

        // Search By Content
        $found =  $fFinder->findAllFileByContent($directory, $searchKey);

        // Make a Response
        $response = $this->makeResponse($found, $searchKey);

        // Send Response
        return $response;
    }

    /**
     * makeResponse function
     *
     * @param array $found
     * @param string $searchKey
     * @return response
     */
    private function makeResponse($found, &$searchKey="^default-data*")
    {
        $result = array("searchKey" => $searchKey, "results" => $found, "resultCount" => count($found));

        $http_status = 200;
        if (count($found)==0) {
            $http_status = 404;
        }

        $response = response($result)
            ->header('Content-Type', 'application/json')
            ->setStatusCode($http_status);

        return $response;
    }
}
