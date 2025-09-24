<?php

$router->get('/','HomeController@index');

$router->get('/auth/register','UserController@create',['guest']);
$router->get('/auth/login','UserController@login',['guest']);
$router->get('/user/account-settings','UserController@account_settings',['auth']);
$router->get('/auth/signout','UserController@signout',['auth']);
$router->get('/user/add-property-type','UserController@addPropertyType',['auth']);
$router->get('/user/add-property-location','UserController@addPropertyLocation',['auth']);
$router->get('/user/add-property-photos','UserController@addPropertyPhotos',['auth']);
$router->get('/user/add-property-details','UserController@addPropertyDetails',['auth']);
$router->get('/user/add-property-price','UserController@addPropertyPrice',['auth']);
$router->get('/user/add-property-contact','UserController@addPropertyContact',['auth']);
$router->get('/user/add-property-accept-terms','UserController@addPropertyTerms',['auth']);
$router->get('/user/account-payment','UserController@account_payment',['auth']);
$router->get('/user/account-profile','UserController@account_profile',['auth']);
$router->get('/user/account-listings','UserController@account_listings',['auth']);
$router->get('/user/account-helpCenter','UserController@account_helpCenter',['auth']);



$router->get('/listings/{id}','ListingController@show',['guest']);
$router->get('/listings/vendor/{id}', 'ListingController@vendor',['guest']);

$router->get('/listings','ListingController@showAll',['guest']);



$router->get('/admin/auth/login','AdminController@showlogin');
$router->get('/admin/account-settings','AdminController@account_settings');
$router->get('/admin/account-profile','AdminController@account_profile');
$router->get('/admin/account-listings','AdminController@account_listings');
$router->get('/admin/account-helpCenter','AdminController@account_helpCenter');
$router->get('/admin/auth/signout','AdminController@signout');










$router->post('/auth/register','UserController@store',['guest']);
$router->post('/auth/login','UserController@authenticate',['guest']);
$router->post('/user/account-settings','UserController@account_info',['auth']);
$router->post('/admin/auth/login','AdminController@login');
$router->post('/admin/account-settings','AdminController@account_info');
$router->post('/admin/delete-user','AdminController@delete_user');
$router->post('/listings/schedule-tour','ListingController@scheduleTour',['guest']);
$router->post('/listings/contact-realtor','ListingController@contactRealtor',['guest']);






$router->put('/user/add-property-type','UserController@savePropertyType',['auth']);
$router->put('/user/add-property-location','UserController@savePropertyLocation',['auth']);
$router->put('/user/add-property-photos','UserController@savePropertyPhotos',['auth']);
$router->put('/user/add-property-details','UserController@savePropertyDetails',['auth']);
$router->put('/user/add-property-price','UserController@savePropertyPrice',['auth']);
$router->put('/user/add-property-contact','UserController@savePropertyContact',['auth']);
$router->put('/user/add-property-accept-terms','UserController@savePropertyTerms',['auth']);
$router->put('/user/save-card','UserController@saveCard',['auth']);
$router->put('/user/save-paypal','UserController@savePaypal',['auth']);


$router->delete('/user/delete-card','UserController@deleteCard',['auth']);
$router->delete('/user/delete-listing','UserController@delete_listing',['auth']);