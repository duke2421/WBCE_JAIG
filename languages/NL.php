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
$module_description = 'Met deze module kun je een fotoalbum maken mbv galerie.php - een eenvoudig fotalbum script van Daniel Wacker <daniel.wacker@web.de>.';

//Variables for the Frontend
$MOD_WBCE_JAIG['PREVIOUS'] = 'vorige';
$MOD_WBCE_JAIG['NEXT']	= 'volgende';
$MOD_WBCE_JAIG['OVERVIEW']	= 'start';

//Variables for the Backend
$MOD_WBCE_JAIG['MAIN_SETTINGS'] = 'Fotoalbum Instellingen';
$MOD_WBCE_JAIG['TITLE'] = 'Fotoalbum';
$MOD_WBCE_JAIG['ORIGINAL_PICS'] = 'Pictures';
$MOD_WBCE_JAIG['THUMBS'] = 'Thumbs';
$MOD_WBCE_JAIG['GALLERY'] = 'Gallery';
$MOD_WBCE_JAIG['TITLE_TEXT'] = 'Define Title';
$MOD_WBCE_JAIG['SHOW_TITLE'] = 'Titel zichtbaar';
$MOD_WBCE_JAIG['PICDIR'] = 'Fotomap';
$MOD_WBCE_JAIG['INCLUDE_SUBDIRS'] = 'Inclusief submappen';
$MOD_WBCE_JAIG['THUMBDIR'] = 'Mapnaam thumbnails ';
$MOD_WBCE_JAIG['MAXPICS'] = 'Aantal thumbnails per pagina';
$MOD_WBCE_JAIG['THUMBS_BACKGROUND'] = 'Thumbnails achtergrondkleur';
$MOD_WBCE_JAIG['THUMBSIZE'] = 'Thumbnail grootte';
$MOD_WBCE_JAIG['MAXWIDTH']	= 'Maximale breedte foto';
$MOD_WBCE_JAIG['SHOW_FILE_NAMES'] = 'Bestandsnaam zichtbaar';
$MOD_WBCE_JAIG['SHOW_FILE_EXTENSIONS'] = 'Bestandsextensies zichtbaar';
$MOD_WBCE_JAIG['SHOW_ORIGINAL'] = 'Originele foto zichtbaar (nieuw scherm)';
$MOD_WBCE_JAIG['SHOW_TEXTLINK'] = 'Volgende/vorige als tekst ipv plaatje';
$MOD_WBCE_JAIG['THUMBNAILS_CLICKABLE'] = 'Miniaturen aanklikbaar';
$MOD_WBCE_JAIG['INLINE'] = 'Show gallery inline';

//Variables for Error messages
$MOD_WBCE_JAIG['words']['error'] = 'Fout';
$MOD_WBCE_JAIG['words']['php_error'] = 'PHP >= 4.1 is nodig.';
$MOD_WBCE_JAIG['words']['gd_error'] = 'GD Library is nodig. Ga naar http://www.boutell.com/gd/.';
$MOD_WBCE_JAIG['words']['jpg_error'] = 'JPEG software is nodig. Ga naar ftp://ftp.uu.net/graphics/jpeg/.';
$MOD_WBCE_JAIG['words']['mkdir_error'] = 'Schrijfrechten zijn nodig op deze map.';
$MOD_WBCE_JAIG['words']['opendir_error'] = 'De map "%1" kan niet worden gelezen.';

?>