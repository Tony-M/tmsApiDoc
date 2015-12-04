<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 04.12.2015
 * Time: 18:09
 */

namespace tms\ApiDoc;


class tmsApiDocHeaders  extends tmsApiDoc__AbstractAction
{
    public static function  getData($data)
    {
        if (isset($data['HEADERS'])) return static::formatOutput($data['HEADERS']);
        return '';
    }


}