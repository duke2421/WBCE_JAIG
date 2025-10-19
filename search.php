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

function imagegallery_search($func_vars) {
	extract($func_vars, EXTR_PREFIX_ALL, 'func');

	$WB_PATH = WB_PATH;
	//$WB_URL = WB_URL;
	$MEDIA_PATH = MEDIA_DIRECTORY;

	// how many lines of excerpt we want to have at most
	$max_excerpt_num = $func_default_max_excerpt;
	// show thumbnail in excerpt?
	$show_thumb = true;
	$divider = ".";
	$result = false;
	$show_thumb_ok = false;
	
	$table = TABLE_PREFIX."mod_imagegallery_settings";
	$query = $func_database->query("
		SELECT `thumbdir`, `thumbsize`, `subdirs`, `picdir`
		FROM $table
		WHERE `section_id` = '$func_section_id'
	");
	if($query->numRows() > 0) {
		if($res = $query->fetchRow()) {
			// standard-values
			$mod_vars = array(
				'page_link' => $func_page_link,
				//'page_link_target' => '',
				'page_title' => $func_page_title,
				'page_description' => $func_page_description,
				'page_modified_when' => $func_page_modified_when,
				'page_modified_by' => $func_page_modified_by,
				//'text' => ''.$divider,
				'max_excerpt_num' => $max_excerpt_num
			);

			$galdir = rtrim($res['picdir'], '/');
			$thumbdir = $res['thumbdir'];
			$sid = $func_section_id;
			
			$filetype = 'jpg|jpeg';
			if(function_exists('imagecreatefromgif'))
				$filetype .= '|gif';
			if(function_exists('imagecreatefrompng'))
				$filetype .= '|png';
			
			// get all files and dirs below $res['picdir']
			$depth = true;
			if($res['subdirs'] == '0')
				$depth = false;
			$files=array(); $dirs=array();
			list($files, $dirs) = list_files_dirs($WB_PATH.$MEDIA_PATH.$galdir, $depth); // returns an array of two arrays
			// remove unwanted entries
			$files = clear_filelist($files, '\.('.$filetype.')$', true); // keep only files which ends on ".jpg", ...
			$files = clear_filelist($files, "/$thumbdir/", false); // remove all files-paths containing "/thumbs/"
			$dirs = clear_filelist($dirs, '/'.$thumbdir.'$', false); // remove dirs ending on "/thumbs"
			// cut-away "$WB_PATH.$MEDIA_PATH.$galdir"-part from $files and $dirs
			$len = strlen($WB_PATH.$MEDIA_PATH.$galdir);
			array_walk($files, create_function('&$path,$key,$len','$path = substr($path, $len+1);'), $len-1); // keep leading '/'
			array_walk($dirs, create_function('&$path,$key,$len','$path = substr($path, $len+1);'), $len);

			// Album-names aka directories
			foreach($dirs as $dir) {
				$mod_vars['page_link_target'] = "&dir$sid=/$dir";
				$mod_vars['text'] = $dir.$divider;
				if(print_excerpt2($mod_vars, $func_vars)) {
					$result = true;
				}
			}

			// Picture-names
			// shall we show a thumbnail?
			if($show_thumb) {
			// show thumbs only when 10 <= thumbwidth <= 200
				if($res['thumbsize'] > 9 && $res['thumbsize'] < 201) {
					$show_thumb_ok = true;
				}
			}
			sort($files); // $files have to be sorted by sort() for this to work!
			$i = 0;
			$old_path = '';
			foreach($files as $file) {
				// split $file in $path+$image
				$pic_link = '';
				list($path, $image) = preg_split('/(^.*\/)/', $file, -1, (PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY));
				if($path != $old_path) {
					$old_path = $path;
					$i = 0;
				}
				if($show_thumb_ok) {
					if(file_exists($WB_PATH.$MEDIA_PATH.$galdir.$path.$thumbdir.'/'.$image.".thumb.jpg")) {
						$pic_link = $galdir.$path.$thumbdir.'/'.$image.".thumb.jpg";
					}
				}
				$mod_vars['page_link_target'] = "&dir$sid=$path&pic$sid=$i";
				$mod_vars['text'] = $image.$divider;
				$mod_vars['pic_link'] = $pic_link;
				if(print_excerpt2($mod_vars, $func_vars)) {
					$result = true;
				}
				++$i;
			}
			
		}
	}
	return $result;
}

?>