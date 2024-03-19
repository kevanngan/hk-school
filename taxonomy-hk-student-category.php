<?php
/**
 * The template for displaying the Developer archive in the Student category section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
		<h1><?php echo single_term_title() . ' Students'; ?></h1>
		</header><!-- .page-header -->

		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			?>
			
			<article class="student-item">
				<a href="<?php the_permalink(); ?>" class="main-link underline-link">
					<h2><?php the_title(); ?></h2>
				</a>
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'student-thumbnail-200px-300px', array( 'class' => 'alignleft' ) );
				} 
				?>
				<?php the_content();?>
			</article>

			<?php
		endwhile;

		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>
	

</main><!-- #primary -->

<?php
get_footer();