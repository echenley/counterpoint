<?php get_header(); ?>
<?php get_sidebar(); ?>
  
<section id="content">
  <header class="post-header" <?php echo post_thumb_style($post->ID); ?> >
    <div class="post-title"><h2>
      <?php the_title(); ?>
    </h2></div>
  </header>
    
  <article id="page" <?php post_class(); ?>>
  <?php
    while(have_posts()): the_post();
      wp_link_pages();
      the_content();
      wp_link_pages();
    endwhile; ?>
    <div id="article-bottom"><?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('article-bottom')) : ?><?php endif; ?></div>
  </article>
  
  <section id="comments-section">
    <?php comments_template(); ?>
  </section>
  
</section>

<?php get_footer(); ?>