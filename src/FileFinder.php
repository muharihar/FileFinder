<?php
/*
 * This file is part of the Local File Finder package.
 *
 * (c) Muhamamad Hari S <hi.muhammad.hari@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Muharihar\FileFinder;

use Illuminate\Support\Facades\Storage;

/**
 * FileFinder allows to find files and directories by name or by content.
 */
class FileFinder
{
    /**
     * localAppStoragePath variable
     *
     * @var string
     */
    public $localAppStoragePath = "";

    /**
     * publicStoragePath variable
     *
     * @var string
     */
    public $publicStoragePath = "";

    /**
     * fileFinderStoragePath variable
     *
     * @var string
     */
    public $fileFinderStoragePath = "";
    /**
     * fileFilterAllowed variable
     *
     * @var array
     */
    public $fileFilterAllowed = array("txt");

    /**
     * __construct function
     */
    public function __construct()
    {
        $this->localAppStoragePath = "app" . DIRECTORY_SEPARATOR;
        $this->publicStoragePath = $this->localAppStoragePath . "public" . DIRECTORY_SEPARATOR;
        $this->fileFinderStoragePath = $this->publicStoragePath . "file-finder" . DIRECTORY_SEPARATOR;
    }

    /**
     * List all directories and files
     *
     * @param string $dir
     * @param array $results
     * @param integer $idx
     * @return array
     */
    public function listDirAndFiles($dir, &$results = array(), &$idx = 1)
    {
        if (is_dir($dir)) {
            $files = scandir($dir, SCANDIR_SORT_ASCENDING);

            $storageAppPath = storage_path($this->localAppStoragePath);

            foreach ($files as $key => $value) {
                $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
                $sorthPath = str_replace($storageAppPath, "", $path);
                $basePath = dirname($sorthPath);

                if (!is_dir($path)) {
                    $extension = pathinfo($sorthPath, PATHINFO_EXTENSION);
                    if (in_array($extension, $this->fileFilterAllowed)) {
                        $fileSize = filesize($path);
                        $results[] = array(
                            //"realPath" => $path,
                            "idx" => $idx,
                            "isDir" => false,
                            "shortPath" => $sorthPath,
                            "extension" => $extension,
                            "fileSize" => $fileSize,
                            "parentPath" => $basePath);

                        $idx = $idx + 1;
                    }
                } else if ($value != "." && $value != "..") {
                    $results[] = array(
                        //"realPath" => $path,
                        "idx" => $idx,
                        "isDir" => true,
                        "shortPath" => $sorthPath,
                        "extension" => "",
                        "fileSize" => 0,
                        "parentPath" => $basePath);
                    $idx = $idx + 1;
                    $this->listDirAndFiles($path, $results, $idx);
                }
            }
        }

        return $results;
    }

    /**
     * File file by content
     *
     * @param string $file
     * @param string $searchKey
     * @return array
     */
    public function findFileByContent($file, $searchKey)
    {
        $result["isExist"] = false;
        $result["pos"] = -1;
        $result["strInfo"] = "";

        $fullFilePath = storage_path($this->localAppStoragePath . $file);
        //check if exists and if is a file
        if (Storage::disk('local')->exists($file) && is_file($fullFilePath)) {
            $content = Storage::disk('local')->get($file);
            $result["strLength"] = strlen($content);

            $pos = strpos(strtolower($content), strtolower($searchKey));
            if ($pos !== false) {
                //$result = true;
                $result["isExist"] = true;
                $result["firstPos"] = $pos;
                $result["firstStr"] = ($pos == 0 ? "":"...").substr($content,$pos,50).(($pos+50) > strlen($content)? "...":"");
            }
        }

        return $result;
    }

    /**
     * Find all files by content.
     *
     * @param string $dir
     * @param string $searchKey
     * @return array
     */
    public function findAllFileByContent($dir, $searchKey)
    {
        // List all directories and files
        $directory = storage_path("app/" . $dir);
        $resources = $this->listDirAndFiles($directory);

        $result = array();
        foreach ($resources as $key => $value) {
            $found = $this->findFileByContent($value["shortPath"], $searchKey);
            if ($found["isExist"]) {
                $value["info"]["firstPos"] = $found["firstPos"];
                $value["info"]["firstStr"] = $found["firstStr"];
                $result[] = $value;
            }
        }
        return $result;
    }

    /**
     * Find file by name
     *
     * @param string $file
     * @param string $searchKey
     * @return bool
     */
    public function findFileByName($file, $searchKey)
    {
        $result = false;

        $fullFilePath = storage_path($this->localAppStoragePath . $file);
        //check if exists and if is a file
        if (Storage::disk('local')->exists($file) && is_file($fullFilePath)) {

            $str = basename($file);

            $pos = strpos(strtolower($str), strtolower($searchKey));
            if ($pos !== false) {
                $result = true;
            }
        }

        return $result;
    }

    /**
     * Find directory and files by name
     *
     * @param string $file
     * @param string $searchKey
     * @return bool
     */
    public function findDirAndFileByName($file, $searchKey)
    {
        $result = false;

        //check if exists
        if (Storage::disk('local')->exists($file)) {

            $str = basename($file);

            $pos = strpos(strtolower($str), strtolower($searchKey));
            if ($pos !== false) {
                $result = true;
            }
        }

        return $result;
    }

    /**
     * Find all directories and files by name
     *
     * @param string $dir
     * @param string $searchKey
     * @return array
     */
    public function findAllDirAndFileByName($dir, $searchKey)
    {
        // List all directories and files
        $directory = storage_path("app/" . $dir);
        $resources = $this->listDirAndFiles($directory);

        $result = array();
        foreach ($resources as $key => $value) {
            $isExist = $this->findDirAndFileByName($value["shortPath"], $searchKey);
            if ($isExist) {
                $result[] = $value;
            }
        }

        return $result;
    }
}
