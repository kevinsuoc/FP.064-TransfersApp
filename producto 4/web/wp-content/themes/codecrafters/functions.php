<?php
/**
 * OceanWP Child Theme Functions
 *
 * When running a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions will be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {

	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update the theme).
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );

	// Load the stylesheet.
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	
}

add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );


function load_styles() {
  ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" type="text/css" media="all">
  <?php
}
add_action( 'wp_head', 'load_styles');


function footer_hook() {
    ?>
	<div class="footer-container">
		<div class="container custom-footer">
			<div class="footer-nav">
				<p><strong>Sitio Web</strong><a href="https://fp064.techlab.uoc.edu/~uocx2/producto3/" class="footer-link">CodeCrafters Transfers</a></p>
				<p><strong>Soporte</strong> soportecliente@cct.com, 902202122</p>
				<p><strong>Corporativo</strong> corporativo@cct.com, 902202123</p>
			</div>
		</div>
	</div>
	<div class="footer-container footer-copyright">
		<p> Desarrollado por CodeCrafters </p>
	</div>
    <?php
}
add_action('ocean_footer', 'footer_hook', 10);

function header_hook(){
	?>

			<div class="header-container">
				<div class="container custom-header">
					<img width="1215" height="182" src="http://localhost/wp-content/themes/codecrafters/assets/logo.png" class="custom-logo">
				</div>
			</div>

			<div class="nav-background">
				<div class="header-nav">
					<div class="link-container"><a href="/">HOME</a></div>
					<div class="link-container"><a href="nuestros-servicios">NUESTROS SERVICIOS</a></div>
					<div class="link-container"><a href="nuestra-flota">NUESTRA FLOTA</a></div>
					<div class="link-container"><a href="noticias">NOTICIAS</a></div>
				</div>
			</div>
	<?php
}
add_action('ocean_header', 'header_hook', 10);
