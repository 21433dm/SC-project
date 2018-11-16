<?php //projects.php

include('classes/db.php');
include ('classes/Login.php');


DB::query('SELECT title, post, st_userid, cl_userid FROM posts ORDER BY id ASC');

$title = $_GET['title'];
$project = $_GET['post'];	
echo $title && $project;
?>