<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 03.12.2015
 * Time: 15:39
 */

namespace tms\ApiDoc;


class tmsApiDocMethod extends tmsApiDoc__AbstractAction
{
    public static function getData($data = array())
    {
        if (isset($data['METHOD'])) return static::formatOutput($data['METHOD']);
        return '';
    }
}