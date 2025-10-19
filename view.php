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

// Must include code to stop this file being access directly
if(defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

// check if module language file exists for the language set by the user (e.g. DE, EN)
if(!file_exists(WB_PATH .'/modules/another_image_gallery_noext/languages/'.LANGUAGE .'.php')) {
	// no module language file exists for the language set by the user, include default module language file EN.php
	require_once(WB_PATH .'/modules/another_image_gallery_noext/languages/EN.php');
} else {
	// a module language file exists for the language defined by the user, load it
	require_once(WB_PATH .'/modules/another_image_gallery_noext/languages/'.LANGUAGE .'.php');
}



// Get settings
$query_settings = $database->query("SELECT `maxpics`, `thumbdir`, `thumbsize`, `filenames`, `show_extensions`, `subdirs`, `title`, `picdir`, `bg`, `maxwidth`, `showoriginal`, `textlink`, `titletext`, `inline` FROM `".TABLE_PREFIX."mod_imagegallery_settings` WHERE `section_id` = '$section_id'");
$settings = $query_settings->fetchRow();

$charset = DEFAULT_CHARSET;
$maxpics = $settings['maxpics'];
$thumbdir = $settings['thumbdir'];
$thumbsize = $settings['thumbsize'];
$filenames = $settings['filenames'];
$show_extensions = $settings['show_extensions'];
$subdirs = $settings['subdirs'];
$title = $settings['title'];
$picdir = $settings['picdir'];
$maxwidth = $settings['maxwidth'];
$showoriginal = $settings['showoriginal'];
$textlink = $settings['textlink'];
$included = true;
$titletext = $settings['titletext'];
$inline = $settings['inline'];
$bg = $settings['bg'];

global $words;
$words = $MOD_AIG_NOEXT['words'];

if (function_exists('ini_set')) {
	@ini_set('memory_limit', -1);
	ini_set( 'arg_separator.output' , '&amp;' );
}

$jpg = '\.jpg$|\.jpeg$|\.JPG$|\.JPEG$';
$gif = '\.gif$|\.GIF$';
$png = '\.png$|\.PNG$';
$fontsize = 2;

if(!function_exists('word')){
	function word ($word) {
		global $words;
		if (isset($word)) :
			return html($words[$word]);
		else :
			return '';
		endif;
	}
}
if(!function_exists('html')){
		function html ($word) {
		global $charset;
		//return htmlentities($word, ENT_COMPAT, $charset);
		return $word;
	}
}
if(!function_exists('error')){
		function error ($word, $arg = '') {
		global $words;
		return html(str_replace('%1', $arg, $words[$word .'_error']));
	}
}

echo "\n".'<!-- start image gallery -->'."\n";
echo '<div class="another_image_gallery_noext">'."\n";
$delim = DIRECTORY_SEPARATOR;
if (array_key_exists('dir'.$section_id, $_GET) && $subdirs) {
	$dir = str_replace('../', '', $_GET['dir'.$section_id]);
} else {
	$dir = '';
}

$dirname = WB_PATH.MEDIA_DIRECTORY.$picdir.str_replace (WB_PATH.MEDIA_DIRECTORY.$picdir, '', $dir);
$dirnamehttp = WB_URL.MEDIA_DIRECTORY.$picdir.str_replace (WB_PATH.MEDIA_DIRECTORY.$picdir, '', $dir);
$realdir = $dirname;

if ($delim == '\\') {
	$dirnamehttp = strtr($dirnamehttp, '\\', '/');
}
if (substr($dirnamehttp, 0, 2) == './') {
	$dirnamehttp = substr($dirnamehttp, 2);
}
if (empty($dirnamehttp)) {
	$dirnamehttp = '.';
}

$ti = ($subdirs && !empty($dirname)) ? ':'.$dirname :'';

if (($d = @opendir($realdir)) === false) {
	$error = error('opendir', array($realdir));
}
if (isset($error)) {
	echo '<p style="color:red;">'.$error.'</p>'."\n";
	exit;
}

if ($title) {
	echo '<h1>'.$titletext.'</h1>'."\n".'<hr />'."\n";
}
$dirs = $pics = array();
$query = $jpg;
if (function_exists('imagecreatefromgif')) {
	$query .= '|'.$gif;
}
if (function_exists('imagecreatefrompng')) {
	$query .= '|'.$png;
}

// Read the picture directory and sort by filedate:
/*while (($filename = readdir($d)) !== false) {
	if ($filename == $thumbdir || ($filename == '..' && $dirname == '') || ($filename != '..' && substr($filename, 0, 1) == '.')) {
		continue;
	}
	$file = $realdir . $delim . $filename;
	if (is_dir($file)) {
		$dirs[] = $filename;
	} elseif (preg_match("/".$query."/", $file)) {
		$pics[] = filemtime($file)."_".$filename;
	}
}
closedir($d);
sort($dirs);
sort($pics);
for($i=0;$i<count($pics);$i++){
	$pics[$i] = substr($pics[$i],11);
};
$urlsuffix = '';
*/
// Read the picture directory and sort by filename:
while (($filename = readdir($d)) !== false) {
	if ($filename == $thumbdir || ($filename == '..' && $dirname == '') || ($filename != '..' && substr($filename, 0, 1) == '.')) {
		continue;
	}
	$file = $realdir . $delim . $filename;
	if (is_dir($file)) {
		$dirs[] = $filename;
	} elseif (preg_match("/".$query."/", $file)) {
		$pics[] = $filename;
	}
}
closedir($d);
sort($dirs);
sort($pics);
$urlsuffix = '';

foreach ($_GET as $v => $r) {
	if (!in_array($v, array('dir', 'pic', 'offset'))) {
		$urlsuffix .= '&amp;'.$v.'='.urlencode($r);
	}
}
if ($included && $inline && array_key_exists('pic'.$section_id, $_GET)) {
	$pic = $_GET['pic'.$section_id];
	$url = ($dirname  == '') ? '?' : '?dir'.$section_id.'=' . urlencode($dir) . '&amp;';

	//Show pictures
	echo '<!-- start pictures -->'."\n";
	echo '<div class="pictures">'."\n";
	list($width, $height, $type, $attr) = @getimagesize(html($dirname.'/'.$pics[$pic]));
	if ($width <= $maxwidth && ($width != "" || $width == 0)) {
		/* ...do something, whatever the programmer's think... */
	} else {
		$heightadjust = $maxwidth/$width;
		$width = $maxwidth;
		$height = $heightadjust*$height;
	}
	if ($showoriginal == 1) {
		echo '<a href="'.html($dirnamehttp.'/'.$pics[$pic]).'" target="_blank">';
	}
	echo '<img src="'.html($dirnamehttp.'/'.$pics[$pic]).'" alt="'.html(basename($pics[$pic])).'" width="'.$width.'" height="'.$height.'" />';
	if ($showoriginal==1) {
		echo '</a>'."\n";
	} else {
		echo "\n" ;
	}
	echo '<hr />'."\n";

	//Generate previous/next section
	if ((array_key_exists('dir'.$section_id, $_GET)) or (array_key_exists('pic'.$section_id, $_GET))){
		$showarrows = 'yes';
	}
	$urlsuffix = str_replace('pic'.$section_id.'='.$pic,'',$urlsuffix);
	if ($showarrows == 'yes'){
		if ($pic > 0) {
			if ($textlink==1){
				echo '<a href="'.html($url).'pic'.$section_id.'='.($pic-1).html($urlsuffix).'">['.$MOD_AIG_NOEXT['PREVIOUS'].']</a>';
			} else {
				echo '<a href="'.html($url).'pic'.$section_id.'='.($pic-1).html($urlsuffix).'" title="'.$MOD_AIG_NOEXT['PREVIOUS'].'"><img src="'.WB_URL.'/modules/another_image_gallery_noext/images/left_16.png" border="0" alt="'.$MOD_AIG_NOEXT['PREVIOUS'].'" /></a>';
			}
		}
	}
	if ($pic >= $maxpics) {
		$u = $url.'offset='.floor($pic / $maxpics) * $maxpics.$urlsuffix;
	} else {
		if (array_key_exists('dir'.$section_id, $_GET)) {
			$u = substr($url, 0, strlen($url) - 1).$urlsuffix;
		} else {
			$u = preg_replace('/^([^?]+).*$/', '\1', $_SERVER['REQUEST_URI']);
			if (!empty($urlsuffix)) {
				if (strstr($u, '?') === false) {
					$u .= '?'.substr($urlsuffix, 1);
				} else {
					$u .= $urlsuffix;
				}
			}
		}
	}
	if ($showarrows == 'yes'){
		if ($textlink == 1) {
			echo '<a href="'.html($u).'">['.$MOD_AIG_NOEXT['OVERVIEW'].']</a>';
		} else {
			echo '<a href="'.html($u).'" title="'.$MOD_AIG_NOEXT['OVERVIEW'].'"><img src="'.WB_URL.'/modules/another_image_gallery_noext/images/up_16.png" border="0" alt="'.$MOD_AIG_NOEXT['OVERVIEW'].'" /></a>';
		}
		if ($pic + 1 < sizeof($pics)){
			if ($textlink == 1){
					echo '<a href="'.html($url).'pic'.$section_id.'='.($pic + 1).html($urlsuffix).'">['.$MOD_AIG_NOEXT['NEXT'].']</a>';
			} else {
					echo '<a href="'.html($url).'pic'.$section_id.'='.($pic + 1).html($urlsuffix).'" title="'.$MOD_AIG_NOEXT['NEXT'].'"><img src="'.WB_URL.'/modules/another_image_gallery_noext/images/right_16.png" border="0" alt="'.$MOD_AIG_NOEXT['NEXT'].'" /></a>';
			}
		}
	}
	echo "\n".'</div>'."\n";
	echo '<!-- end pictures -->'."\n";
} else {

	// Check for Subdirectories and list them:
	if (sizeof($dirs) > 0 && $subdirs) {
		echo '<!-- start directories -->'."\n";
		echo '<ul class="directories">'."\n";
		foreach ($dirs as $filename) {
			if (isset($rp)) {
				$target = substr(realpath($realdir.$delim.$filename), strlen($root));
			} else {
				$target = substr($dir.$delim.$filename, strlen(isset($root)));
			}
			if ($delim == '\\') {
				$target = strtr($target, '\\', '/');
			}
			if ($target == '') {
				$url = preg_replace('/^([^?]+).*$/', '\1', $_SERVER['REQUEST_URI']);
				if (!empty($urlsuffix)) {
					if (strstr($url, '?') === false) {
						$url .= '?' . substr($urlsuffix, 1);
					} else {
						$url .= $urlsuffix;
					}
				}
			} else {
				$url = '?dir'.$section_id.'='.urlencode($target);
			}
			$predir = str_replace (WB_PATH.MEDIA_DIRECTORY.$picdir, '', $dirname);
			$target2 = str_replace($dir,'',$target);
			if ($target2 == '/..' && trim($predir) == ''){
				/* ...do something, whatever the programmer's think... */
			} else {
				if ($target2 == '/..'){
					$urlsearch = array('%2F..', '%2F', '+');
					$urlreplace = array('', '/', ' ');
					$url = str_replace($urlsearch, $urlreplace, $url);
					$urllist = explode('/', $url);
					$urlcount = count($urllist);
					$urlpre = $urllist[$urlcount-1];
					$url = str_replace('/'.$urlpre, '', $url);
				}
				echo '<li><a href="'.html($url).'">'.html($filename).'</a></li>'."\n";
			}
		}
		echo '</ul>'."\n".'<hr />'."\n";
		echo '<!-- end directories -->'."\n";
	}
	if (($num = sizeof($pics)) > 0) {
		if (array_key_exists('offset'.$section_id, $_GET)) {
			$offset = $_GET['offset'.$section_id];
		} else {
			$offset = 0;
		}
		if ($num > $maxpics) {

			//generate pagenumbers
			echo '<!-- start pagenumbers -->'."\n";
			echo '<div class="pagenumbers">'."\n";
			for ($i = 0; $i < $num; $i += $maxpics) {
				$e = $i + $maxpics - 1;
				if ($e > $num - 1) {
					$e = $num - 1;
				}
				if ($i != $e) {
					$b = ($i + 1).'-'.($e + 1);
				} else {
					$b = $i + 1;
				}
				if ($i == $offset) {
					echo '<strong>'.$b.'</strong>';
				} else {
					$predir = str_replace (WB_PATH.MEDIA_DIRECTORY.$picdir, '', $dirname);
					$url = ($dirname  == '') ? '?' : '?dir'.$section_id.'=' . urlencode($predir).'&amp;';
					$urlsuffix = str_replace('offset'.$section_id.'='.$offset,"",$urlsuffix);
					echo '<a href="'.$url.'offset'.$section_id.'='.$i.html($urlsuffix).'">'.$b.'</a>';
				}
				if ($e != $num - 1) {
					echo ' |';
				}
				echo "\n" ;
			}
			echo '</div>'."\n".'<hr />'."\n";
			echo '<!-- end pagenumbers -->'."\n";
		}

		//generate preview images
		echo '<!-- start preview images -->'."\n";
		echo '<div class="pictures">'."\n";
		for ($i = 0; $i < $num; $i++) {
		//for ($i = $offset; $i < $offset + $maxpics; $i++) {
		//	if ($i >= $num) {
		//		break;
		//	}
			$filename = $pics[$i];
			$file = $realdir . $delim . $filename;
			if (!is_readable($file)) {
				continue;
			}
			if (!is_dir($realdir . $delim . $thumbdir)) {
				$u = umask(0);
				if (!@mkdir($realdir . $delim . $thumbdir, 0777)) {
					echo '<p style="color: red; text-align: center;">'.word('mkdir_error').'</p>';
					break;
				}
				umask($u);
			}
			$thumb = $realdir . $delim . $thumbdir . $delim . $filename . '.thumb.jpg';
			if (!is_file($thumb)) {
				if (preg_match("/".$jpg."/", $file)) {
					$original = @imagecreatefromjpeg($file);
				} elseif (preg_match("/".$gif."/", $file)) {
					$original = @imagecreatefromgif($file);
				} elseif (preg_match("/".$png."/", $file)) {
					$original = @imagecreatefrompng($file);
				} else {
					continue;
				}
				if ($original) {
					if (function_exists('getimagesize')) {
						list($width, $height, $type, $attr) = getimagesize($file);
						$exif = @exif_read_data($file);
						if(!empty($exif['Orientation'])) {
							switch($exif['Orientation']) {
								case 8:
									$original = imagerotate($original,90,0);
									$tmpor = $width;
									$width = $height;
									$height = $tmpor;
									break;
								case 3:
									$original = imagerotate($original,180,0);
									break;
								case 6:
									$original = imagerotate($original,-90,0);
									$tmpor = $width;
									$width = $height;
									$height = $tmpor;
									break;
							}
						}
					} else {
						continue;
					}
					if ($width >= $height && $width > $thumbsize) {
						$smallwidth = $thumbsize;
						$smallheight = floor($height / ($width / $smallwidth));
						$ofx = 0;
						$ofy = floor(($thumbsize - $smallheight) / 2);
					}
					elseif ($width <= $height && $height > $thumbsize) {
						$smallheight = $thumbsize;
						$smallwidth = floor($width / ($height / $smallheight));
						$ofx = floor(($thumbsize - $smallwidth) / 2); $ofy = 0;
					} else {
						$smallheight = $height;
						$smallwidth = $width;
						$ofx = floor(($thumbsize - $smallwidth) / 2);
						$ofy = floor(($thumbsize - $smallheight) / 2);
					}
				}
				if (function_exists('imagecreatetruecolor')) {
					$small = imagecreatetruecolor($thumbsize, $thumbsize);
				} else {
					$small = imagecreate($thumbsize, $thumbsize);
				}
				sscanf($bg, '%2x%2x%2x', $red, $green, $blue);
				$b = imagecolorallocate($small, $red, $green, $blue);
				imagefill($small, 0, 0, $b);
				if ($original) {
					if (function_exists('imagecopyresampled')) {
						imagecopyresampled($small, $original, $ofx, $ofy, 0, 0, $smallwidth, $smallheight, $width, $height);
					} else {
						imagecopyresized($small, $original, $ofx, $ofy, 0, 0, $smallwidth, $smallheight, $width, $height);
					}
				} else {
					$black = imagecolorallocate($small, 0, 0, 0);
					$fw = imagefontwidth($fontsize);
					$fh = imagefontheight($fontsize);
					$htw = ($fw * strlen($filename)) / 2;
					$hts = $thumbsize / 2;
					imagestring($small, $fontsize, $hts - $htw, $hts - ($fh / 2), $filename, $black);
					imagerectangle($small, $hts - $htw - $fw - 1, $hts - $fh, $hts + $htw + $fw - 1, $hts + $fh, $black);
				}
				imagejpeg($small, $thumb);
			}
			$showThumb = $i >= $offset && $i < ($offset + $maxpics);
			if  ($showThumb)
				echo '<span class="picturelink">';
			else
			  	echo '<span class="picturelink" style="display:none">';
			if ($included && $inline) {
				echo '<a href="?';
				if (array_key_exists('dir'.$section_id, $_GET)) {
					echo 'dir'.$section_id.'='.urlencode($_GET['dir'.$section_id]).'&amp;';
				}
				echo 'pic'.$section_id.'='.$i.html($urlsuffix).'">';
			} else {
				echo '<a class="colorbox" rel="group" href="'.html($dirnamehttp.'/'.$filename).'">';
			}
			if ($showThumb)
				echo '<img src="' . html($dirnamehttp.'/'.$thumbdir.'/'.$filename.'.thumb.jpg').'" alt="'.html($filename).'" width="'.$thumbsize.'" height="'.$thumbsize.'" />';
                        if ($filenames) {
                                $display_filename = $show_extensions ? $filename : pathinfo($filename, PATHINFO_FILENAME);
                                echo '<br /><span class="filename">'.html($display_filename).'</span>';
                        }
			echo '</a></span>'."\n";
		}
		echo '<span class="clear">&nbsp;</span>'."\n";
		echo '</div>'."\n";
		echo '<!-- end preview images -->'."\n";
	}
}
echo '</div>'."\n";
echo '<!-- end image gallery -->'."\n";
