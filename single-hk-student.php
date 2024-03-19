<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">
	<?php 
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
	
			<div class=entry-title>
				<h1><?php the_title(); ?></h1>
			</div>
			<article class="single-student-content student-item">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'student-thumbnail-284x300', array( 'class' => 'alignright' ) );
					} 
					?>
					<?php the_content();?>
				</article>	
		<?php
		endwhile; // End of the loop.
		get_template_part( 'template-parts/content', 'hk-student' );
	else :
		get_template_part( 'template-parts/content', 'none' );
    endif;
	?>

	</main><!-- #primary -->

<?php
get_footer();
