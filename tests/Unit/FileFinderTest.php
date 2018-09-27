<?php
/*
 * This file is part of the Local File Finder package.
 *
 * (c) Muhamamad Hari S <hi.muhammad.hari@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Muharihar\FileFinder\FileFinder;
use Tests\TestCase;

/**
 * FileFinderTest class
 */
class FileFinderTest extends TestCase
{
    /**
     * Positive test for function FileFinder->listDirAndFiles
     *
     * @return void
     */
    public function testListDirAndFilesIsTrue()
    {
        $fileFinder = new FileFinder();
        $directory = 'public/file-finder';

        // list all directories and files
        $directory = storage_path("app/" . $directory);
        $result = $fileFinder->listDirAndFiles($directory);

        $this->assertTrue(count($result) > 0);
    }

    /**
     * Negative test for function FileFinder->listDirAndFiles
     *
     * @return void
     */
    public function testListDirAndFilesIsFalse()
    {
        $fileFinder = new FileFinder();
        $directory = 'public/file-finder/not-found';

        // list all directories and files
        $directory = storage_path("app/" . $directory);
        $result = $fileFinder->listDirAndFiles($directory);

        $this->assertTrue(count($result) == 0);
    }

    /**
     * Positive test for function FileFinder->findFileByContent
     *
     * @return void
     */
    public function testFindFileByContentIsTrue()
    {
        $fileFinder = new FileFinder();

        $searchKey = "obama";
        $filePath = "public/file-finder/folder_peoples/folder_presidents/file_us.txt";

        $result = $fileFinder->findFileByContent($filePath, $searchKey);

        $this->assertTrue($result["isExist"]);
    }

    /**
     * Negative test for function FileFinder->findFileByContent
     *
     * @return void
     */
    public function testFindFileByContentIsFalse()
    {
        $fileFinder = new FileFinder();

        $searchKey = "obama-not-found";
        $filePath = "public/file-finder/folder_peoples/folder_presidents/file_us.txt";

        $result = $fileFinder->findFileByContent($filePath, $searchKey);

        $this->assertFalse($result["isExist"]);
    }

    /**
     * Positive test for function FileFinder->findAllFileByContent
     *
     * @return void
     */
    public function testFindAllFileByContentIsTrue()
    {
        $fileFinder = new FileFinder();

        $searchKey = "obama";
        $directory = 'public/file-finder';

        $result = $fileFinder->findAllFileByContent($directory, $searchKey);

        $this->assertTrue(count($result) > 0);
    }

    /**
     * Negative test for function FileFinder->findAllFileByContent
     *
     * @return void
     */
    public function testFindAllFileByContentIsFalse()
    {
        $fileFinder = new FileFinder();

        $searchKey = "obama-not-fand";
        $directory = 'public/file-finder';

        $result = $fileFinder->findAllFileByContent($directory, $searchKey);

        $this->assertTrue(count($result) == 0);
    }

    /**
     * Positive test for function FileFinder->findFileByName
     *
     * @return void
     */
    public function testFindFileByNameIsTrue()
    {
        $fileFinder = new FileFinder();

        $searchKey = "us";
        $filePath = "public/file-finder/folder_peoples/folder_presidents/file_us.txt";

        $isExist = $fileFinder->findFileByName($filePath, $searchKey);

        $this->assertTrue($isExist);
    }

    /**
     * Negative test for function FileFinder->findFileByName
     *
     * @return void
     */
    public function testFindFileByNameIsFalse()
    {
        $fileFinder = new FileFinder();

        $searchKey = "us-not-found";
        $filePath = "public/file-finder/folder_peoples/folder_presidents/file_us.txt";

        $isExist = $fileFinder->findFileByName($filePath, $searchKey);

        $this->assertFalse($isExist);
    }

    /**
     * Positive test for function FileFinder->findDirAndFileByName
     *
     * @return void
     */
    public function testFindDirAndFileByNameIsTrue(){
        $fileFinder = new FileFinder();

        $searchKey = "presidents";
        $filePath = "public/file-finder/folder_peoples/folder_presidents";

        $isExist = $fileFinder->findDirAndFileByName($filePath, $searchKey);

        $this->assertTrue($isExist);
    }

    /**
     * Negative test for function FileFinder->findDirAndFileByName
     *
     * @return void
     */
    public function testFindDirAndFileByNameIsFalse(){
        $fileFinder = new FileFinder();

        $searchKey = "presidents-not-found";
        $filePath = "public/file-finder/folder_peoples/folder_presidents";

        $isExist = $fileFinder->findDirAndFileByName($filePath, $searchKey);

        $this->assertFalse($isExist);
    }

    /**
     * Positive test for function FileFinder->findAllDirAndFileByName 
     *
     * @return void
     */
    public function testFindAllDirAndFileByNameIsTrue(){
        $fileFinder = new FileFinder();

        $searchKey = "folder";
        $directory = 'public/file-finder';

        $result = $fileFinder->findAllDirAndFileByName($directory, $searchKey);

        $this->assertTrue(count($result) > 0);
    }

    /**
     * Negative test for function FileFinder->findAllDirAndFileByName 
     *
     * @return void
     */
    public function testFindAllDirAndFileByNameIsfalse(){
        $fileFinder = new FileFinder();

        $searchKey = "folder-not-found";
        $directory = 'public/file-finder';

        $result = $fileFinder->findAllDirAndFileByName($directory, $searchKey);

        $this->assertTrue(count($result) == 0);
    }
}