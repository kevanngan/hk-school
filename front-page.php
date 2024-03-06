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
        <?php the_post_thumbnail("large"); ?>
        <?php
            if ( function_exists( 'get_field' ) ) {
                if ( get_field( 'top_section' ) ) {
                    the_field( 'top_section' );
                }
            }
        ?>
    </section>

    <?php
    $args = array(
        "post_type"      => "fwd-work",
        "posts_per_page" => 4,   // Get all of the post in fwd-work
        "tax_query"      => array(
            array(
                "taxonomy" => "fwd-featured",
                "field"    => "slug",
                "terms"    => "front-page"
            )
        )
    );

    $query = new WP_Query( $args );
    if ( $query -> have_posts() ) :
        ?>
        <section class="home-work">
            <h2>Featured Works</h2>
            <?php
            while ( $query -> have_posts() ) :
                $query -> the_post();
                ?>
                <article>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( "medium" ); ?>
                        <p><?php the_title(); ?></p>
                    </a>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </section>
        <?php
    endif;
    ?>

    <div class="left-right-container">
        <section class="home-left">
            <?php
                if ( function_exists( "get_field" )) {    // Makes sure the site still loads if get_field from ACF doesnt exist or its deactiviated
                    if ( get_field( "left_section_heading" )) {    // Ensures we are outputting the h2 tag only if the left_section_heading field is filled in
                        echo "<h2>";
                        esc_html(the_field( "left_section_heading" ));
                        echo "</h2>";
                    }

                    if ( get_field( "left_section_content" ) ) {
                        echo "<p>";
                        esc_html(the_field( "left_section_content" ));
                        echo "</p>";
                    }
                }
            ?>
        </section>

        <section class="home-right">
            <?php
                if ( function_exists( "get_field" )) {
                    if ( get_field( "right_section_heading" )) {
                        echo "<h2>";
                        esc_html(the_field( "right_section_heading" ));
                        echo "</h2>";
                    }

                    if ( get_field( "right_section_content" ) ) {
                        echo "<p>";
                        esc_html(the_field( "right_section_content" ));
                        echo "</p>";
                    }
                }
            ?>
        </section>
    </div>

    <section class="home-slider">
        <?php
            $args = array(
                'post_type'      => 'fwd-testimonial',
                'posts_per_page' => -1
            );
            
            $query = new WP_Query( $args );
            
            if ( $query->have_posts() ) :
                ?>
                <h2>Testimonials</h2>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php
                        while ( $query->have_posts() ) :
                            $query->the_post();
                            ?>
                            <div class="swiper-slide"> <?php the_content(); ?> </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <button class="swiper-button-prev"></button>
                    <button class="swiper-button-next"></button>

                </div>
                <?php
            endif;
        ?>
    </section>
    
    <section class="home-blog">
        <!-- Make the header escape characters and make it translatable -->
        <h2><?php esc_html_e( "Latest Blog Post", "fwd" ) ?></h2>

        <!-- <h2>Latest Blog Posts</h2> -->
        <?php
            // WP_Query() arguments
            $args = array(
                "post_type" => "post",   // post_type => post or post_type => page
                "posts_per_page" => 4,   // Request databse for 2 most recent posts
            );

            $blog_query = new WP_Query($args);

            if ( $blog_query -> have_posts() ) {
                while ( $blog_query -> have_posts() ) {
                    $blog_query -> the_post();
                    ?>
                    <article>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'latest-blog-post' ); ?>
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo get_the_date(); ?></p>
                        </a>
                    </article>
                    <?php
                }
                // Always reset!!!
                wp_reset_postdata();
            }
        ?>
    </section>

    <?php
endwhile; // End of the loop.
?>

</main><!-- #primary -->

<?php
get_footer();
?>