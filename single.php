<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <header class="post-header" <?php echo post_thumb_style($post->ID); ?> >
    <div class="post-title"><h2><?php the_title(); ?></h2></div>
  </header>
  
  <article id="post">
    <?php while(have_posts()): the_post(); ?>
      <section class="post-meta">
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('article-top')) : ?><?php endif; ?>
        <time datetime="<?php echo get_the_date('Y-m-j'); ?>" class="timestamp"><?php the_time( get_option( 'date_format' ) ); ?></time>
      </section>
      <?php the_content();
    endwhile;
    counterpoint_link_pages(array('next_or_number' => 'next_and_number')); ?>
    <div id="article-bottom"><?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('article-bottom')) : ?><?php endif; ?></div>
  </article>
  
  <section id="comments-section">
    <?php comments_template(); ?>
  </section>
  
</section>

<?php get_footer(); ?>