<?php get_header(); ?>
<?php get_sidebar(); ?>
  
<section id="content">
  <header class="post-header" <?php echo post_thumb_style($post->ID); ?> >
    <div class="post-title"><h2>
      <?php echo $post->post_title ? the_title(false) : __( 'Untitled', 'counterpoint' ); /* Default title: "Untitled" */ ?>
    </h2></div>
  </header>
    
  <article id="page" <?php post_class(); ?>>
  <?php
    while(have_posts()): the_post();
      counterpoint_link_pages(array('next_or_number' => 'next_and_number'));
      the_content();
    endwhile;
    counterpoint_link_pages(array('next_or_number' => 'next_and_number')); ?>
    <div id="article-bottom"><?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('article-bottom')) : ?><?php endif; ?></div>
  </article>
  
  <section id="comments-section">
    <?php comments_template(); ?>
  </section>
  
</section>

<?php get_footer(); ?>