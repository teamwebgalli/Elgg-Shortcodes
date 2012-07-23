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
	
	elgg_register_plugin_hook_handler("view", "all", "elgg_shortcode_filter", 1);
}
function elgg_shortcode_filter($hook, $entity_type, $returnvalue, $params){
	return elgg_do_shortcode($returnvalue);
}	