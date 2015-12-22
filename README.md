Delete Action
=============
![Elgg 1.11](https://img.shields.io/badge/Elgg-1.11.x-orange.svg?style=flat-square)
![Elgg 1.12](https://img.shields.io/badge/Elgg-1.12.x-orange.svg?style=flat-square)
![Elgg 2.x](https://img.shields.io/badge/Elgg-2.x-orange.svg?style=flat-square)

Generic delete action controller

## Usage

```php
echo elgg_view('output/url', array(
	'text' => elgg_view_icon('delete'),
	'href' => '/action/entity/delete?guid=123",
	'is_action' => true,
));
```

You can alternatively add a forward URL:

```php
$action_url = elgg_http_add_url_query_elements('/action/entity/delete', array(
	'guid' => 456,
	'forward_url' => '/path/to/forward/to',
));
```