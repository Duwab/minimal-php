<?php
// upload from http://codular.com/javascript-ajax-file-upload-with-progress
// Output JSON
function outputJSON($msg, $status = 'error'){
    header('Content-Type: application/json');
    die(json_encode(array(
        'data' => $msg,
        'status' => $status
    )));
}


// Check for errors
if($user->id != 1){
    outputJSON('you shall be logged in');
}

if($_FILES['SelectedFile']['error'] > 0){
    outputJSON('An error ocurred when uploading.');
}

/* if(!getimagesize($_FILES['SelectedFile']['tmp_name'])){
    outputJSON('Please ensure you are uploading an image.');
} */

// Check filetype
/* if($_FILES['SelectedFile']['type'] != 'image/png'){
    outputJSON('Unsupported filetype uploaded.');
} */

// Check filesize
if($_FILES['SelectedFile']['size'] > 5000000000000){
    outputJSON('File uploaded exceeds maximum upload size.');
}

// Check if the file exists
if(file_exists($user->profile['name'] . '/' . $_FILES['SelectedFile']['name'])){
    outputJSON('File with that name already exists.');
}
$encode = json_encode(scandir("/tmp")[3]);
$tmp = $_FILES['SelectedFile']['tmp_name'];
$new = $_FILES['SelectedFile']['name'];
// Upload file
if(!move_uploaded_file($_FILES['SelectedFile']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/files/' . $user->profile['name'] . '/' . $_FILES['SelectedFile']['name'])){
// if(!rename($_FILES['SelectedFile']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/files/upload/' . $_FILES['SelectedFile']['name'])){
    outputJSON('Error uploading file - check destination is writeable.' . $encode);
}

// Success!
outputJSON('File uploaded successfully to "' . 'upload/' . $user->profile['name'] . '/' . $tmp . ' | ' . $_FILES['SelectedFile']['name'] . '".', 'success');
