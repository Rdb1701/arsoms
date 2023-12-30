<?php
session_start();

unset($_SESSION['officer']);

header('location:../index');


?>