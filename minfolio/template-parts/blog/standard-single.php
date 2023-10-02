
<div class="post-single standard-layout">  

    <?php

        /* Start the Loop */
        while ( have_posts() ) {
                    
            the_post();			

            get_template_part( 'template-parts/blog/content/post', get_post_format() );
                    
            get_template_part( 'template-parts/blog/layout/navigation' ); 
            
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }				

        } // End of the loop.

    ?>
    
</div>

<?php get_sidebar(); ?>