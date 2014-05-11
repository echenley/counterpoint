<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  
  <article id="post" <?php post_class(); ?>>
  
    <header class="post-header <?php echo counterpoint_thumbnail_style($post->ID); ?>" >
      <div class="post-title"><h2>
        <?php the_title(); ?>
      </h2></div>
    </header>
  <?php
    while(have_posts()): the_post(); ?>
      <section class="post-meta">
        <?php counterpoint_categories(); ?>
        <?php counterpoint_posted_on(); ?>
        <?php edit_post_link( __( 'Edit', 'counterpoint' ), '<span class="edit-link">', ' &middot;&nbsp;</span>' ); ?>
      </section>
      <?php
      wp_link_pages();
      the_content();
      wp_link_pages();
    endwhile; ?>
    <div id="article-bottom"><?php dynamic_sidebar('article-bottom'); ?></div>
    <?php counterpoint_adjacent_posts(); ?>
  </article>
  
  <section id="comments-section">
    <?php comments_template(); ?>
  </section>
  
</section>

<?php get_footer(); ?>