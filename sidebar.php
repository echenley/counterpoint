<div id="sidebar">
  <nav id="site-nav">
    <h1 id="title">
      <a class="title-link" href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a>
      <a href="#menu" class="menu-link">&#9776;</a>
    </h1>
    <?php wp_nav_menu( array('theme_location' => 'sidebar', 'container' => false) ); ?>
  </nav>
  <div id="sidebar-widget">
    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-bottom')) : ?><?php endif; ?>
  </div>
</div>