<!DOCTYPE html>
<html <?php language_attributes() ?>>
  <head>
    <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="container" class="cf">
      <header id="header">
        <h1 id="title">
          <a class="title-link" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        </h1>
        <span id="header-widget"><?php dynamic_sidebar('header-right'); ?></span>
        <a href="#" class="menu-toggle">&#9776;</a>
      </header>