<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <header class="archive-header">
    <h3><?php printf( __('Search Results For: %s', 'counterpoint'), get_search_query('', false)); ?></h3>
  </header>
  
  <ul id="archive">
  
  <?php get_search_form(); ?>
  
  <?php $even = false;
  while(have_posts()): the_post();
    $class = $even ? 'even' : 'odd'; ?>
    <li <?php post_class($class); ?>>
      <a href="<?php the_permalink(); ?>"><div class="thumbnail" <?php echo post_thumb_style($post->ID); ?> ></div></a>
      <h3 class="post-title"><a href="<?php the_permalink(); ?>">
        <?php echo $post->post_title ? the_title(false) : __( 'Untitled', 'counterpoint' ); /* Default title: "Untitled" */ ?>
      </a></h3>
      <section class="post-meta">
        <?php counterpoint_posted_on(); ?>
      </section>
      <div class="excerpt cf"><?php echo get_the_excerpt(); ?><a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Keep reading &rarr;', 'counterpoint'); ?></a></div>
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