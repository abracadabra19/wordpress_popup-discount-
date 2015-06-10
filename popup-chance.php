<?php

/*
 Plugin Name: Popup chance  
 Description: The plugin allows users to get a discount on the journey after add the popup contact forms easily on the website. That popup contact form let user to send the emails to site admin.
 Author: .
 Version: 0.1 beta
 Plugin URI: https://
 Author URI: http://
 Donate link: 
 License: GPLv2 or later
 License URI:  http://www.opensource.org/licenses/mit-license.php
*/
 
function PopupChance()
{
        $display = "dontshow";
        if(is_home() && get_option('PopupChance_On_Homepage') == 'YES') {      $display = "show";      }
        if(is_single() && get_option('PopupChance_On_Posts') == 'YES') {       $display = "show";      }
        if(is_page() && get_option('PopupChance_On_Pages') == 'YES') {		$display = "show";      }

}
function PopupChance_install()
{
}
function PopupChance_widget($args)
{
        $display = "dontshow";
        if(is_home() && get_option('PopupChance_On_Homepage') == 'YES') {      $display = "show";      }
        if(is_single() && get_option('PopupChance_On_Posts') == 'YES') {       $display = "show";      }
        if(is_page() && get_option('PopupChance_On_Pages') == 'YES') {		$display = "show";      }

        $title = get_option('PopupChance_title');
        if($display == "show")
        {
             	extract($args);
		echo $before_widget;
                PopupChance();
                echo $after_widget;
        }
}

function PopupChance_control()
{
        echo '<p>';
        _e('Check official website for more information', 'popup-chance');
?> <a target="_blank" href="http://"><?php _e('click here', 'popup-chance'); ?></a></p><?php
}

function PopupChance_widget_init(){
	if(function_exists('wp_register_sidebar_widget')){
	wp_register_sidebar_widget( __('Popup chance', 'popup-chance'), __('Popup chance', 'popup-chance'), 'PopupChance_widget');
	}	

	if(function_exists('wp_register_widget_control')){
	wp_register_widget_control( __('Popup chance', 'popup-chance'), array(__('Popup chance', 'popup-chance'), 'widgets'), 'PopupChance_control');
	}
}

function PopupChance_deactivation(){
	// No action required.
}

function PopupChance_admin(){
	global $wpdb;
	include('content-setting.php');
}

function PopupChance_add_to_menu(){
	add_options_page( __('Popup chance', 'popup-chance'), __('Popup chance', 'popup-chance'), 'manage_options', __FILE__, 'PopupChance_admin' );

}

if (is_admin()){
add_action('admin_menu', 'PopupChance_add_to_menu');
        }

function PopupChance_add_javascript_files(){
	
	//Define right way to chance.js 
	wp_enqueue_script( 'popup-chance', get_template_directory_uri().'/inc/js/chance.js',array('jquery'), '1.0.0', true );
	wp_localize_script('popup-chance', 'pw_script_vars', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ), 
		'popupnonce' => wp_create_nonce( 'popup-nonce' )
		));
}

function PopupChance_shortcode($atts){
	
	
	$html ='<a data-toggle="modal" data-target="#getchance" id="chanceimg">
	  </a>

<div class="modal fade" id="getchance" tabindex="-1" role="dialog" aria-labelledby="getchanceLabel" aria-hidden="true">
   <div class="modal-dialog">
        <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="getchanceLabel">Получите мгновенную скидку на тур от 1 до 10%</h4>
                        </div>
<div class="modal-body">
        <form role="form" id="personal-form">

                <div id="fname" class="form-group">
                        <label for="inputname">Имя</label>
                        <input type="name" name="inputname" class="form-control" id="inputname" placeholder="Cвирид Петрович Голохвастов">
                </div>
                <div id="femail" class="form-group">
                        <label for="inputemail">Адрес электронной почты</label>
                        <input type="email" name="inputemail" class="form-control" id="inputemail" placeholder="моя@почта.com">
                </div>

                <div class="checkbox">
                        <label>
                        <input type="checkbox" name="subscribe"> Подписаться на рассылку горящих туров
                        </label>
                </div>
                <div class="form-group">
                        <div class="row">
                                <div class="col-sm-4">
                                <button type="submit" id="submit-btn" class="btn btn-default" data-complete-text="finished!" data-loading-text="Loading...">Получить скидку</button>
                                </div>
                                <div class="col-sm-8">
                                        <p id="show-answer" class="bg-success " align="center" ><?php $nextWeek = time() + (7 * 24 * 60 * 60);

                                </div>
                        </div>
                </div>
        </form>
                <input type="hidden" name="action" value="form-submit" />
</div>
                <!--div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Ok</button>
                </div-->
</div>
</div>
</div>';	
	return $html;
		
} 



function PopupChance_plugin_form_submit($vars){

if ($_SERVER["REQUEST_METHOD"] == "POST"){	
	
	$popupnonce=substr(htmlspecialchars(trim($_POST['popupnonce'])), 0, 10);
	$inputname=substr(htmlspecialchars(trim($_POST['inputname'])), 0, 62);
	$inputemail=substr(sanitize_email($_POST['inputemail']),0,31);
	
	// check submitted nonce which generated earlier
	if ( ! wp_verify_nonce( $popupnonce, 'popup-nonce')){
		 PopupChance_plugin_send_json('busted');
		die(); 
	}
	
	if (empty($inputname)){
		PopupChance_plugin_send_json('empty');
		die();
	}

			
	$to = 'mail@ukr.net';
	$headers='MIME-Version: 1.0' . "\r\n";
        $headers.='Content-type:text/html;charset="utf-8"' . "\r\n";	
	$headers.='From: "'.$inputname.'" <mail@ukr.net>'."\n";
	$discount=mt_rand(3,10);
	$subject='скидка для: '.$inputemail.'; повезло : '.$discount.'%; имя счастливчика: '.$inputname;
	$message='<html> <head> <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"> <title></title> </head> <body bgcolor="#FFFFFF" text="#000000"> Здравствуйте! <br> <br> Хочу получить скидку, мои данные:<br> <br> <table border="1" cellpadding="2" cellspacing="2" width="100%"> <tbody> <tr valign="middle" align="center" width="20%"> <td>Имя</td> <td>Почта</td> <td>Скидка</td> <td>IP</td> </tr> <tr valign="middle" align="center" width="20%"> <td>'.$inputname.'</td> <td>'.$inputemail.'</td> <td>'.$discount.'</td> <td>'.stripslashes($_SERVER['REMOTE_ADDR']).'</td> </tr> </tbody> </table> <br><p> Спасибо! Хорошего дня!<p><br> </body></html>';
	
	
	list($issave,$discdb)=PopupChance_plugin_save_db($inputname,$inputemail,$discount);
	switch($issave){
		case 1:
			wp_mail($to,$subject,$message,$headers);
			PopupChance_plugin_send_json('sent-successfully',$discdb);
			
			break;
		case 0:
			PopupChance_plugin_send_json('try-later',$discdb);
			break;
	 	default:
			die();
	}
	
}	
	PopupChance_plugin_send_json('error');
	die();
	
}
function PopupChance_plugin_send_json($sendtxt,$discdb=null){
		
	if($discdb){
		$return=array('condition'=>$sendtxt,'discount'=>$discdb);
	}else{
		$return=array('condition'=>$sendtxt);
	}
	ob_start();
	header('Content-Type: application/json');
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 2015 05:00:00 GMT'); 
	echo json_encode($return);
	ob_flush();
	die();
}


function check_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


function PopupChance_plugin_nonce_hourly() {
	
	return 3600;
}

function PopupChance_plugin_save_db($named,$emaild,$discount){
	global $wpdb;
	
	$checkid=$wpdb->get_row($wpdb->prepare( 
        	"SELECT * FROM wp_chance WHERE email=%s",
        	$emaild),ARRAY_A);
	$idn=$checkid['idn'];
	$nowdate=date("Y-m-d H:i:s",time());	
	if (is_null($idn)){
		$wpdb->query( $wpdb->prepare( 
			"INSERT INTO wp_chance ( name, email, registr_date) VALUES ( %s, %s, %s)", 
        		$named, 
			$emaild,
			$nowdate	
			));
		$idn = $wpdb->insert_id;
	}else{
		$windb=$wpdb->get_row( $wpdb->prepare( 
                 	"select * from wp_chance_win where idn=%s order by idw desc", 
                        $idn
                        ),ARRAY_A);
		$lastwin=$windb['win_date'];
		$differ = strtotime ("$nowdate")-strtotime("$lastwin");
		if ($differ<86400){	
			$discount=$windb['win_discount'];
			return array("0","$discount");
			}	
	}
	$wpdb->query( $wpdb->prepare( 
                        "INSERT INTO wp_chance_win ( idn, win_discount, win_date)  VALUES ( %s, %d, %s )",
                        $idn,
         	        $discount,
			$nowdate	
			));
	return array("1","$discount");
	
}
function PopupChance_plugin_smtp_email_settings($phpmailer){
	// Define that we are sending with SMTP
	$phpmailer->isSMTP();
 
	// The hostname of the mail server
	$phpmailer->Host = 'smtp.gmail.com';

	// Use SMTP authentication (true|false)
	$phpmailer->SMTPAuth = true;
 
	// SMTP port number - likely to be 25, 465 or 587
	$phpmailer->Port = '587';
 
	// Username to use for SMTP authentication
	$phpmailer->Username = 'mail@gmail.com';
 	//$phpmailer->Username = 'netspam@ukr.net';
		
	// Password to use for SMTP authentication
	$phpmailer->Password = 'password';
	
	// The encryption system to use - ssl (deprecated) or tls
	$phpmailer->SMTPSecure = 'tls';
 
	$phpmailer->From = 'mail@gmail.com';
	$phpmailer->FromName = 'system';
}

add_action('wp_ajax_form-submit', 'PopupChance_form_submit');
add_action('wp_ajax_nopriv_form-submit', 'PopupChance_plugin_form_submit' );
add_filter('nonce_life', 'PopupChance_plugin_nonce_hourly' );
add_action('phpmailer_init','PopupChance_plugin_smtp_email_settings');


add_shortcode( 'popup-chance', 'PopupChance_shortcode' );  
add_action('wp_enqueue_scripts', 'PopupChance_add_javascript_files');
add_action("plugins_loaded", "PopupChance_widget_init");
register_activation_hook(__FILE__, 'PopupChance_install');
register_deactivation_hook(__FILE__, 'PopupChance_deactivation');
add_action('init', 'PopupChance_widget_init');

?>
