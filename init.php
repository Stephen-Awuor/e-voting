<?php
ob_start();
session_start();

mysql_connect('localhost', 'root','');
mysql_select_db('evoter');


include_once "func/voter.func.php";
include_once "func/contestant.func.php";
include_once "func/init.func.php";
include_once "func/voting.func.php";
include_once "func/admin.func.php";
?>