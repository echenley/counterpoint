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
        <div id="title">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="title-link"><?php bloginfo('name'); ?></a>
        </div>
        <?php dynamic_sidebar('header-right'); ?>
        <a href="#" class="menu-toggle">&#9776;</a>
      </header>
      <div id="content-container" class="cf">