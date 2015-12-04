<?php
/**
 * Created by PhpStorm.
 * User: morozov
 * Date: 03.12.2015
 * Time: 15:22
 */

namespace tms\ApiDoc;


abstract class tmsApiDoc__AbstractAction
{

    abstract public static function getData($data);

    public static function formatOutput($data)
    {
        $data = static::FormatJson($data);
        $data = static::FormatXml($data);
        $data = static::FormatPhp($data);
        $data = preg_replace('/[\r\n]{2,}/',PHP_EOL,$data);
        $data = nl2br($data);
        return $data;
    }

    /**
     * indentJsons a flat JSON string to make it more human-readable.
     *
     * @param string $json The original JSON string to process.
     *
     * @return string indentJsoned version of the original JSON string.
     */
    public static function indentJson($json)
    {


        $json = preg_replace('/\r\n/', '', $json);
        $result = '';
        $pos = 0;
        $strLen = strlen($json);
        $indentJsonStr = '&nbsp;&nbsp;&nbsp;&nbsp;';
        $newLine = "<br />";
        $prevChar = '';
        $outOfQuotes = true;

        for ($i = 0; $i <= $strLen; $i++) {

            // Grab the next character in the string.
            $char = substr($json, $i, 1);

            // Are we inside a quoted string?
            if ($char == '"' && $prevChar != '\\') {
                $outOfQuotes = !$outOfQuotes;

                // If this character is the end of an element,
                // output a new line and indentJson the next line.
            } else if (($char == '}' || $char == ']') && $outOfQuotes) {
                $result .= $newLine;
                $pos--;
                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indentJsonStr;
                }
            }

            // Add the character to the result string.
            $result .= $char;

            // If the last character was the beginning of an element,
            // output a new line and indentJson the next line.
            if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
                $result .= $newLine;
                if ($char == '{' || $char == '[') {
                    $pos++;
                }

                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indentJsonStr;
                }
            }

            $prevChar = $char;
        }

        return $result;
    }


    public static function FormatJson($data)
    {
        $result = '';
        $in_json = false;
        $tmp = '';

        foreach (preg_split("/((\r?\n)|(\r\n?))/", $data) as $line) {
            if ($line == '{JSON}') {
                $in_json = true;
                continue;
            }

            if ($line == '{/JSON}') {
                $in_json = false;
                $tmp = static::indentJson($tmp) . PHP_EOL;
                $tmp = preg_replace('/([{}\"\:])/', '<span style="color:green">$1</span>', $tmp);
//                $tmp='<div style="color:firebrick; font-family: monospace; font-size: 12px; padding: 4px; border: 1px solid #f1f1f1; background: #fefefe;">'.$tmp.'</div>';
//                $tmp = '<div style="color:#BF360C; font-family: monospace; font-size: 12px; padding: 4px; border: 1px solid #f1f1f1; background: #fefefe;">' . $tmp . '</div>';
//                $tmp='<div style="color:#1565C0; font-family: monospace; font-size: 12px; padding: 4px; border: 1px solid #f1f1f1; background: #fefefe;">'.$tmp.'</div>';

                $n = substr_count($tmp, '<br />')+1;
                $lines = '';
                for ($i = 0; $i < $n; $i++) $lines .= $i . '<br />';
                $tmp = '<div class="code_block">'
                    . '<span class="label label-info code_title" >JSON</span>'
                    . '<div class="code_lines">'.$lines. '</div>'
                    .'<div class="code_text">'
                    . $tmp
                    . '</div>'
//                    . '</div>'
                    . '</div>';

                $result .= $tmp . PHP_EOL;
                $tmp = '';
                continue;

            }

            if (!$in_json) $result .= $line . PHP_EOL;
            else {
                $tmp .= $line;
            }


        }


        return $result;
    }

    public static function FormatXml($data)
    {
        $result = '';
        $in_json = false;
        $tmp = '';

        foreach (preg_split("/((\r?\n)|(\r\n?))/", $data) as $line) {
            if ($line == '{XML}') {
                $in_json = true;
                continue;
            }

            if ($line == '{/XML}') {
                $in_json = false;
                $tmp = static::indentXml($tmp) . PHP_EOL;
                $n = substr_count($tmp, '<br />');
                $lines = '';
                for ($i = 0; $i < $n; $i++) $lines .= $i . '<br />';
//                $tmp = preg_replace('/([{}\"\:])/','<span style="color:green">$1</span>',$tmp);
//                $tmp='<div style="color:firebrick; font-family: monospace; font-size: 12px; padding: 4px; border: 1px solid #f1f1f1; background: #fefefe;">'.$tmp.'</div>';
                $tmp = '<div class="code_block">'
                    . '<span class="label label-info code_title">XML</span>'
                    . '<div class="code_lines">'.$lines. '</div>'
                    .'<div class="code_text">'
                    . $tmp
                    . '</div>'
//                    . '</div>'
                    . '</div>';
//                $tmp='<div style="color:#1565C0; font-family: monospace; font-size: 12px; padding: 4px; border: 1px solid #f1f1f1; background: #fefefe;">'.$tmp.'</div>';
                $tmp = preg_replace('/[\r\n]/','',$tmp);
                $result .= $tmp . PHP_EOL;
                $tmp = '';
                continue;

            }

            if (!$in_json) $result .= $line . PHP_EOL;
            else {
                $tmp .= $line;
            }


        }


        return $result;
    }

    public static function indentXml($xml)
    {
        $_defaultOptions = array(
            "removeLineBreaks" => true,
            "removeLeadingSpace" => true,       // not implemented, yet
            "indent" => "    ",
            "linebreak" => "\n",
            "caseFolding" => false,
            "caseFoldingTo" => "uppercase",
            "normalizeComments" => false,
            "maxCommentLine" => -1,
            "multilineTags" => false
        );
        $fmt = new \XML_Beautifier($_defaultOptions);

        $fmt = nl2br(htmlentities($fmt->formatString($xml)));
        $fmt = preg_replace('/(    )/', '&nbsp;&nbsp;&nbsp;&nbsp;', $fmt);
        $fmt = preg_replace('/(&lt;\/|&gt;|&lt;|=|&quot;)/', '<b style="color:green">$1</b>', $fmt);
//        $fmt = preg_replace('/(&lt;\/)/', '<b style="color:green">$1</b>', $fmt);
//        $fmt = preg_replace('/(&lt;)/', '<b style="color:green">$1</b>', $fmt);
//        $fmt = preg_replace('/(&gt;)/', '<b style="color:green">$1</b>', $fmt);
//        $fmt = preg_replace('/(=&quot;)/', '<b style="color:green">$1</b>', $fmt);
//        $fmt = preg_replace('/(&quot;)/', '<b style="color:green">$1</b>', $fmt);
//        $fmt = nl2br($fmt);

        return $fmt;
    }

    public static function indentPhp($code)
    {
        $r=  \PHPLighter::highlight( $code,true, \PHPLighter::NO_LINKIFY_LINKS | \PHPLighter::NO_LINKIFY_EMAILS );
        $r = nl2br($r);
        $r = preg_replace('/^(<pre class="pretty-php">)/','<zz class="pretty-php">',$r);
        $r = preg_replace('/(<\/pre>)$/','</zz>',$r);
        $r = preg_replace('/[\r\n]/','',$r);


        return $r;
    }


    public static function FormatPhp($data)
    {
        $result = '';
        $in_json = false;
        $tmp = '';

        foreach (preg_split("/((\r?\n)|(\r\n?))/", $data) as $line) {
            if ($line == '{PHP}') {
                $in_json = true;
                continue;
            }

            if ($line == '{/PHP}') {
                $in_json = false;
                $tmp = static::indentPhp($tmp) . PHP_EOL;
                $n = substr_count($tmp, '<br />');
                $lines = '';
                for ($i = 0; $i < $n; $i++) $lines .= $i . '<br />';
//                $tmp = preg_replace('/([{}\"\:])/','<span style="color:green">$1</span>',$tmp);
//                $tmp='<div style="color:firebrick; font-family: monospace; font-size: 12px; padding: 4px; border: 1px solid #f1f1f1; background: #fefefe;">'.$tmp.'</div>';
                $tmp = '<div class="code_block">'
                    . '<span class="label label-info code_title">PHP</span>'
                    . '<div class="code_lines">'.$lines. '</div>'
                    .'<div class="code_text">'
                    . $tmp
                    . '</div>'
//                    . '</div>'
                    . '</div>';
//                $tmp='<div style="color:#1565C0; font-family: monospace; font-size: 12px; padding: 4px; border: 1px solid #f1f1f1; background: #fefefe;">'.$tmp.'</div>';
                $result .= $tmp . PHP_EOL;
                $tmp = '';
                continue;

            }

            if (!$in_json) $result .= $line . PHP_EOL;
            else {
                $tmp .= $line.PHP_EOL;
            }


        }


        return $result;
    }
}