<?php
/*$titlebar = "All Site My_Blogs";
$pagetitle = "List of all my_blogs";

$body = elgg_list_entities(array(
    'type' => 'object',
    'subtype' => 'contact_form',
));

$body = elgg_view_title($pagetitle) . elgg_view_layout('one_column', array('content' => $body));

echo elgg_view_page($titlebar, $body);*/
elgg_gatekeeper();
elgg_admin_gatekeeper();
function contact_form_get_page_content_list($container_guid = NULL) {

	$return = array();

	$return['filter_context'] = $container_guid ? 'mine' : 'all';

	$options = array(
		'type' => 'object',
		'subtype' => 'contact_form',
		'full_view' => false,
		'no_results' => elgg_echo('contact_form:none'),
		'preload_owners' => true,
		'distinct' => false,
	);

	$current_user = elgg_get_logged_in_user_entity();

	if ($container_guid) {
		// access check for closed groups
		//elgg_group_gatekeeper();

		$container = get_entity($container_guid);
		if ($container instanceof ElggGroup) {
		$options['container_guid'] = $container_guid;
		} else {
			$options['owner_guid'] = $container_guid;
		}
		$return['title'] = elgg_echo('elggpress:title:userblogs', array($container->name));

		$crumbs_title = $container->name;
		//elgg_push_breadcrumb($crumbs_title);

		if ($current_user && ($container_guid == $current_user->guid)) {
			$return['filter_context'] = 'mine';
		} else if (elgg_instanceof($container, 'group')) {
			$return['filter'] = false;
		} else {
			// do not show button or select a tab when viewing someone else's posts
			$return['filter_context'] = 'none';
		}
	} else {
		$options['preload_containers'] = true;
		$return['filter_context'] = 'all';
		$return['title'] = elgg_echo('contact_form:all');
		//elgg_pop_breadcrumb();
		//elgg_push_breadcrumb(elgg_echo('elggpress:blogs'));
	}

	//elgg_register_title_button('posts', 'add', 'object', 'posts');

	$return['content'] = elgg_list_entities($options);

	return $return;
}

$page_type = elgg_extract('page_type', $vars);

$params = contact_form_get_page_content_list();

//$params['sidebar'] = elgg_view('elggpress/sidebar', ['page' => $page_type]);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($params['title'], $body);