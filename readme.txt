=== Bhutanese Calendar ===
Contributors: sangay
Tags: Bhutanese Calendar, Bhutan Calendar  
Requires at least: 3.2  
Tested up to: 3.9  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  
Stable tag: trunk

Adds monthly Bhutanese Calendar from year 1900 to 2099.

== Description ==

This plugin lets you add monthly Bhutanese calendar from the year 1900 to 2099. Bhutanese  calendar data extracted from <a href="http://www.kalacakra.org/calendar/bhutlist.htm">Open Source Bhutanese Calendar software</a>.


<h4>Features</h4>

1. Adds monthly Bhutanese Calendar on Widget, Pate/Post or directly onto Wordpress template file
2. Calendar data available from year 1900 to 2099
3. You can navigate to any specific month
4. Shows the name of Bhutanese year and month (and of course date)

<h4>Future Development</h4>
1. Display Bhutanese calendar for a year
2. Add Bhutanese holidays
3. Conversion between Bhutanese and Western Calendar date

(All these features available on <a href="http://www.bhutanesecalendar.com" target="_blank">bhutanesecalendar.com</a>)


== Changelog ==

= 1.00 =
Initial version (Released on 6 April 2014)


== Installation ==

You can either install it automatically from the WordPress admin, or do it manually:

1. Unzip the archive and put the <strong>bhutanese-calendar</strong> folder into your plugins folder <strong>/wp-content/plugins/</strong>.
1. Activate the plugin from the Plugins menu.

= Usage =

After installing the Plugin, go to Settings page and choose colors options to match your theme. Or you can leave the default colors.

Then you can display the calendar through three different ways:

1. <em>Widget:</em> on your Wordpress Dashboard, check <strong>Appearance -> Widget</strong>. You will see a widget called <strong>Bhutanese Calendar Widget</strong>. Simply drag it to your widget area, tick the options and viola!

2. <em>Use Shortcode:</em> You can use Shortcode <strong>[bhutanese_calendar_month]</strong> to show the calendar on Posts/Pages. Optionally, pass arguments "year", "month", "navi" and "links" to the Shortcode. <br />Eg <strong>[bhutanese_calendar_month year="true" month="true" navi="true" link="true"]</strong>.

3. <em>Directly on Wordpress template:</em> You can also directly paste code <br /><strong>&lt;?php bhutanese_calendar_month (true,true,true,true);?&gt; </strong> onto any template.

== Frequently Asked Questions ==

= Where do the calendar data come from? =
The calendar data is extracted from <a href="http://www.kalacakra.org/calendar/bhutlist.htm">Open Source Bhutanese Calendar software</a>

== Screenshots ==

1. Options Setting

2. Widget Example