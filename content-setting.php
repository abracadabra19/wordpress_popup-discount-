<div class="wrap">
  <div class="form-wrap">
    <div id="icon-plugins" class="icon32 icon32-posts-post"><br>
    </div>
    <h2><?php _e('Popup chance form', 'popup-chance'); ?></h2>
    <?php
	$PopupChance_title = get_option('PopupChance_title');
	$PopupChance_On_Homepage = get_option('PopupChance_On_Homepage');
	$PopupChance_On_Posts = get_option('PopupChance_On_Posts');
	$PopupChance_On_Pages = get_option('PopupChance_On_Pages');
	$PopupChance_On_Search = get_option('PopupChance_On_Search');
	$PopupChance_On_Archives = get_option('PopupChance_On_Archives');
	$PopupChance_On_MyEmail = get_option('PopupChance_On_MyEmail');
	$PopupChance_On_Subject = get_option('PopupChance_On_Subject');
	$PopupChance_Caption = get_option('PopupChance_Caption');
	$PopupChance_homeurl = get_option('PopupChance_homeurl');
	
	if (isset($_POST['PopupChance_form_submit']) && $_POST['PopupChance_form_submit'] == 'yes')
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('PopupChance_form_setting');
			
		$PopupChance_title = stripslashes($_POST['PopupChance_title']);
		$PopupChance_On_Homepage = stripslashes($_POST['PopupChance_On_Homepage']);
		$PopupChance_On_Posts = stripslashes($_POST['PopupChance_On_Posts']);
		$PopupChance_On_Pages = stripslashes($_POST['PopupChance_On_Pages']);
		$PopupChance_On_Search = stripslashes($_POST['PopupChance_On_Search']);
		$PopupChance_On_Archives = stripslashes($_POST['PopupChance_On_Archives']);
		$PopupChance_On_MyEmail = stripslashes($_POST['PopupChance_On_MyEmail']);
		$PopupChance_On_Subject = stripslashes($_POST['PopupChance_On_Subject']);
		$PopupChance_Caption = stripslashes($_POST['PopupChance_Caption']);
		$PopupChance_homeurl = stripslashes($_POST['PopupChance_homeurl']);
		
		update_option('PopupChance_title', $PopupChance_title );
		update_option('PopupChance_On_Homepage', $PopupChance_On_Homepage );
		update_option('PopupChance_On_Posts', $PopupChance_On_Posts );
		update_option('PopupChance_On_Pages', $PopupChance_On_Pages );
		update_option('PopupChance_On_Search', $PopupChance_On_Search );
		update_option('PopupChance_On_Archives', $PopupChance_On_Archives );
		update_option('PopupChance_On_MyEmail', $PopupChance_On_MyEmail );
		update_option('PopupChance_On_Subject', $PopupChance_On_Subject );
		update_option('PopupChance_Caption', $PopupChance_Caption );
		update_option('PopupChance_homeurl', $PopupChance_homeurl );
		
		?>
		<div class="updated fade">
			<p><strong><?php _e('Details successfully updated.', 'popup-chance'); ?></strong></p>
		</div>
		<?php
	}
	?>
	<h3><?php _e('Popup email setting', 'popup-chance'); ?></h3>
	<form name="sdp_form" method="post" action="">
	
		<label for="tag-image"><?php _e('Email address', 'popup-chance'); ?></label>
		<input name="PopupChance_On_MyEmail" type="text" id="PopupChance_On_MyEmail" value="<?php echo $PopupChance_On_MyEmail; ?>" size="75" />
		<p><?php _e('Please enter admin email address to receive mails.', 'popup-chance'); ?></p>
		
		<label for="tag-image"><?php _e('Email subject', 'popup-chance'); ?></label>
		<input name="PopupChance_On_Subject" type="text" id="PopupChance_On_Subject" value="<?php echo $PopupChance_On_Subject; ?>" size="75"  />
		<p><?php _e('Please enter mail subject.', 'popup-chance'); ?></p>
		
		<label for="tag-image"><?php _e('Link Button / Text', 'popup-chance'); ?></label>
		<input name="PopupChance_Caption" type="text" id="PopupChance_Caption" value="<?php echo $PopupChance_Caption; ?>" size="100"  />
		<p><?php _e('This box is to add the contact us Image Button or Text, Entered value will display in the front end.', 'popup-chance'); ?></p>
	
		<div style="height:5px;"></div>
		<h3><?php _e('Popup widget setting', 'popup-chance'); ?></h3>
		
		<label for="tag-title"><?php _e('Popup title', 'popup-chance'); ?></label>
		<input name="PopupChance_title" type="text" id="PopupChance_title" value="<?php echo $PopupChance_title; ?>" />
		<p><?php _e('Please enter popup box title.', 'popup-chance'); ?></p>
		
		<label for="tag-title"><?php _e('On home page display', 'popup-chance'); ?></label>
		<select name="PopupChance_On_Homepage" id="PopupChance_On_Homepage">
			<option value='YES' <?php if($PopupChance_On_Homepage == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($PopupChance_On_Homepage == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p><?php _e('Select YES if you need to display on home page.', 'popup-chance'); ?></p>
		
		<label for="tag-title"><?php _e('On posts display', 'popup-chance'); ?></label>
		<select name="PopupChance_On_Posts" id="PopupChance_On_Posts">
			<option value='YES' <?php if($PopupChance_On_Posts == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($PopupChance_On_Posts == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p><?php _e('Select YES if you need to display on posts.', 'popup-chance'); ?></p>
		
		<label for="tag-title"><?php _e('On pages display', 'popup-chance'); ?></label>
		<select name="PopupChance_On_Pages" id="PopupChance_On_Pages">
			<option value='YES' <?php if($PopupChance_On_Pages == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($PopupChance_On_Pages == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p><?php _e('Select YES if you need to display on wordpress pages.', 'popup-chance'); ?></p>
		
		<label for="tag-title"><?php _e('On search page display', 'popup-chance'); ?></label>
		<select name="PopupChance_On_Search" id="PopupChance_On_Search">
			<option value='YES' <?php if($PopupChance_On_Search == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($PopupChance_On_Search == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p><?php _e('Select YES if you need to display on search pages.', 'popup-chance'); ?></p>
		
		<label for="tag-title"><?php _e('On archive page display', 'popup-chance'); ?></label>
		<select name="PopupChance_On_Archives" id="PopupChance_On_Archives">
			<option value='YES' <?php if($PopupChance_On_Archives == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($PopupChance_On_Archives == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p><?php _e('Select YES if you need to display on archive pages.', 'popup-chance'); ?></p>
		
		<h3><?php _e('Security Check (Spam Stopper)', 'send-link-to-friend'); ?></h3>
		<label for="tag-width"><?php _e('Home URL', 'send-link-to-friend'); ?></label>
		<input name="PopupChance_homeurl" type="text" value="<?php echo $PopupChance_homeurl; ?>"  id="PopupChance_homeurl" size="50" maxlength="500">
		<p><?php _e('This home URL is for security check. We can submit the form only on this website. ', 'popup-chance'); ?></p>
		
		<br />		
		<input type="hidden" name="PopupChance_form_submit" value="yes"/>
		<input name="PopupChance_submit" id="PopupChance_submit" class="button add-new-h2" value="<?php _e('Update All Details', 'popup-chance'); ?>" type="submit" />
		<input name="Help" lang="publish" class="button add-new-h2" onclick="window.open('http://www.ericmmartin.com/');" value="<?php _e('Help', 'popup-chance'); ?>" type="button" />
		<?php wp_nonce_field('PopupChance_form_setting'); ?>
	</form>
  </div>
  <h3><?php _e('Plugin configuration option', 'popup-chance'); ?></h3>
	<ol>
		<li><?php _e('Drag and drop the plugin widget to your sidebar.', 'popup-chance'); ?></li>
		<li><?php _e('Add plugin in the posts or pages using short code.', 'popup-chance'); ?></li>
		<li><?php _e('Add directly in to the theme using PHP code.', 'popup-chance'); ?></li>
	</ol>
  <p class="description"><?php _e('Check official website for more information', 'popup-chance'); ?> 
  <a target="_blank" href="http://www.ericmmartin.com/"><?php _e('click here', 'popup-chance'); ?></a></p>
</div>
