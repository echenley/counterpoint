<?php get_header(); ?>
<?php get_sidebar(); ?>
  
<section id="content">
  <?php // Checks for post thumbnail => gets first image => randomizes color //
    $imgSrc = function() { 
      if (has_post_thumbnail()) {
        return 'url(' . wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full')[0] . '); background-position: center; background-size: cover';
      } else {
        $firstImg = catch_that_image();
        if ($firstImg) {
          return 'url(' . $firstImg . '); background-position: center; background-size: cover';
        } else {
          $rand = array('4', '5', '6', '7', '8');
          return '#'.$rand[rand(0,4)].$rand[rand(0,4)].$rand[rand(0,4)].$rand[rand(0,4)].$rand[rand(0,4)].$rand[rand(0,4)];
        };
      };
    };
  ?>
  <header class="post-header" style="background: <?php echo $imgSrc(); ?>;">
    <div class="post-title"><h2><?php the_title(); ?></h2></div>
  </header>
    
  <article id="page">
    <?php while(have_posts()): the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </article>
</section>

<?php get_footer(); ?>