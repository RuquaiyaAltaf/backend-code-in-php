<?php


$con = mysqli_connect(hostname:'localhost',username:'root',password:'',database:'login');

function row_count($result){
    return mysqli_num_rows($result);
}

function escape($string){
    global $con;
    return mysqli_real_escape_string($con, $string);
}

function confirm($result){
    global $con;
    if(!$result){
        
        die("Query Failed".   mysqli_error($con));
    }
     
    
}


function query($query){
    global $con;
    return mysqli_query($con, $query);
}


function fetch_array($result){
    global $con;
    return mysqli_fetch_array($result);
}




 




?>