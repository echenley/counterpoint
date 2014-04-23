<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
  <label class="screen-reader-text" for="s">Search for:</label>
  <input type="text" value placeholder="<?php printf(__('Search %s', 'counterpoint'), get_bloginfo('name')); ?>*" name="s" id="s" />
</form>