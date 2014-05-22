<?php
/*
Template Name: Archive Page
*/
get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
  <?php
    if (has_post_thumbnail()) {
      $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
      $archive_img = $thumbnail[0];
    } else {
      $archive_img = get_template_directory_uri() . '/library/images/archive.jpg';
    }
  ?>

  <article id="archive-page" <?php post_class(); ?>>
  
    <header class="post-header">
      <div class="post-thumbnail" style="background: #fff url(<?php echo $archive_img; ?>); background-position: center; background-size: cover;">
      </div>
      <h1><?php the_title(); ?></h1>
    </header>
    
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
    <div class="tag-cloud"><?php wp_tag_cloud(); ?></div>
  </article>
</section>

<?php get_footer(); ?>