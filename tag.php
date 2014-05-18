<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <header class="archive-header">
    <h2><?php printf( __( 'Tag Archives: %s', 'counterpoint' ), single_tag_title( '', false ) ); ?></h2>
  </header>
  
  <ul id="archive">
    <?php counterpoint_index_loop($post->ID); ?>
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