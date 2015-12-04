<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 03.12.2015
 * Time: 16:51
 */

namespace tms\ApiDoc;


class tmsApiDocDescription extends tmsApiDoc__AbstractAction
{
    public static function  getData($data)
    {
        if (isset($data['DESCRIPTION'])) return static::formatOutput($data['DESCRIPTION']);
        return '';
    }


}