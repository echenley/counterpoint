<!DOCTYPE html>
<html>
  <head>
    <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      <?php
        if (is_single() || is_page()) {
          wp_title('',true);
        } elseif (is_front_page()) {
          bloginfo('description');
        } else { bloginfo('description'); } ?> — <?php bloginfo('name');
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
  <body>
    <div id="container" class="cf">