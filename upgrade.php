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

if(!defined('WB_PATH')) { exit("Cannot access this file directly"); }

$table = TABLE_PREFIX."mod_imagegallery_settings";

if (!$database->field_exists($table, 'titletext')) {
	$database->query("ALTER TABLE `".$table."` ADD `titletext` TEXT NULL");
}
if (!$database->field_exists($table, 'inline')) {
        $database->query("ALTER TABLE `".$table."` ADD `inline` INT NOT NULL DEFAULT '1'");
}
if (!$database->field_exists($table, 'show_extensions')) {
        $database->query("ALTER TABLE `".$table."` ADD `show_extensions` INT NOT NULL DEFAULT '0'");
}
if (!$database->field_exists($table, 'thumbnails_clickable')) {
        $database->query("ALTER TABLE `".$table."` ADD `thumbnails_clickable` INT NOT NULL DEFAULT '1'");
}
