<?php
/**
 *
 * WBCE CMS
 * Way Better Content Editing.
 * Visit https://wbce.org to learn more and to join the community.
 * @category        modules
 * @package         another_image_gallery_noext
 * @author          Daniel Wacker, Matthias Gallas, Rob Smith, Manfred Fuenkner, Bernd, tomno399
 * @copyright       2004-2009, Ryan Djurovich
 * @copyright       2009-2010, Website Baker Org. e.V.
 * @copyright       WBCE Project (2015-)
 * @license         http://www.gnu.org/licenses/gpl.html
 * @requirements    PHP 4.3.0 and higher
 * Changes: https://forum.websitebaker.org/index.php/topic,2725.0.html
 *
*/

/*
 * galerie.php - a simple gallery script
 * Copyright (C) 2004  Daniel Wacker <daniel.wacker@web.de>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 *
 * --
 * This script provides a simple gallery of all images that are located
 * in the script's directory and subdirectories.
 *
 * Requirements
 * - PHP >= 4.1.0
 * - GD Library ( >= 2.0.1 for good thumbnails)
 * - JPEG software
 * - PHP >= 4.3.0 or GD < 1.6 for GIF support
 * - libpng for PNG support
 * - Colorbox-Modul
 *
 * Installation
 * Simply put this script in a folder of your web server and call it in a
 * web browser. Be sure that the script has permission to read the image
 * files and to create and write into the thumbnail folder.
 *
 * Attention:
 * This script tries to generate jpeg thumbnail files in a subfolder of the
 * gallery folder(s). The filenames look like "originalfilename.thumb.jpg".
 *
*/

$module_directory = 'another_image_gallery_noext';
$module_name = 'Another Image Gallery (No-Ext)';
$module_function = 'page';
$module_version = '2.4.4';
$module_platform = '2.8.x';
$module_author = 'Daniel Wacker, Matthias Gallas, Rob Smith, Manfred Fuenkner, tomno399';
$module_license = 'GNU General Public License';
$module_description = 'This module allows you to create a image Gallery using galerie.php - a simple gallery script from Daniel Wacker <daniel.wacker@web.de>.';


// 2.4.2 fixes for MySQL-Strict (Bernd)
// 2.4.3 fix upgrade.php to work with MySQL-Strict/Doctrine
// 2.4.4 add missing quotation marks around class an rel in view.php (Florian)
?>
