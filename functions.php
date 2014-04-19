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
  
  // Post Header Function Call //
  
  function post_thumb_style($post_id) { // Checks for post thumbnail || gets first image || randomizes color //
    
    if (has_post_thumbnail($post_id)) {
      $img_id = get_post_thumbnail_id($post_id);
      $alt_text = get_post_meta($img_id, '_wp_attachment_image_alt', true);
      if ($alt_text === '') { $alt_text = get_the_title($post_id); };
      return 'style="background: url(' . wp_get_attachment_image_src($img_id, 'full')[0] . '); background-position: center; background-size: cover" title="' . $alt_text . '"';
    } else {
      $firstImg = catch_that_image($post_id);
      if ($firstImg) {
        return 'style="background: url(' . $firstImg . '); background-position: center; background-size: cover"';
      } else {
        $rand = array('3','4', '5', '6', '7');
        return 'style="background: #' . $rand[rand(0,4)].$rand[rand(0,4)].$rand[rand(0,4)].$rand[rand(0,4)].$rand[rand(0,4)].$rand[rand(0,4)] . '"';
      };
    };
  };
  
  // Add Custom Favicon to Admin Pages //
  
  function add_favicon() {
    $favicon_url = get_template_directory_uri() . '/library/images/favicon-admin.ico';
    echo '<link rel="shortcut icon" href="' . $favicon_url . '">';
  }
  add_action('login_head', 'add_favicon');
  add_action('admin_head', 'add_favicon');
  
  // jQuery Insert From Google //
  
  if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
  function my_jquery_enqueue() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'http' . ($_SERVER['SERVER_PORT'] == 443 ? 's' : '') . '://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', false, null);
    wp_enqueue_script('jquery');
  }

  // Remove Admin Bar //
  
  add_filter('show_admin_bar', '__return_false');

  // Register Sidebar Menu //
  
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
          <div class="comment-author-info"><?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
          <?php edit_comment_link(__('Edit'),' &#183; ',''); ?>
          <?php comment_reply_link(array_merge( $args, array('before' => ' &#183; ','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
          </div>
          <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?></a></time>
        </header>
        <?php if ($comment->comment_approved == '0') : ?>
          <div class="alert alert-info">
            <p><?php _e( 'Your comment is awaiting moderation.', 'counterpoint' ) ?></p>
          </div>
        <?php endif; ?>
        <section class="comment-content">
          <?php comment_text(); ?>
        </section>
      </div>
    <?php // </li> is added by WordPress automatically
  } // don't remove this bracket!
  
  // Password Protected Form //
  
  function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<p class="no-dropcap">' . __( "This post is password protected. Enter the password to view it." ) . '</p>
    <form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post" class="post-password-form"><label for="' . $label . '">' . __( "Password:" ) . ' </label><input name="post_password" id="' . $label . '" type="password" maxlength="20" placeholder="Enter Password*" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
    </form>
    ';
    return $o;
  }
  add_filter( 'the_password_form', 'my_password_form' );
  
  // Numeric Page Nav //
  
  function counterpoint_page_nav() {
    global $wp_query;
    $bignum = 999999999;
    if ( $wp_query->max_num_pages <= 1 )
      return;
    $paginate_links = paginate_links( array(
      'base'      => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
      'format'    => '',
      'current'   => max( 1, get_query_var('paged') ),
      'total'     => $wp_query->max_num_pages,
      'prev_text' => __('&larr; Newer'),
      'next_text' => __('Older &rarr;'),
      'type'      => 'array',
      'end_size'  => 3,
      'mid_size'  => 3
    ) );
    
    if ( $paginate_links ) {
      echo '<nav class="pagination">';
      foreach($paginate_links as $key=>$value) {
        echo $value;
      };
      echo '</nav>';
    }
    
  }
  
  // Adds 'next_and_number' option for wp_link_pages arg 'next_or_number' //
  
  add_filter('wp_link_pages_args','add_next_and_number');
  function add_next_and_number($args){
    if($args['next_or_number'] == 'next_and_number') {
      global $page, $numpages, $multipage, $more, $pagenow;
      $args['next_or_number'] = 'number';
      $prev = '';
      $next = '';
      if ( $multipage && $more ) {
        $i = $page - 1;
        if ( $i && $more ) {
          $prev .= _wp_link_page($i);
          $prev .= $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
        }
        $i = $page + 1;
        if ( $i <= $numpages && $more ) {
          $next .= _wp_link_page($i);
          $next .= $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>';
        }
      }
      $args['before'] = $args['before'] . $prev;
      $args['after'] = $next . $args['after'];    
    }
    return $args;
  }
  
  function counterpoint_link_pages( $args = '' ) {
    $defaults = array(
      'before' => '<div class="post-pagination">', 
      'after' => '</div>',
      'link_before' => '',
      'link_after' => '',
      'next_or_number' => 'number', 
      'nextpagelink' => __( 'Next Page &rarr;' ),
      'previouspagelink' => __( '&larr; Previous Page' ),
      'pagelink' => '%',
      'echo' => 1
    );
  
    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );
  
    global $page, $numpages, $multipage, $more, $pagenow;
    
    $output = '';
    if ( $multipage ) {
      if ( 'number' == $next_or_number ) {
        $output .= $before;
        for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
          $j = str_replace( '%', $i, $pagelink );
          $output .= ' ';
          if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
            $output .= _wp_link_page( $i );
          else
            $output .= '<span class="current">';
  
          $output .= $text_before . $j . $text_after;
          if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
            $output .= '</a>';
          else
            $output .= '</span>';
        }
        $output .= $after;
      } else {
        if ( $more ) {
          $output .= $before;
          $i = $page - 1;
          if ( $i && $more ) {
            $output .= _wp_link_page( $i );
            $output .= $text_before . $previouspagelink . $text_after . '</a>';
          }
          $i = $page + 1;
          if ( $i <= $numpages && $more ) {
            $output .= _wp_link_page( $i );
            $output .= $text_before . $nextpagelink . $text_after . '</a>';
          }
          $output .= $after;
        }
      }
    }
  
    if ( $echo )
      echo $output;
  
    return $output;
  }
?>