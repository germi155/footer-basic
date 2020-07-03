<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$industry =[
    elgg_echo('contact_form:option:android') => elgg_echo('contact_form:option:android'),
    elgg_echo('contact_form:option:ios') => elgg_echo('contact_form:option:ios'),
    elgg_echo('contact_form:option:frontend') => elgg_echo('contact_form:option:frontend'),
    elgg_echo('contact_form:option:wordpress') => elgg_echo('contact_form:option:wordpress'),
    elgg_echo('contact_form:option:other') => elgg_echo('contact_form:option:other'),
];
echo '</br>';
echo elgg_echo('test:test');
echo '</br>';
echo '</br>';
echo elgg_view_field([
'#type' => 'select',
'#label' => elgg_echo('contact_form:dropdown:title'),
'name' => 'quote_type',
'options_values' => $industry,
'value' => $entity->sectorindustry,
'required' => true,
]);

echo elgg_view_field([
    '#type' => 'text',
    '#label' => elgg_echo('contact_form:field:fullname'),
    'name' => 'fullname',
    'required' => true,
]);



echo elgg_view_field([
    '#type' => 'text',
    '#label' => elgg_echo('email'),
    'name' => 'email',
    'required' => true,
]);

echo elgg_view_field([
    '#type' => 'plaintext',
    '#label' => elgg_echo('contact_form:field:body'),
    'name' => 'body',
    'required' => true,
]);
 

$submit = elgg_view_field(array(
    '#type' => 'submit',
    '#class' => 'elgg-foot',
    'value' => elgg_echo('save'),
));
elgg_set_form_footer($submit);
