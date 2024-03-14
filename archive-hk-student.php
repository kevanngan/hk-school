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

		<header class="page-header">
			<h1>The Class</h1>
			<h1><?php single_term_title(); ?></h1>
		</header><!-- .page-header -->

		<section class="students">
			<?php 
			$args = array(
				'post-type' 	   => 'hk-student',
				'posts_per_page'   => -1,
				'orderby'		   => 'title',
				'order'            => 'ASC',
				'tax_query'	       => array(
					array(
						'taxonomy' => 'hk-student-category',
						'field'	   => 'slug',
						'terms'    => array( 'designer', 'developer,' ),
						'operator' => 'IN',
					),
				),
			);
			$query = new WP_Query( $args );
			if ( $query -> have_posts()) {
				while ( $query -> have_posts() ) {
					$query -> the_post();
					?>
					<article class="student-item">
					<h2><a href="<?php the_permalink(); ?>" class="main-link underline-link"><?php the_title(); ?></a></h2>
					<a href="<?php the_permalink(); ?>" class="main-link underline-link">
						<?php the_post_thumbnail('student-thumbnail-300x257'); ?>
					</a>
					<p>
						<?php 
							echo wp_trim_words(get_the_excerpt(), 25, ''); 
							echo '<br><a href="' . get_permalink() . '" class="main-link underline-link">Read more about the student...</a>';
						?>
					</p>
					<p><?php echo get_the_term_list(get_the_ID(), 'hk-student-category', 'Specialty: '); ?></p>
					</article>
					<?php
				}
				wp_reset_postdata();
			}
			?>
		</section>


	</main><!-- #main -->

<?php
get_footer();
