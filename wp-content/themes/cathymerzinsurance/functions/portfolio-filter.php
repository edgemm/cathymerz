<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Function which prints portfolio filter
function add_portfolio_filter ( $loop ) {
	?>
	<ul id="sort-categories" data-option-key="filter">
		<?php

			// Extract portfolio item IDs
			$portfolio_ids = array(); 
			while ( $loop->have_posts() ) : $loop->the_post(); 
				$portfolio_ids[] = get_the_ID();			
			endwhile;

			echo '<li class="current-category"><a href="#" data-option-value="*" title="'.count($portfolio_ids).'">All</a> <span>/ </span></li>';
					
			// Extract portfolio skills from the portfolio items
			$terms_pre = wp_get_object_terms($portfolio_ids, 'portfolio_skills');
			$terms = array();
			foreach ( $terms_pre as $term ) {	
				if(!in_array($term, $terms))
					$terms[] = $term;
			}
			$count = count($terms);
						
			// Print portfolio filter
			if($count > 0 ) {
				foreach ( $terms as $term ) {	
			    $term_slug = strtolower($term->slug);
				echo '<li><a href="#" title="'.$term->count.'" data-option-value=".' . $term_slug . '">' . $term->name . '</a> <span>/ </span></li>';
				}
			}
		?>
	</ul>
	<?php
}
?>