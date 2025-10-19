<?php
/**
 *
 * @category        modules
 * @package         WBCE_JAIG
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
$MOD_WBCE_JAIG['PREVIOUS'] = '<< f&ouml;reg&aring;ende';
$MOD_WBCE_JAIG['NEXT']	= 'n&auml;sta >>';
$MOD_WBCE_JAIG['OVERVIEW']	= 'bild&ouml;versikt';

//Variables for the Backend
$MOD_WBCE_JAIG['MAIN_SETTINGS'] = 'Huvudinst&auml;llningar';
$MOD_WBCE_JAIG['TITLE'] = 'Imagegallery';
$MOD_WBCE_JAIG['ORIGINAL_PICS'] = 'Pictures';
$MOD_WBCE_JAIG['THUMBS'] = 'Thumbs';
$MOD_WBCE_JAIG['GALLERY'] = 'Gallery';
$MOD_WBCE_JAIG['TITLE_TEXT'] = 'Define Title';
$MOD_WBCE_JAIG['SHOW_TITLE'] = 'Visa titel';
$MOD_WBCE_JAIG['PICDIR'] = 'Bildmapp';
$MOD_WBCE_JAIG['INCLUDE_SUBDIRS'] = 'Inkludera undermappar';
$MOD_WBCE_JAIG['THUMBDIR'] = 'Namn p&aring; tumnagelmapp';
$MOD_WBCE_JAIG['MAXPICS'] = 'Antalet tumnaglar per sida';
$MOD_WBCE_JAIG['THUMBS_BACKGROUND'] = 'Bakgrund p&aring; tumnagelbilder';
$MOD_WBCE_JAIG['THUMBSIZE'] = 'Storlek p&aring; tumnagel';
$MOD_WBCE_JAIG['MAXWIDTH']	= 'Maximal bildbredd';
$MOD_WBCE_JAIG['SHOW_FILE_NAMES'] = 'Visa filnamn';
$MOD_WBCE_JAIG['SHOW_FILE_EXTENSIONS'] = 'Visa filändelser';
$MOD_WBCE_JAIG['SHOW_ORIGINAL'] = 'Visa orginal';
$MOD_WBCE_JAIG['SHOW_TEXTLINK'] = 'Text n&auml;sta/f&ouml;reg&aring;ende l&auml;nkar';
$MOD_WBCE_JAIG['THUMBNAILS_CLICKABLE'] = 'Miniatyrer klickbara';
$MOD_WBCE_JAIG['INLINE'] = 'Show gallery inline';

//Variables for Error messages
$MOD_WBCE_JAIG['words']['error'] = 'Error';
$MOD_WBCE_JAIG['words']['php_error'] = 'PHP >= 4.1 is required.';
$MOD_WBCE_JAIG['words']['gd_error'] = 'GD Library is required. See http://www.boutell.com/gd/.';
$MOD_WBCE_JAIG['words']['jpg_error'] = 'JPEG software is required. See ftp://ftp.uu.net/graphics/jpeg/.';
$MOD_WBCE_JAIG['words']['mkdir_error'] = 'Write permission is required in this folder.';
$MOD_WBCE_JAIG['words']['opendir_error'] = 'The directory "%1" can not be read.';

?>