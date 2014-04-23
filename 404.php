<?php get_header(); ?>
<?php get_sidebar(); ?>
  
<section id="content">
  <header class="post-header" style="background: url(<?php echo get_template_directory_uri(); ?>/library/images/404.jpg); background-position: center; background-size: cover;">
    <div class="post-title"><h2><?php _e('433 Not Found', 'counterpoint'); ?></h2></div>
  </header>
    
  <article id="error">
    <p>
      <br><?php _e('You broke my site!', 'counterpoint'); ?> :(<br>
      <?php printf( __('Return to the %s', 'counterpoint'), '<a class="title-link" href="' . home_url('/') . '">Home Page</a>' ); ?>.
    </p>
  </article>
</section>

<?php get_footer(); ?>