<?php get_header(); ?>
<?php get_sidebar(); ?>
  
<section id="content">
  <header class="post-header" style="background: url(<?php echo get_template_directory_uri(); ?>/library/images/404.png); background-position: center; background-size: cover;">
    <div class="post-title"><h2>433 Not Found</h2></div>
  </header>
    
  <article id="error">
    <p><br>You broke my site! :(<br>
      Return to the <a class="title-link" href="<?php echo home_url('/'); ?>">Home Page</a>.
    </p>
  </article>
</section>

<?php get_footer(); ?>