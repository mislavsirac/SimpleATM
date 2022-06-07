<?php

$conn=mysqli_connect('localhost','root','','atm');

if(mysqli_connect_errno()){
    echo 'Nije uspješno povezana baza podataka'.mysqli_connect_error();
}
?>
