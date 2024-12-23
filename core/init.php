<?php 
	session_start();
	include 'database/connection.php';
	include 'classes/user.php';
	include 'classes/admin.php';
	include 'classes/post.php';
	include 'classes/follow.php';
	include 'classes/message.php';
	include 'classes/rent.php';
  	global $pdo;

  	$getFromU = new User($pdo);
	$getFromA = new Admin($pdo);
  	$getFromT = new Post($pdo);
    $getFromF = new Follow($pdo);
    $getFromM = new Message($pdo);
	$getFromR = new Rent($pdo);
  
  	define('BASE_URL', 'http://localhost/zietnam_club_php/');
 ?>                                                   
 