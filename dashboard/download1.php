<?php
$dir = "download/";
$filename = $_GET['file'];
$file_path = $dir . $filename;
$ctype = "application/octet-stream";
if (!empty($file_path) && file_exists($file_path)) { /*check keberadaan file*/
    header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
    header("Content-Type: application/force-download");
    header("Content-Length: " . filesize($file));
    header("Connection: close");
    readfile($file);
    flush();
    exit();
} else {
    echo "The File does not exist.";
}
