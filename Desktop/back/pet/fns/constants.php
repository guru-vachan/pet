<?php


 
// change to false on remote server
define('DEBUG',true,true);

# defines the constants for database tables
define('T_USER','user',true); 
define('T_REST','rest',true);
define('T_CAT','category',true);
define('T_DISH','products',true);
define('T_CUSTOMER','cuser',true);   
define('T_CUSER','cuser',true);   
define('T_AUTO_LOGIN','autologin',true);
define('T_ADD','address',true);
define('T_HOSTEL','hostel',true);
define('T_ORDER','order',true);
define('T_ORDER_DET','order_detail',true);
define('T_ORDER_STATUS','order_statuses',true);
define('T_CONTACT','contactus',true);
define('T_R_RATE','rest_rating',true);
define('T_R_REVIEW','rest_review',true);
define('T_NEW_REST','new_rest',true);
define('T_HOME_REST','rest_home',true);
define('T_COUPON','coupon',true);
define('T_COUPON_DET','coupon_det',true);
define('T_FORGOT_PASSWD','forgotpassword',true);
define('T_PARTY','party',true);
define('T_FB_USER','fb_user',true);
define('T_ADDONS','addons',true);
define('T_CAREER','careers',true);
define('T_TESTIMONY','love',true);
define('T_CAROUSEL','carousel_text',true);
define('T_BASKET','add_remove',true);
define('T_EMAIL_LIST','email_list',true);
define('T_EMAIL_EMAIL','email_email',true);
define('T_SERVE','serve',true);
define('T_ORDER_ADDONS', 'order_addons', true);

define('CID','cid',true);
define('CNAME','cname',true);
define('RNAME','rname',true);
define('NICK','nick',true);

# defines various error messages
define('E_AUTH_FAILED', 1, true);
define('E_NOT_FILLED', 2, true);
define('E_VALID_EMAIL', 3, true);
define('E_EMAIL_EXISTS', 4, true);
define('E_NO_TERMS', 5, true);
define('E_PASSWD_MATCH', 6, true);
define('E_USER_TYPE', 7, true);
define('E_SORRY', 8, true);
define('E_PASSWD_CURRENT', 9, true);
define('E_EMAIL_NO_EXISTS', 10, true);
define('E_SUCCESS_UPDATE', 11, true);
define('E_NOT_IMAGE', 12, true);
define('E_EXCEED_SIZE', 13, true);
define('E_NO_IMAGE', 14, true);
define('E_REMOVE_CONNECTION', 15, true);
define('E_ADD_CONNECTION', 16, true);
define('E_SUBMIT_FEEDBACK', 17, true);
define('E_SUBMIT_COMPLAINT', 18, true);
define('E_NO_DISH', 19, true);
define('E_NO_VENDOR', 20, true);
define('E_VALID_MOB', 21, true);
define('E_VALID_HOSTEL', 22, true);
define('E_THANKS', 23, true);
define('E_SAME_ALT_MOB', 24, true);
define('E_COUPON_EXPIRE', 25, true);

# constants kept as session variable to pass the errors between the files
define('C_LOGIN','loginerror', true);
define('C_SIGNUP','signuperror', true);
define('C_PASSWD_ERROR', 'changePasswordError', true);
define('C_PASSWD_RESET', 'resetPasswordError', true);
define('C_RESET_PASSWD', 'resetpasswdemail', true);
define('C_CONTACT', 'updatecontact', true);
define('C_TIEUPS', 'updatetieups', true);
define('C_LOGO', 'updatelogo', true);
define('C_INITIATIVES', 'updateinitiatives', true);
define('C_DISHES', 'updatedishes', true);
define('C_CONNECTIONS', 'orgconnections', true);
define('C_FEEDBACK', 'feedback', true);
define('C_COMPLAINT', 'complaints', true);
define('C_DISH_INTAKE', 'dishintake', true);
define('C_ADD', 'address', true);
define('C_REST', 'restaurant', true);
define('C_NEW_REST', 'restaurant', true);
define('C_PARTY', 'party', true);
define('C_CONFIRM', 'order_confirm', true);
define('C_CAREER','careersform',true);
define('C_TESTIMONY','lovetestimony',true);

define('MSG_PROFILE','profilemessage', true);
define('S_PASSWD',0,true);

define('MAX_LOGIN_ATTEMPTS',100, true);

define('BASKET','basket',true);
define('NUM','num',true);
define('NAME','name',true);
define('COST','cost',true);
define('SHIP','ship',true);	//shipping address
define('SPOONS','spoons',true);
define('DISCOUNT','discount',true);
define('DAYS','days',true);
define('DISCOUNT_VALUE','discount_value',true);
define('COUPON','coupon',true);
define('INR','0',true);
define('PERCENTAGE','1',true);
define('COKES','cokes',true);
define('VAT','vat',true);
define('STAX','stax',true);
define('TYPE','type',true);
define('RID','rid',true);
define('PRID','rpid',true);
define('DESC','desc',true);
define('VEG','veg',true);
define('PRIORITY','priority',true);
define('ORDERS','orders',true);
define('STATUS','status',true);
define('ADDED','added',true);
define('ITEM','item',true);
define('DELIVERY_CHARGE_NO_MIN',200,true);
define('DELIVERY_CHARGE',30,true);
define('LITTLE_BASKET_RATE',5,true);
define('ADDONS', 'addons', true);


define('S_INACTIVE', 0, true);
define('S_REST', 1, true);
define('S_CAKES', 2, true);

# defines groups for users
define('G_ADMIN', 0, true);
define('G_CUSTOMER', 1, true);
define('G_CUSER', 1, true);
define('G_ORGANIZATION', 2, true);
define('G_MANUFACTURER', 3, true);
define('G_VENDOR', 4, true);
define('G_DIETITIAN', 5, true);

#services off
define('SERVICES',true,true);

define('U_PENDING',0,true);
define('U_CONFIRM',1,true);
define('U_SEEN',10,true);
define('U_LOGO',"/assets/img/profile/",true);

define('O_NEW',0,true);
define('O_SEEN',1,true);
define('O_REST',2,true);
define('O_WAY',3,true);
define('O_DELIVERED',4,true);
define('O_CANCEL',5,true);
define('O_FAKE',6,true);
define('O_ALL',10,true);

define('FB_APP_ID','443819082389941',true);
define('FB_APP_SECRET','166fb969f9b07d63b4d35518c0e6e5f2', true);

define('M_ORDER_PLACED','order_placed',true);
define('M_CONTACT_US','contact_us',true);

?>