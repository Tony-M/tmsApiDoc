<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 03.12.2015
 * Time: 17:06
 */

namespace tms\ApiDoc;


class tmsApiDocGet extends tmsApiDoc__AbstractAction
{
    public static function getData($data = array())
    {
        if (isset($data['GET'])) return static::formatOutput( $data['GET']);
        return '';
    }
}