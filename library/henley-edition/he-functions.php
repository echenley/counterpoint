<?php
/*
 * Extensions which were disallowed on Wordpress.com
*/

  // Add Custom Favicon to Admin Pages //
  function add_favicon() {
    $favicon_url = get_template_directory_uri() . '/library/henley-edition/favicon-admin.ico';
    echo '<link rel="shortcut icon" href="' . $favicon_url . '">';
  }
  add_action('login_head', 'add_favicon');
  add_action('admin_head', 'add_favicon');
  
?>