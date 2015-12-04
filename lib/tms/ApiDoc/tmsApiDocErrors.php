<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 03.12.2015
 * Time: 17:09
 */

namespace tms\ApiDoc;


class tmsApiDocErrors  extends tmsApiDoc__AbstractAction
{
    public static function getData($data = array())
    {
        if (isset($data['ERRORS'])) return $data['ERRORS'];
        return '';
    }
}