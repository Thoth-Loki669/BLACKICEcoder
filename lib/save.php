<?php 
$file = $_REQUEST['file'];
$contents = $_REQUEST['contents'];
$action = $_REQUEST['action'];

if($action == 'save'){
  if (is_file($file) and is_writable($file)) {
    $savefile = file_put_contents($file, $contents, LOCK_EX);
    echo '{ "status": "saved" }';
  } else {
    echo '{ "status": "error" }';
  }
}

if($action == 'create') {
  $filetowrite = $_SERVER["DOCUMENT_ROOT"].$file;
  if (file_exists($filetowrite)) {
    echo '{ "status": "exists", "file", "'.$filetowrite.'" }';
  } else {
    $newfile = fopen($filetowrite, "w");
    $contents = "// create something amazing";
    fwrite($newfile, $contents);
    fclose($newfile);
    echo '{ "status": "created" }';
  }
}

?>