<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogwaves
 */

?>
</div><!-- #content -->

<?php $show_copyright = get_theme_mod('blogwaves_footer_copyright_display',true);  ?>
<footer class="footer-section">
        <?php if ( is_active_sidebar( 'footer-widgets' ) ) { ?>
            <div class="container">
                <div class="footer-top">
                    <div class="row clearfix">
                        <?php dynamic_sidebar('footer-widgets'); ?>
                        
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if($show_copyright) { ?>
            <div class="copyright-footer">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-md-center align-self-center">
                            <p><?php echo esc_html(get_theme_mod('blogwaves_copyright','Copyright © 2020 Powered by WordPress')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </footer>

    </div><!-- #page -->

    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa fa-angle-up"></i>
    </button> 
	
<?php  wp_footer(); ?>

</body>
</html>