<?php
  add_theme_support( 'post-thumbnails' );
  
  function BlogAddress() { return get_bloginfo('wpurl'); }
  add_shortcode('url','BlogAddress');
  
  function custom_excerpt_more( $more ) { return ' &hellip; '; }
  add_filter( 'excerpt_more', 'custom_excerpt_more' );
  
  function new_excerpt_length($length) { return 60; }
  add_filter('excerpt_length', 'new_excerpt_length');
  
  function remove_caption_padding($width) { return $width - 10; }
  add_filter( 'img_caption_shortcode_width', 'remove_caption_padding' );

  // Register Menu //
  
  function register_my_menu() {
    register_nav_menu('sidebar',__( 'Sidebar' ));
  }
  add_action('init', 'register_my_menu');
  
  // Widget Space //
  
  if (function_exists('register_sidebar')) {
    register_sidebar(array(
      'name' => 'Sidebar Bottom',
      'id'   => 'sidebar-bottom',
      'description'   => 'Area at the bottom of the sidebar.',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
    ));
    
    register_sidebar(array(
      'name' => 'Article Top',
      'id'   => 'article-top',
      'description'   => 'Area the top of each post, next to the timestamp.',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
    ));
    
    register_sidebar(array(
      'name' => 'Article Bottom',
      'id'   => 'article-bottom',
      'description'   => 'Area at the bottom of each post, before the comments.',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
    ));
  }

  // Returns the first image in a post (in lieu of Featured Image) //
  
  function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];
  
    if(empty($first_img)) {
      return false;
    }
    return $first_img;
  }

  // Comment Layout //

  function counterpoint_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?>>
      <div id="comment-<?php comment_ID(); ?>">
        <header class="comment-author vcard">
          <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( get_comment_author_email() ); ?>?s=64" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.png" />
          <div class="comment-author-info"><?php printf('<cite class="fn">%s</cite>', get_comment_author_link()) ?>
          <?php edit_comment_link(__('Edit'),' &#183; ','') ?>
          <?php comment_reply_link(array_merge( $args, array('before' => ' &#183; ','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
          </div>
          <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
        </header>
        <?php if ($comment->comment_approved == '0') : ?>
          <div class="alert alert-info">
            <p><?php _e( 'Your comment is awaiting moderation.', 'counterpoint' ) ?></p>
          </div>
        <?php endif; ?>
        <section class="comment-content">
          <?php comment_text() ?>
        </section>
      </article>
    <?php // </li> is added by WordPress automatically
  } // don't remove this bracket!
  
  // Numeric Page Nav //
  
  function counterpoint_page_nav() {
    global $wp_query;
    $bignum = 999999999;
    if ( $wp_query->max_num_pages <= 1 )
      return;
    
    echo '<nav class="pagination">';
    
      echo paginate_links( array(
        'base'      => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
        'format'    => '',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $wp_query->max_num_pages,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
        'type'      => 'list',
        'end_size'  => 3,
        'mid_size'  => 3
      ) );
    
    echo '</nav>';
  }
?>