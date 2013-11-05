<?php
include_once("system.php");

$uri = new Uri();

$template = $uri->template();

$output = new Output();

$output->load($template, array('uri' => $uri), false);
$output->display();
?>