<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 03.12.2015
 * Time: 18:19
 */

namespace tms\ApiDoc;


class tmsApiDocInput extends tmsApiDoc__AbstractAction
{
    public static function  getData($data)
    {
        if (isset($data['INPUT'])) return static::formatOutput($data['INPUT']);
        return '';
    }


}