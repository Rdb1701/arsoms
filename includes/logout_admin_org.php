<?php
session_start();

unset($_SESSION['admin_org']);

header('location:../index');


?>