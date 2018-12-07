<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

    <div class="py-5">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header>
                    <div class="entry-content">
                        <?php
                        the_content();

                        ?>
                    </div>
                    </article>
                <?php

            endwhile; // End of the loop.
            ?>

        </div>
    </div>

<?php
get_footer();
