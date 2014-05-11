<?php get_header(); ?>
<?php get_sidebar(); ?>
  
<section id="content">

  <article id="post" <?php post_class(); ?>>
  
    <header class="post-header <?php echo counterpoint_thumbnail_style($post->ID, array(800,312)); ?>">
      <div class="post-title"><h2>
        <?php the_title(); ?>
      </h2></div>
    </header>
  <?php
    while(have_posts()): the_post();
      wp_link_pages();
      the_content();
      wp_link_pages();
    endwhile; ?>
    <div id="article-bottom"><?php dynamic_sidebar('article-bottom'); ?></div>
  </article>
  
  <section id="comments-section">
    <?php comments_template(); ?>
  </section>
  
</section>

<?php get_footer(); ?>