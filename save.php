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

require('../../config.php');
require(WB_PATH.'/modules/admin.php');

// Tells script to update when this page was last updated
$update_when_modified = true; 

//Get settings
if (isset($_POST['maxpics'])) {
    $maxpics = $_POST['maxpics'];
} else {
    $maxpics = '9';
}
if (isset($_POST['thumbdir'])) {
    $thumbdir = $_POST['thumbdir'];
} else {
    $thumbdir = 'thumbs';
}
if (isset($_POST['thumbsize'])) {
    $thumbsize = $_POST['thumbsize'];
} else {
    $thumbsize = '150';
}
if (isset($_POST['filenames'])) {
    $filenames = $_POST['filenames'];
} else {
    $filenames = '0';
}
if (isset($_POST['show_extensions'])) {
    $show_extensions = $_POST['show_extensions'];
} else {
    $show_extensions = '0';
}
if (isset($_POST['subdirs'])) {
    $subdirs = $_POST['subdirs'];
} else {
    $subdirs = '0';
}
if (isset($_POST['title'])) {
    $title = $_POST['title'];
} else {
    $title = '0';
}
if (isset($_POST['maxwidth'])) {
    $maxwidth = $_POST['maxwidth'];
} else {
    $maxwidth = '500';
}
if (isset($_POST['showoriginal'])) {
    $showoriginal = $_POST['showoriginal'];
} else {
    $showoriginal = '0';
}
if (isset($_POST['textlink'])) {
    $textlink = $_POST['textlink'];
} else {
    $textlink = '0';
}
if (isset($_POST['picdir'])) {
    $picdir = addslashes($_POST['picdir']);
} else {
    $picdir = '';
}
if (isset($_POST['bg'])) {
    $bg = $_POST['bg'];
} else {
    $bg = 'FFFFFF';
}
if (isset($_POST['titletext'])) {
    $titletext = $_POST['titletext'];
} else {
    $titletext = 'Gallery';
}
if (isset($_POST['inline'])) {
    $inline = $_POST['inline'];
} else {
    $inline = '0';
}

//Write to database	
$query = "UPDATE `".TABLE_PREFIX."mod_imagegallery_settings` "
		. "	SET `maxpics` = '$maxpics',"
		. "	`thumbdir` = '$thumbdir',"
		. "	`thumbsize` = '$thumbsize',"
		. "	`filenames` = '$filenames',"
		. "	`show_extensions` = '$show_extensions',"
		. "	`subdirs` = '$subdirs',"
		. "	`title` = '$title',"
		. "	`picdir` = '$picdir',"
		. "	`bg` = '$bg',"			
		. "	`maxwidth` = '$maxwidth',"
		. "	`showoriginal` = '$showoriginal',"			
		. "	`textlink` = '$textlink',"
		. "	`titletext` = '$titletext',"
		. "	`inline` = '$inline'";
$query .=  " WHERE `section_id` = '$section_id'";

$database->query($query);

// Check if there is a database error, otherwise say successful
if($database->is_error()) {
	$admin->print_error($database->get_error(), $js_back);
} else {
	$admin->print_success($MESSAGE['PAGES']['SAVED'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer
$admin->print_footer();

?>