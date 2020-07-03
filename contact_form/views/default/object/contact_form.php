<?php
/**
 * View for blog objects
 *
 * @package Blog
 */

$full = elgg_extract('full_view', $vars, FALSE);
$contact_form = elgg_extract('entity', $vars, FALSE);

if (!$contact_form) {
	return TRUE;
}

$owner = $contact_form->getOwnerEntity();
$categories = elgg_view('output/categories', $vars);
$excerpt = $contact_form->email;
if (!$excerpt) {
	$excerpt = elgg_get_excerpt($contact_form->description);
}

$owner_icon = elgg_view_entity_icon($owner, 'tiny');

$vars['owner_url'] = "contact_form/owner/$owner->username";
$by_line = elgg_view('page/elements/by_line', $vars);

	$comments_link = '';


$subtitle = "$by_line $comments_link $categories";

$request_received = elgg_echo('contact_form:content');
$name_received = elgg_echo('contact_form:fullname');
$email_received = elgg_echo('contact_form:email');

$metadata = '';
if (!elgg_in_context('widgets')) {
	// only show entity menu outside of widgets
	$metadata = elgg_view_menu('entity', array(
		'entity' => $vars['entity'],
		'handler' => 'contact_form',
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
	));
}

if ($full) {
    
    $body =<<<__HTML
                
                    <h2>$name_received</h2>
                
__HTML;
    $body.= elgg_view('output/text', array(
		'value' => $contact_form->fullname,
		'class' => 'blog-contact_form',
	));

        $body.=<<<__HTML
                </br></br>
                    <h2>$request_received</h2>
__HTML;
	$body.= elgg_view('output/longtext', array(
		'value' => $contact_form->description,
		'class' => 'blog-contact_form',
	));
        
        $body.=<<<__HTML
                 </br></br>
                    <h2>$email_received</h2>
                 
__HTML;
        
        $body.= elgg_view('output/text', array(
		'value' => $contact_form->email,
		'class' => 'blog-contact_form',
	));

	$params = array(
		'entity' => $contact_form,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	echo elgg_view('object/elements/full', array(
		'entity' => $contact_form,
		'summary' => $summary,
		'icon' => $owner_icon,
		'body' => $body,
	));

} else {
	// brief view

	$params = array(
		'entity' => $contact_form,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $excerpt,
		'icon' => $owner_icon,
	);
	$params = $params + $vars;
	echo elgg_view('object/elements/summary', $params);

}
