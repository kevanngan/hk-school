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
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		endwhile; // End of the loop.
		?>

		<?php
		$terms = get_the_terms( get_the_ID(), 'hk-student-category' );

		if ( $terms && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {

				// Fetch other posts with same term using wp_query
				$args = array(
					'post_type'      => 'hk-student',
					'posts_per_page' => -1,
					'tax_query'      => array(
						array(
							'taxonomy' => 'hk-student-category',
							'field'    => 'slug',
							'terms'    => $term->slug,
						),
					),
					'post__not_in'   => array( get_the_ID() ),
				);

				$query = new WP_Query( $args );
				echo '<h2>Meet other ' . esc_html( $term->name ) . ' students:</h2>';

				// Display the links to other students
				if ( $query->have_posts() ) {
					echo '<ul>';
					while ( $query->have_posts() ) {
						$query->the_post();
						echo '<li><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></li>';
					}
					echo '</ul>';
					wp_reset_postdata();
				}
			}
		}
		?>

	</main><!-- #primary -->

<?php
get_footer();
