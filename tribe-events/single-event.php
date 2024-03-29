<?php

/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Overriding parent theme file
 *
 * @package TribeEventsCalendar
 *
 * @theme_package 	Charity NGO Child
 * @theme_author		Dominic Cartwright
 * @theme_version 	1.0.1
 *
 */

if(  ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

if( have_posts() ) : the_post();

?>

<div id="tribe-events-content" class="tribe-events-single vevent hentry">
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'cmsmasters_single_event' ); ?>>


		<!-- ===== Event Header Section ===== -->
		<div class="cmsmasters_single_event_header clearfix">
			<div class="cmsmasters_single_event_header_left clearfix">


				<!-- Event Date -->
				<div class="cmsmasters_event_big_date">
					<div class="cmsmasters_event_big_date_wrap">
						<div class="cmsmasters_event_big_day"><?php echo tribe_get_start_date( null, false, 'd' ); ?></div>
						<div class="cmsmasters_event_big_date_ovh">
							<div class="cmsmasters_event_big_month"><?php echo tribe_get_start_date( null, false, 'F' ); ?></div>
							<div class="cmsmasters_event_big_week"><?php echo tribe_get_start_date( null, false, 'l' ); ?></div>
						</div>
					</div>
				</div>
				<div class="cmsmasters_single_event_header_left_inner">
					<?php

					the_title( '<h2 class="tribe-events-single-event-title summary entry-title">', '</h2>' );
					echo '<div class="tribe-events-schedule updated published clearfix">' .
						tribe_events_event_schedule_details($event_id, '<div class="tribe-events-date">', '</div>');

						if( tribe_get_cost() ) {
							echo '<div class="tribe-events-cost">' . tribe_get_cost( null, true ) . '</div>';
						}
					echo '</div>';

					?>
				</div>
			</div>
			<div class="cmsmasters_single_event_header_right clearfix">
				<div class="tribe-events-back">
					<a class="cmsmasters_theme_icon_date" href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( esc_html__( 'All %s', 'charity-ngo' ), $events_label_plural ); ?></a>
				</div>

				<?php

				// -- Add Google and iCal Shortcuts --
				$cmsmasters_tribe_events_ical = new Tribe__Events__iCal();
				$cmsmasters_tribe_events_ical->single_event_links();

				?>
			</div>
		</div>
		<!-- ===== End Event Header Section ===== -->

		<?php

		/* #region Event Details Section */
		tribe_the_notices();

		if( has_post_thumbnail() || tribe_embed_google_map() ) {
			echo '<div class="cmsmasters_row_margin">';

			// -- Event Thumbnail --
			if( has_post_thumbnail() ) {
				echo '<div class="cmsmasters_single_event_img' . ( !tribe_embed_google_map() ? ' one_first' : ' one_half' ) . '">' .
					tribe_event_featured_image( $event_id, 'cmsmasters-event-thumb', false ) .
				'</div>';
			}

			// -- Event Google Map --
			if( tribe_embed_google_map() ) {
				echo '<div class="cmsmasters_single_event_map' . ( !has_post_thumbnail() ? ' one_first' : ' one_half' ) . '">';
					tribe_get_template_part( 'modules/meta/map' );
				echo '</div>';
			}

			echo '</div>';
		}

		do_action( 'tribe_events_single_event_before_the_content' );

		// -- Event Description --
		echo '<div class="tribe-events-single-event-description cmsmasters_single_event_content tribe-events-content entry-content description">';
			the_content();
		echo '</div>';

		do_action( 'tribe_events_single_event_after_the_content' );
		/* #endregion */

	echo '</div>';

	do_action( 'tribe_events_single_event_before_the_meta' );

	// -- Event Details --
	if( !apply_filters( 'tribe_events_single_event_meta_legacy_mode', false ) ) {
		tribe_get_template_part( 'modules/meta' );
	} else {
		echo tribe_events_single_event_meta();
	}

	$cmsmasters_post_type = get_post_type();
	$published_events = wp_count_posts( $cmsmasters_post_type )->publish;

	if( $published_events > 1 ) {
		echo '<aside id="tribe-events-sub-nav" class="post_nav cmsmasters_single_tribe_nav">';

			if( tribe_get_prev_event_link() ) {
				echo '<span class="tribe-events-nav-previous cmsmasters_prev_post">' .
					'<span class="post_nav_sub">' .
						esc_html__( 'Previous', 'charity-ngo' ) .
						'<span class="post_nav_type"> ' .
							esc_html__( 'Event', 'charity-ngo' ) .
						' </span>' .
						esc_html__( 'Link', 'charity-ngo' ) .
					'</span>';

					tribe_the_prev_event_link( '%title%' );

					echo  '<span class="cmsmasters_prev_arrow"><span></span></span>' .
				'</span>';
			}

			if( tribe_get_next_event_link() ) {
				echo '<span class="tribe-events-next-previous cmsmasters_next_post">' .
					'<span class="post_nav_sub">' .
					esc_html__( 'Next', 'charity-ngo' ) .
					'<span class="post_nav_type"> ' .
						esc_html__( 'Event', 'charity-ngo' ) .
					' </span>' .
					esc_html__( 'Link', 'charity-ngo' ) .
				'</span>';

				tribe_the_next_event_link( '%title%' );

					echo  '<span class="cmsmasters_next_arrow"><span></span></span>' .
				'</span>';
			}

		echo '</aside>';
	}

	do_action( 'tribe_events_single_event_after_the_meta' );

	if( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) {
		comments_template();
	}

echo '</div>';


endif;

