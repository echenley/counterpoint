<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">

  <header class="attachment-header">
    <h3><?php printf( __( 'Attachment: %s', 'counterpoint' ), get_the_title() ); ?></h3>
  </header>
    
  <article id="attachment" <?php post_class(); ?>>
  <?php
  while ( have_posts() ) : the_post();
    $photographer = get_post_meta($post->ID, 'be_photographer_name', true);
    $photographerurl = get_post_meta($post->ID, 'be_photographer_url', true);
    ?>
    
    <section class="post-meta cf">
      <?php counterpoint_posted_on(); ?>
    </section>
    
    <div class="photometa">
      <span class="photographername"><?php echo $photographer; ?></span><a href="<?php echo $photographerurl; ?>" target="_blank" class="photographerurl"><?php echo $photographerurl; ?></a>
    </div>
    <div class="entry-attachment">
    
    <?php if ( wp_attachment_is_image( $post->ID ) ) : $att_image = wp_get_attachment_image_src( $post->ID, 'full')[0]; ?>
      <a href="<?php echo wp_get_attachment_url($post->ID); ?>" title="<?php printf( __( 'Attachment: %s', 'counterpoint' ), get_the_title() ); ?>" rel="attachment"><img src="<?php echo $att_image; ?>"  class="attachment-medium aligncenter" alt="<?php $post->post_excerpt; ?>" /></a>
    <?php else : ?>
      <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php the_title(); ?>" rel="attachment"><?php echo wp_basename($post->guid); ?></a>
    <?php endif; ?>
    </div>
    
  <?php endwhile; ?>
  </article>
  
</section>

<?php get_footer(); ?>