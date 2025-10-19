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
$module_description = 'Met deze module kun je een fotoalbum maken mbv galerie.php - een eenvoudig fotalbum script van Daniel Wacker <daniel.wacker@web.de>.';

//Variables for the Frontend
$MOD_AIG_NOEXT['PREVIOUS'] = 'vorige';
$MOD_AIG_NOEXT['NEXT']	= 'volgende';
$MOD_AIG_NOEXT['OVERVIEW']	= 'start';

//Variables for the Backend
$MOD_AIG_NOEXT['MAIN_SETTINGS'] = 'Fotoalbum Instellingen';
$MOD_AIG_NOEXT['TITLE'] = 'Fotoalbum';
$MOD_AIG_NOEXT['ORIGINAL_PICS'] = 'Pictures';
$MOD_AIG_NOEXT['THUMBS'] = 'Thumbs';
$MOD_AIG_NOEXT['GALLERY'] = 'Gallery';
$MOD_AIG_NOEXT['TITLE_TEXT'] = 'Define Title';
$MOD_AIG_NOEXT['SHOW_TITLE'] = 'Titel zichtbaar';
$MOD_AIG_NOEXT['PICDIR'] = 'Fotomap';
$MOD_AIG_NOEXT['INCLUDE_SUBDIRS'] = 'Inclusief submappen';
$MOD_AIG_NOEXT['THUMBDIR'] = 'Mapnaam thumbnails ';
$MOD_AIG_NOEXT['MAXPICS'] = 'Aantal thumbnails per pagina';
$MOD_AIG_NOEXT['THUMBS_BACKGROUND'] = 'Thumbnails achtergrondkleur';
$MOD_AIG_NOEXT['THUMBSIZE'] = 'Thumbnail grootte';
$MOD_AIG_NOEXT['MAXWIDTH']	= 'Maximale breedte foto';
$MOD_AIG_NOEXT['SHOW_FILE_NAMES'] = 'Bestandsnaam zichtbaar';
$MOD_AIG_NOEXT['SHOW_FILE_EXTENSIONS'] = 'Bestandsextensies zichtbaar';
$MOD_AIG_NOEXT['SHOW_ORIGINAL'] = 'Originele foto zichtbaar (nieuw scherm)';
$MOD_AIG_NOEXT['SHOW_TEXTLINK'] = 'Volgende/vorige als tekst ipv plaatje';
$MOD_AIG_NOEXT['THUMBNAILS_CLICKABLE'] = 'Miniaturen aanklikbaar';
$MOD_AIG_NOEXT['INLINE'] = 'Show gallery inline';

//Variables for Error messages
$MOD_AIG_NOEXT['words']['error'] = 'Fout';
$MOD_AIG_NOEXT['words']['php_error'] = 'PHP >= 4.1 is nodig.';
$MOD_AIG_NOEXT['words']['gd_error'] = 'GD Library is nodig. Ga naar http://www.boutell.com/gd/.';
$MOD_AIG_NOEXT['words']['jpg_error'] = 'JPEG software is nodig. Ga naar ftp://ftp.uu.net/graphics/jpeg/.';
$MOD_AIG_NOEXT['words']['mkdir_error'] = 'Schrijfrechten zijn nodig op deze map.';
$MOD_AIG_NOEXT['words']['opendir_error'] = 'De map "%1" kan niet worden gelezen.';

?>