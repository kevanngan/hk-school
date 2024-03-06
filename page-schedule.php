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

	<main id='primary' class='site-main'>

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			
			<h1>Course Schedule</h1>
			<article id='post-<?php the_ID(); ?>' <?php post_class(); ?>>
                <div class='entry-content'>
					<?php
					the_content();
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hk-school' ),
							'after'  => '</div>',
						)
					);

					if ( function_exists( 'get_field' ) ) {
						if ( get_field( 'course_schedule' ) ) {
							?>
							<table>
								<caption>Weekly Course Schedule</caption>
								<thead>
									<tr>
										<th>Date</th>
										<th>Course</th>
										<th>Instructor</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$courseScheduleTable = get_field( 'course_schedule' );
									foreach ( $courseScheduleTable as $row ) {
										// Convert date to Month xx, xxxx format
										$date = strtotime(esc_html($row['date']));
										$date = date('F j, Y', $date);
										$course = esc_html($row['course']);
										$instructor = esc_html(get_the_title($row['instructor'][0]));

										?>
										<tr>
											<td><?php echo $date ?></td>
											<td><?php echo $course ?></td>
											<td><?php echo $instructor ?></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
							<?php
						}
					}
                    ?>
				</div>
			</article>

		<?php
		endwhile; // End of the loop.
		?>
	</main><!-- #main -->

<?php
get_footer();
