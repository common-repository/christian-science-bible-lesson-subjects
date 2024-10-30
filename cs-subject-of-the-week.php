<?php
/*
Plugin Name: Christian Science Bible Lesson Subjects
Plugin URI: http://sharethepractice.org/plugins/christian-science-bible-lesson-subjects/
Description: Display upcoming Christian Science Bible Lesson subjects in a widget or using shortcode [cs_subject_of_the_week].  Bonus: Add the new CSPS Internet Radio player using shortcode [csps_internet_radio]
Donate URI: http://bit.ly/cs-bible-lesson-plugin-donation
Author: Gabriel Serafini (ShareThePractice.org)
Author URI: http://sharethepractice.org/
Version: 1.9.1
Text-Domain: christian-science-bible-lesson-subjects
Domain Path: /languages/

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/ 


/**
 * Return Bible Lesson subject for a given week number
 *
 * Note that in some years this may need to be adjusted when there is an extra
 * week in the year that may be filled with an arbitrary other lesson subject
 * 
 * @param string $date_to_use Optional. Uses any valid strtotime value
 * @return string Subject for a given week of the year
 */
function stp_getSubject($date_to_use='now') {

	// Array of Christian Science Bible Lesson subjects 
	$cs_lesson_subjects = array(
		__('God', 'christian-science-bible-lesson-subjects'),
		__('Sacrament', 'christian-science-bible-lesson-subjects'),
		__('Life', 'christian-science-bible-lesson-subjects'),
		__('Truth', 'christian-science-bible-lesson-subjects'),
		__('Love', 'christian-science-bible-lesson-subjects'),
		__('Spirit', 'christian-science-bible-lesson-subjects'),
		__('Soul', 'christian-science-bible-lesson-subjects'),
		__('Mind', 'christian-science-bible-lesson-subjects'),
		__('Christ Jesus', 'christian-science-bible-lesson-subjects'),
		__('Man', 'christian-science-bible-lesson-subjects'),
		__('Substance', 'christian-science-bible-lesson-subjects'),
		__('Matter', 'christian-science-bible-lesson-subjects'),
		__('Reality', 'christian-science-bible-lesson-subjects'),
		__('Unreality', 'christian-science-bible-lesson-subjects'),
		__('Are Sin, Disease, and Death Real?', 'christian-science-bible-lesson-subjects'),
		__('Doctrine of Atonement', 'christian-science-bible-lesson-subjects'),
		__('Probation After Death', 'christian-science-bible-lesson-subjects'),
		__('Everlasting Punishment', 'christian-science-bible-lesson-subjects'),
		__('Adam and Fallen Man', 'christian-science-bible-lesson-subjects'),
		__('Mortals and Immortals', 'christian-science-bible-lesson-subjects'),
		__('Soul and Body', 'christian-science-bible-lesson-subjects'),
		__('Ancient and Modern Necromancy, <i>alias</i> Mesmerism and Hypnotism, Denounced', 'christian-science-bible-lesson-subjects'),
		__('God the Only Cause and Creator', 'christian-science-bible-lesson-subjects'),
		__('God the Preserver of Man', 'christian-science-bible-lesson-subjects'),
		__('Is the Universe, Including Man, Evolved by Atomic Force?', 'christian-science-bible-lesson-subjects'),
		__('Christian Science', 'christian-science-bible-lesson-subjects')
		);
	
	// repeat the array since lesson subjects are repeated twice a year in the same order
	$cs_lesson_subjects = array_merge($cs_lesson_subjects, $cs_lesson_subjects);

	// Bonus lesson for years with 53 Sundays
	$cs_lesson_subjects[] = __('Christ Jesus', 'christian-science-bible-lesson-subjects');
	
	// Add a blank entry to the front of the array so we're matching week 1 = [1]
	array_unshift($cs_lesson_subjects, "");

	// Get the lesson for the upcoming next Sunday for any given date
    // Use strftime('%U, ...) not date("W", ...) in order to get weeks of the year using Sunday as starting day, not Monday
	$week_num_sun = (int) strftime('%U', strtotime('next Sunday ' . $date_to_use));

	return $cs_lesson_subjects[$week_num_sun];

}


/**
 * Display message about next Thanksgiving Day service
 *
 * @param int $thanksgiving_days_in_advance Optional. Number of days in advance to display message
 * @return mixed - String if date is within next $days_in_advance, false if not
 */
function stp_getThanksgivingMessage( $thanksgiving_days_in_advance = 30 ) {

	// Allow widget to disable display of Thanksgiving message
	if ($thanksgiving_days_in_advance == 0) return false;

	$thanksgiving_message = false;

	// Seconds from Jan. 1st, 1970 to Thanksgiving of current year
	$secstoThksgvg = strtotime("3 weeks thursday", mktime(0, 0, 0, 11, 1, date("Y")));

	// Seconds from Jan. 1st, 1970 to current day
	$secstoNow = strtotime("now");

	// Seconds until Thanksgiving from now
	$secstoThksgvg = $secstoThksgvg - $secstoNow;
	
	// Seconds before Thanksgiving when user wants alert to activate
	$secsbforThksgvg = $thanksgiving_days_in_advance * 86400;

	// If days until Thanksgiving falls within range given by user, display notice
	if ($secsbforThksgvg > $secstoThksgvg && $secstoThksgvg >= 0) {

		$thanksgiving_date = date("d", strtotime("3 weeks thursday", mktime(0, 0, 0, 11, 1, Date("Y")))). ", " . Date("Y");

		$thanksgiving_message  = '';
		$thanksgiving_message .= __('<strong>Join us for a special Thanksgiving Service!</strong><br />', 'christian-science-bible-lesson-subjects');
		$thanksgiving_message .= __('Christian Science Churches in the United States will be holding a service on Thanksgiving Day, November&nbsp;', 'christian-science-bible-lesson-subjects') .  $thanksgiving_date . '.';


	}

	return $thanksgiving_message;

}

/**
 * Return HTML formatted list of Bible Lesson topics
 *
 * @param int $weeks_to_display Optional. Number of weeks to display
 * @param bool $display_more_info_link Optional. Display more info link or not
 * @param int $thanksgiving_days_in_advance Optional. Number of days in advance to display message
 * @return string
 */
function stp_getBibleLessonSubjects( $weeks_to_display = 3, $display_more_info_link = '0', $thanksgiving_days_in_advance = 30 ) {

	$output  = "";
	$output .= '<div class="stp_cs_bible_lesson_topics_widget">';
	$output .= '<ul>';
	for ($n=0; $weeks_to_display > $n; $n++) {

		$output .= '<li>';
		$date_to_use = 'now + ' . $n . ' week';
		$output .= '<span class="stp_cs_bible_lesson_topics_date">' . date_i18n(__('n/j/Y', 'christian-science-bible-lesson-subjects'), strtotime('next Sunday', strtotime($date_to_use))) . '</span> - <span class="stp_cs_bible_lesson_topics_subject">' . stp_getSubject($date_to_use) . '</span>';
		$output .= '</li>';

	}

	if ('1' == $display_more_info_link) {
		$output .= __('<li class="stp_cs_bible_lesson_topics_more_info_link"><a href="https://biblelesson.christianscience.com/" target="_blank">More info about the Bible Lesson &raquo;</a></li>', 'christian-science-bible-lesson-subjects');
	}

	$output .= '</ul>';
	
	$thanksgiving_message = stp_getThanksgivingMessage($thanksgiving_days_in_advance);

	if ($thanksgiving_message) {

		$output .= '<div class="stp_cs_bible_lesson_topics_thanksgiving_message" style="padding: 8px; border: 1px solid #999; border-radius: 4px;">';			
		$output .= '' . $thanksgiving_message . '';
		$output .= '</div>';
	}

	$output .= '</div>';
	
	return $output;

}

/**
 * Shortcode functionality
 *
 * @param mixed $atts Optional. Attributes to use in shortcode
 * @return HTML for list
 */
function stp_cs_subject_of_the_week_shortcode($atts) {

	extract(shortcode_atts(array(
		'weeks_to_display' => '3',
		'display_more_info_link' => 'false',
		'thanksgiving_days_in_advance' => '30',
	), $atts));

	return stp_getBibleLessonSubjects($weeks_to_display, $display_more_info_link, $thanksgiving_days_in_advance);
}

// Register shortcode
add_shortcode('cs_subject_of_the_week', 'stp_cs_subject_of_the_week_shortcode');

/**
 * Shortcode functionality for Internet Radio player, includes ability to customize output
 * https://jsh.christianscience.com/csps-internet-radio/csps-internet-radio-embed-instructions
 *
 * Supplies this script:
 * <script src="https://jsh.christianscience.com/mediafile/file/includes/csps-radio.js" type="text/javascript"></script>
 *
 * @param mixed $atts Optional. Attributes to use in shortcode
 * @return HTML embedded playlists
 */
function stp_csps_internet_radio($atts) {

	extract(shortcode_atts(array(
	    'show_title_bar' => true,
	    'iframe_height' => '380',
	    'iframe_width' => '100%',
	), $atts));

    $output  = '<div class="csps-internet-radio-container">';

    $output .= '<!-- Configurable version of script found here: https://jsh.christianscience.com/mediafile/file/includes/csps-radio.js -->' . "\n\n";
    $output .= "<!-- https://jsh.christianscience.com/csps-internet-radio/csps-internet-radio-embed-instructions -->";

    if ($show_title_bar) {
        $output .= '<a href="https://jsh.christianscience.com" target="_blank"><img src="https://jsh.christianscience.com/mediafile/file/images/csps-radio/csps-internet-radio-banner.png" style="width:100%; border:none;"></a>';
    }

    $output .= '<iframe width="' . $iframe_width . '" height="' . $iframe_height . '" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/337881838%3Fsecret_token%3Ds-IMWuW&color=ff5500&auto_play=false&hide_related=false&show_comments=false&show_user=false&show_reposts=false"></iframe>';    

    $output .= '</div>';

	return $output;
}

// Register shortcode
add_shortcode('csps_internet_radio', 'stp_csps_internet_radio');

/**
 * Add plugin page links
 */
function set_plugin_meta($links, $file) {
 
	$plugin = plugin_basename(__FILE__);
 	$donate_url = 'http://bit.ly/cs-bible-lesson-plugin-donation';
 
	// create link
	if ($file == $plugin) {
		return array_merge(
			$links,
			array( sprintf( '<a href="%s" title="Thank you for supporting Open Source development and maintenance of this plugin!" target="_blank"><strong>%s :)</strong></a>', $donate_url, __('Donate', 'christian-science-bible-lesson-subjects') ) )
		);
	}
 
	return $links;
}

// Activate additional plugin links
add_filter( 'plugin_row_meta', 'set_plugin_meta', 10, 2 );


/**
 * Define our widget
 */
class STP_CS_Bible_Lesson_Topics extends WP_Widget {

	/**
	 * Set up widget options
	 */
	function STP_CS_Bible_Lesson_Topics() {
		$widget_ops = array('classname' => 'widget_text', 'description' => __('Show upcoming Bible Lesson topics', 'christian-science-bible-lesson-subjects'));
		$control_ops = array('width' => 200, 'height' => 90);
		$this->WP_Widget('widget-stpcslessonsubject', __('CS Bible Lesson Topics', 'christian-science-bible-lesson-subjects'), $widget_ops, $control_ops);
	}

	/**
	 * Output contents of widget into a sidebar
	 *
	 * @param mixed $args Standard input
	 * @param object $instance Specific instance of this widget
	 * @return string Outputs HTML for sidebar widget
	 */
	function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters( 'widget_title', empty($instance['title']) ? __('Upcoming Bible Lessons', 'christian-science-bible-lesson-subjects') : $instance['title'], $instance );
		$weeks_to_display = apply_filters( 'widget_text', empty($instance['weeks_to_display']) ? __('3', 'christian-science-bible-lesson-subjects') : $instance['weeks_to_display'], $instance );
		$thanksgiving_days_in_advance = apply_filters( 'widget_text', empty($instance['thanksgiving_days_in_advance']) ? __('30', 'christian-science-bible-lesson-subjects') : $instance['thanksgiving_days_in_advance'], $instance );
		$display_more_info_link = apply_filters( 'widget_text', $instance['display_more_info_link'], $instance );
		// Output widget as long as we have at least 1 week's topic to display
		if ($weeks_to_display > 0) {

			echo $before_widget;
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
			echo stp_getBibleLessonSubjects($weeks_to_display, $display_more_info_link, $thanksgiving_days_in_advance);
			echo $after_widget;
		}

	}

	/**
	 * Update widget options
	 *
	 * @param object $new_instance
	 * @param object $old_instance
	 * @return object $instance object
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['weeks_to_display'] = strip_tags($new_instance['weeks_to_display']);
		$instance['thanksgiving_days_in_advance'] = strip_tags($new_instance['thanksgiving_days_in_advance']);
		$instance['display_more_info_link'] = isset($new_instance['display_more_info_link']);

		return $instance;
	}

	/**
	 * Output widget option form in backend Widgets admin
	 *
	 * @param object $instance
	 * @return string Outputs widget options HTML
	 */
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );

		$title = apply_filters( 'widget_title', empty($instance['title']) ? __('Upcoming Bible Lessons', 'christian-science-bible-lesson-subjects') : $instance['title'], $instance );
		$weeks_to_display = apply_filters( 'widget_text', empty($instance['weeks_to_display']) ? __('3', 'christian-science-bible-lesson-subjects') : $instance['weeks_to_display'], $instance );
		$thanksgiving_days_in_advance = apply_filters( 'widget_text', empty($instance['thanksgiving_days_in_advance']) ? __('30', 'christian-science-bible-lesson-subjects') : $instance['thanksgiving_days_in_advance'], $instance );
		$display_more_info_link = apply_filters( 'widget_text', empty($instance['display_more_info_link']) ? 1 : $instance['display_more_info_link'], $instance );

?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'christian-science-bible-lesson-subjects'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('weeks_to_display'); ?>"><?php _e('Number of upcoming Bible lesson topics to display:', 'christian-science-bible-lesson-subjects'); ?></label>
		<input style="width: 60px;" id="<?php echo $this->get_field_id('weeks_to_display'); ?>" name="<?php echo $this->get_field_name('weeks_to_display'); ?>" type="text" value="<?php echo esc_attr($weeks_to_display); ?>" /></p>

		<p><input id="<?php echo $this->get_field_id('display_more_info_link'); ?>" name="<?php echo $this->get_field_name('display_more_info_link'); ?>" type="checkbox" <?php checked(isset($instance['display_more_info_link']) ? $instance['display_more_info_link'] : 1); ?> />&nbsp;<label for="<?php echo $this->get_field_id('display_more_info_link'); ?>"><?php _e('Display more info link', 'christian-science-bible-lesson-subjects'); ?></label><br />
		<?php _e('<a href="https://biblelesson.christianscience.com/sample" target="_blank">View a sample Bible Lesson</a></p>', 'christian-science-bible-lesson-subjects'); ?>

		<p style="border-top: 1px solid #eee; margin: 10px 0 8px 0; padding: 6px 0 0 0;"><strong><?php _e('Special Thanksgiving day message:', 'christian-science-bible-lesson-subjects'); ?></strong></p>		
		<p><?php echo stp_getThanksgivingMessage(365); ?></p>

		<p><label for="<?php echo $this->get_field_id('thanksgiving_days_in_advance'); ?>"><?php _e('Days in advance to display message:<br /> (Default = 30, 0 to disable)', 'christian-science-bible-lesson-subjects'); ?></label>
		<input style="width: 60px;" id="<?php echo $this->get_field_id('thanksgiving_days_in_advance'); ?>" name="<?php echo $this->get_field_name('thanksgiving_days_in_advance'); ?>" type="text" value="<?php echo esc_attr($thanksgiving_days_in_advance); ?>" /></p>

<?php
	}
}

/**
 * Loads textdomain for plugin.
 */
function cs_bible_lesson_load_plugin_textdomain() {
    load_plugin_textdomain( 'christian-science-bible-lesson-subjects', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

// Actions
add_action( 'plugins_loaded', 'cs_bible_lesson_load_plugin_textdomain' );

// Register widget so it displays on Widgets page
add_action( 'widgets_init', function() {return register_widget("STP_CS_Bible_Lesson_Topics");} );

?>