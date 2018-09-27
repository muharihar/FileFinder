<?php
/*
 * This file is part of the Local File Finder package.
 *
 * (c) Muhamamad Hari S <hi.muhammad.hari@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Muharihar\FileFinder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * FileFinder facade class
 */
class FileFinder extends Facade
{
    /**
     * getFacadeAccessor function
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'FileFinder';
    }
}