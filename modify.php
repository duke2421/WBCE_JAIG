<?php
/**
 *
 * @category        modules
 * @package         another_image_gallery_noext
 * @author          Daniel Wacker, Matthias Gallas, Rob Smith, Manfred Fuenkner
 * @copyright       2004-2009, Ryan Djurovich
 * @copyright       2009-2010, Website Baker Org. e.V.
 * @link			http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/gpl.html
 * @platform        WebsiteBaker 2.8.x
 * @requirements    PHP 4.3.0 and higher
 *
*/

// prevent this file from being accessed directly
if(!defined('WB_PATH')) die(header('Location: index.php'));

// include core functions of WB 2.7 to edit the optional module CSS files (frontend.css, backend.css)
@include_once(WB_PATH .'/framework/module.functions.php');

// check if module language file exists for the language set by the user (e.g. DE, EN)
if(!file_exists(WB_PATH .'/modules/another_image_gallery_noext/languages/'.LANGUAGE .'.php')) {
	// no module language file exists for the language set by the user, include default module language file EN.php
	require_once(WB_PATH .'/modules/another_image_gallery_noext/languages/EN.php');
} else {
	// a module language file exists for the language defined by the user, load it
	require_once(WB_PATH .'/modules/another_image_gallery_noext/languages/'.LANGUAGE .'.php');
}

// check if backend.css file needs to be included into the <body></body> of modify.php
if(!method_exists($admin, 'register_backend_modfiles') && file_exists(WB_PATH ."/modules/another_image_gallery_noext/backend.css")) {
	echo '<style type="text/css">';
	include(WB_PATH .'/modules/another_image_gallery_noext/backend.css');
	echo "\n</style>\n";
}

require_once(WB_PATH.'/framework/functions.php');

// Get settings
$query_settings = $database->query("SELECT `maxpics`, `thumbdir`, `thumbsize`, `filenames`, `subdirs`, `title`, `picdir`, `bg`, `maxwidth`, `showoriginal`, `textlink`,  `titletext`, `inline` FROM `".TABLE_PREFIX."mod_imagegallery_settings` WHERE `section_id` = '$section_id'");
$settings = $query_settings->fetchRow();

?>
<h2><?php echo $MOD_AIG_NOEXT['MAIN_SETTINGS']; ?></h2>
<div class="gallery_box">
<?php
// include the button to edit the optional module CSS files
// Note: CSS styles for the button are defined in backend.css (div class="mod_moduledirectory_edit_css")
// Place this call outside of any <form></form> construct!!!
if(function_exists('edit_module_css')) {
	edit_module_css('another_image_gallery_noext');
}
?>
<form name="modify" action="<?php echo WB_URL; ?>/modules/another_image_gallery_noext/save.php" method="post" >
<input type="hidden" name="section_id" value="<?php echo $section_id; ?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id; ?>" />

<fieldset class="gallery">
	<legend><?php echo $MOD_AIG_NOEXT['TITLE']; ?></legend>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['TITLE_TEXT']; ?>:<br /></div>
	<div class="gallery_setting_value"><input type="text" name="titletext" value="<?php echo $settings['titletext']; ?>" /><br /></div>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['SHOW_TITLE']; ?>:<br /></div>
	<div class="gallery_setting_value"><?php if ($settings['title'] == '1') {$checked = 'checked';} else {$checked = '';}?><input type="checkbox" value="1" name="title" <?php echo $checked; ?> /><br /></div>
</fieldset>

<fieldset class="gallery">
	<legend><?php echo $MOD_AIG_NOEXT['ORIGINAL_PICS']; ?></legend>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['PICDIR']; ?>:<br /></div>
	<div class="gallery_setting_value">
		<select name="picdir">
		<option value="<?php echo $settings['picdir']; ?>" selected><?php echo $settings['picdir']; ?></option>
		<?php
		$folder_list=directory_list(WB_PATH.MEDIA_DIRECTORY);
		array_push($folder_list,WB_PATH.MEDIA_DIRECTORY);
		sort($folder_list);
		echo"<pre>";print_r($folder_list);echo"</pre>";
		foreach($folder_list AS $foldername) {
			$thumb_count=substr_count($foldername, '/thumbs');
			if($thumb_count==0 and trim($foldername)!=""){
				echo "<option value='".str_replace(WB_PATH.MEDIA_DIRECTORY,'',$foldername)."'>".str_replace(WB_PATH.MEDIA_DIRECTORY,'',$foldername)."</option>\n";
			}
			$thumb_count="";
		}
		?>
		</select><br />
	</div>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['INCLUDE_SUBDIRS']; ?>:<br /></div>
	<div class="gallery_setting_value"><?php if ($settings['subdirs'] == '1') {$checked = 'checked';} else {$checked = '';}?><input type="checkbox" value="1" name="subdirs" <?php echo $checked; ?> /><br /></div>
</fieldset>
<fieldset class="gallery">
	<legend><?php echo $MOD_AIG_NOEXT['THUMBS']; ?></legend>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['THUMBDIR']; ?>:<br /></div>
	<div class="gallery_setting_value"><input type="text" name="thumbdir" value="<?php echo $settings['thumbdir']; ?>" /><br /></div>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['THUMBS_BACKGROUND']; ?>:<br /></div>
	<div class="gallery_setting_value"><input type="text" name="bg" value="<?php echo $settings['bg']; ?>" /><br /></div>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['MAXPICS']; ?>:<br /></div>
	<div class="gallery_setting_value"><input type="text" name="maxpics" value="<?php echo $settings['maxpics']; ?>" /><br /></div>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['THUMBSIZE']; ?>:<br /></div>
	<div class="gallery_setting_value"><input type="text" name="thumbsize" value="<?php echo $settings['thumbsize']; ?>" /> px<br /></div>
</fieldset>
<fieldset class="gallery">
	<legend><?php echo $MOD_AIG_NOEXT['GALLERY']; ?></legend>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['MAXWIDTH']; ?>:<br /></div>
	<div class="gallery_setting_value"><input type="text" name="maxwidth" value="<?php echo $settings['maxwidth']; ?>" /> px<br /></div>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['INLINE']; ?>:<br /></div>
	<div class="gallery_setting_value"><?php if ($settings['inline'] == '1') {$checked = 'checked';} else {$checked = '';}?><input type="checkbox" value="1" name="inline" <?php echo $checked; ?> /><br /></div>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['SHOW_FILE_NAMES']; ?>:<br /></div>
	<div class="gallery_setting_value"><?php if ($settings['filenames'] == '1') {$checked = 'checked';} else {$checked = '';}?><input type="checkbox" value="1" name="filenames" <?php echo $checked; ?> /><br /></div>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['SHOW_ORIGINAL']; ?>:<br /></div>
	<div class="gallery_setting_value"><?php if ($settings['showoriginal'] == '1') {$checked = 'checked';} else {$checked = '';}?><input type="checkbox" value="1" name="showoriginal" <?php echo $checked; ?> /><br /></div>

	<div class="gallery_setting_name"><?php echo $MOD_AIG_NOEXT['SHOW_TEXTLINK']; ?>:<br /></div>
	<div class="gallery_setting_value"><?php if ($settings['textlink'] == '1') {$checked = 'checked';} else {$checked = '';}?><input type="checkbox" value="1" name="textlink" <?php echo $checked; ?> /><br /></div>
</fieldset>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="left">
			<input name="save" type="submit" value="<?php echo $TEXT['SAVE']; ?>" style="width: 100px; margin-top: 5px;" />
		</td>
		<td align="right">
			<input type="button" value="<?php echo $TEXT['CANCEL']; ?>" onclick="javascript: window.location = '<?php echo ADMIN_URL; ?>/pages/index.php'; return false;" style="width: 100px; margin-top: 5px;" />
		</td>
	</tr>
</table>
</form>
</div>
