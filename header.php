<!DOCTYPE html>
<html>
<head>
<title>KECH</title>
<meta charset="utf-8">

<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css">
<?php
	wp_head();
	include 'config.php';
?>
</head>
<body background="<?php echo get_template_directory_uri(); ?>/pics/tlo.gif">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/datetimepicker/jquery.datetimepicker.css"/ >
<div id="container">
<a href="<?php echo home_url();?>"><img src="<?php bloginfo('template_directory'); ?>/pics/banner.jpg" width="1024"/></a>
<div id="calendar_div"><a id="calendar" href="/wordpress/kalendarz"><img src="<?php bloginfo('template_directory'); ?>/pics/kalendarz.png""/></a></div>

<div id="header">

<?php
	wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'main-menu'));
?>
</div>
