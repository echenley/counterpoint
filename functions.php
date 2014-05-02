<?php
/*
  Theme Name: Counterpoint
  Author: Evan Henley
  Author URL: http://henleyedition.com/
  
  Contents
  ----------------------
  *  Theme Support
  *  Translation-Ready Function
  *  Clean Up wp_head (and associated functions)
  *  Small Customizations
  *  Custom Favicon For Admin
  *  Font URL Function (called from enqueue)
  *  Enqueue Scripts and Styles
  *  Remove Admin Bar
  *  Register Menus
  *  Register Widget Space
  *  Catch That Image
  *  Post-Header Function Call
  *  Comment Layout
  *  Password Protected Form
  *  Numeric Page Navigation
  *  Next and Previous Post Navigation
  *  Display Categories
  *  Display Timestamp
  *  Custom Link Pages
  *  Index/Archive Loop Function

 */
 
  // Content Width Setup //
  if ( ! isset( $content_width ) ) $content_width = 1080;


  /*
   * Counterpoint Setup
  */
  
  if ( ! function_exists( 'counterpoint_setup' ) ) :
  function counterpoint_setup() {
  
    /*
     * Translation-Ready Function - via Sté Kerwer
     * http://dukeo.com/how-to-make-your-wordpress-theme-translation-ready/
    */
    load_theme_textdomain( 'counterpoint', get_template_directory_uri() . '/languages' );
    
    $locale = get_locale();
    $locale_file = get_template_directory_uri() . "/languages/$locale.php";
    if ( is_readable($locale_file) )
      require_once($locale_file);
      
    
    // Theme Support //
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    
    
    // Sidebar Menu //
    register_nav_menu('sidebar',__( 'Sidebar', 'counterpoint' ));
  
  }
  endif; // End Counterpoint Setup //
  add_action( 'after_setup_theme', 'counterpoint_setup' );


  /* 
   * Code to clean up wp_head
   *
   * Courtesy of Bones Theme ( http://themble.com/bones )
   * Eddie Machado
   * License: WTFPL
   * License URI: http://sam.zoy.org/wtfpl/
  */

  remove_action( 'wp_head', 'rsd_link' );                                // EditURI link
  remove_action( 'wp_head', 'wlwmanifest_link' );                        // windows live writer
  remove_action( 'wp_head', 'index_rel_link' );                          // index link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );             // previous link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );              // start link
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );  // links for adjacent posts
  remove_action( 'wp_head', 'wp_generator' );                            // WP version
  add_filter( 'style_loader_src', 'counterpoint_remove_wp_ver_css_js', 9999 );  // remove WP version from css
  add_filter( 'script_loader_src', 'counterpoint_remove_wp_ver_css_js', 9999 ); // remove Wp version from scripts
  add_filter( 'wp_title', 'counterpoint_title', 10, 3 );                 // Better Title
  add_filter( 'the_generator', 'counterpoint_rss_version' );             // remove WP version from RSS
  
  // Better Title. ( http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html ) //
  function counterpoint_title( $title, $sep, $seplocation ) {
    global $page, $paged;
  
    // Don't affect in feeds.
    if ( is_feed() ) return $title;
  
    // Add the blog's name
    if ( 'right' == $seplocation )
      $title .= get_bloginfo( 'name' );
    else
      $title = get_bloginfo( 'name' ) . $title;
  
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
  
    if ( $site_description && ( is_home() || is_front_page() ) )
      $title .= " {$sep} {$site_description}";
  
    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
      $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  
    return $title;
  }
  
  // remove WP version from RSS //
  function counterpoint_rss_version() { return ''; }
  
  // remove WP version from scripts //
  function counterpoint_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
      $src = remove_query_arg( 'ver', $src );
    return $src;
  }
  
  
  /*
   * Small Customizations
  */
  
  // Custom Excerpt More. Replaces [...] with 'Keep Reading' link //
  function counterpoint_excerpt_more( $more ) {
    return ' &hellip; <a class="read-more" href="' . esc_attr(get_the_permalink()) . '" title="' . esc_attr( get_the_title() ) . '">' . __( 'Keep reading &rarr;', 'counterpoint') . '</a>';
  }
  add_filter( 'excerpt_more', 'counterpoint_excerpt_more' );
  
  // Removes junk from around images //
  function counterpoint_filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
  }
  add_filter( 'the_content', 'counterpoint_filter_ptags_on_images' );

  // Excerpt Length //
  function counterpoint_excerpt_length($length) { return 70; }
  add_filter('excerpt_length', 'counterpoint_excerpt_length');
  
  // Remove Caption Padding //
  function counterpoint_caption_padding($width) { return $width - 10; }
  add_filter( 'img_caption_shortcode_width', 'counterpoint_caption_padding' );
  
  // Default Title //
  function counterpoint_default_title($title) {
    $title = __('Untitled', 'counterpoint');
    return $title;
  }
  add_filter( 'default_title', 'counterpoint_default_title' );
  
  // If title field is left blank //
  function counterpoint_no_title($title) {
    if ( $title == '' ) $title = __('Untitled', 'counterpoint');
    return $title;
  }
  add_filter( 'the_title', 'counterpoint_no_title' );
  
  
  // Return Merriweather Font URL (called via enqueue) //
  function counterpoint_font_url() {
    $font_url = '';
    /*
     * Translators: If there are characters in your language that are not supported
     * by Lato, translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'counterpoint' ) )
      $font_url = add_query_arg( 'family', urlencode( 'Merriweather:400,400italic,700' ), '//fonts.googleapis.com/css' );
  
    return $font_url;
  }

  
  // Enqueue Scripts and Styles. jQuery Insert From Google //
  add_action("wp_enqueue_scripts", "counterpoint_scripts", 11);
  function counterpoint_scripts() {
  
    // CSS //
    wp_enqueue_style( 'merriweather-font', counterpoint_font_url(), array(), null );
    wp_enqueue_style('counterpoint-style', get_template_directory_uri() . '/library/css/style.css');
      
    // Javascript //
    wp_enqueue_script('counterpoint-scripts', get_template_directory_uri() . '/library/js/scripts-min.js',
      array('jquery'), '', true);

    if ( is_singular() && comments_open() && get_option('thread_comments') )
      wp_enqueue_script( 'comment-reply' );
  }
  
  
  // Register Widget Space //
  if (function_exists('register_sidebar')) {
    register_sidebar(array(
      'name' => __('Sidebar Bottom', 'counterpoint'),
      'id'   => 'sidebar-bottom',
      'description'   => __('Area at the bottom of the sidebar.', 'counterpoint'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
    ));
    
    register_sidebar(array(
      'name' => __('Article Bottom', 'counterpoint'),
      'id'   => 'article-bottom',
      'description'   => __('Area at the bottom of each post, before the comments.', 'counterpoint'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
    ));
    
    register_sidebar(array(
      'name' => __('Header Right', 'counterpoint'),
      'id'   => 'header-right',
      'description'   => __('Area at the right side of the header.', 'counterpoint'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
    ));
  }


  /*
   * Catch That Image. Returns the first image in a post (in lieu of Featured Image)
   * http://css-tricks.com/snippets/wordpress/get-the-first-image-from-a-post/
  */
  function counterpoint_catch_image($post_id) {
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post($post_id)->post_content, $matches);
    if ( empty($output) ) return false;
    $first_img = $matches[1][0];
    return $first_img;
  }
  
  
  // Post Header Function Call //
  function post_thumb_style($post_id) { // Checks for post thumbnail || if none, gets first image || else, default color //
    if ( has_post_thumbnail($post_id) ) {
      $img_id = get_post_thumbnail_id($post_id);
      $alt_text = get_post_meta($img_id, '_wp_attachment_image_alt', true);
      if ( !$alt_text )
        $alt_text = get_the_title($post_id);
      return 'style="background: url(' . esc_attr( wp_get_attachment_image_src($img_id, 'full')[0] ) . '); background-position: center; background-size: cover" title="' . esc_attr( $alt_text ) . '"';
    } else {
      $first_img = counterpoint_catch_image($post_id);
      if ( $first_img )
        return 'style="background: url(' . esc_attr( $first_img ) . '); background-position: center; background-size: cover" title="' . esc_attr( get_the_title() ) .'"';
      return 'style="background: url(' . get_template_directory_uri() . '/library/images/no-featured-image.jpg' . '); background-position: center; background-size: cover" title="' . esc_attr( get_the_title() ) .'"';
    };
  };


  // Comment Layout //
  
  function counterpoint_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?>>
      <div id="comment-<?php comment_ID(); ?>">
        <header class="comment-author vcard">
          <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( get_comment_author_email() ); ?>?s=64" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.png" />
          <div class="comment-author-info"><?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
          <?php edit_comment_link(__('Edit', 'counterpoint'), ' &#183; ', ''); ?>
          <?php comment_reply_link(array_merge($args, array('before' => ' &#183; ','depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
          </div>
          <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo esc_html( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?></a></time>
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
  add_filter( 'the_password_form', 'counterpoint_password_form' );
  function counterpoint_password_form() {
    global $post;
    $label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<p class="no-dropcap">' . __( 'This post is password protected. Enter the password to view it.', 'counterpoint' ) . '</p>
      <form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post" class="post-password-form">
        <label for="' . $label . '">' . __( 'Password:', 'counterpoint' ) . ' </label><input name="post_password" id="' . $label . '" type="password" maxlength="20" placeholder="Enter Password*" /><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'counterpoint' ) . '" />
      </form>';
    return $o;
  }
  
  
  // Numeric Page Navigation //
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
      'prev_text' => __('&larr; Newer', 'counterpoint'),
      'next_text' => __('Older &rarr;', 'counterpoint'),
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
  
  
  // Next and Previous Post Navigation //
  function counterpoint_adjacent_posts() {
    $next_post = get_next_post();
    $prev_post = get_previous_post();
    $is_next = is_object($next_post);
    $is_prev = is_object($prev_post); ?>
    <nav id="post-nav" class="cf">
      <?php
      if ( $is_next && $is_prev ) {
        $nurl = get_permalink($next_post->ID);
        $ntitle = get_the_title($next_post->ID);
        $purl = get_permalink($prev_post->ID);
        $ptitle = get_the_title($prev_post->ID); ?>
        
        <div class="next-post half-width" <?php echo post_thumb_style($next_post->ID); ?>>
          <a href="<?php echo esc_url($nurl); ?>" title="<?php echo esc_attr($ntitle); ?>">&larr; <?php _e('Next', 'counterpoint'); ?></a>
        </div>
        <div class="prev-post half-width" <?php echo post_thumb_style($prev_post->ID); ?>>
          <a href="<?php echo esc_url($purl); ?>" title="<?php echo esc_attr($ptitle); ?>"><?php _e('Previous', 'counterpoint'); ?> &rarr;</a>
        </div>
        
      <?php
      } else if ( $is_next ) {  // if first post //
        $nurl = get_permalink($next_post->ID);
        $ntitle = get_the_title($next_post->ID); ?>
        
        <div class="next-post full-width" <?php echo post_thumb_style($next_post->ID); ?>>
          <a href="<?php echo esc_url($nurl); ?>" title="<?php echo esc_attr($ntitle); ?>">&larr; <?php _e('Next', 'counterpoint'); ?></a>
        </div>
        
      <?php
      } else if ( $is_prev ) { // if last post //
        $purl = get_permalink($prev_post->ID);
        $ptitle = get_the_title($prev_post->ID); ?>
        
        <div class="prev-post full-width" <?php echo post_thumb_style($prev_post->ID); ?>>
          <a href="<?php echo esc_url($purl); ?>" title="<?php echo esc_attr($ptitle); ?>"><?php _e('Previous', 'counterpoint'); ?> &rarr;</a>
        </div>
        
      <?php
      } ?>
    </nav>
  <?php
  }
  
  
  // Display Categories //
  function counterpoint_categories() {
    $categories = get_the_category();
    $separator = ', ';
    $output = _n('Topic', 'Topics', count($categories), 'counterpoint') . ': ';
    if($categories) {
      foreach($categories as $category) {
        $output .= '<a href="' . get_category_link( $category->term_id ) . '"';
        $output .= ' title="' . esc_attr( sprintf( __( 'View all posts in %s', 'counterpoint' ), $category->name ) ) . '">' . $category->cat_name . '</a>' . $separator;
      }
      echo trim($output, $separator);
    }
  }
  
  
  // Display Timestamp //
  function counterpoint_posted_on() {
    printf('<time datetime="%1$s" class="timestamp">%2$s</time>',
    esc_attr( get_the_date('c') ),
    esc_html( get_the_date() )
    );
  }
  
  
  /*
   * Custom Link Pages. Adds 'next_and_number' option for wp_link_pages() arg 'next_or_number'
   * Adapted from:
   * http://www.velvetblues.com/web-development-blog/wordpress-number-next-previous-links-wp_link_pages/
  */
  add_filter('wp_link_pages_args','counterpoint_link_pages_args');
  function counterpoint_link_pages_args($args){
    $cp_defaults = array(
      'next_or_number'   => 'next_and_number',
      'before'           => '<nav class="post-pagination">',
      'after'            => '</nav>',
      'pagelink'         => '<span>%</span>',
      'nextpagelink'     => '<span>' . __('Next &rarr;', 'counterpoint') . '</span>',
      'previouspagelink' => '<span>' . __('&larr; Previous', 'counterpoint') . '</span>'
    );
    $args = wp_parse_args( $cp_defaults, $args ); // overwrites $args with $cp_defaults //
    
    if($args['next_or_number'] == 'next_and_number') {
      global $page, $numpages, $multipage, $more;
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
  
  
  // Main Index/Archive Loop Function (index.php, archive.php, search.php, tag.php, category.php) //
  function counterpoint_archive_loop() { ?>
    <ul id="archive">
    <?php
    while(have_posts()): the_post();
      global $post; ?>
      <li <?php post_class(); ?>>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><div class="thumbnail" <?php echo post_thumb_style($post->ID); ?> ></div></a>
        <h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
          <?php the_title(); ?>
        </a></h3>
        <section class="post-meta">
          <?php counterpoint_posted_on(); ?>
        </section>
        <div class="excerpt cf"><?php echo get_the_excerpt(); ?></div>
        <hr>
        <div class="categories"><?php counterpoint_categories(); ?></div>
        <div class="tags"><?php the_tags(); ?></div>
      </li>
    <?php
    endwhile; ?>
    </ul>
  <?php
  }
  
?>