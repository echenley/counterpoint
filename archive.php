<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <header class="archive-header">
    <h2>
      <?php
        if ( is_day() ) :
          printf( __( 'Daily Archives: %s', 'counterpoint' ), get_the_date() );
        elseif ( is_month() ) :
          printf( __( 'Monthly Archives: %s', 'counterpoint' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'counterpoint' ) ) );
        elseif ( is_year() ) :
          printf( __( 'Yearly Archives: %s', 'counterpoint' ), get_the_date( _x( 'Y', 'yearly archives date format', 'counterpoint' ) ) );
        else :
          _e( 'Archives', 'counterpoint' );
        endif;
      ?>
    </h2>
  </header>
  
  <?php counterpoint_archive_loop(); ?>
  
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