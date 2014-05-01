<!DOCTYPE html>
<html <?php language_attributes() ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="shortcut icon" type="image/ico" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="container" class="cf">
      <header id="header">
        <h1 id="title">
          <a class="title-link" href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a>
        </h1>
        <span id="header-widget"><?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('header-right')) : ?><?php endif; ?></span>
        <a href="#" class="menu-link">&#9776;</a>
      </header>