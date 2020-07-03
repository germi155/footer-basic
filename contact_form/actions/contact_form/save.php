<?php
$ia = elgg_set_ignore_access(true);
elgg_set_ignore_access(true);
// get the form inputs
$title = get_input('quote_type');
$fullname = get_input('fullname');
$email = get_input('email');
$body = get_input('body');
//$tags = string_to_tag_array(get_input('tags'));

// create a new my_blog object and put the content in it
$contact_form = new ElggObject();
$contact_form->title = $title;
$contact_form->fullname = $fullname;
$contact_form->email = $email;
$contact_form->description = $body;

$contact_username = elgg_get_plugin_setting('contact_username','contact_form');


// the object can and should have a subtype
$contact_form->subtype = 'contact_form';

// for now, make all my_blog posts public
$contact_form->access_id = 2;
$user = get_user_by_username($contact_username);
// owner is logged in user
$contact_form->owner_guid = $user->guid;

// save to database and get id of the new my_blog
$contact_guid = $contact_form->save();

// if the my_blog was saved, we want to display the new post
// otherwise, we want to register an error and forward back to the form
if ($contact_guid) {
   system_message("Your request was sent");
   forward($site_url);
} else {
   register_error("The post could not be saved.");
   forward(REFERER); // REFERER is a global variable that defines the previous page
}