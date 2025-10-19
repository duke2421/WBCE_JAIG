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
	
// Create table
$database->query("DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_imagegallery_settings`");
$mod_aig_noext = 'CREATE TABLE `'.TABLE_PREFIX.'mod_imagegallery_settings` ('
		. ' `section_id` INT NOT NULL DEFAULT \'0\','
		. ' `page_id` INT NOT NULL DEFAULT \'0\','
		. ' `maxpics` INT NOT NULL DEFAULT \'0\','
		. ' `thumbdir` TEXT NOT NULL ,'
		. ' `thumbsize` INT NOT NULL DEFAULT \'0\','
		. ' `filenames` INT NOT NULL DEFAULT \'0\','
		. ' `subdirs` INT NOT NULL DEFAULT \'0\','
		. ' `title` INT NOT NULL DEFAULT \'0\','
		. ' `picdir` TEXT NOT NULL,'
		. ' `bg` TEXT NOT NULL ,'
		. ' `maxwidth` INT NOT NULL DEFAULT \'0\','
		. ' `showoriginal` INT NOT NULL DEFAULT \'0\','
		. ' `textlink` INT NOT NULL DEFAULT \'0\','
		. ' `titletext` TEXT NOT NULL ,'
		. ' `inline` INT NOT NULL DEFAULT \'1\','
		. 'PRIMARY KEY (`section_id`)'
		. ')';
$database->query($mod_aig_noext);

?>