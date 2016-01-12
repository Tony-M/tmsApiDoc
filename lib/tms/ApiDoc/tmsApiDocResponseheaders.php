<?php

namespace tms\ApiDoc;


class tmsApiDocResponseheaders  extends tmsApiDoc__AbstractAction
{
    public static function  getData($data)
    {
        if (isset($data['RESPONSEHEADERS'])) return static::formatOutput($data['RESPONSEHEADERS']);
        return '';
    }


}
?>