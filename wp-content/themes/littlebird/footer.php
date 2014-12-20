<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package littlebird
 */
?>

	</div><!-- #content -->

	</div><!-- /.container -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'littlebird' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'littlebird' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'littlebird' ), 'littlebird', '<a href="http://littlebird.mobi" rel="designer">Yusuke Takahashi</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
