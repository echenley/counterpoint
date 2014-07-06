<?php

/*
 * Comment layout inspired by Bones Theme ( http://themble.com/bones )
 * Author: Eddie Machado
 * License: WTFPL
 * License URI: http://sam.zoy.org/wtfpl/
*/

  if ( ! empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
    <div class="alert-blue">
      <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'counterpoint' ); ?></p>
    </div>
  <?php return;
  }
  
if ( have_comments() ) : ?>
  <h3 id="comments"><?php comments_number( __( '<span>No</span> Responses', 'counterpoint' ), __( '<span>One</span> Response', 'counterpoint' ), _n( '<span>%</span> Response', '<span>%</span> Responses', get_comments_number(), 'counterpoint' ) );?> to &#8220;<?php the_title(); ?>&#8221;</h3>
  <nav class="pagination cf"><?php paginate_comments_links( array('prev_text' => '&larr; Previous', 'next_text' => 'Next &rarr;') ); ?></nav>
  <ol class="commentlist">
    <?php wp_list_comments( array('type' => 'all', 'callback' => 'counterpoint_comments') ); ?>
  </ol>
  <nav class="pagination cf"><?php paginate_comments_links( array('prev_text' => '&larr; Previous', 'next_text' => 'Next &rarr;') ); ?></nav>
<?php endif;

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$fields = array(
  'author' =>
    '<p class="comment-form-author"><label for="author">' . __( 'Name <span class="required">*</span>', 'counterpoint' ) . '</label>' .
    '<input type="text" id="author" name="author" type="text" placeholder="Your Name*" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' /></p>',

  'email' =>
    '<p class="comment-form-email"><label for="email">' . __( 'Email <span class="required">*</span>', 'counterpoint' ) . '</label>' .
    '<input type="email" id="email" name="email" type="text" placeholder="Your Email*" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>',

  'url' =>
    '<p class="comment-form-url"><label for="url">' . __( 'Website', 'counterpoint' ) . '</label>' .
    '<input type="url" id="url" name="url" type="text" placeholder="Your Website (optional)" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" /></p>'
);

comment_form(
  array(
    'fields' => $fields,
    'logged_in_as' => '<div class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</div>',
    'comment_field' =>
      '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment <span class="required">*</span>', 'noun', 'counterpoint' ) . '</label><textarea id="comment" placeholder="Enter Your Comment Here*" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
    'label_submit' => __('Post Comment &rarr;', 'counterpoint')
  ), $post->ID
);