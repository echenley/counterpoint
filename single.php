<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <header class="post-header" <?php echo post_thumb_style($post->ID); ?> >
    <div class="post-title"><h2>
      <?php echo $post->post_title ? the_title(false) : "Untitled"; /* Default title: "Untitled" */ ?>
    </h2></div>
  </header>
  
  <article id="post" <?php post_class(); ?>>
    <?php while(have_posts()): the_post(); ?>
      <section class="post-meta">
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('article-top')) : ?><?php endif; ?>
        <time datetime="<?php echo get_the_date('Y-m-j'); ?>" class="timestamp"><?php the_time( get_option( 'date_format' ) ); ?></time>
      </section>
      <?php counterpoint_link_pages(array('next_or_number' => 'next_and_number'));
      the_content();
    endwhile;
    counterpoint_link_pages(array('next_or_number' => 'next_and_number')); ?>
    <div id="article-bottom"><?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('article-bottom')) : ?><?php endif; ?></div>
    <nav id="post-nav" class="cf">
      <?php 
      $next_post = get_next_post();
      if ( is_object($next_post) ) {
        $url = get_permalink($next_post->ID);
        $title = get_the_title($next_post->ID); ?>
        <div class="next-post" <?php echo post_thumb_style($next_post->ID); ?>>
          <a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>">&larr; Next</a>
        </div>
      <?php }
      $prev_post = get_previous_post();
      if ( is_object($prev_post) ) {
        $url = get_permalink($prev_post->ID);
        $title = get_the_title($prev_post->ID); ?>
        <div class="prev-post" <?php echo post_thumb_style($prev_post->ID); ?>>
          <a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>">Previous &rarr;</a>
        </div>
      <?php } ?>
    </nav>
  </article>
  
  <section id="comments-section">
    <?php comments_template(); ?>
  </section>
  
</section>

<?php get_footer(); ?>