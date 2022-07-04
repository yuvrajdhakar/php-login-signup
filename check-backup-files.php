<?php

$path = 'database';
$files = scandir($path);

$limit = 3;


if ($files) {

    $list_files = [];

    foreach ($files as $file) {

        if($file == "." or $file == '..'){
            continue;
        }

        $list_files[$file] = filemtime("database/".$file);

        echo "creation time of file : {$file} is :" . date("F d Y H:i:s.", filemtime("database/".$file)); echo "<br/>";
    }

    arsort($list_files);


    $i = 0;
    foreach ($list_files as $key=> $list_file) {

        $i++;

        if($i <= $limit){
            continue;
        }

        echo $key;
        unlink("database/".$key);
    }
}
