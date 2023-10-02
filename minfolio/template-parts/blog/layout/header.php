
<header class="entry-header">
    
    <div class="entry-meta">
		<?php minfolio_posted_on(); ?>
	</div>

	<?php        
        
		if ( ! is_single() ) {			
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}			

	?>
		
</header>