<?php

/**
 * Delete action
 *
 * @package hypeJunction
 * @subpackage actions_delete
 *
 * @author Ismayil Khayredinov <info@hypejunction.com>
 */

elgg_register_event_handler('init', 'system', 'actions_delete_init');

/**
 * Initialize
 * @return void
 */
function actions_delete_init() {

	elgg_register_action('delete', __DIR__ . '/actions/delete.php');
	elgg_register_plugin_hook_handler('route', 'delete', 'actions_delete_route_hook');
}

/**
 * Route /delete handler to delete action
 * @return array
 */
function actions_delete_route_hook($hook, $type, $return, $params) {

	$segments = elgg_extract('segments', $params, array());
	$guid = elgg_extract(0, $segments);
	set_input('guid', $guid);

	return array(
		'identifier' => 'action',
		'handler' => 'action',
		'segments' => array('delete')
	);
}

