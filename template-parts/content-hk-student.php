<?php
/**
 * Template part for displaying page content in single-hk-student.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HK_School
 */

?>

<?php
	
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
			echo '<h3>Meet other ' . esc_html( $term->name ) . ' students:</h3>';

			// Display the links to other students
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					echo '<p><a href="' . esc_url( get_permalink() ) . '" class="main-link underline-link">' . get_the_title() . '</a></p>';
				}
				wp_reset_postdata();
			}
		}
	}
?>