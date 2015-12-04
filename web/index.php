<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once '../parser.php';

$action = isset($_GET['act'])?$_GET['act']:null;
switch ($action) {
    default:
        $url_list = $doc->getUrlList();
        $body = 'tpl/url_list.php';
        break;
    case 'resource':
        $r = base64_decode($_GET['r']);
        $data = $doc->getResourceFile($r);
        $body = 'tpl/resource.php';
        break;
}


?>
<!DOCTYPE html> <html lang=en> <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/php.css">
    <script src="/js/jquery-2.1.4.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <style>
        .desc {margin-left: 50px;}
        p , td, div.desc {font-size: 12px;}
        hr{margin-bottom: 10px; margin-top: 10px;}
        body{
            padding-top: 50px;;
        }

        .code_block{position:relative; display: table; width:100%; color:#BF360C; font-family: monospace; font-size: 12px; padding: 4px; border: 1px solid #f1f1f1; background: #fefefe;}
        .code_text{position:absolute; left:50px; top:0px; float:left ;position:relative; top:0px; overflow-x: auto; line-height: 18px;}
        .code_lines{position:absolute; left: 0px; top:0px; height: 100%;  relative; top:0px;line-height: 18px; background: #eee;float:left; min-width:40px; color:gray; text-align:right; display:block; padding-right:8px; border-right: 1px solid gray; margin-right:8px}
        .code_title{position:absolute; left:0px; width: 40px; top: 0px;}


    </style>
</head>
<body>
<?php require_once 'tpl/top_menu.php'; ?>

<div class="container" >
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php require_once $body; ?>
        </div>
    </div>
</div>
</body>
</html>