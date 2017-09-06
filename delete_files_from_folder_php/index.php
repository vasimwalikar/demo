<?php
/****
 * Author: CodexWorld.com
 * Author URL: http://www.codexworld.com
 * Author Email: admin@codexworld.com
 * Tutorial Link: http://www.codexworld.com/delete-all-files-from-folder-using-php/
 */

//Delete all files from folder
$files = glob('my_folder/*'); //get all file names
foreach($files as $file){
    if(is_file($file))
    unlink($file); //delete file
}

//Delete specific files from folder
$files = glob('my_folder/*.jpg'); //get all file names
foreach($files as $file){
    if(is_file($file))
    unlink($file); //delete file
}

//Delete time specific files from folder
$files = glob('my_folder/*'); //get all file names
foreach($files as $file){
    $lastModifiedTime = filemtime($file);
    $currentTime = time();
    $timeDiff = abs($currentTime - $lastModifiedTime)/(60*60); //in hours
    if(is_file($file) && $timeDiff > 10) //check if file is modified before 10 hours
    unlink($file); //delete file
}
?>