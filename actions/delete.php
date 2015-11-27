<?php

$guid = get_input('guid');
$entity = get_entity($guid);

if (!$entity instanceof ElggEntity) {
	register_error(elgg_echo('actions:delete:item_not_found'));
	forward(REFERRER);
}

if (is_callable(array($entity, 'canDelete'))) {
	if (!$entity->canDelete()) {
		register_error(elgg_echo('actions:delete:permission_denied'));
		forward(REFERRER);
	}
} else if (!$entity->canEdit()) {
	register_error(elgg_echo('actions:delete:permission_denied'));
	forward(REFERRER);
}

set_time_limit(0);

// determine what name to show on success
$display_name = $entity->getDisplayName();
if (!$display_name) {
	$display_name = elgg_echo('actions:delete:item');
}

$type = $entity->getType();
$subtype = $entity->getSubtype();
$container = $entity->getContainerEntity();

if ($entity->delete()) {
	// determine forward URL
	$forward_url = get_input('forward');
	if (!$forward_url) {
		$forward_url = REFERRER;
		$referrer_url = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		if ($referrer_url) {
			$segments = explode('/', parse_url($referrer_url, PHP_URL_PATH));
			if (in_array($entity->guid, $segments)) {
				// referrer URL contains a reference to the entity that will be deleted
				$forward_url = ($container) ? $container->getURL() : '';
			}
		} else if ($container) {
			$forward_url = $container->getURL() ? : '';
		}
	}

	$success_keys = array(
		"actions:delete:$type:$subtype:success",
		"actions:delete:$type:success",
		"actions:delete:success",
	);

	foreach ($success_keys as $success_key) {
		if (elgg_language_key_exists($success_key)) {
			system_message(elgg_echo($success_key, array($display_name)));
			break;
		}
	}
	forward($forward_url);
} else {
	register_error(elgg_echo('actions:delete:error'));
	forward(REFERRER);
}