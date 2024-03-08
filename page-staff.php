<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HK_School
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'page' );
	endwhile; // End of the loop.
	?>

	<!-- Custom loop to display staff cpt -->
	<?php
	// Get the staff categories
	$terms = get_terms(
		array(
			'taxonomy' => 'hk-staff-category'
		)
	);

	if ( $terms && !is_wp_error( $terms ) ) {
		// Loop through the categories and output their associated posts
		foreach ( $terms as $term ) {
			$args = array(
				'post_type' => 'hk-staff',
				'posts_per_page' => -1,
				'order' => 'ASC',
				'orderby' => 'title',
				'tax_query' => array(   // Get only the "hk-staff" CPT with the specific category
					array(
						"taxonomy" => "hk-staff-category",
						"field"    => "slug",
						"terms"    => $term -> name
					)
				)
			);

			$query = new WP_QUERY( $args );

			if ( $query -> have_posts() ) {
				?>
				<!-- Display the staff -->
				<section class="staff">
					<h2><?php echo esc_html( $term->name ); ?></h2>
					<?php
					while ( $query -> have_posts() ) {
						$query -> the_post();
						?>
						<article>
							<?php
							if ( function_exists( "get_field" )) {
								if ( get_field( "biography" )) {
									?>
									<h3 id=<?php echo esc_attr(get_the_ID()); ?>><?php the_title(); ?></h3>
									<p><?php esc_html(the_field( "biography" )); ?></p>
									<?php 
								}

								// Output courses only for faculty
								if ( $term -> name == "Faculty" ) {
									// Output courses if they exist
									if ( get_field( "courses" ) ) {
										?>
										<p class="courses">Courses: 
										<?php
										$courses = get_field( "courses" );
										foreach ( $courses as $index => $value ) {
											echo esc_html( $value['course'] );
											// Output , inbetween courses
											if ( $index < (count( $courses ) - 1) ) {
												echo ', ';
											}
										}
										?>
										</p>
										<?php
									}

									// Output instructor website if it exists
									if ( get_field( "instructor_website" ) ) {
										?>
										<p>
											<a class="instructor-website" href="<?php echo esc_url( get_field( "instructor_website" ) ) ?>">Instructor Website</a>
										</p>
										<?php
									}
								}
							}
							?>
						</article>
						<?php
					}
					wp_reset_postdata();
				?>
				</section>
				<?php
			}
		}
	}
	?>
</main><!-- #main -->

<?php
get_footer();
