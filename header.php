<!DOCTYPE html>
<html <?php language_attributes() ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="shortcut icon" type="image/ico" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <?php if ( is_singular() ) wp_enqueue_script('comment-reply'); wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="container" class="cf">