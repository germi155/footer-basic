<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$contact_username = $vars['entity']->contact_username;
?>

 <?php
	
echo elgg_view_input('text', [
    'name' => 'params[contact_username]',
    'label' => elgg_echo('contact:username:title'),
    'value' => $contact_username,
]);
?>