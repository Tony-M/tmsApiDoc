<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 03.12.2015
 * Time: 14:14
 */

namespace tms\ApiDoc;


class tmsApiDocTitle extends tmsApiDoc__AbstractAction
{
    public static function  getData($data)
    {
        if(isset($data['TITLE']))return static::formatOutput( $data['TITLE']);
        return '';
    }
}