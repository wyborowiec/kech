<!DOCTYPE html>
<html>
<head>
<title>KECH</title>
<meta charset="utf-8">

<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css">
<?php wp_head(); ?>
</head>
<body bgcolor="#e4dcad">


<div id="container">
<img src="<?php bloginfo('template_directory'); ?>/baner.jpg" width="1024"/>
<div id="header">

<?php wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'main-menu')); ?>
</div>

