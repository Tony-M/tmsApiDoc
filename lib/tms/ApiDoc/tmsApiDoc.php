<?php

namespace tms\ApiDoc;

class tmsApiDoc
{
    protected $doc_path = null;
    protected $FILES = array();

    public function  __construct($path = '')
    {
        $this->doc_path = $path;
        $list = scandir($this->doc_path);

        if (is_array($list)) {
            foreach ($list as $row) {
                $file_path = $this->doc_path . $row;
                if (is_file($file_path)) {
                    $this->FILES[$file_path] = $row;
                }
            }
        }
    }

    public function getUrlList()
    {
        $result = array();

        foreach ($this->FILES as $file_path => $file) {
            $data = $this->parseFile($file_path);
            $result[] = array('resource' => base64_encode($file), 'method' => $this->getMethod($data), 'url' => $this->getUrl($data), 'title' => $this->getTitle($data));
        }
//        static::pre($result);

        $kk = array();
        foreach($result as $key => $v){
            $kk[]=$v['url'];
        }
        sort($kk);

        $tmp = array();
        foreach($kk as $key){
            foreach($result as $v){
                if($v['url']==$key){
                    $tmp[] = $v;
                }
            }
        }
        $result = $tmp;
        return $result;
    }

//    function getDescription($data){
//        $c= 'tms\ApiDoc\\tmsApiDocDescription';
//        return $c::getData($data);
//    }

    function __call($method = null, $arguments)
    {
        if (is_null($method)) return false;
        if (preg_match('/^(get)(.+)$/', $method, $matches)) {
            $action_class = 'tms\ApiDoc\\tmsApiDoc' . $matches[2];
            return nl2br($action_class::getData($arguments[0]));
        }

        echo $method;
    }

    protected function parseFile($file)
    {
        $data = array();
        $handle = fopen($file, "r");
        if ($handle) {
            $key = '__somewhat';
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                if (preg_match('/^(\:)(.*)(\:)$/', $line, $matches)) {
                    $key = $matches[2];
                    $data[$key] = '';
                    continue;
                }
                if (substr($line, 0, 1) != ';' && $line!='') {
//                     if($line=='|')$line='';
                    if(!isset($data[$key]))$data[$key] = '';
                    $data[$key] .= $line.PHP_EOL;
                }
            }
            fclose($handle);
        } else {
            throw new  \Exception('error opening the data file: ' . $file);
        }
        return $data;
    }

    public function getResourceFile($filename)
    {
        $file = $this->doc_path . $filename;
        $doc = $this->parseFile($file);
        $result = array();
        foreach ($doc as $section => $data) {
            try {
                $method = 'get' . ucfirst(strtolower($section));
                $result[strtolower($section)] = $this->$method($doc);
            } catch (\Exception $e) {

            }
        }
        return $result;

    }

    public static function pre($a)
    {
        echo '<pre>' . print_r($a, true) . '</pre>';
    }

    public static function tell($param,$key)
    {
      if (isset($param[$key])) {
        $t = $param[$key];
        $t = preg_replace('/^(\|){1}/mi','<br/>', $t);
        return $t; 
      }
      else 
        return null;
    }
}