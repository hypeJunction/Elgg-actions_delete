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
	elgg_register_action('entity/delete', __DIR__ . '/actions/entity/delete.php');
}
