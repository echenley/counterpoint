<?php get_header()?>
<?php get_sidebar()?>
  
<section id="content">
  <?php $imgSrc = has_post_thumbnail() ? wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full')[0] : catch_that_image();
  if ($imgSrc) { ?>
    <header class="post-header" style="background: url(<?php echo $imgSrc; ?>); background-position: center; background-size: cover;">
      <h2><span class="post-title"><?php the_title(); ?></span></h2>
    </header>
  <?php }; ?>
    
  <article id="page">
    <?php while(have_posts()): the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </article>
</section>

<?php get_footer()?>