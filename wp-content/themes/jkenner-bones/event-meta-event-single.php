<?php
/**
 * The template is used for displaying a single event details.
 *
 * You can use this to edit how the details re displayed on your site. (see notice below).
 *
 * Or you can edit the entire single event template by creating a single-event.php template
 * in your theme.
 *
 * For a list of available functions (outputting dates, venue details etc) see http://wp-event-organiser.com/documentation/function-reference/
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. See http://wp-event-organiser.com/documentation/editing-the-templates/ for more information
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.7
 */
?>

<div class="entry-meta eventorganiser-event-meta clearfix">
	<!-- Choose a different date format depending on whether we want to include time -->
	<?php if( eo_is_all_day() ){
		$date_format = 'j F Y'; 
	}else{
		$date_format = 'j F Y ' . get_option('time_format'); 
	} ?>

	<!-- Event details -->
		<h4><?php _e('Event Details', 'eventorganiser') ;?></h4>

		<!-- Is event recurring or a single event -->
		<?php if( eo_reoccurs() ):?>
			<!-- Event reoccurs - is there a next occurrence? -->
			<?php $next =   eo_get_next_occurrence($date_format);?>

			<?php if($next): ?>
				<!-- If the event is occurring again in the future, display the date -->
				<?php printf('<p>'.__('This event is running from %1$s until %2$s. It is next occurring on %3$s','eventorganiser').'.</p>', eo_get_schedule_start('j F Y'), eo_get_schedule_last('j F Y'), $next);?>
	
			<?php else: ?>
				<!-- Otherwise the event has finished (no more occurrences) -->
				<?php printf('<p>'.__('This event finished on %s','eventorganiser').'.</p>', eo_get_schedule_last('d F Y',''));?>
			<?php endif; ?>
		<?php endif; ?>

	<ul class="eo-event-meta" style="float:left;width:40%">


		<?php if( !eo_reoccurs() ){ ?>
				<!-- Single event -->
				<li><strong><?php _e('Start', 'eventorganiser') ;?>:</strong> <?php eo_the_start($date_format); ?> </li>
				<?php
		 } ?>

		<?php if( eo_get_venue() ){ ?>
			<li><strong><?php _e('Venue','eventorganiser'); ?>:</strong> <a href="<?php eo_venue_link(); ?>"> <?php eo_venue_name(); ?></a></li>
		<?php } ?>


		<?php if( get_the_terms(get_the_ID(),'event-category') ){ ?>
			<li><strong><?php _e('Event Category','eventorganiser'); ?>:</strong> <?php echo get_the_term_list( get_the_ID(),'event-category', '', ', ', '' ); ?></li>
		<?php } ?>

	
		<?php if( get_the_terms(get_the_ID(),'event-tag') && !is_wp_error( get_the_terms(get_the_ID(),'event-tag') ) ){ ?>
			<li><strong><?php _e('Tags','eventorganiser'); ?>:</strong> <?php echo get_the_term_list( get_the_ID(),'event-tag', '', ', ', '' ); ?></li>
		<?php } ?>

		<?php if( eo_reoccurs() ){ 			
				//Event reoccurs - display dates. 
				$upcoming = new WP_Query(array(
					'post_type'=>'event',
					'event_start_after' => 'today',
					'posts_per_page' => -1,
					'event_series' => get_the_ID(),
					'group_events_by'=>'occurrence'//Don't group by series
				));
	
				if( $upcoming->have_posts() ): ?>

					<li><strong><?php _e('Upcoming Dates','eventorganiser'); ?>:</strong>
						<ul id="eo-upcoming-dates">
							<?php while( $upcoming->have_posts() ): $upcoming->the_post(); ?>
									<li> <?php eo_the_start($date_format) ?></li>
							<?php endwhile; ?>
						</ul>
					</li>
 
					<?php 
					wp_reset_postdata(); 
					//With the ID 'eo-upcoming-dates', JS will hide all but the next 5 dates, with options to show more.
					wp_enqueue_script('eo_front');
					?>
				<?php endif; ?>
		<?php } ?>

	</ul>

	<!-- Does the event have a venue? -->
	<?php if( eo_get_venue() ): ?>
		<!-- Display map -->
		<div id="test" style="width:55%;float:right;margin-bottom:1em;">
		<?php echo eo_get_venue_map(eo_get_venue(),array('width'=>'100%')); ?>
		</div>
	<?php endif; ?>

	<?php
  //Inside the loop
  $url = eo_get_add_to_google_link();
  echo '<a class="button" href="'.esc_url($url).'" title="Click to add this event to a Google calendar">Add to Google Calendar</a>';
  ?>

  <a class="permalink" href="<?php the_permalink(); ?>" title="Permalink for <?php the_title_attribute(); ?>">Permalink</a>


</div><!-- .entry-meta -->
