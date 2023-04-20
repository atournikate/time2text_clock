<?php
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
$clock = new Clock_Object();
$lang = $clock->lang;

?>
<!doctype html>
<html lang="<?php $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet">
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