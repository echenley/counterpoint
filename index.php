<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <?php counterpoint_archive_loop(); ?>
  
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