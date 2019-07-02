<?php
/**
 * Template Name: Events List Tamplate
 *
 * Description: Use this page template for a page with a left sidebar.
 *
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */
get_header();
?>

<div class="container">

			<div id="content" role="main">

			<?php

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		    $today = current_time('Y-m-d g:i:s');


			$args = array(
				'post_type'              => 'events',
                 'meta_query'             => array(
					            'relation' => 'AND',
                                 array(
                                 'key'       => 'time',
                                 'value'     => $today,
                                 'compare'   => '>=',
								 ),
								 array(
									'key'     => 'active',
									'value'   => true,
									'compare' => '=',
								),
                 ),
                 'meta_key' => 'time',
                 'orderby'  => 'meta_value',
				 'order'  => 'ASC',
				 'posts_per_page' => 25,
                   'paged' => $paged,
			);  

			$events = new WP_Query( $args );
                   if( $events->have_posts() ) : ?>
                <ul>
                  <?php
                 while( $events->have_posts() ) :
				  $events->the_post();

				  $id=get_the_ID();
				  

				  $time=get_post_meta( $id,'time')[0];
				  $datetime1 = new DateTime( $time );
                  $datetime2 = new DateTime(); // current date
	              $interval = $datetime1->diff( $datetime2 );
				  $value=$interval->format( '%a days' );

				 ?>
				 <div class="events_holder">
				      <div class="events_header">
				           <div class="events_name">
					              <strong>Events:</strong> <?php echo get_the_title(); ?>
                           </div>
					        <div class="events_time">
								    <div><?php echo  $time; ?></div>
							       <strong>Started for:</strong> <?php echo $value; ?>
                             </div>
					  </div>
					  
					  <div class="events_body">

					     <div class="events_body_left">
                           <div class="events_organization">
						        <strong>Organize by:</strong>  <?php echo get_post_meta( $id,'organizer')[0]; ?>
				          </div>
						  <div class="events_email">
						        <strong>Email:</strong> <a href="mailto:<?php echo get_post_meta( $id,'email')[0]; ?>"> <?php echo get_post_meta( $id,'email')[0]; ?></a>
						  </div>
				         </div>  

						 <div class="events_body_right">
						  <div class="events_address">
						        <strong>Address:</strong>  <?php echo get_post_meta( $id,'address')[0]; ?>
				          </div>
						  <div class="events_location">
						       <strong>Location:</strong> <?php echo ("(".get_post_meta( $id,'latitude')[0].",". get_post_meta( $id,'longitude')[0].")"); ?>
						  </div>
				         </div>

					  </div>

				 </div>
                 


                <?php 


                 
					endwhile;

					$big = 999999999; 
					echo '<div class="pagination_holder">'.paginate_links( array(
						'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $events->max_num_pages
					) ).'</div>'; 
              wp_reset_postdata();
             ?>
             </ul>
           <?php
             else :
                 esc_html_e( 'No events', 'text-domain' );
              endif;
           ?>





			</div><!-- #content -->
	

</div><!-- .container-->

</div><!-- #page -->


</div><!-- #content -->
<?php wp_footer(); ?>

</body>
</html>