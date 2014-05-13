<?php
//This page is to create Plugin Admin setting page

//Add color picker script
function mw_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('js/jscolor/jscolor.js', __FILE__ ), array( 'wp-color-picker' ), false, true )		;
}
add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );

//Add admin setting page
add_action('admin_init', 'btcal_register_options');  // register options for the form
add_action('admin_menu', 'btcal_admin_links');  // register admin menu hyperlinks

//Function to register form fields
function btcal_register_options(){
    register_setting('btcal_options_group', 'btcal_settings', 'btcal_validate');
}

//Function to add link to Bhutan Calendar setting page under WP Settings
function btcal_admin_links() {
	add_options_page('Bhutanese Calendar Setup', 'Bhutanese Calendar', 'manage_options', 'btcal', 'btcal_admin_page' );  
	//add_filter( 'plugin_action_links', 'btcal_settings_link', 10, 2 );  
}

//Function to add link to Setting on WP Plugin list
//function btcal_settings_link($links, $file){
    //if ( $file == plugin_basename( dirname(__FILE__). '/bhutanesecalendar.php')){
		//$settings_link = '<a href="options-general.php?page=btcal">' .__('Settings') . '</a>';
		//array_unshift( $links, $settings_link ); // place before other links
   // }
	//return $links;
//}

// Options input validation
function btcal_validate($input) {
  return array_map('wp_filter_nohtml_kses', (array)$input);
}

//Options setting
function btcal_admin_page() { ?>
    <h2>Bhutanese Calendar Settings</h2>
    <form method="post" action="options.php">
    <?php
    settings_fields('btcal_options_group');
    $btcal_options = get_option('btcal_settings');
    ?>
    <!--<input type="checkbox" name="btcal_settings[checkbox1]" value="1" <?php //checked('1', $btcal_options['checkbox1']); ?> /><br />-->
    <!--<input type="radio" name="btcal_settings[radio1]" value="item1" <?php //checked('item1', $btcal_options['radio1']); ?> /><br />
    <input type="radio" name="btcal_settings[radio1]" value="item2" <?php //checked('item2', $btcal_options['radio1']); ?> /><br />  -->   
    
    <table style="padding:20px 40px;">
    <tr>
    <td valign="top">Year Title color</td>
    <td valign="top">
    <input type="text" id="btcal_year_title" name="btcal_settings[btcal_year_title]" value="<?php echo $btcal_options['btcal_year_title']; ?>" data-default-color="#fc7708" /></td>
    </tr>
    <tr>
    <td valign="top">Month Title color</td>
    <td valign="top">
    <input type="text" id="btcal_month_title" name="btcal_settings[btcal_month_title]" value="<?php echo $btcal_options['btcal_month_title']; ?>" data-default-color="#666666" /></td>
    </tr>
    
    <tr>
    <td style="padding-top:10px; border-top:1px solid #eee;">Day Cell background color</td>
    <td style="padding-top:10px; border-top:1px solid #eee;">
    <input type="text" id="btcal_daycell_bg" name="btcal_settings[btcal_daycell_bg]" value="<?php echo $btcal_options['btcal_daycell_bg']; ?>" data-default-color="#fd9945" /></td>
    </tr>
    <tr>
    <td valign="top">Day Cell text color</td>
    <td valign="top">
    <input type="text" id="btcal_daycell_txt" name="btcal_settings[btcal_daycell_txt]" value="<?php echo $btcal_options['btcal_daycell_txt']; ?>" data-default-color="#222222" /></td>
    </tr>
    <tr>
    <td style="padding-top:10px; border-top:1px solid #eee;">Date Cell background color</td>
    <td style="padding-top:10px; border-top:1px solid #eee;">
    <input type="text" id="btcal_datecell_bg" name="btcal_settings[btcal_datecell_bg]" value="<?php echo $btcal_options['btcal_datecell_bg']; ?>" data-default-color="#ffe1c8" /></td>
    </tr>
    <tr>
    <td valign="top">Date Cell text color</td>
    <td valign="top">
    <input type="text" id="btcal_datecell_txt" name="btcal_settings[btcal_datecell_txt]" value="<?php echo $btcal_options['btcal_datecell_txt']; ?>" data-default-color="#222222" /></td>
    </tr>
    <tr>
    <td style="padding-top:10px; border-top:1px solid #eee;">Today Cell background color</td>
    <td style="padding-top:10px; border-top:1px solid #eee;">
    <input type="text" id="btcal_todaycell_bg" name="btcal_settings[btcal_todaycell_bg]" value="<?php echo $btcal_options['btcal_todaycell_bg']; ?>" data-default-color="#fc7708" /></td>
    </tr>
    <tr>
    <td valign="top">Today Cell text color</td>
    <td valign="top">
    <input type="text" id="btcal_todaycell_txt" name="btcal_settings[btcal_todaycell_txt]" value="<?php echo $btcal_options['btcal_todaycell_txt']; ?>" data-default-color="#ffffff" /></td>
    </tr>
   </table>
    <?php submit_button(); ?>
    </form>
    
    <h3>Shortcode</h3>
    
Use Shortcode <strong>[bhutanese_calendar_month]</strong> to show the calendar on Posts/Pages. <br /><br />Optionally, pass arguments "year", "month", "navi" and "links" <br /> eg. <strong>[bhutanese_calendar_month year="true" month="true" navi="true" link="true"]</strong>.<br /><br />

If you are familiar with Wordpress template files, you can also directly use the function call <br /><strong>&lt;?php bhutanese_calendar_month (true,true,true,true);?&gt;</strong> onto any template file.

<?php } ?>