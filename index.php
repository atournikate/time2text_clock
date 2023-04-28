<?php
header('Content-Type: text/html; charset=utf-8');
include_once 'Clock_Object.php';
$testTimes = [
    '',
    '11:03',
    '23:08',
    '11:12',
    '23:16',
    '11:21',
    '23:28',
    '11:32',
    '23:36',
    '11:40',
    '23:47',
    '11:54',
    '23:59',
];
$clock = new Clock_Object('16:55');
$lang = $clock->lang;

?>
<!doctype html>
<html lang="<?php $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
</head>
<body>

<div class="container clock">
    <?php
        print_r($clock->buildClock());
    ?>
</div>

</body>
<div class="container" id="output"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>