<?php
/**
 *	Elgg Shortcodes integration
 *	Author : Mohammed Aqeel | Team Webgalli
 *	Team Webgalli | Elgg developers and consultants
 *	Mail : info@webgalli.com
 *	Web	: http://webgalli.com
 *	Skype : 'team.webgalli'
 *	@package Collections of Shortcodes for Elgg
 *	Licence : GNU2
 *	Copyright : Team Webgalli 2011-2015
 */ 
elgg_register_event_handler('init', 'system', 'galliShortcodes_init');

function galliShortcodes_init() {
	$root = dirname(__FILE__);
	// Short code processing library (from Wordpress)
	elgg_register_library('elgg:shortcodes', "$root/lib/shortcodes.php");	
	elgg_load_library('elgg:shortcodes');
	// Short code collections 
	elgg_register_library('elgg:galliShortcodes', "$root/lib/galliShortcodes.php");	
	elgg_load_library('elgg:galliShortcodes');
	// Extend JS and CSS for shortcode support
	elgg_extend_view('js/elgg', 'galliShortcodes/js');
	elgg_extend_view('css/elgg', 'galliShortcodes/css');
	// Process the shortcodes
	$views = array('output/longtext','river/item');
	foreach($views as $view){
		elgg_register_plugin_hook_handler("view", $view, "elgg_shortcode_filter", 1000);
	}	
	// Some plugin functions
	elgg_register_plugin_hook_handler('register', 'menu:longtext', 'shortcodes_longtext_menu');	
	elgg_register_page_handler('shortcodes', 'shortcodes_page_handler');
}

function elgg_shortcode_filter($hook, $entity_type, $returnvalue, $params){
	return elgg_do_shortcode($returnvalue);
}	

function shortcodes_longtext_menu($hook, $type, $items, $vars) {
	$url = 'shortcodes';
	$items[] = ElggMenuItem::factory(array(
		'name' => 'shortcodes',
		'href' => $url,
		'text' => elgg_echo('shortcodes:link'),
		'rel' => 'lightbox',
		'link_class' => "elgg-longtext-control elgg-lightbox",
		'priority' => 50,
	));
	elgg_load_js('lightbox');
	elgg_load_css('lightbox');
	return $items;
}
/**
 * Popup the content for the shortcodes help lightbox
 * @param array $page URL segments
 */
function shortcodes_page_handler($page) {
	echo elgg_view('galliShortcodes/list');
	exit;
}