<?php
/*
Plugin Name: Bhutanese Calendar
Plugin URI: http://bhutanesecalendar.com
Description: Adds monthly Bhutanese Calendar from years 1900 to 2099.
Version: 1.0
Author: Sangay Tenzin
Author URI: http://sangaytenzin.com
License: GPL2
*/

//Plugin Activate hook
register_activation_hook( __FILE__, 'install_btcal_table' );
register_activation_hook( __FILE__, 'install_btcal_data' );

//Plugin Deactivate hook
register_deactivation_hook( __FILE__, 'uninstall_btcal_data' );

//Create database table
function install_btcal_table() {
	global $wpdb;
	$thetable= $wpdb->prefix."bhutanese_calendar";
	
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $thetable) {
			$sql = "DROP table $thetable;CREATE TABLE $thetable (
		  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
		  `dayname` varchar(3) DEFAULT NULL,
		  `bdate` int(2) DEFAULT NULL,
		  `bmonth` int(2) DEFAULT NULL,
		  `intercalary` int(2) DEFAULT NULL,
		  `byear` varchar(50) DEFAULT NULL,
		  `wdate` int(2) DEFAULT NULL,
		  `wmonth` int(2) DEFAULT NULL,
		  `wyear` int(4) DEFAULT NULL,
		  PRIMARY KEY (`entry_id`)
		)";	
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql);
	}
}

//Insert table data. The table data is stored in a separate datafile called data/data.txt
function install_btcal_data() {
	global $wpdb;
	$thetable= $wpdb->prefix."bhutanese_calendar";
	$insert="INSERT INTO $thetable (entry_id, dayname, bdate, bmonth, intercalary, byear, wdate, wmonth, wyear) 
	VALUES ".file_get_contents('data/data.txt', true);
	//reference to upgrade.php file
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $insert);
}

//Remove database table when the plugin is uninstalled
function uninstall_btcal_data() {
	global $wpdb;
	$table = $wpdb->prefix."bhutanese_calendar";
	//Delete any options thats stored also?
	//delete_option('wp_yourplugin_version');
	$wpdb->query("DROP TABLE IF EXISTS $table");
}

//Add stylesheet to the plugin
function add_bhutanese_calendar_css() {
	wp_enqueue_style( 'prefix-style', plugins_url('css/bhutanesecal.css', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'add_bhutanese_calendar_css' );

//Widget setting
include_once dirname( __FILE__ ) . '/widget/widget.php';

//Shortcode setting
include_once dirname( __FILE__ ) . '/shortcode/shortcode.php';

//Admin setting
include_once dirname( __FILE__ ) . '/admin/admin.php';

//The main plugin hook
function bhutanese_calendar_month($y,$m,$n,$l) {
	global $wpdb;
	$table = $wpdb->prefix."bhutanese_calendar";
	
	//Input values
	$month_input = $_POST["month_input"];
    $year_input  = $_POST["year_input"];
	
	//echo "Month:".$form->getValue('month');
	//http://localhost/wordpress/?month=2&year=1901
	//If month and year is not selected, take the currect month and year values
	if (!isset($month_input)) $month_input = date("m");
	if (!isset($year_input))  $year_input  = date("Y");
	
	//For prev and next month
	$prev_month_year = $year_input;
    $next_month_year = $year_input;
 	$prev_month = $month_input-1;
 	$next_month = $month_input+1;
 	if ($prev_month == 0 ) {
    	$prev_month = 12;
    	$prev_month_year = $year_input - 1;
    }
	 
	if ($next_month == 13 ) {
		$next_month = 1;
		$next_month_year = $year_input + 1;
    }
	
	//For prev and next year
	$prev_year=$year_input-1;
	$next_year=$year_input+1;
	
	//The input values are Western Calendar date
	$wyear=$year_input;
	$wmonth = $month_input;
	$wdate = date('d'); 
	
	//Get full month name
	$wmonth_full=date ("F", mktime(0,0,0,$month_input,1));
	
	//Find the first Day of the month 
	$query_firstday="SELECT dayname FROM  $table WHERE wmonth = '$wmonth' AND  wyear ='$wyear' AND wdate=1";
	$result_firstday = mysql_query($query_firstday);
	$row_firstday = mysql_fetch_array($result_firstday);
	$first_day_of_week = $row_firstday['dayname'] ; 
	
	//Once we know the first day of the month, we calculate "blank" spaces.
	 //If the first day of the week is a Sunday then number of blanks is 0.
	 //If Bhutanese day is Monday, it is actually Tuesday ...
	 //The calendar programmer thinks Bhutanese/Tibetan equivalent of Za Nyima is Sunday and so on
	 
	 switch($first_day_of_week) { 
		 case "Sun": $blank = 6; break; 
		 case "Mon": $blank = 0; break; 
		 case "Tue": $blank = 1; break; 
		 case "Wed": $blank = 2; break; 
		 case "Thu": $blank = 3; break; 
		 case "Fri": $blank = 4; break; 
		 case "Sat": $blank = 5; break; 
	 }
	 
	//Get the first date of Bhutanese calendar
	$result_btfirst=mysql_query ("SELECT bdate, bmonth, byear, intercalary FROM  $table WHERE  wyear =  '$wyear' AND  wmonth ='$wmonth'  ORDER BY  wdate ASC LIMIT 1");
	$row_btfirst = mysql_fetch_array($result_btfirst);
	$bt_date = $row_btfirst['bdate'];
	$bt_month = $row_btfirst['bmonth'];
	$bt_year = $row_btfirst['byear'] ; 
	$intercalary1 = $row_btfirst['intercalary'];
	
	//Get the second date of Bhutanese calendar
	$result_btsecond=mysql_query ("SELECT bdate, bmonth , byear, intercalary FROM  $table WHERE  wyear =  '$wyear' AND  wmonth ='$wmonth'  ORDER BY  wdate DESC LIMIT 1");
	$row_btsecond = mysql_fetch_array($result_btsecond);
	$bt_seconddate = $row_btsecond['bdate'];
	$bt_secondmonth = $row_btsecond['bmonth'];
	$bt_secondyear = $row_btsecond['byear'] ;
	$intercalary2 = $row_btsecond['intercalary']; 
	
	include ("includes/dzongkha_month.php");
	include ("includes/dzongkha_year.php");
	
	?>
    <div class="btcal">
		<?php
        $btcal_options = get_option('btcal_settings');
        ?>
        <style type="text/css">
			.year_heading {
				color: <?php echo $btcal_options['btcal_year_title']; ?> !important;
			}
			.month_heading {
				color: <?php echo $btcal_options['btcal_month_title']; ?> !important;
			}
			.cell_day {
				color: <?php echo $btcal_options['btcal_daycell_txt']; ?> !important;
				background: <?php echo $btcal_options['btcal_daycell_bg']; ?> !important;
			}
			.cell_date {
				color: <?php echo $btcal_options['btcal_datecell_txt']; ?> !important;
				background: <?php echo $btcal_options['btcal_datecell_bg']; ?> !important;
			}
			.today {
				color: <?php echo $btcal_options['btcal_todaycell_txt']; ?> !important;
				background: <?php echo $btcal_options['btcal_todaycell_bg']; ?> !important;
        }
        </style>
        <?php if ($y=="true") { 
        ?>
        <div class="year_heading">
        <?php
            if ($bt_year!=$bt_secondyear) {
                ?>
                <span class="dzongkha">
                    གནམ་ལོ་ 
                    <?php echo $bt_year_tr."ལོ  - ".$bt_secondyear_tr;?>ལོ།
                </span>
                <h2><?php echo ucwords(strtolower(str_replace("-", " ", $bt_year)))." - ".ucwords(strtolower(str_replace("-", " ", $bt_secondyear)));?><em>year</em></h2>
            <?php } 
            else { ?>
                <span class="dzongkha">
                གནམ་ལོ་ <?php
                    echo $bt_year_tr;?>ལོ།
                </span>
                <h2><?php echo ucwords(strtolower(str_replace("-", " ", $bt_year)));?> Year <em><?php echo $wyear;?></em></h2>
             <?php } 
        ?></div>
        <?php } ?>
        <?php if ($m=="true") { ?>
        <div class="month_heading">
            <span class="dzongkha">
                འབྲུག་ཟླ་ <?php 
                if ($bt_month!=$bt_secondmonth) { echo $bt_month_tr." - ".$bt_secondmonth_tr."།"; }
                else if ($intercalary1 !=$intercalary2) { echo $bt_month_tr."(1) - ".$bt_month_tr."(2)"; }
                else  {echo  $bt_month_tr;}
            ?>
            </span>
            <h2><?php echo $wmonth_full." ".$wyear;?></h2>
            
        </div>   
        <?php } ?>
        <?php if($n=="true") { ?>
        <div class="month_year_form">
            <form name='' method='POST'>
                <select class="input_select input_select_month" name="month_input">
                <option>- m -</option>
                <option value="1" <?php if($month_input==1) echo "selected";?>>Jan</option>
                <option value="2" <?php if($month_input==2) echo "selected";?>>Feb</option>
                <option value="3" <?php if($month_input==3) echo "selected";?>>Mar</option>
                <option value="4" <?php if($month_input==4) echo "selected";?>>Apr</option>
                <option value="5" <?php if($month_input==5) echo "selected";?>>May</option>
                <option value="6" <?php if($month_input==6) echo "selected";?>>Jun</option>
                <option value="7" <?php if($month_input==7) echo "selected";?>>Jul</option>
                <option value="8" <?php if($month_input==8) echo "selected";?>>Aug</option>
                <option value="9" <?php if($month_input==9) echo "selected";?>>Sep</option>
                <option value="10" <?php if($month_input==10) echo "selected";?>>Oct</option>
                <option value="11" <?php if($month_input==11) echo "selected";?>>Nov</option>
                <option value="12" <?php if($month_input==12) echo "selected";?>>Dec</option>
                </select>
                <?php 
                $query_year = mysql_query("SELECT distinct wyear FROM  $table");
                $row_year = mysql_fetch_array($query_year) ;
                echo "<select class='input_select input_select_year' name='year_input'>
                    <option>- y -</option>";
                    do {
                        ?><option value='<?php echo $row_year['0'];?>' <?php if($year_input==$row_year['0']) echo "selected";?>><?php echo $row_year['0'];?></option>
                    <?php 
                    }
                    while ($row_year = mysql_fetch_array($query_year) );
                echo "</select>";
                ?>
                <input type="submit" class="submit_btn" value="Go" />
             </form>
             </div>
             <?php } ?>
             
             <div class="calendar">
                <div class="cell cell_day cell_col_1">
                    <span class="dzongkha">ཟླ་བ</span>
                    <span class="day_eng">Sun</span>
                </div>
                <div class="cell cell_day">
                    <span class="dzongkha">མིག་དམར</span>
                    <span class="day_eng">Mon</span>
                </div>
                <div class="cell cell_day">
                    <span class="dzongkha">ལྷག་པ</span>
                    <span class="day_eng">Tue</span>
                </div>
                <div class="cell cell_day">
                    <span class="dzongkha">ཕུར་བུ</span>
                    <span class="day_eng">Wed</span>
                </div>
                <div class="cell cell_day">
                    <span class="dzongkha">པ་སངས</span>
                    <span class="day_eng">Thu</span>
                </div>
                <div class="cell cell_day">
                    <span class="dzongkha">སྤེན་པ</span>
                    <span class="day_eng">Fri</span>
                </div>
                <div class="cell cell_day cell_col_7">
                    <span class="dzongkha">ཉི་མ</span>
                    <span class="day_eng">Sat</span> 
                </div>
                
                <?
                $column_count = 1; 
                while ( $blank > 0 )  {  ?>
                    <div class="cell cell_blank <?php echo "cell_col_".$column_count;?>">&nbsp;
                    </div>
                    <?php 
                     $blank = $blank-1; 
                     $column_count++;
                } 
                
                $today_day= date("d");
                $today_month= date ("m");
                
                //Select the dates of the month
                $result_dates = mysql_query("SELECT bdate, bmonth, wdate, wmonth, wyear FROM $table WHERE  wmonth = '$wmonth' AND wyear = '$wyear'");
                
                while ($row_dates = mysql_fetch_array($result_dates) ) {
                    
                    $bt_date=$row_dates['bdate'];
                    
                    //Select occasion of the date
                  // $result_occasion = mysql_query("SELECT occasion FROM btoccasion WHERE (odate=".$row_dates['bdate']." AND omonth=".$row_dates['bmonth']." AND calendar='bt') OR (odate=".$row_dates['wdate']." AND omonth=".$row_dates['wmonth']." AND calendar='wn') order by entry_id");
                    
                    //Check if there are occasion(s) on the day
                    //$count_occ = mysql_num_rows($result_occasion);
                    include ('includes/dzongkha_dates.php');
                    ?>
                    <div class="cell_date cell<?php if($count_occ!=0) echo " cell_occasion tooltip";?><?php echo " cell_col_".$column_count;?><?php if ($row_dates['wdate'] ==$today_day && $row_dates['wmonth']==$today_month) echo " today";?>">
                    
                        <?php if($count_occ!=0) { ?><p><?php
                            
                            while ($row_occasion = mysql_fetch_array($result_occasion) ) {
                                echo $row_occasion['occasion']."<br />";
                                
                            } 
                            ?></p><?php
                        } ?>
                        
                        <span class="dzongkha date_dz"><?php echo $bt_date_tr;?></span>
                        <span class="date_eng"><?php echo $row_dates['wdate'];?></span>
                    </div>
                    <?php $column_count++;
                    if ($column_count > 7)
                    {
                        ?>
                        <?php 
                        $column_count = 1;
                    }
                }
                while ( $column_count >1 && $column_count <=7 ) 
                { ?>
                    <div class="cell cell_blank <?php echo " cell_col_".$column_count;?>">
                    </div>
                    <?php  
                     $column_count++; 
                     } 
                ?>
                </div>
                <?php if($l=="true") { ?>
                <p class="btcal_poweredby">Powered by <a href="http://www.bhutanesecalendar.com" target="_blank">Bhutanese Calendar</a></p>
          <?php } ?>
     </div>    
    <?php
}