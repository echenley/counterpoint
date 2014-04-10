<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <?php $imgSrc = has_post_thumbnail() ? wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full')[0] : catch_that_image();
  if ($imgSrc) { ?>
    <header class="post-header" style="background: url(<?php echo $imgSrc; ?>); background-position: center; background-size: cover;">
      <h2><span class="post-title"><?php the_title(); ?></span></h2>
    </header>
  <?php }; ?>
  
  <article id="post">
    <?php while(have_posts()): the_post(); ?>
      <section id="post-meta">
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('article-top')) : ?><?php endif; ?>
        <time datetime="<?php echo get_the_date('Y-m-j'); ?>" class="timestamp"><?php the_time( get_option( 'date_format' ) ); ?></time>
      </section>
      <?php the_content();
    endwhile; ?>
    <div id="article-bottom"><?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('article-bottom')) : ?><?php endif; ?></div>
  </article>
  
  <section id="comments-section">
    <?php comments_template(); ?>
  </section>
</section>

<?php get_footer(); ?>