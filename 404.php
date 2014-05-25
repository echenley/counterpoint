<?php get_header(); ?>
<?php get_sidebar(); ?>
  
<section id="content">
  
  <header class="post-header">
    <div class="post-thumbnail" style="background: #fff url(<?php echo get_template_directory_uri(); ?>/library/images/404.jpg); background-position: center; background-size: cover;">
    </div>
    <h1><?php _e('433 Not Found', 'counterpoint'); ?></h1>
  </header>
    
  <article id="error">
    <p><?php _e('You broke my site!', 'counterpoint'); ?> :(</p>
    <p><?php printf( __('Return to the %s', 'counterpoint'), '<a href="' . home_url('/') . '">Home Page</a>' ); ?>.</p>
  </article>
</section>

<?php get_footer(); ?>