        </div>
            <footer id="footer" class="cf">
                <nav class="footer-nav">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container' => false,
                        'depth' => -1
                    ) ); ?>
                </nav>
                <?php dynamic_sidebar('footer-widget'); ?>
            </footer>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>