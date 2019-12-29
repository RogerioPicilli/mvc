<?php 
session_start();
//Para evitar o highjacking
if(empty($_SESSION['dono'])) { //PEGA O IP E A REF DO NAVEGADOR DO USUARIO
	$_SESSION['dono'] = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
}

$token = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
if($_SESSION['dono'] != $token) {
	exit;
}

print_r($_SESSION);
