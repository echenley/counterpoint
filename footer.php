        </div>
            <footer id="footer" class="cf">
                <nav class="footer-nav">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container' => false,
                        'depth' => -1
                    ) ); ?>
                </nav>
                <hr>
                <div class="footer-widget-area"><?php dynamic_sidebar('footer-widget'); ?></div>
                <p class="theme-credit">Theme designed by <a href="http://henleythemes.com/">HenleyThemes</a></p>
            </footer>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>