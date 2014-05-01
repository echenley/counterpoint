<div id="sidebar">
  <nav id="site-nav">
    <?php wp_nav_menu( array('theme_location' => 'sidebar', 'container' => false) ); ?>
  </nav>
  <div id="sidebar-widget">
    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-bottom')) : ?><?php endif; ?>
  </div>
</div>