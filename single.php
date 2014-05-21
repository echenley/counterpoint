<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  
  <article id="post" <?php post_class(); ?>>
  
    <header class="post-header">
      <div class="post-thumbnail<?php echo counterpoint_thumbnail_style($post->ID); ?>">
        <?php counterpoint_posted_on(); ?>
      </div>
      <h1><?php the_title(); ?></h1>
    </header>
  <?php
    while(have_posts()): the_post(); ?>
      <section class="post-meta">
        <?php counterpoint_categories(); ?>
      </section>
      <?php
      the_content();
      wp_link_pages();
    endwhile; ?>
    <?php dynamic_sidebar('article-widget'); ?>
    <?php counterpoint_adjacent_posts(); ?>
  </article>
  
  <section id="comments-section">
    <?php comments_template(); ?>
  </section>
  
</section>

<?php get_footer(); ?>