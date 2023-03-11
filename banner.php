<?php

$image = file_get_contents('img/test.jpg');
header('Content-type: image/jpeg');

echo $image;