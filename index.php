<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <ul id="post-list">
  <?php $even = false;
  while(have_posts()): the_post();
    $class = $even ? 'even' : 'odd'; ?>
    <li <?php post_class($class); ?>>
      <a href="<?php the_permalink(); ?>"><div class="thumbnail" <?php echo post_thumb_style($post->ID); ?> ></div></a>
      <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <section class="post-meta">
        <time datetime="<?php echo get_the_date('Y-m-j'); ?>" class="timestamp"><?php the_time( get_option( 'date_format' ) ); ?></time>
      </section>
      <div class="excerpt cf"><?php echo get_the_excerpt(); ?><a class="read-more" href="<?php the_permalink(); ?>"> Keep reading &rarr;</a></div>
    </li>
  <?php $even = !$even;
  endwhile; ?>
  </ul>
  
  <?php if ( function_exists( 'counterpoint_page_nav' ) ) {
    counterpoint_page_nav();
  } else { ?>
    <nav class="pagination">
      <ul class="cf">
        <li class="alignleft"><?php next_posts_link( __( '&larr; Newer Entries', 'counterpoint' )) ?></li>
        <li class="alignright"><?php previous_posts_link( __( 'Older Entries &rarr;', 'counterpoint' )) ?></li>
      </ul>
    </nav>
  <?php } ?>
</section>

<?php get_footer(); ?>