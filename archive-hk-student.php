<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HK_School
 */

get_header();
?>

	<main id="primary" class="site-main">
	<?php 
	if ( have_posts() ) :
		get_template_part( 'template-parts/content', 'archive-hk-student' );
	else :
		get_template_part( 'template-parts/content', 'none' );
    endif;
	?>

	</main><!-- #main -->

<?php
get_footer();
