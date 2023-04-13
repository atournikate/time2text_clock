<?php
include_once 'Clock_Object.php';

$timeElementArray = [
    ['IT'],
    ['L'],
    ['IS'],
    ['AK'],
    ['AM'],
    ['PM'],
    ['A'],
    ['C'],
    ['QUARTER'],
    ['DC'],
    ['TWENTY'],
    ['FIVE'],
    ['X'],
    ['HALF'],
    ['S'],
    ['TEN'],
    ['F'],
    ['TO'],
    ['PAST'],
    ['ERU'],
    ['NINE'],
    ['ONE'],
    ['SIX'],
    ['THREE'],
    ['FOUR'],
    ['FIVE'],
    ['TWO'],
    ['EIGHT'],
    ['ELEVEN'],
    ['SEVEN'],
    ['TWELVE'],
    ['TEN'],
    ['SE'],
    ['O'],
    ['CLOCK']
];
$clock = new Clock_Object($timeElementArray);

?>
<!doctype html>
<html lang="en">
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