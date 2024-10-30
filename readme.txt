=== Christian Science Bible Lesson Subjects ===
Contributors: gserafini
Donate link: http://bit.ly/cs-bible-lesson-plugin-donation
Tags: cs, christian science, subjects, bible lesson, church, csps, widget, sidebar, plugin
Requires at least: 2.7
Requires PHP: 5.3
Tested up to: 6.5
Stable tag: 1.9.1

Provides configurable widget and shortcode for displaying upcoming weekly Christian Science Bible Lesson subjects.

== Description ==

Display upcoming Christian Science Bible Lesson topics in any widget area on your site.  Also includes shortcode and Spanish translation.  Bonus new feature: Embed CSPS Internet Radio player in your site.

= Widget Features: =

* Select number of upcoming subjects to display (default is 3 weeks)
* Select whether to display 'more info' link to [ChristianScience.com](https://biblelesson.christianscience.com "More information about Bible Lessons at ChristianScience.com")
* Configure number of days in advance of Thanksgiving Day service to display explanatory message
* Option to disable Thanksgiving Day message if desired

= Shortcodes: =

_Christian Science Bible Lesson topics shortcode_

Insert `[cs_subject_of_the_week]` into any post or page to insert the default number of upcoming subjects

Optional shortcode parameters

`[cs_subject_of_the_week weeks_to_display="3" display_more_info_link="1" thanksgiving_days_in_advance="30"]`

* weeks_to_display - configure number of weeks in advance to display
* display_more_info_link - Set to '1' to show more info link, '0' to hide (Default)
* thanksgiving_days_in_advance - Set to 0 to disable, or number of days in advance of Thanksgiving Day to show special message

_CSPS Internet Radio embed shortcode_

Insert `[csps_internet_radio]` in post or page to embed the player

Optional shortcode parameters

`[csps_internet_radio customize_player=false show_title_bar=true iframe_height="380" iframe_width="100%"]`

* customize_player - Default is false, load standard script directly from JSH site
* show_title_bar - Include the standard title bar graphic for the player? Default is true
* iframe_height - height of embedded playlist iframe - Default is 380 (px)
* iframe_width - width of embedded playlist iframe - Default is 100%



== Installation ==

1. Unzip the ZIP file and drop the folder straight into your wp-content/plugins directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

= Use as a widget =

1. Navigate to 'Appearance' -> 'Widgets'
2. Drag the 'CS Bible Lesson Topics' widget into a sidebar to display in that sidebar
3. Configure widget if you'd like to change the default settings

= Use as a shortcode =

1. Insert `[cs_subject_of_the_week]` into any post or page to insert the default number of upcoming subjects

	Optional shortcode parameters

	`[cs_subject_of_the_week weeks_to_display="3" display_more_info_link="1" thanksgiving_days_in_advance="30"]`

	* weeks_to_display - configure number of weeks in advance to display
	* display_more_info_link - Set to '1' to show more info link, '0' to hide (Default)
	* thanksgiving_days_in_advance - Set to 0 to disable, or number of days in advance of Thanksgiving Day to show special message

2. Publish and  view post or page to see output.

= Use in Templates for Theme authors =

You can use this plugin in your themes if you wish instead of using it as a widget.

Place into your theme to display list of upcoming subjects:
`&lt;?php if (function_exists('stp_getBibleLessonSubjects')) echo stp_getBibleLessonSubjects( 3, true, 30); ?&gt;`

Function parameters are ( weeks_to_display, display_more_info_link, thanksgiving_days_in_advance).  
You can also call the function without parameters and the defaults will be used.

= CSS Classes for adding custom styles =

Add the following declarations to your stylesheet if you'd like to further customize the output of this plugin:

`/* Enclosing div */
.stp_cs_bible_lesson_topics_widget { }

/* span surrounding date in outputted list */
.stp_cs_bible_lesson_topics_date { }

/* span surrounding subject in outputted list */
.stp_cs_bible_lesson_topics_subject { }

/* class on enclosing li tag for more info link */
.stp_cs_bible_lesson_topics_more_info_link { }

/* enclosing class for special Thanksgiving message */
.stp_cs_bible_lesson_topics_thanksgiving_message { }`



== Frequently Asked Questions ==

= Is this provided by the Christian Science Publishing Society? =

No, this has been coded by [ShareThePractice.org](http://sharethepractice.org/) for use by branch churches and societies.

= Is support available? =

Yes, use the contact form on the ShareThePractice.org [website](http://sharethepractice.org/contact/).

== Screenshots ==

1. Widget configuration options 
2. Output of widget in a sidebar

== Changelog ==

= 1.9.1 =
* Release date: March 11, 2024
* Update link to point to sample Bible Lesson, change to https
* Tested using WordPress 6.4.3

= 1.8 =
* Release date: November 12, 2018
* Fix PHP notice about undefined constant

= 1.7 =
* Release date: October 31, 2018
* Tested to upcoming WordPress 5.0 version
* Improve grammar / display of Thanksgiving date
* Update CSPS Internet Player playlist URL

= 1.6 =
* Release date: March 9, 2018
* Add CSPS Internet Player `[csps_internet_radio]` shortcode to plugin

= 1.5 =
* Release date: May 30, 2017
* Add Spanish language translation of Bible Lesson subjects

= 1.4 =
* Release date: December 19, 2016
* Permanent fix for correctly calculating week numbers using Sunday as start day for the week

= 1.3 =
* Release date: November 16, 2016
* Add 2016 Thanksgiving Bible Lesson link to special Thanksgiving message box.  Change styling to use div instead of ul.

= 1.2 =
* Release date: January 12, 2016
* Fix to re-synchronize weekly Bible study lesson topics for 2016
* Update "More info about Bible Lesson" link to point to new URL

= 1.1 =
* Release date: January 9, 2013
* Fix to re-synchronize weekly Bible study lesson topics for 2013
* Fix widget so it correctly shows the More Info link depending on user input in widget options
* Update "More info about Bible Lesson" link to point to new URL

= 1.0 =
* Release date: January 9, 2013
* Initial public release of plugin

== Upgrade Notice ==

= 1.7 =
* Tested to WordPress 5.0
* Fix for CSPS Internet Player playlist URL

= 1.6 =
* Add CSPS Internet Player `[csps_internet_radio]` shortcode to plugin 

= 1.5 =
* Latest version of plugin now includes Spanish language translation

= 1.4 =
* Upgrade now to get correct 2017 Bible Lesson subjects

= 1.3 =
* Upgrade now to include 2016 Thanksgiving Bible Lesson link

= 1.1 =
* Fix to synchronize weekly Bible study lesson topics for 2016 - Please upgrade!

= 1.1 =
* Fix to synchronize weekly Bible study lesson topics for 2013

= 1.0 =
Initial Release

