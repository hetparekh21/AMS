<?php

use App\Models\classes;

function get_unique_code() : string{

$code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

$sql = "SELECT * FROM class WHERE class_code = '$code'";

$result = classes::all()->where(['class_code',$code]);

// $result = $conn->query($sql) or die("Error: " . $sql . "<br>" . $conn->error);

if($result->num_rows > 0){

    $code =  get_unique_code();

}else{

    return $code;
}

return $code;

}

