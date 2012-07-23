<?php
/**
 *	Elgg Shortcodes integration
 *	Author : Mohammed Aqeel | Team Webgalli
 *	Team Webgalli | Elgg developers and consultants
 *	Mail : info [at] webgalli [dot] com
 *	Web	: http://webgalli.com
 *	Skype : 'team.webgalli'
 *	@package Collections of Shortcodes for Elgg
 *	Licence : GNU2
 *	Copyright : Team Webgalli 2011-2015
 */ 
 
/**
 * Pdf embedding
 * Usage: [embedpdf width="600px" height="500px"]http://infolab.stanford.edu/pub/papers/google.pdf[/embedpdf]
 */
function embed_pdf_function($attr, $url) {
   extract(shortcode_atts(array(
       'width' => '640',
       'height' => '480'
   ), $attr));
   return '<iframe src="http://docs.google.com/viewer?url=' . $url . '&embedded=true" style="width:' .$width. '; height:' .$height. ';">Your browser does not support iframes</iframe>';
}
elgg_add_shortcode('embedpdf', 'embed_pdf_function');

/**
 * Show Charts 
 * Usage : [chart data="41.52,37.79,20.67,0.03" bg="F7F9FA" labels="Reffering+sites|Search+Engines|Direct+traffic|Other" colors="058DC7,50B432,ED561B,EDEF00" size="488x200" title="Traffic Sources" type="pie"]
 */ 
function chart_shortcode( $atts ) {
	extract(elgg_shortcode_atts(array(
	    'data' => '',
	    'colors' => '',
	    'size' => '400x200',
	    'bg' => 'ffffff',
	    'title' => '',
	    'labels' => '',
	    'advanced' => '',
	    'type' => 'pie'
	), $atts));
	switch ($type) {
		case 'line' :
			$charttype = 'lc'; break;
		case 'xyline' :
			$charttype = 'lxy'; break;
		case 'sparkline' :
			$charttype = 'ls'; break;
		case 'meter' :
			$charttype = 'gom'; break;
		case 'scatter' :
			$charttype = 's'; break;
		case 'venn' :
			$charttype = 'v'; break;
		case 'pie' :
			$charttype = 'p3'; break;
		case 'pie2d' :
			$charttype = 'p'; break;
		default :
			$charttype = $type;
		break;
	}
	if ($title) $string .= '&chtt='.$title.'';
	if ($labels) $string .= '&chl='.$labels.'';
	if ($colors) $string .= '&chco='.$colors.'';
	$string .= '&chs='.$size.'';
	$string .= '&chd=t:'.$data.'';
	$string .= '&chf='.$bg.'';
	return '<img title="'.$title.'" src="http://chart.apis.google.com/chart?cht='.$charttype.''.$string.$advanced.'" alt="'.$title.'" />';
}
elgg_add_shortcode('chart', 'chart_shortcode');

/**
 * Get snaps of webpages
 * Usage : [snap url="http://www.webgalli.com" alt="My description" w="400" h="300"]
 */ 
function webpage_snaps($atts, $content = null) {
        extract(elgg_shortcode_atts(array(
			"snap" => 'http://s.wordpress.com/mshots/v1/',
			"url" => 'http://www.catswhocode.com',
			"alt" => 'My image',
			"w" => '400', // width
			"h" => '300' // height
        ), $atts));
		$img = '<img src="' . $snap . '' . urlencode($url) . '?w=' . $w . '&h=' . $h . '" alt="' . $alt . '"/>';
        return $img;
}
elgg_add_shortcode("snap", "webpage_snaps");

/**
 * Google Maps
 * Usage : [googlemap width="600" height="300" src="http://maps.google.com/maps?q=Heraklion,+Greece&hl=en&ll=35.327451,25.140495&spn=0.233326,0.445976& sll=37.0625,-95.677068&sspn=57.161276,114.169922& oq=Heraklion&hnear=Heraklion,+Greece&t=h&z=12"]
 */
function googlemap_function($atts, $content = null) {
   extract(elgg_shortcode_atts(array(
      "width" => '640',
      "height" => '480',
      "src" => ''
   ), $atts));
   return '<iframe width="'.$width.'" height="'.$height.'" src="'.$src.'&output=embed" ></iframe>';
}
elgg_add_shortcode("googlemap", "googlemap_function");

/**
 * Google Maps
 * Usage : [youtube value="http://www.youtube.com/watch?v=1aBSPn2P9bg"]
 * Optional attributes: width, height, name, allowFullScreen, allowScriptAccess, controls  
 */
function youtube($atts) {
    extract(elgg_shortcode_atts(array(
        "value" => 'http://',
        "width" => '475',
        "height" => '350',
        "name"=> 'movie',
        "allowFullScreen" => 'true',
        "allowScriptAccess"=>'always',
        "controls"=> '1',
    ), $atts));
    return '<object style="height: '.$height.'px; width: '.$width.'px"><param name="'.$name.'" value="'.$value.'"><param name="allowFullScreen" value="'.$allowFullScreen.'"><param name="allowScriptAccess" value="'.$allowScriptAccess.'"><embed src="'.$value.'" type="application/x-shockwave-flash" allowfullscreen="'.$allowFullScreen.'" allowScriptAccess="'.$allowScriptAccess.'" width="'.$width.'" height="'.$height.'"></object>';
}
elgg_add_shortcode("youtube", "youtube");