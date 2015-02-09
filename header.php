<!DOCTYPE html>
<html>
<head>
<title>KECH</title>
<meta charset="utf-8">

<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css">
<?php wp_head(); ?>
</head>
<body background="<?php echo get_template_directory_uri(); ?>/pics/tlo.gif">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/datetimepicker/jquery.datetimepicker.css"/ >
<div id="container">
<img src="<?php bloginfo('template_directory'); ?>/pics/banner.jpg" width="1024"/>
<a href="plan"><img id="calendar" src="<?php bloginfo('template_directory'); ?>/pics/kalendarz.png""/></a>
<div id="header">

<?php 
	wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'main-menu')); 
?>
</div>

