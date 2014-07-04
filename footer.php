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
                <ul class="grid cf"><?php dynamic_sidebar('footer-widget'); ?></ul>
                <p class="theme-credit">Theme design by <a href="http://henleythemes.com/">HenleyThemes</a></p>
            </footer>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>