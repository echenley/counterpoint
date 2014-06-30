<?php get_header(); ?>
<?php get_sidebar(); ?>
  
<section id="content">

  <article id="post" <?php post_class(); ?>>
  
    <header class="post-header">
      <div class="post-thumbnail<?php echo counterpoint_thumbnail_style($post->ID); ?>">
      </div>
      <h1><?php the_title(); ?></h1>
    </header>
  <?php
    while(have_posts()): the_post();
      the_content();
      wp_link_pages();
    endwhile; ?>
    <hr class="endpost">
  </article>
  
  <section id="comments-section">
    <?php comments_template(); ?>
  </section>
  
</section>

<?php get_footer(); ?>