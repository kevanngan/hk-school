<?php
/**
 * The template for displaying the homepage of the site
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>
<main id="primary" class="site-main">

<?php
while ( have_posts() ) :
    the_post();
    ?>

    <section class="home-intro">
        <h1><?php the_title(); ?></h1>
        <!-- Output the content of the homepage block editor -->
        <?php the_content(); ?>
    </section>

    <!-- Recent news section -->
    <?php
    $args = array(
        "posts_per_page" => 3,   // Get 3 latest posts
    );

    $query = new WP_Query( $args );
    if ( $query -> have_posts() ) :
        ?>
        <section class="recent-news">
            <h2>Recent News</h2>
            <?php
            while ( $query -> have_posts() ) {
                $query -> the_post();
                ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( "medium" ); ?>
                    <p class='blog-title'><?php the_title(); ?></p>
                </a>

                <?php
            }
            wp_reset_postdata();
            ?>
            <p class="blog-link">
                <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ) ?>">See All News</a>
            </p>
        </section>
        <?php
    endif;
    ?>
   <?php
endwhile; // End of the loop.
?>

</main><!-- #primary -->

<?php
get_footer();
?>