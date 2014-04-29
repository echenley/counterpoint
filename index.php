<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <ul id="post-list">
  <?php
  $even = false;
  while(have_posts()): the_post();
    $class = $even ? 'even' : 'odd';
    $title_of_post = $post->post_title ? get_the_title() : __( 'Untitled', 'counterpoint' ); /* Default title: "Untitled" */
  ?>
    <li <?php post_class($class); ?>>
      <a href="<?php the_permalink(); ?>" title="<?php echo $title_of_post; ?>"><div class="thumbnail" <?php echo post_thumb_style($post->ID); ?> ></div></a>
      <h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php echo $title_of_post; ?>">
        <?php echo $title_of_post; ?>
      </a></h3>
      <section class="post-meta">
        <?php counterpoint_posted_on(); ?>
      </section>
      <div class="excerpt cf"><?php echo get_the_excerpt(); ?><a class="read-more" href="<?php the_permalink(); ?>" title="<?php echo $title_of_post; ?>"><?php _e( 'Keep reading &rarr;', 'counterpoint'); ?></a></div>
      <div class="categories"><?php counterpoint_categories(); ?></div>
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