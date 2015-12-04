<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 03.12.2015
 * Time: 18:21
 */

namespace tms\ApiDoc;


class tmsApiDocOutput  extends tmsApiDoc__AbstractAction
{
    public static function  getData($data)
    {
        if (isset($data['OUTPUT'])) return static::formatOutput($data['OUTPUT']);
        return '';
    }


}
{

}