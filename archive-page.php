<?php
/*
Template Name: Archive Page
*/
get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <?php if ( has_post_thumbnail() ) {
    $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
  } ?>
    
  <header class="post-header" style="background: url(<?php echo $src[0]; ?>); background-position: center; background-size: cover;">
    <h2><span class="post-title"><?php the_title(); ?></span></h2>
  </header>

  <article id="archive-page">
    
    <?php while(have_posts()): the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
    
    <?php get_search_form(); ?>
    
    <h3>Monthly</h3>
    <ul class="monthly">
      <?php wp_get_archives('show_post_count=1'); ?>
    </ul>
    
    <h3>Topics</h3>
    <ul class="topics">
      <?php wp_list_categories('title_li=&show_count=1'); ?>
    </ul>
    
    <h3>Tags</h3>
    <?php wp_tag_cloud(); ?>
  </article>
</section>

<?php get_footer(); ?>