<?php

// register an initializer
elgg_register_event_handler('init', 'system', 'contact_form_init');

function contact_form_init() {
    // register the save action
    elgg_register_action("contact_form/save", __DIR__ . "/actions/contact_form/save.php", "public");

    // register the page handler
    elgg_register_page_handler('contact_form', 'contact_form_page_handler');

    // register a hook handler to override urls
    elgg_register_plugin_hook_handler('entity:url', 'object', 'contact_form_set_url');
    if(!elgg_is_logged_in()){
    $item = new ElggMenuItem('contact_form', elgg_echo('contact_form:menu'), 'contact_form/add');
    elgg_register_menu_item('site', $item);
    }
    
    if(elgg_is_admin_logged_in()){
    $item = new ElggMenuItem('contact_form', elgg_echo('contact_form:view'), 'contact_form/all');
    elgg_register_menu_item('site', $item);
    }
    
}


function contact_form_set_url($hook, $type, $url, $params) {
    $entity = $params['entity'];
    if (elgg_instanceof($entity, 'object', 'contact_form')) {
        return "contact_form/view/{$entity->guid}";
    }
}

function contact_form_page_handler($segments) {
   switch ($segments[0]) {
        case 'add':
           echo elgg_view_resource('contact_form/add');
           break;

        case 'view':
            $resource_vars['guid'] = elgg_extract(1, $segments);
            echo elgg_view_resource('contact_form/view', $resource_vars);
            break;

        case 'all':
        default:
           echo elgg_view_resource('contact_form/all');
           break;
    }

    return true;
}