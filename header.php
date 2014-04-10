<!DOCTYPE html>
<html>
  <head>
    <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('title')?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/library/css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,400italic,700' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Inconsolata'>
    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/scripts-min.js"></script>
  </head>
  <body>
    <div id="container" class="cf">