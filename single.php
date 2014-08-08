
<?php get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">

    <article id="post" <?php post_class(); ?>>

    <header class="post-header">
    <div class="post-thumbnail<?php echo counterpoint_thumbnail_style($post->ID); ?>">
    <div class="post-info">
    <div class="cp-cats"><?php counterpoint_categories(); ?></div>
    <?php counterpoint_posted_on(); ?>
    </div>
    </div>
    <h1><?php the_title(); ?></h1>
    </header>
    <?php while(have_posts()): the_post(); ?>
    <?php the_content(); ?>
    <?php wp_link_pages(); ?>
    <?php endwhile; ?>
    <hr class="endpost">
    <?php counterpoint_adjacent_posts(); ?>
    </article>

</section>

<?php get_footer(); ?>