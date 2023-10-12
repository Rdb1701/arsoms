<?php
session_start();

unset($_SESSION['osa']);

header('location:../index');


?>