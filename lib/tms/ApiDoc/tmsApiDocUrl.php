<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 03.12.2015
 * Time: 15:21
 */

namespace tms\ApiDoc;


class tmsApiDocUrl extends tmsApiDoc__AbstractAction
{
    public static function  getData($data)
    {
        if (isset($data['URL'])) {
            $data['URL'] = preg_replace('/[\r\n]/','',$data['URL']);
            return htmlentities($data['URL']);
        }
        return '';
    }

}