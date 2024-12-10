<?php
if(isset($_POST["deconnection"])){
    session_destroy();
    header("Location:login.php");
}
session_start();