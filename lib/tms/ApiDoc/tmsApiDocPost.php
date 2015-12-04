<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 03.12.2015
 * Time: 17:08
 */

namespace tms\ApiDoc;


class tmsApiDocPost extends tmsApiDoc__AbstractAction
{
    public static function getData($data = array())
    {
        if (isset($data['POST'])) return static::formatOutput($data['POST']);
        return '';
    }
}