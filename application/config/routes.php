<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';




$route['read-notification/(:any)']='User_notification/readNotification/$1';
$route['read-notification-store/(:any)']='Sc_Notification/readNotification/$1';

$route['checkout-payment/(:any)']='checkout_payment/index/$1';
$route['checkout-payment/(:any)/confirmation']='checkout_payment/confirmation/$1';
//Filter atau Search produk
$route['c/(:any)']='products/index/$1';

//Tentang toko dan penjual
$route['s/(:any)']='store/index/$1';
$route['s/(:any)/feedback']='store/store_feedback_list/$1';
$route['s/(:any)/label/(:any)']='store/index/$1/$2';

//Detail Produk (aktor: pembeli, penjual)
$route['p/(:any)/(:any)'] = 'product/detail/$1/$2';




//Profile




$route['my-account'] = 'profile_summary/profileSummary';
$route['my-account/profile'] = 'profile/profileEdit';
$route['my-account/address'] = 'profile_address/profileAddress';
$route['my-account/wallet'] = 'profile_wallet/profileWallet';
$route['my-account/saving-account'] = 'profile_rekening/profileRekening';
$route['my-account/wishlist'] = 'profile_wishlist/profileWishlist';
$route['my-account/notification'] = 'User_notification/all_notification';


$route['my-account/transaction'] = 'profile_transaction/profileTransactionInvoice';
$route['my-account/transaction/(:any)'] = 'profile_transaction/profileTransactionDetail/$1';
$route['my-account/transaction-split'] = 'profile_transaction/profileTransactionSingle';


$route['my-account/transaction/feedback/(:any)/reviewDelivered/(:any)'] = 'response_feedback/products/$1/$2';
$route['my-account/transaction/feedback/(:any)/product'] = 'response_feedback/product/$1';
$route['my-account/transaction/feedback/(:any)/product/(:any)'] = 'response_feedback/productSingle/$1/$2';
$route['my-account/transaction/feedback/(:any)/product/(:any)/edit'] = 'response_feedback/productSingleEdit/$1/$2';

//My Store
$route['my-store/address'] = 'seller_center/address';
$route['my-store/settings/rekening'] = 'sc_rekening/index';
$route['my-store/store'] = 'seller_center/store';
$route['my-store/store-info'] = 'seller_center/storeInfo';
$route['my-store/close-store'] = 'seller_center/closeStore';
$route['my-store/merchant-notes'] = 'seller_center/merchantNotes';
$route['my-store/store-verification'] = 'seller_center/storeVerification';
$route['my-store/edit-store-address'] = 'seller_center/editStoreAddress';
$route['my-store/notification'] = 'Sc_Notification/all_notification';




$route['my-store/register'] = 'sc_register';

$route['my-store'] = 'Sc_dashboard';

$route['my-store/transaction'] = 'sc_transaction';

$route['my-store/transaction'] = 'sc_transaction';

$route['my-store/credit'] = 'sc_credit';

$route['my-store/products'] = 'sc_products';
$route['my-store/products/new'] = 'Sc_product_new/newProduct';
$route['my-store/products/edit/(:any)'] = 'Sc_product_edit/editProduct/$1';

$route['my-store/storefront'] = 'Sc_storefront';



//My store - settings - shipping
$route['my-store/settings/shipping'] = 'Sc_settings/courierShipping';
$route['my-store/settings/shipping_schedule'] = 'Sc_settings/courierShippingSchedule';
$route['my-store/settings/shipping-courier-update'] = 'Sc_settings/shippingCourierUpdate';
$route['my-store/settings/shipping-openday-update'] = 'Sc_settings/shippingDayUpdate';
$route['my-store/settings/shipping-openhour-update'] = 'Sc_settings/shippingHourUpdate';
$route['my-store/settings/shipping-processtime-update'] = 'Sc_settings/shippingProcesstimeUpdate';

//My store - settings - address
$route['my-store/settings'] = 'Sc_settings/store';
$route['my-store/settings/general'] = 'Sc_settings/store';
$route['my-store/settings/general/information-edit'] = 'Sc_settings/storeInfo';


//My store - settings - address
$route['my-store/settings/address'] = 'Sc_settings/address';



$route['history/transaction/(:any)/p/(:any)'] = 'product_sold/detail/$1/$2';

$route['buy/(:any)/(:any)'] = 'cart/buy/$1/$2';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
