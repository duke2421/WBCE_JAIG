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

//Modul Description
$module_description = 'This module allows you to create a image Gallery using galerie.php - a simple gallery script from Daniel Wacker <daniel.wacker@web.de>.';

//Variables for the Frontend
$MOD_AIG_NOEXT['PREVIOUS'] = '<< f&ouml;reg&aring;ende';
$MOD_AIG_NOEXT['NEXT']	= 'n&auml;sta >>';
$MOD_AIG_NOEXT['OVERVIEW']	= 'bild&ouml;versikt';

//Variables for the Backend
$MOD_AIG_NOEXT['MAIN_SETTINGS'] = 'Huvudinst&auml;llningar';
$MOD_AIG_NOEXT['TITLE'] = 'Imagegallery';
$MOD_AIG_NOEXT['ORIGINAL_PICS'] = 'Pictures';
$MOD_AIG_NOEXT['THUMBS'] = 'Thumbs';
$MOD_AIG_NOEXT['GALLERY'] = 'Gallery';
$MOD_AIG_NOEXT['TITLE_TEXT'] = 'Define Title';
$MOD_AIG_NOEXT['SHOW_TITLE'] = 'Visa titel';
$MOD_AIG_NOEXT['PICDIR'] = 'Bildmapp';
$MOD_AIG_NOEXT['INCLUDE_SUBDIRS'] = 'Inkludera undermappar';
$MOD_AIG_NOEXT['THUMBDIR'] = 'Namn p&aring; tumnagelmapp';
$MOD_AIG_NOEXT['MAXPICS'] = 'Antalet tumnaglar per sida';
$MOD_AIG_NOEXT['THUMBS_BACKGROUND'] = 'Bakgrund p&aring; tumnagelbilder';
$MOD_AIG_NOEXT['THUMBSIZE'] = 'Storlek p&aring; tumnagel';
$MOD_AIG_NOEXT['MAXWIDTH']	= 'Maximal bildbredd';
$MOD_AIG_NOEXT['SHOW_FILE_NAMES'] = 'Visa filnamn';
$MOD_AIG_NOEXT['SHOW_FILE_EXTENSIONS'] = 'Visa filändelser';
$MOD_AIG_NOEXT['SHOW_ORIGINAL'] = 'Visa orginal';
$MOD_AIG_NOEXT['SHOW_TEXTLINK'] = 'Text n&auml;sta/f&ouml;reg&aring;ende l&auml;nkar';
$MOD_AIG_NOEXT['THUMBNAILS_CLICKABLE'] = 'Miniatyrer klickbara';
$MOD_AIG_NOEXT['INLINE'] = 'Show gallery inline';

//Variables for Error messages
$MOD_AIG_NOEXT['words']['error'] = 'Error';
$MOD_AIG_NOEXT['words']['php_error'] = 'PHP >= 4.1 is required.';
$MOD_AIG_NOEXT['words']['gd_error'] = 'GD Library is required. See http://www.boutell.com/gd/.';
$MOD_AIG_NOEXT['words']['jpg_error'] = 'JPEG software is required. See ftp://ftp.uu.net/graphics/jpeg/.';
$MOD_AIG_NOEXT['words']['mkdir_error'] = 'Write permission is required in this folder.';
$MOD_AIG_NOEXT['words']['opendir_error'] = 'The directory "%1" can not be read.';

?>