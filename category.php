<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <header class="archive-header">
    <h3><?php printf( __( 'Category Archives: %s', 'counterpoint' ), single_cat_title( '', false ) ); ?></h3>
  </header>
  
  <ul id="archive">
  <?php $even = false;
  while(have_posts()): the_post();
    $class = $even ? 'even' : 'odd'; ?>
    <li <?php post_class($class); ?>>
      <a href="<?php the_permalink(); ?>"><div class="thumbnail" <?php echo post_thumb_style($post->ID); ?> ></div></a>
      <h3 class="post-title"><a href="<?php the_permalink(); ?>">
        <?php echo $post->post_title ? the_title(false) : "Untitled"; // Default title: "Untitled" ?>
      </a></h3>
      <section class="post-meta">
        <time datetime="<?php echo get_the_date('Y-m-j'); ?>" class="timestamp"><?php the_time( get_option( 'date_format' ) ); ?></time>
      </section>
      <div class="excerpt cf"><?php echo get_the_excerpt(); ?><a class="read-more" href="<?php the_permalink(); ?>"> Keep reading &rarr;</a></div>
      <div class="categories"><?php counterpoint_categories(); ?></div>
    </li>
  <?php $even = !$even;
  endwhile; ?>
  
  </ul>
  <?php if ( function_exists( 'counterpoint_page_nav' ) ) {
    counterpoint_page_nav();
  } else { ?>
    <nav class="wp-prev-next">
        <ul class="clearfix">
          <li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'counterpoint' )) ?></li>
          <li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'counterpoint' )) ?></li>
        </ul>
      </nav>
  <?php } ?>
</section>

<?php get_footer(); ?>