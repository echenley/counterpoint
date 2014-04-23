<!DOCTYPE html>
<html <?php language_attributes() ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
    <title>
      <?php
        wp_title('&mdash;', true, 'right');
        bloginfo('name');
      ?>
    </title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/library/css/style.css">
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Merriweather:400,400italic,700'>
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Inconsolata'>
    <link rel="shortcut icon" type="image/ico" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <?php wp_head(); ?>
    <script src="<?php echo get_template_directory_uri(); ?>/library/js/scripts.js"></script>
  </head>
  <body <?php body_class(); ?>>
    <div id="container" class="cf">