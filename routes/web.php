<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/404', 'PagenotfoundController');
Route::get('/test', 'TestController');

/*
 * Frontend
 */

Route::group(['namespace' => 'Frontend'], function () {

    Route::get('/{slug}.html', 'Static_pagesController');

    Route::get('/rateme/{token}', 'RatemeController@index');
    Route::post('/rateme/{token}', 'RatemeController@store');

    Route::get('/register', 'RegisterController@index');
    Route::post('/register', 'RegisterController@store');

    Route::get('/', 'IndexController');
    Route::get('/back', function () {
        return redirect('/');
    });

    //    Route::get('/success', 'SuccessController');

    Route::get('{providername}/{agenda}.html', 'ProfilesController@index');

    Route::post('/search', 'SearchController@minedata');
    Route::get('/search/filter', 'SearchController@filter');
    Route::get('/search', 'SearchController@index');

    Route::post('/join', 'JoinController@store');
    Route::get('/join', 'JoinController@index');
    Route::get('/join/{plan}', 'JoinController@selected');

    Route::group(['middleware' => ['customer']], function () {
        Route::post('{providername}/{agenda}.html', 'ProfilesController@select_service_category');
        Route::post('{providername}/{agenda}/slot.html', 'ProfilesController@select_slot');
        Route::post('{providername}/{agenda}/confirm.html', 'ProfilesController@confirm_appointment');
        Route::post('{providername}/{agenda}/process.html', 'ProfilesController@process_appointment');
        Route::get('{providername}/{reference}/thank-you.html', 'ProfilesController@success');
    });
});

// logout
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// js / css admin
Route::get('js/autofetch.js', 'jsController@autofetch');
Route::get('js/msbfunctions.js', 'jsController@msbfunctions');
Route::get('js/modal.js', 'jsController@modal');

/*
- Sign and Accept
*/

Route::group(['namespace' => 'Signandaccept'], function () {
    Route::group(['prefix' => 'signandaccept'], function () {
        Route::post('/accept/{token}', 'SignatureController@process');
        Route::get('/success', 'SignatureController@success');
        Route::get('/accept/{token?}', function () {
            return redirect('signandaccept/');
        });
        Route::get('/{token?}', 'SignatureController@index');
        Route::post('/{token?}', 'SignatureController@preview');
    });
});

/*
- SMS Delivery, Status Update and Call
*/

// sms delivery status
Route::any('/inboundcall', 'Inbound_callController');
Route::any('/smsdelivery', 'Inbound_sms_deliveryController');
Route::any('/inboundsms', 'Inbound_sms_newController');
Route::any('/calldelivery', 'Call_statusController');
Route::get('/xml/{xml}', 'XmlController');

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', function () {
    return redirect('route_login');
});

// public documents
Route::get('/documents/invoice/{thumbprint}', 'DocumentsController@invoice');
Route::get('/documents/quotation/{thumbprint}', 'DocumentsController@quotation');
Route::get('/documents/credit_note/{thumbprint}', 'DocumentsController@credit_note');
Route::get('/documents/payment/{thumbprint}', 'DocumentsController@payment');
Route::get('/documents/cash_receipt/{thumbprint}', 'DocumentsController@cash_receipt');

/*
- Payments
*/

Route::group(['namespace' => 'Payments'], function () {
    Route::group(['prefix' => 'payment'], function () {

        Route::get('/add-funds/bank-payment/{profileid?}', 'Bank_paymentsController');

        Route::get('/add-funds/paypal/status', 'PaypalController@getPaymentStatus');
        Route::get('/add-funds/paypal/{profileid?}', 'PaypalController@index');
        Route::post('/add-funds/paypal/{profileid?}', 'PaypalController@store');

        Route::get('/add-funds/stripe/{profileid?}', 'StripeController@index');
        Route::post('/add-funds/stripe/{profileid?}', 'StripeController@store');

    });
});

// route login
Route::get('route_login', 'Route_loginController');

Route::group(['middleware' => ['auth']], function () {

    /*
     * ALL of the following routes may ONLY be accessed by administrators
     */

    Route::group(['namespace' => 'Admin'], function () {
        Route::group(['prefix' => 'admin'], function () {

            Route::get('/', function () {
                return redirect('admin/dashboard');
            });

            // upgrade
            Route::get('upgrade', 'UpgradeController@view');
            Route::patch('upgrade', 'UpgradeController@upgrade');

            // cache_clear
            Route::get('cache_clear', 'Clear_configurationsController@view');
            Route::patch('cache_clear', 'Clear_configurationsController@clear');

            // dashboard
            Route::get('dashboard', 'DashboardController');

            // profiles
            Route::get('profiles', 'ProfilesController@index');
            Route::post('profiles', 'ProfilesController@store');
            Route::get('profiles/create', 'ProfilesController@create');
            Route::get('profiles/search', 'ProfilesController@search');
            //Route::get('profiles/taxfields', 'ProfilesController@taxfields');
            Route::get('profiles/{profile}/ajaxreload', 'ProfilesController@ajaxreload');
            Route::get('profiles/{profile}/linksubscription/{reload}', 'ProfilesController@linksubscription');
            Route::post('profiles/{profile}/linksubscription', 'ProfilesController@linksubscription_process');
            Route::get('profiles/{profile}/changeplan/{reload}', 'ProfilesController@changeplan');
            Route::post('profiles/{profile}/changeplan', 'ProfilesController@changeplan_process');
            Route::get('profiles/{profile}/edit', 'ProfilesController@edit');
            Route::delete('profiles/{profile}/cancel', 'ProfilesController@cancel');
            Route::get('profiles/{profile}', 'ProfilesController@show');
            Route::patch('profiles/{profile}', 'ProfilesController@update');
            //Route::delete('profiles/{profile}', 'ProfilesController@destroy');

            // profile serviceoptions
            Route::get('profiles/{profile}/serviceoptions', 'ProfilesController@serviceoptions');

            // profile billing
            Route::patch('{profile}/profile_billing', 'Profile_billingController@update');
            Route::get('{profile}/profile_billing/edit', 'Profile_billingController@edit');

            // users
            Route::get('{profile}/users/create/{reload}', 'UsersController@create');
            Route::patch('{profile}/users/{user}', 'UsersController@update');
            Route::delete('{profile}/users/{user}', 'UsersController@destroy');
            Route::get('{profile}/users/{user}/edit/{reload}', 'UsersController@edit');
            Route::get('{profile}/users', 'UsersController@index');
            Route::post('{profile}/users', 'UsersController@store');

            Route::get('{profile}/user_contact_numbers/{contact_number}/edit', 'User_contact_numbersController@edit');
            Route::patch('{profile}/user_contact_numbers/{contact_number}', 'User_contact_numbersController@update');
            Route::get('{profile}/user_contact_numbers/{user}/create', 'User_contact_numbersController@create');
            Route::post('{profile}/user_contact_numbers/{user}', 'User_contact_numbersController@store');
            Route::delete('{profile}/user_contact_numbers/{contact_number}', 'User_contact_numbersController@destroy');

            Route::get('{profile}/users/{user}/send_mail', 'UsersController@send_mail');
            Route::post('{profile}/users/{user}/send_mail', 'UsersController@process_mail');
            Route::get('{profile}/users/{user}/send_sms/{contact}', 'UsersController@send_sms');
            Route::post('{profile}/users/{user}/send_sms/{contact}', 'UsersController@process_sms');
            Route::get('{profile}/users/{user}/send_sms', 'UsersController@send_sms');
            Route::post('{profile}/users/{user}/send_sms', 'UsersController@process_sms');

            // professionals
            Route::get('{profile}/professionals/create/{reload}', 'ProfessionalsController@create');
            Route::patch('{profile}/professionals/{user}', 'ProfessionalsController@update');
            Route::delete('{profile}/professionals/{user}', 'ProfessionalsController@destroy');
            Route::get('{profile}/professionals/{user}/edit/{reload}', 'ProfessionalsController@edit');
            Route::get('{profile}/professionals', 'ProfessionalsController@index');
            Route::post('{profile}/professionals', 'ProfessionalsController@store');

            Route::get('{profile}/professionals/{user}/send_mail', 'ProfessionalsController@send_mail');
            Route::post('{profile}/professionals/{user}/send_mail', 'ProfessionalsController@process_mail');
            Route::get('{profile}/professionals/{user}/send_sms', 'ProfessionalsController@send_sms');
            Route::post('{profile}/professionals/{user}/send_sms', 'ProfessionalsController@process_sms');

            Route::get('{profile}/professionals/{user}/linkbranch', 'ProfessionalsController@link_branch');
            Route::patch('{profile}/professionals/{user}/linkbranch', 'ProfessionalsController@link_branch_process');
            Route::delete('{profile}/professionals/{user}/revoke_branch/{branch}', 'ProfessionalsController@revoke_branch');

            // receptions
            Route::get('{profile}/receptions/create/{reload}', 'ReceptionsController@create');
            Route::patch('{profile}/receptions/{user}', 'ReceptionsController@update');
            Route::delete('{profile}/receptions/{user}', 'ReceptionsController@destroy');
            Route::get('{profile}/receptions/{user}/edit/{reload}', 'ReceptionsController@edit');
            Route::get('{profile}/receptions', 'ReceptionsController@index');
            Route::post('{profile}/receptions', 'ReceptionsController@store');

            Route::get('{profile}/receptions/{user}/send_mail', 'ReceptionsController@send_mail');
            Route::post('{profile}/receptions/{user}/send_mail', 'ReceptionsController@process_mail');
            Route::get('{profile}/receptions/{user}/send_sms', 'ReceptionsController@send_sms');
            Route::post('{profile}/receptions/{user}/send_sms', 'ReceptionsController@process_sms');

            // branches
            Route::get('{profile}/branches/create', 'BranchesController@create');
            Route::patch('{profile}/branches/{branch}', 'BranchesController@update');
            Route::delete('{profile}/branches/{branch}', 'BranchesController@destroy');
            Route::get('{profile}/branches/{branch}', 'BranchesController@view');
            Route::get('{profile}/branches/{branch}/edit', 'BranchesController@edit');
            Route::get('{profile}/branches', 'BranchesController@index');
            Route::post('{profile}/branches', 'BranchesController@store');

            Route::get('{profile}/quotations', 'ProfilesController@quotations');
            Route::get('{profile}/invoices', 'ProfilesController@invoices');
            Route::get('{profile}/credit_notes', 'ProfilesController@credit_notes');
            Route::get('{profile}/payments', 'ProfilesController@payments');
            Route::get('{profile}/payment_transactions', 'ProfilesController@payment_transactions');
            Route::get('{profile}/subscriptions', 'ProfilesController@subscriptions');
            Route::get('{profile}/agendas', 'ProfilesController@agendas');
            Route::post('{profile}/airtime/buy', 'ProfilesController@airtime_buy_process');
            Route::get('{profile}/airtime/buy', 'ProfilesController@airtime_buy');
            Route::get('{profile}/airtime', 'ProfilesController@airtime');

//            // profile agendas
//            Route::get('{profile}/agendas/create/', 'AgendasController@create');
//            Route::patch('{profile}/agendas/{agenda}', 'AgendasController@update');
//            Route::get('{profile}/agendas/{agenda}/edit/', 'AgendasController@edit');
//            Route::delete('{profile}/agendas/{agenda}', 'AgendasController@destroy');
//            Route::post('{profile}/agendas', 'AgendasController@store');

            // appointment_text_notifications
            Route::patch('appointment_text_notifications/{branch}/edit/{notification}', 'Appointment_text_notificationsController@update');
            Route::get('appointment_text_notifications/{branch}/edit/{notification}', 'Appointment_text_notificationsController@edit');
            Route::delete('appointment_text_notifications/{branch}/delete/{notification}', 'Appointment_text_notificationsController@destroy');
            Route::post('appointment_text_notifications/{branch}', 'Appointment_text_notificationsController@store');
            Route::get('appointment_text_notifications/{branch}/create', 'Appointment_text_notificationsController@create');
            Route::get('appointment_text_notifications/{branch}', 'Appointment_text_notificationsController@index');

            // appointment_call_notifications
            Route::patch('appointment_call_notifications/{branch}/edit/{notification}', 'Appointment_call_notificationsController@update');
            Route::get('appointment_call_notifications/{branch}/edit/{notification}', 'Appointment_call_notificationsController@edit');
            Route::delete('appointment_call_notifications/{branch}/delete/{notification}', 'Appointment_call_notificationsController@destroy');
            Route::post('appointment_call_notifications/{branch}', 'Appointment_call_notificationsController@store');
            Route::get('appointment_call_notifications/{branch}/create', 'Appointment_call_notificationsController@create');
            Route::get('appointment_call_notifications/{branch}', 'Appointment_call_notificationsController@index');

            // scheduled_text_notifications
            Route::patch('scheduled_text_notifications/{branch}/edit/{notification}', 'Scheduled_text_notificationsController@update');
            Route::get('scheduled_text_notifications/{branch}/edit/{notification}', 'Scheduled_text_notificationsController@edit');
            Route::delete('scheduled_text_notifications/{branch}/delete/{notification}', 'Scheduled_text_notificationsController@destroy');
            Route::post('scheduled_text_notifications/{branch}', 'Scheduled_text_notificationsController@store');
            Route::get('scheduled_text_notifications/{branch}/create', 'Scheduled_text_notificationsController@create');
            Route::get('scheduled_text_notifications/{branch}', 'Scheduled_text_notificationsController@index');

            // scheduled_call_notifications
            Route::patch('scheduled_call_notifications/{branch}/edit/{notification}', 'Scheduled_call_notificationsController@update');
            Route::get('scheduled_call_notifications/{branch}/edit/{notification}', 'Scheduled_call_notificationsController@edit');
            Route::delete('scheduled_call_notifications/{branch}/delete/{notification}', 'Scheduled_call_notificationsController@destroy');
            Route::post('scheduled_call_notifications/{branch}', 'Scheduled_call_notificationsController@store');
            Route::get('scheduled_call_notifications/{branch}/create', 'Scheduled_call_notificationsController@create');
            Route::get('scheduled_call_notifications/{branch}', 'Scheduled_call_notificationsController@index');

            // did_numbers
            Route::delete('{profile}/did_number/{branch}/release/{did}', 'Branch_didsController@release');
            Route::post('{profile}/did_number/{branch}', 'Branch_didsController@store');
            Route::get('{profile}/did_number/{branch}/purchase', 'Branch_didsController@purchase');
            Route::get('{profile}/did_number/{branch}', 'Branch_didsController@index');

            // admin users
            Route::get('users/create', 'Admin_usersController@create');
            Route::patch('users/{user}', 'Admin_usersController@update');
            Route::delete('users/{user}', 'Admin_usersController@destroy');
            Route::get('users/{user}/edit', 'Admin_usersController@edit');
            Route::get('users', 'Admin_usersController@index');
            Route::post('users', 'Admin_usersController@store');

            Route::get('user_contact_numbers/{contact_number}/edit', 'Admin_user_contact_numbersController@edit');
            Route::patch('user_contact_numbers/{contact_number}', 'Admin_user_contact_numbersController@update');
            Route::get('user_contact_numbers/{user}/create', 'Admin_user_contact_numbersController@create');
            Route::post('user_contact_numbers/{user}', 'Admin_user_contact_numbersController@store');
            Route::delete('user_contact_numbers/{contact_number}', 'Admin_user_contact_numbersController@destroy');

            Route::get('users/{user}/send_mail', 'Admin_usersController@send_mail');
            Route::post('users/{user}/send_mail', 'Admin_usersController@process_mail');
            Route::get('users/{user}/send_sms/{contact}', 'Admin_usersController@send_sms');
            Route::post('users/{user}/send_sms/{contact}', 'Admin_usersController@process_sms');
            Route::get('users/{user}/send_sms', 'Admin_usersController@send_sms');
            Route::post('users/{user}/send_sms', 'Admin_usersController@process_sms');

            // address_billings
            Route::get('profiles/{profile}/address_billings', 'Profile_address_billingsController@index');
            Route::post('profiles/{profile}/address_billings', 'Profile_address_billingsController@store');
            Route::get('profiles/{profile}/address_billings/create/{reload}', 'Profile_address_billingsController@create');
//                //Route::get('profiles/{profile}/address_billings/{address}', 'Profile_address_billingsController@show');
            Route::patch('profiles/{profile}/address_billings/{address}', 'Profile_address_billingsController@update');
            Route::delete('profiles/{profile}/address_billings/{address}', 'Profile_address_billingsController@destroy');
            Route::get('profiles/{profile}/address_billings/{address}/edit/{reload}', 'Profile_address_billingsController@edit');
            Route::post('profiles/{profile}/address_billings/{address}/setasdefault', 'Profile_address_billingsController@setasdefault');

            // address_shippings
            Route::get('profiles/{profile}/address_shippings', 'Profile_address_shippingsController@index');
            Route::post('profiles/{profile}/address_shippings', 'Profile_address_shippingsController@store');
            Route::get('profiles/{profile}/address_shippings/create/{reload}', 'Profile_address_shippingsController@create');
//                //Route::get('profiles/{profile}/address_shippings/{address}', 'Profile_address_shippingsController@show');
            Route::patch('profiles/{profile}/address_shippings/{address}', 'Profile_address_shippingsController@update');
            Route::delete('profiles/{profile}/address_shippings/{address}', 'Profile_address_shippingsController@destroy');
            Route::get('profiles/{profile}/address_shippings/{address}/edit/{reload}', 'Profile_address_shippingsController@edit');
            Route::post('profiles/{profile}/address_shippings/{address}/setasdefault', 'Profile_address_shippingsController@setasdefault');

            // app_settings
            Route::get('app_settings', 'App_settingsController@index');
            Route::patch('app_settings', 'App_settingsController@update');

            // static_pages
            Route::get('cms', 'Static_pagesController@index');
            Route::get('cms/create', 'Static_pagesController@create');
            Route::get('cms/{slug}', 'Static_pagesController@edit');
            Route::patch('cms/{slug}', 'Static_pagesController@update');
            Route::post('cms', 'Static_pagesController@store');
            Route::delete('cms/{slug}', 'Static_pagesController@delete');

            // system_notification_builder
            Route::get('system_notification_builder', 'System_notification_builderController@index');
            Route::patch('system_notification_builder', 'System_notification_builderController@update');

            // system profile
            Route::get('profile_settings', 'System_profileController@index');
            Route::patch('profile_settings', 'System_profileController@update');

            // system did
            Route::get('system_did', 'System_didController@index');
            Route::get('system_did/create', 'System_didController@create');
            Route::post('system_did/{did}/release', 'System_didController@release');
            Route::post('system_did', 'System_didController@store');

            // app settings / system packages
            Route::get('service_packages/{package}/show', 'Subscription_packagesController@show');
            Route::get('service_packages/{package}/edit', 'Subscription_packagesController@edit');
            Route::patch('service_packages/{package}/update', 'Subscription_packagesController@update');
            Route::delete('service_packages/{package}', 'Subscription_packagesController@destroy');
            Route::get('service_packages/create', 'Subscription_packagesController@create');
            Route::get('service_packages', 'Subscription_packagesController@index');
            Route::post('service_packages', 'Subscription_packagesController@store');

            // app_settings / app_sms_configuration
            Route::get('sms_provider_configurations/create', 'App_sms_configurationsController@create');
            Route::patch('sms_provider_configurations/{configuration}', 'App_sms_configurationsController@update');
            Route::get('sms_provider_configurations/{configuration}/edit', 'App_sms_configurationsController@edit');
            Route::get('sms_provider_configurations/{configuration}/validate_connection', 'App_sms_configurationsController@validate_connection');
            Route::post('sms_provider_configurations/{configuration}/validate_connection', 'App_sms_configurationsController@validate_connection_process');
            Route::delete('sms_provider_configurations/{configuration}', 'App_sms_configurationsController@destroy');
            Route::post('sms_provider_configurations/{configuration}/setasdefault', 'App_sms_configurationsController@setasdefault');
            Route::post('sms_provider_configurations/{configuration}/sync', 'App_sms_configurationsController@sync');
            Route::get('sms_provider_configurations', 'App_sms_configurationsController@index');
            Route::post('sms_provider_configurations', 'App_sms_configurationsController@store');

            // app_settings / sv_gateway_providers
            Route::get('sv_gateway_providers/{configuration}/buy_numbers', 'Sv_gateway_providersController@buy_number');
            Route::post('sv_gateway_providers/{configuration}/buy_numbers', 'Sv_gateway_providersController@buy_number_process');
            Route::post('sv_gateway_providers/{configuration}/buy_numbers_purchase', 'Sv_gateway_providersController@buy_number_purchase');
            Route::get('sv_gateway_providers/{configuration}/cancel_numbers', 'Sv_gateway_providersController@cancel_numbers');
            Route::post('sv_gateway_providers/{configuration}/cancel_numbers', 'Sv_gateway_providersController@cancel_number');


            // app_settings / app_sms_charge
            Route::patch('sms_provider_charge_configuration', 'App_sms_chargesController@update');
            Route::get('sms_provider_charge_configuration', 'App_sms_chargesController@index');

            // app_settings / app_sms_did_numbers
            Route::patch('sms_did_numbers/{number}', 'App_sms_did_numbersController@update');
            Route::get('sms_did_numbers/{number}/validate', 'App_sms_did_numbersController@prevalidate');
            Route::get('sms_did_numbers/{number}/edit', 'App_sms_did_numbersController@edit');
            Route::delete('sms_did_numbers/{number}', 'App_sms_did_numbersController@destroy');
            Route::get('sms_did_numbers', 'App_sms_did_numbersController@index');

            // app_settings / app_email_settings
            Route::patch('app_email_settings', 'App_email_settingsController@update');
            Route::get('app_email_settings', 'App_email_settingsController@index');

            // app_settings / tax configuration
            Route::patch('tax_configurations/{configuration}/assign', 'Tax_configurationsController@assign_process');
            Route::get('tax_configurations/{configuration}/assign', 'Tax_configurationsController@assign');
            Route::get('tax_configurations/create', 'Tax_configurationsController@create');
            Route::patch('tax_configurations/{configuration}', 'Tax_configurationsController@update');
            Route::get('tax_configurations/{configuration}/edit', 'Tax_configurationsController@edit');
            Route::delete('tax_configurations/{configuration}', 'Tax_configurationsController@destroy');
            Route::get('tax_configurations', 'Tax_configurationsController@index');
            Route::post('tax_configurations', 'Tax_configurationsController@store');

            // app_settings / payment gateway
            Route::get('payment_gateways/create', 'Payment_gatewaysController@create');
            Route::patch('payment_gateways/{gateway}', 'Payment_gatewaysController@update');
            Route::get('payment_gateways/{gateway}/edit', 'Payment_gatewaysController@edit');
            Route::delete('payment_gateways/{gateway}', 'Payment_gatewaysController@destroy');
            Route::post('payment_gateways/{gateway}/enable', 'Payment_gatewaysController@enable');
            Route::post('payment_gateways/{gateway}/disable', 'Payment_gatewaysController@disable');
            Route::get('payment_gateways', 'Payment_gatewaysController@index');
            Route::post('payment_gateways', 'Payment_gatewaysController@store');

            // app_settings / service categories
            Route::get('service_categories/create', 'Service_categoriesController@create');
            Route::patch('service_categories/{category}', 'Service_categoriesController@update');
            Route::get('service_categories/{category}/edit', 'Service_categoriesController@edit');
            Route::delete('service_categories/{category}', 'Service_categoriesController@destroy');
            Route::get('service_categories', 'Service_categoriesController@index');
            Route::post('service_categories', 'Service_categoriesController@store');

            // app_settings / service items
            Route::get('service_items/create', 'Service_itemsController@create');
            Route::patch('service_items/{item}', 'Service_itemsController@update');
            Route::get('service_items/{item}/edit', 'Service_itemsController@edit');
            Route::delete('service_items/{item}', 'Service_itemsController@destroy');
            Route::get('service_items', 'Service_itemsController@index');
            Route::post('service_items', 'Service_itemsController@store');

            // app_settings / category_divisions
            Route::get('category_divisions/create', 'Category_divisionsController@create');
            Route::patch('category_divisions/{category}', 'Category_divisionsController@update');
            Route::get('category_divisions/{category}/edit', 'Category_divisionsController@edit');
            Route::delete('category_divisions/{category}', 'Category_divisionsController@destroy');
            Route::get('category_divisions', 'Category_divisionsController@index');
            Route::post('category_divisions', 'Category_divisionsController@store');

            // app_settings / child_categories
            Route::get('child_categories/create', 'Child_categoriesController@create');
            Route::patch('child_categories/{category}', 'Child_categoriesController@update');
            Route::get('child_categories/{category}/edit', 'Child_categoriesController@edit');
            Route::delete('child_categories/{category}', 'Child_categoriesController@destroy');
            Route::get('child_categories', 'Child_categoriesController@index');
            Route::post('child_categories', 'Child_categoriesController@store');

            // contract templates
            Route::get('contract_templates/create', 'Contract_templatesController@create');
            Route::patch('contract_templates/{template}', 'Contract_templatesController@update');
            Route::get('contract_templates/{template}/edit', 'Contract_templatesController@edit');
            Route::delete('contract_templates/{template}', 'Contract_templatesController@destroy');
            Route::get('contract_templates', 'Contract_templatesController@index');
            Route::post('contract_templates', 'Contract_templatesController@store');

            // contracts
            Route::get('contracts/create/{template}', 'ContractsController@create');
            Route::patch('contracts/{contract}', 'ContractsController@update');
            Route::get('contracts/{contract}/edit', 'ContractsController@edit');
            Route::delete('contracts/{contract}/revoke_signature_request', 'ContractsController@revoke_signature_request');
            Route::delete('contracts/{contract}', 'ContractsController@destroy');
            Route::get('contracts', 'ContractsController@index');
            Route::get('contracts/template/{template}', 'ContractsController@contractsbytemplate');
            Route::get('contracts/{contract}/pdf/{action}', 'ContractsController@pdf');
            Route::get('contracts/{contract}/email', 'ContractsController@email');
            Route::post('contracts/{contract}/email', 'ContractsController@email_process');
            Route::get('contracts/{contract}/electronic_signature_request', 'ContractsController@electronic_signature_request');
            Route::post('contracts/{contract}/electronic_signature_request', 'ContractsController@electronic_signature_request_process');
            Route::get('contracts/{contract}', 'ContractsController@view');
            Route::post('contracts/{template}', 'ContractsController@store');

            // static contracts
            Route::post('static_contracts/upload', 'Static_contractsController@upload');
            Route::get('static_contracts/view/{file}', 'Static_contractsController@view');
            Route::get('static_contracts/download/{file}', 'Static_contractsController@download');
            Route::get('static_contracts/email/{contract}', 'Static_contractsController@email');
            Route::post('static_contracts/email/{contract}', 'Static_contractsController@email_process');
            Route::delete('static_contracts/{contract}/revoke_signature_request', 'Static_contractsController@revoke_signature_request');
            Route::get('static_contracts/{contract}/electronic_signature_request', 'Static_contractsController@electronic_signature_request');
            Route::post('static_contracts/{contract}/electronic_signature_request', 'Static_contractsController@electronic_signature_request_process');
            Route::delete('static_contracts/{contract}', 'Static_contractsController@destroy');
            Route::get('static_contracts', 'Static_contractsController@index');

            // media manager
            Route::delete('media_manager/delete/{file}', 'Media_managerController@delete');
            Route::get('media_manager/link_email_attachment/{filename}', 'Media_managerController@link_email_attachment');
            Route::post('media_manager/link_email_attachment', 'Media_managerController@process_email_attachment');
            Route::delete('media_manager/revoke_attachment/{attachment}', 'Media_managerController@revoke_attachment');
            Route::post('media_manager/{directory?}', 'Media_managerController@upload');
            Route::get('media_manager/{category?}', 'Media_managerController@index');

            // media manager category
            Route::get('media_manager_categories/create/{category?}', 'Media_manager_categoriesController@create');
            Route::post('media_manager_categories/create', 'Media_manager_categoriesController@store');
            Route::get('media_manager_categories/edit/{category}', 'Media_manager_categoriesController@edit');
            Route::patch('media_manager_categories/edit/{category}', 'Media_manager_categoriesController@update');
            Route::get('media_manager_categories', 'Media_manager_categoriesController@list_categories');
            Route::delete('media_manager_categories/delete/{category}', 'Media_manager_categoriesController@delete');

            // media item
            Route::get('media_items/create', 'Media_itemsController@create');
            Route::post('media_items/create', 'Media_itemsController@store');
            Route::delete('media_items/delete/{category}', 'Media_itemsController@delete');
            Route::delete('media_items/{category}', 'Media_itemsController@delete');

            // app_settings / myaccount
            Route::patch('myaccount', 'My_accountController@update');
            Route::get('myaccount', 'My_accountController@index');

            // app_settings / mypassword
            Route::patch('mypassword', 'My_passwordController@update');
            Route::get('mypassword', 'My_passwordController@index');

            // app_settings / myavatar
            Route::patch('myavatar', 'My_avatarController@update');
            Route::get('myavatar', 'My_avatarController@index');

            // app_settings / validate email
            Route::post('validate_email', 'Validate_emailController@store');
            Route::get('validate_email', 'Validate_emailController@index');

            // app_settings / contract templates
            Route::get('email_templates/{template}', 'Email_templatesController@show');
            Route::patch('email_templates/{template}', 'Email_templatesController@update');
            //Route::get('email_templates/{contract}/edit/{reload}', 'Email_templatesController@edit');
            //Route::delete('email_templates/{contract}', 'Email_templatesController@destroy');
            Route::get('email_templates', 'Email_templatesController@index');
            //Route::post('email_templates', 'Email_templatesController@store');

            // ajaxdata **> ajax only
            Route::get('ajaxdata/relation/{relation}', 'AjaxdataController@relation');
            Route::get('ajaxdata/inbound_sms_messages/{instance}/read', 'AjaxdataController@inbound_sms_messages_update');
            Route::get('ajaxdata/inbound_sms_messages', 'AjaxdataController@inbound_sms_messages');
            Route::get('ajaxdata/unrouted_inbound_sms_messages/{instance}/read', 'AjaxdataController@unrouted_inbound_sms_messages_update');
            Route::get('ajaxdata/unrouted_inbound_sms_messages', 'AjaxdataController@unrouted_inbound_sms_messages');
            Route::get('ajaxdata/system_errors', 'AjaxdataController@system_errors');
            Route::get('ajaxdata/read_notifications/{instance}/read', 'AjaxdataController@read_notifications_update');
            Route::get('ajaxdata/read_notifications', 'AjaxdataController@read_notifications');
            Route::get('ajaxdata/profile_customer_search/{profile}', 'AjaxdataController@profile_customer_search_view');
            Route::get('ajaxdata/profile_customer_search', 'AjaxdataController@profile_customer_search');
            Route::get('ajaxdata/profile_customer_user_search', 'AjaxdataController@profile_customer_user_search');
            Route::get('ajaxdata/customer_search_view/{profile}/{customer}', 'AjaxdataController@customer_search_view');
            Route::get('ajaxdata/customer_search/{profile}', 'AjaxdataController@customer_search');


            // customers

            Route::get('customer_contact_numbers/{contact_number}/edit', 'Customer_contact_numbersController@edit');
            Route::patch('customer_contact_numbers/{contact_number}', 'Customer_contact_numbersController@update');
            Route::get('customer_contact_numbers/{customer}/create', 'Customer_contact_numbersController@create');
            Route::post('customer_contact_numbers/{customer}', 'Customer_contact_numbersController@store');
            Route::delete('customer_contact_numbers/{contact_number}', 'Customer_contact_numbersController@destroy');

            Route::get('customer_billing_address/{address}/edit', 'Customer_address_billingsController@edit');
            Route::patch('customer_billing_address/{address}', 'Customer_address_billingsController@update');
            Route::get('customer_billing_address/{customer}/create', 'Customer_address_billingsController@create');
            Route::post('customer_billing_address/{customer}', 'Customer_address_billingsController@store');
            Route::post('customer_billing_address/{address}/setasdefault', 'Customer_address_billingsController@setasdefault');
            Route::delete('customer_billing_address/{address}', 'Customer_address_billingsController@destroy');

            Route::get('customer_shipping_address/{address}/edit', 'Customer_address_shippingsController@edit');
            Route::patch('customer_shipping_address/{address}', 'Customer_address_shippingsController@update');
            Route::get('customer_shipping_address/{customer}/create', 'Customer_address_shippingsController@create');
            Route::post('customer_shipping_address/{customer}', 'Customer_address_shippingsController@store');
            Route::post('customer_shipping_address/{address}/setasdefault', 'Customer_address_shippingsController@setasdefault');
            Route::delete('customer_shipping_address/{address}', 'Customer_address_shippingsController@destroy');

            Route::get('customers/search', 'CustomersController@search');
//                Route::patch('customers/{quotation}/build', 'CustomersController@update');
            Route::post('customers/create', 'CustomersController@store');
            Route::get('customers/create', 'CustomersController@create');
            Route::get('customers/{customer}/quotations', 'CustomersController@quotations');
            Route::get('customers/{customer}/invoices', 'CustomersController@invoices');
            Route::get('customers/{customer}/credit_notes', 'CustomersController@credit_notes');
            Route::get('customers/{customer}/payments', 'CustomersController@payments');
            Route::get('customers/{customer}/payment_transactions', 'CustomersController@payment_transactions');
            Route::get('customers/{customer}/subscriptions', 'CustomersController@subscriptions');
            Route::get('customers/{customer}/edit', 'CustomersController@edit');
            Route::patch('customers/{customer}', 'CustomersController@update');
            Route::get('customers/{customer}', 'CustomersController@show');
            Route::get('customers', 'CustomersController@index');

            Route::get('customers/{customer}/send_mail', 'CustomersController@send_mail');
            Route::post('customers/{customer}/send_mail', 'CustomersController@process_mail');
            Route::get('customers/{customer}/send_sms/{contact}', 'CustomersController@send_sms');
            Route::post('customers/{customer}/send_sms/{contact}', 'CustomersController@process_sms');
            Route::get('customers/{customer}/send_sms', 'CustomersController@send_sms');
            Route::post('customers/{customer}/send_sms', 'CustomersController@process_sms');

            // quotations
            Route::get('quotations/search', 'QuotationsController@search');
            Route::post('quotations/{quotation}/add_item', 'QuotationsController@ajax_add_item_process');
            Route::get('quotations/{quotation}/buildlinks', 'QuotationsController@buildlinks');
            Route::get('quotations/{quotation}/add_item', 'QuotationsController@ajax_add_item');
            Route::get('quotations/{quotation}/items', 'QuotationsController@ajax_list_items');
            Route::delete('quotations/{quotation}/items/{item}/remove', 'QuotationsController@ajax_remove_item');
            Route::patch('quotations/{quotation}/build', 'QuotationsController@update'); //*****************************
            Route::get('quotations/{quotation}/build', 'QuotationsController@build');
            Route::get('quotations/{quotation}/preview', 'QuotationsController@preview');
            Route::get('quotations/{quotation}/download', 'QuotationsController@preview');
            Route::delete('quotations/{quotation}/request_signature', 'QuotationsController@request_signature');
            Route::delete('quotations/{quotation}/revoke_signature_request', 'QuotationsController@revoke_signature_request');
            Route::delete('quotations/{quotation}/quotationtoinvoice', 'QuotationsController@quotationtoinvoice');
            Route::delete('quotations/{quotation}/email', 'QuotationsController@preview');
            Route::get('quotations/create/{customer}', 'QuotationsController@create');
            Route::post('quotations/create', 'QuotationsController@store');
            Route::get('quotations/create', 'QuotationsController@create');
            Route::get('quotations', 'QuotationsController@index');

            // invoices
            Route::get('invoices/search', 'InvoicesController@search');
            Route::post('invoices/{invoice}/add_item', 'InvoicesController@ajax_add_item_process');
            Route::get('invoices/{invoice}/buildlinks', 'InvoicesController@buildlinks');
            Route::get('invoices/{invoice}/add_item', 'InvoicesController@ajax_add_item');
            Route::get('invoices/{invoice}/items', 'InvoicesController@ajax_list_items');
            Route::delete('invoices/{invoice}/items/{item}/remove', 'InvoicesController@ajax_remove_item');
            Route::patch('invoices/{invoice}/build', 'InvoicesController@update');
            Route::get('invoices/{invoice}/build', 'InvoicesController@build');
            Route::get('invoices/{invoice}/preview', 'InvoicesController@preview');
            Route::get('invoices/{invoice}/download', 'InvoicesController@preview');
            Route::delete('invoices/{invoice}/email', 'InvoicesController@preview');
            Route::delete('invoices/{invoice}/lockinvoice', 'InvoicesController@lockinvoice');
            Route::delete('invoices/{invoice}/cashreceipt', 'InvoicesController@cashreceipt');
            Route::get('invoices/create/{customer}', 'InvoicesController@create');
            Route::post('invoices/create', 'InvoicesController@store');
            Route::get('invoices/create', 'InvoicesController@create');
            Route::get('invoices', 'InvoicesController@index');

            // custom invoice fields
            Route::delete('custom_invoice_fields/{field}', 'Custom_invoice_fieldsController@destroy');
            Route::patch('custom_invoice_fields/{field}/edit', 'Custom_invoice_fieldsController@update');
            Route::get('custom_invoice_fields/{field}/edit', 'Custom_invoice_fieldsController@edit');
            Route::post('custom_invoice_fields/create', 'Custom_invoice_fieldsController@store');
            Route::get('custom_invoice_fields/create', 'Custom_invoice_fieldsController@create');
            Route::get('custom_invoice_fields', 'Custom_invoice_fieldsController@index');

            // credit notes
            Route::get('credit_notes/search', 'Credit_notesController@search');
            Route::get('credit_notes/{credit_note}/buildlinks', 'Credit_notesController@buildlinks');
            Route::patch('credit_notes/{credit_note}/build', 'Credit_notesController@update');
            Route::get('credit_notes/{credit_note}/build', 'Credit_notesController@build');
            Route::get('credit_notes/{credit_note}/preview', 'Credit_notesController@preview');
            Route::get('credit_notes/{credit_note}/download', 'Credit_notesController@preview');
            Route::delete('credit_notes/{credit_note}/email', 'Credit_notesController@preview');
            Route::delete('credit_notes/{credit_note}/lock', 'Credit_notesController@lock');
            Route::get('credit_notes/create/{customer}', 'Credit_notesController@create');
            Route::get('credit_notes/create', 'Credit_notesController@create');
            Route::post('credit_notes/create', 'Credit_notesController@store');
            Route::get('credit_notes', 'Credit_notesController@index');

            // subscriptions
            Route::get('subscriptions/{subscription}/add_item', 'SubscriptionsController@ajax_add_item');
            Route::post('subscriptions/{subscription}/add_item', 'SubscriptionsController@ajax_add_item_process');
            Route::get('subscriptions/{subscription}/items', 'SubscriptionsController@ajax_list_items');
            Route::delete('subscriptions/{subscription}/items/{item}/remove', 'SubscriptionsController@ajax_remove_item');
            Route::get('subscriptions/search', 'SubscriptionsController@search');
            Route::get('subscriptions/{subscription}/buildlinks', 'SubscriptionsController@buildlinks');
            Route::patch('subscriptions/{subscription}/build', 'SubscriptionsController@update');
            Route::get('subscriptions/{subscription}/build', 'SubscriptionsController@build');
            Route::delete('subscriptions/{subscription}/activate', 'SubscriptionsController@activate');
            Route::delete('subscriptions/{subscription}/cancel', 'SubscriptionsController@cancel');
            Route::get('subscriptions/create/{customer}', 'SubscriptionsController@create');
            Route::get('subscriptions/create', 'SubscriptionsController@create');
            Route::post('subscriptions/create', 'SubscriptionsController@store');
            Route::get('subscriptions', 'SubscriptionsController@index');

            // payments
            Route::get('payments/search', 'PaymentsController@search');
            Route::get('payments/{payment}/buildlinks', 'PaymentsController@buildlinks');
            Route::patch('payments/{payment}/build', 'PaymentsController@update');
            Route::get('payments/{payment}/build', 'PaymentsController@build');
            Route::get('payments/{payment}/preview', 'PaymentsController@preview');
            Route::get('payments/{payment}/download', 'PaymentsController@preview');
            Route::delete('payments/{payment}/email', 'PaymentsController@preview');
            Route::delete('payments/{payment}/lock', 'PaymentsController@lock');
            Route::get('payments/create/{customer}', 'PaymentsController@create');
            Route::get('payments/create', 'PaymentsController@create');
            Route::post('payments/create', 'PaymentsController@store');
            Route::get('payments', 'PaymentsController@index');

            // payment transaction
            Route::get('payment_transactions/{payment}', 'Payment_transactionsController');

            // profile tax configuration
            Route::patch('{profile}/profile_tax_configurations/{configuration}/assign', 'Profile_tax_configurationsController@assign_process');
            Route::get('{profile}/profile_tax_configurations/{configuration}/assign', 'Profile_tax_configurationsController@assign');
            Route::get('{profile}/profile_tax_configurations/create', 'Profile_tax_configurationsController@create');
            Route::patch('{profile}/profile_tax_configurations/{configuration}', 'Profile_tax_configurationsController@update');
            Route::get('{profile}/profile_tax_configurations/{configuration}/edit', 'Profile_tax_configurationsController@edit');
            Route::delete('{profile}/profile_tax_configurations/{configuration}', 'Profile_tax_configurationsController@destroy');
            Route::get('{profile}/profile_tax_configurations', 'Profile_tax_configurationsController@index');
            Route::post('{profile}/profile_tax_configurations', 'Profile_tax_configurationsController@store');

            // profile payment gateway
            Route::get('{profile}/profile_payment_gateways/create/', 'Profile_payment_gatewaysController@create');
            Route::patch('{profile}/profile_payment_gateways/{gateway}', 'Profile_payment_gatewaysController@update');
            Route::get('{profile}/profile_payment_gateways/{gateway}/edit/', 'Profile_payment_gatewaysController@edit');
            Route::delete('{profile}/profile_payment_gateways/{gateway}', 'Profile_payment_gatewaysController@destroy');
            Route::post('{profile}/profile_payment_gateways/{gateway}/enable', 'Profile_payment_gatewaysController@enable');
            Route::post('{profile}/profile_payment_gateways/{gateway}/disable', 'Profile_payment_gatewaysController@disable');
            Route::get('{profile}/profile_payment_gateways', 'Profile_payment_gatewaysController@index');
            Route::post('{profile}/profile_payment_gateways', 'Profile_payment_gatewaysController@store');

            // profile did
            Route::get('{profile}/profile_did_numbers', 'Profile_didsController@index');
            Route::get('{profile}/profile_did_numbers/create/{reload}', 'Profile_didsController@create');
            Route::post('{profile}/profile_did_numbers/{did}/release', 'Profile_didsController@release');
            Route::post('{profile}/profile_did_numbers', 'Profile_didsController@store');

            // profile reports
            Route::get('{profile}/profile_reports', 'Profile_reportsController@index');
        });
    });

});

Route::group(['prefix' => 'customer'], function () {

    Route::get('/', function () {
        return redirect('/');
    });
    // ------------------------------------------------------------- dit gaan nie werk nie, want moet na gate redirect om in te kan log

    Route::group(['namespace' => 'Customer'], function () {
        Route::group(['middleware' => ['customer']], function () {

            // topup
            Route::get('topup/{profile}', 'TopupController');

            // dashboard
            Route::get('/dashboard', function () {
                return redirect('/');
            });
            // myaccount
            Route::patch('myaccount', 'My_accountController@update');
            Route::get('myaccount', 'My_accountController@index');

            // mypassword
            Route::patch('mypassword', 'My_passwordController@update');
            Route::get('mypassword', 'My_passwordController@index');

            // ajax data
            Route::get('ajaxdata/read_notifications/{instance}/read', 'AjaxdataController@read_notifications_update');
            Route::get('ajaxdata/read_notifications', 'AjaxdataController@read_notifications');

            Route::get('{thumbprint}/quotations', 'Provider_documentsController@quotations');
            Route::get('{thumbprint}/invoices', 'Provider_documentsController@invoices');
            Route::get('{thumbprint}/credit_notes', 'Provider_documentsController@credit_notes');
            Route::get('{thumbprint}/payments', 'Provider_documentsController@payments');
            Route::get('{thumbprint}/payment_transactions', 'Provider_documentsController@payment_transactions');
            Route::get('{thumbprint}/subscriptions', 'Provider_documentsController@subscriptions');

            // addresses

            Route::get('address_management', 'Address_managementController');

            Route::get('customer_contact_numbers/{contact_number}/edit', 'Contact_numbersController@edit');
            Route::patch('customer_contact_numbers/{contact_number}', 'Contact_numbersController@update');
            Route::get('customer_contact_numbers/{customer}/create', 'Contact_numbersController@create');
            Route::post('customer_contact_numbers/{customer}', 'Contact_numbersController@store');
            Route::delete('customer_contact_numbers/{contact_number}', 'Contact_numbersController@destroy');
            Route::get('customer_contact_numbers', 'Contact_numbersController@index');

            Route::get('customer_billing_address/{address}/edit', 'Billing_addressesController@edit');
            Route::patch('customer_billing_address/{address}', 'Billing_addressesController@update');
            Route::get('customer_billing_address/{customer}/create', 'Billing_addressesController@create');
            Route::post('customer_billing_address/{customer}', 'Billing_addressesController@store');
            Route::post('customer_billing_address/{address}/setasdefault', 'Billing_addressesController@setasdefault');
            Route::delete('customer_billing_address/{address}', 'Billing_addressesController@destroy');

            Route::get('customer_shipping_address/{address}/edit', 'Shipping_addressesController@edit');
            Route::patch('customer_shipping_address/{address}', 'Shipping_addressesController@update');
            Route::get('customer_shipping_address/{customer}/create', 'Shipping_addressesController@create');
            Route::post('customer_shipping_address/{customer}', 'Shipping_addressesController@store');
            Route::post('customer_shipping_address/{address}/setasdefault', 'Shipping_addressesController@setasdefault');
            Route::delete('customer_shipping_address/{address}', 'Shipping_addressesController@destroy');

        });
    });

    Route::get('/home', function () {
        return redirect('/customer/dashboard');
    });

    Route::get('/login', 'CustomerAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'CustomerAuth\LoginController@login');

    Route::post('/password/email', 'CustomerAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'CustomerAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'CustomerAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'CustomerAuth\ResetPasswordController@showResetForm');

});

Route::group(['prefix' => 'profilecontrol'], function () {

    Route::group(['namespace' => 'Profilecontrol'], function () {
        Route::group(['middleware' => ['profilecontrol']], function () {

            // professional profile
            Route::patch('public_profile', 'Public_profilesController@update');
            Route::get('public_profile', 'Public_profilesController@index');

            // upgrade / downgrade
            Route::post('change_subscription', 'UpgradesController@store');
            Route::get('change_subscription', 'UpgradesController@index');

            // topup
            Route::get('topup', 'TopupController');

            // pending appointments
            Route::get('ajaxdata/pending_appointments', 'AjaxdataController@pending_appointments');

            // dashboard
            Route::get('dashboard', 'DashboardController');

            // myaccount
            Route::patch('myaccount', 'My_accountController@update');
            Route::get('myaccount', 'My_accountController@index');

            // mypassword
            Route::patch('mypassword', 'My_passwordController@update');
            Route::get('mypassword', 'My_passwordController@index');

            // myavatar
            Route::patch('myavatar', 'My_avatarController@update');
            Route::get('myavatar', 'My_avatarController@index');

            // tax configuration
            Route::patch('tax_configurations/{configuration}/assign', 'Tax_configurationsController@assign_process');
            Route::get('tax_configurations/{configuration}/assign', 'Tax_configurationsController@assign');
            Route::get('tax_configurations/create', 'Tax_configurationsController@create');
            Route::patch('tax_configurations/{configuration}', 'Tax_configurationsController@update');
            Route::get('tax_configurations/{configuration}/edit', 'Tax_configurationsController@edit');
            Route::delete('tax_configurations/{configuration}', 'Tax_configurationsController@destroy');
            Route::get('tax_configurations', 'Tax_configurationsController@index');
            Route::post('tax_configurations', 'Tax_configurationsController@store');

            // payment gateway
            Route::get('payment_gateways/create', 'Payment_gatewaysController@create');
            Route::patch('payment_gateways/{gateway}', 'Payment_gatewaysController@update');
            Route::get('payment_gateways/{gateway}/edit', 'Payment_gatewaysController@edit');
            Route::delete('payment_gateways/{gateway}', 'Payment_gatewaysController@destroy');
            Route::post('payment_gateways/{gateway}/enable', 'Payment_gatewaysController@enable');
            Route::post('payment_gateways/{gateway}/disable', 'Payment_gatewaysController@disable');
            Route::get('payment_gateways', 'Payment_gatewaysController@index');
            Route::post('payment_gateways', 'Payment_gatewaysController@store');

            // service categories
            Route::get('service_categories/create', 'Service_categoriesController@create');
            Route::patch('service_categories/{category}', 'Service_categoriesController@update');
            Route::get('service_categories/{category}/edit', 'Service_categoriesController@edit');
            Route::delete('service_categories/{category}', 'Service_categoriesController@destroy');
            Route::get('service_categories', 'Service_categoriesController@index');
            Route::post('service_categories', 'Service_categoriesController@store');

            // service items
            Route::get('service_items/create', 'Service_itemsController@create');
            Route::patch('service_items/{item}', 'Service_itemsController@update');
            Route::get('service_items/{item}/edit', 'Service_itemsController@edit');
            Route::delete('service_items/{item}', 'Service_itemsController@destroy');
            Route::get('service_items', 'Service_itemsController@index');
            Route::post('service_items', 'Service_itemsController@store');

            // system profile
            Route::get('profile_settings', 'Profile_settingsController@index');
            Route::patch('profile_settings', 'Profile_settingsController@update');

            // subscription_billing
            Route::get('subscription_billing/quotations', 'Subscription_billingsController@quotations');
            Route::get('subscription_billing/invoices', 'Subscription_billingsController@invoices');
            Route::get('subscription_billing/credit_notes', 'Subscription_billingsController@credit_notes');
            Route::get('subscription_billing/payments', 'Subscription_billingsController@payments');
            Route::get('subscription_billing/subscriptions', 'Subscription_billingsController@subscriptions');

            Route::post('airtime/buy', 'AirtimesController@buy_process');
            Route::get('airtime/buy', 'AirtimesController@buy');
            Route::get('airtime', 'AirtimesController@index');

            // profile did
            Route::get('did_numbers', 'Did_numbersController@index');
            Route::get('did_numbers/buy', 'Did_numbersController@create');
            Route::post('did_numbers/{did}/release', 'Did_numbersController@release');
            Route::post('did_numbers', 'Did_numbersController@store');

            // did_numbers
            Route::delete('did_number/{branch}/release/{did}', 'Branch_didsController@release');
            Route::post('did_number/{branch}', 'Branch_didsController@store');
            Route::get('did_number/{branch}/purchase', 'Branch_didsController@purchase');
            Route::get('did_number/{branch}', 'Branch_didsController@index');

            // users
            Route::get('users/create', 'UsersController@create');
            Route::patch('users/{user}', 'UsersController@update');
            Route::delete('users/{user}', 'UsersController@destroy');
            Route::get('users/{user}/edit', 'UsersController@edit');
            Route::get('users', 'UsersController@index');
            Route::post('users', 'UsersController@store');

            Route::get('user_contact_numbers/{contact_number}/edit', 'User_contact_numbersController@edit');
            Route::patch('user_contact_numbers/{contact_number}', 'User_contact_numbersController@update');
            Route::get('user_contact_numbers/{user}/create', 'User_contact_numbersController@create');
            Route::post('user_contact_numbers/{user}', 'User_contact_numbersController@store');
            Route::delete('user_contact_numbers/{contact_number}', 'User_contact_numbersController@destroy');

            Route::get('users/{user}/send_mail', 'UsersController@send_mail');
            Route::post('users/{user}/send_mail', 'UsersController@process_mail');
            Route::get('users/{user}/send_sms/{contact}', 'UsersController@send_sms');
            Route::post('users/{user}/send_sms/{contact}', 'UsersController@process_sms');
            Route::get('users/{user}/send_sms', 'UsersController@send_sms');
            Route::post('users/{user}/send_sms', 'UsersController@process_sms');

            // professionals
            Route::get('professionals/create', 'ProfessionalsController@create');
            Route::patch('professionals/{user}', 'ProfessionalsController@update');
            Route::delete('professionals/{user}', 'ProfessionalsController@destroy');
            Route::get('professionals/{user}/edit', 'ProfessionalsController@edit');
            Route::get('professionals', 'ProfessionalsController@index');
            Route::post('professionals', 'ProfessionalsController@store');

            Route::get('professionals/{user}/send_mail', 'ProfessionalsController@send_mail');
            Route::post('professionals/{user}/send_mail', 'ProfessionalsController@process_mail');
            Route::get('professionals/{user}/send_sms/{contact}', 'ProfessionalsController@send_sms');
            Route::post('professionals/{user}/send_sms/{contact}', 'ProfessionalsController@process_sms');
            Route::get('professionals/{user}/send_sms', 'ProfessionalsController@send_sms');
            Route::post('professionals/{user}/send_sms', 'ProfessionalsController@process_sms');

            Route::get('professionals/{user}/linkbranch', 'ProfessionalsController@link_branch');
            Route::patch('professionals/{user}/linkbranch', 'ProfessionalsController@link_branch_process');
            Route::delete('professionals/{user}/revoke_branch/{branch}', 'ProfessionalsController@revoke_branch');

            // receptions
            Route::get('receptions/create', 'ReceptionsController@create');
            Route::patch('receptions/{user}', 'ReceptionsController@update');
            Route::delete('receptions/{user}', 'ReceptionsController@destroy');
            Route::get('receptions/{user}/edit', 'ReceptionsController@edit');
            Route::get('receptions', 'ReceptionsController@index');
            Route::post('receptions', 'ReceptionsController@store');

            Route::get('receptions/{user}/send_mail', 'ReceptionsController@send_mail');
            Route::post('receptions/{user}/send_mail', 'ReceptionsController@process_mail');
            Route::get('receptions/{user}/send_sms/{contact}', 'ReceptionsController@send_sms');
            Route::post('receptions/{user}/send_sms/{contact}', 'ReceptionsController@process_sms');
            Route::get('receptions/{user}/send_sms', 'ReceptionsController@send_sms');
            Route::post('receptions/{user}/send_sms', 'ReceptionsController@process_sms');

            // appointment_text_notifications
            Route::patch('appointment_text_notifications/{branch}/edit/{notification}', 'Appointment_text_notificationsController@update');
            Route::get('appointment_text_notifications/{branch}/edit/{notification}', 'Appointment_text_notificationsController@edit');
            Route::delete('appointment_text_notifications/{branch}/delete/{notification}', 'Appointment_text_notificationsController@destroy');
            Route::post('appointment_text_notifications/{branch}', 'Appointment_text_notificationsController@store');
            Route::get('appointment_text_notifications/{branch}/create', 'Appointment_text_notificationsController@create');
            Route::get('appointment_text_notifications/{branch}', 'Appointment_text_notificationsController@index');

            // appointment_call_notifications
            Route::patch('appointment_call_notifications/{branch}/edit/{notification}', 'Appointment_call_notificationsController@update');
            Route::get('appointment_call_notifications/{branch}/edit/{notification}', 'Appointment_call_notificationsController@edit');
            Route::delete('appointment_call_notifications/{branch}/delete/{notification}', 'Appointment_call_notificationsController@destroy');
            Route::post('appointment_call_notifications/{branch}', 'Appointment_call_notificationsController@store');
            Route::get('appointment_call_notifications/{branch}/create', 'Appointment_call_notificationsController@create');
            Route::get('appointment_call_notifications/{branch}', 'Appointment_call_notificationsController@index');

            // scheduled_text_notifications
            Route::patch('scheduled_text_notifications/{agenda}/edit/{notification}', 'Scheduled_text_notificationsController@update');
            Route::get('scheduled_text_notifications/{agenda}/edit/{notification}', 'Scheduled_text_notificationsController@edit');
            Route::delete('scheduled_text_notifications/{agenda}/delete/{notification}', 'Scheduled_text_notificationsController@destroy');
            Route::post('scheduled_text_notifications/{agenda}', 'Scheduled_text_notificationsController@store');
            Route::get('scheduled_text_notifications/{agenda}/create', 'Scheduled_text_notificationsController@create');
            Route::get('scheduled_text_notifications/{agenda}', 'Scheduled_text_notificationsController@index');

            // scheduled_call_notifications
            Route::patch('scheduled_call_notifications/{agenda}/edit/{notification}', 'Scheduled_call_notificationsController@update');
            Route::get('scheduled_call_notifications/{agenda}/edit/{notification}', 'Scheduled_call_notificationsController@edit');
            Route::delete('scheduled_call_notifications/{agenda}/delete/{notification}', 'Scheduled_call_notificationsController@destroy');
            Route::post('scheduled_call_notifications/{agenda}', 'Scheduled_call_notificationsController@store');
            Route::get('scheduled_call_notifications/{agenda}/create', 'Scheduled_call_notificationsController@create');
            Route::get('scheduled_call_notifications/{agenda}', 'Scheduled_call_notificationsController@index');

            // contract templates
            Route::get('contract_templates/create', 'Contract_templatesController@create');
            Route::patch('contract_templates/{template}', 'Contract_templatesController@update');
            Route::get('contract_templates/{template}/edit', 'Contract_templatesController@edit');
            Route::delete('contract_templates/{template}', 'Contract_templatesController@destroy');
            Route::get('contract_templates', 'Contract_templatesController@index');
            Route::post('contract_templates', 'Contract_templatesController@store');

            // contracts
            Route::get('contracts/create/{template}', 'ContractsController@create');
            Route::patch('contracts/{contract}', 'ContractsController@update');
            Route::get('contracts/{contract}/edit', 'ContractsController@edit');
            Route::delete('contracts/{contract}/revoke_signature_request', 'ContractsController@revoke_signature_request');
            Route::delete('contracts/{contract}', 'ContractsController@destroy');
            Route::get('contracts', 'ContractsController@index');
            Route::get('contracts/template/{template}', 'ContractsController@contractsbytemplate');
            Route::get('contracts/{contract}/pdf/{action}', 'ContractsController@pdf');
            Route::get('contracts/{contract}/email', 'ContractsController@email');
            Route::post('contracts/{contract}/email', 'ContractsController@email_process');
            Route::get('contracts/{contract}/electronic_signature_request', 'ContractsController@electronic_signature_request');
            Route::post('contracts/{contract}/electronic_signature_request', 'ContractsController@electronic_signature_request_process');
            Route::get('contracts/{contract}', 'ContractsController@view');
            Route::post('contracts/{template}', 'ContractsController@store');

            // static contracts
            Route::post('static_contracts/upload', 'Static_contractsController@upload');
            Route::get('static_contracts/view/{file}', 'Static_contractsController@view');
            Route::get('static_contracts/download/{file}', 'Static_contractsController@download');
            Route::get('static_contracts/email/{contract}', 'Static_contractsController@email');
            Route::post('static_contracts/email/{contract}', 'Static_contractsController@email_process');
            Route::delete('static_contracts/{contract}/revoke_signature_request', 'Static_contractsController@revoke_signature_request');
            Route::get('static_contracts/{contract}/electronic_signature_request', 'Static_contractsController@electronic_signature_request');
            Route::post('static_contracts/{contract}/electronic_signature_request', 'Static_contractsController@electronic_signature_request_process');
            Route::delete('static_contracts/{contract}', 'Static_contractsController@destroy');
            Route::get('static_contracts', 'Static_contractsController@index');

            // ajax search customers and users
            Route::get('ajaxdata/inbound_sms_messages/{instance}/read', 'AjaxdataController@inbound_sms_messages_update');
            Route::get('ajaxdata/inbound_sms_messages', 'AjaxdataController@inbound_sms_messages');
            Route::get('ajaxdata/read_notifications/{instance}/read', 'AjaxdataController@read_notifications_update');
            Route::get('ajaxdata/read_notifications', 'AjaxdataController@read_notifications');

            Route::get('ajaxdata/customer_search_view/{customer}', 'AjaxdataController@customer_search_view');
            Route::get('ajaxdata/customer_search', 'AjaxdataController@customer_search');
            Route::get('ajaxdata/customer_user_search', 'AjaxdataController@customer_user_search');

            // customers

            Route::get('customer_contact_numbers/{contact_number}/edit', 'Customer_contact_numbersController@edit');
            Route::patch('customer_contact_numbers/{contact_number}', 'Customer_contact_numbersController@update');
            Route::get('customer_contact_numbers/{customer}/create', 'Customer_contact_numbersController@create');
            Route::post('customer_contact_numbers/{customer}', 'Customer_contact_numbersController@store');
            Route::delete('customer_contact_numbers/{contact_number}', 'Customer_contact_numbersController@destroy');

            Route::get('customer_billing_address/{address}/edit', 'Customer_address_billingsController@edit');
            Route::patch('customer_billing_address/{address}', 'Customer_address_billingsController@update');
            Route::get('customer_billing_address/{customer}/create', 'Customer_address_billingsController@create');
            Route::post('customer_billing_address/{customer}', 'Customer_address_billingsController@store');
            Route::post('customer_billing_address/{address}/setasdefault', 'Customer_address_billingsController@setasdefault');
            Route::delete('customer_billing_address/{address}', 'Customer_address_billingsController@destroy');

            Route::get('customer_shipping_address/{address}/edit', 'Customer_address_shippingsController@edit');
            Route::patch('customer_shipping_address/{address}', 'Customer_address_shippingsController@update');
            Route::get('customer_shipping_address/{customer}/create', 'Customer_address_shippingsController@create');
            Route::post('customer_shipping_address/{customer}', 'Customer_address_shippingsController@store');
            Route::post('customer_shipping_address/{address}/setasdefault', 'Customer_address_shippingsController@setasdefault');
            Route::delete('customer_shipping_address/{address}', 'Customer_address_shippingsController@destroy');

            Route::get('customers/search', 'CustomersController@search');
            Route::post('customers/create', 'CustomersController@store');
            Route::get('customers/create', 'CustomersController@create');
            Route::get('customers/{customer}/quotations', 'CustomersController@quotations');
            Route::get('customers/{customer}/invoices', 'CustomersController@invoices');
            Route::get('customers/{customer}/credit_notes', 'CustomersController@credit_notes');
            Route::get('customers/{customer}/payments', 'CustomersController@payments');
            Route::get('customers/{customer}/payment_transactions', 'CustomersController@payment_transactions');
            Route::get('customers/{customer}/subscriptions', 'CustomersController@subscriptions');
            Route::get('customers/{customer}/edit', 'CustomersController@edit');
            Route::patch('customers/{customer}', 'CustomersController@update');
            Route::get('customers/{customer}', 'CustomersController@show');
            Route::get('customers', 'CustomersController@index');

            Route::get('customers/{customer}/send_mail', 'CustomersController@send_mail');
            Route::post('customers/{customer}/send_mail', 'CustomersController@process_mail');
            Route::get('customers/{customer}/send_sms/{contact}', 'CustomersController@send_sms');
            Route::post('customers/{customer}/send_sms/{contact}', 'CustomersController@process_sms');
            Route::get('customers/{customer}/send_sms', 'CustomersController@send_sms');
            Route::post('customers/{customer}/send_sms', 'CustomersController@process_sms');

            // quotations
            Route::get('quotations/search', 'QuotationsController@search');
            Route::post('quotations/{quotation}/add_item', 'QuotationsController@ajax_add_item_process');
            Route::get('quotations/{quotation}/buildlinks', 'QuotationsController@buildlinks');
            Route::get('quotations/{quotation}/add_item', 'QuotationsController@ajax_add_item');
            Route::get('quotations/{quotation}/items', 'QuotationsController@ajax_list_items');
            Route::delete('quotations/{quotation}/items/{item}/remove', 'QuotationsController@ajax_remove_item');
            Route::patch('quotations/{quotation}/build', 'QuotationsController@update');
            Route::get('quotations/{quotation}/build', 'QuotationsController@build');
            Route::get('quotations/{quotation}/preview', 'QuotationsController@preview');
            Route::get('quotations/{quotation}/download', 'QuotationsController@preview');
            Route::delete('quotations/{quotation}/request_signature', 'QuotationsController@request_signature');
            Route::delete('quotations/{quotation}/revoke_signature_request', 'QuotationsController@revoke_signature_request');
            Route::delete('quotations/{quotation}/quotationtoinvoice', 'QuotationsController@quotationtoinvoice');
            Route::delete('quotations/{quotation}/email', 'QuotationsController@preview');
            Route::get('quotations/create/{customer}', 'QuotationsController@create');
            Route::post('quotations/create', 'QuotationsController@store');
            Route::get('quotations/create', 'QuotationsController@create');
            Route::get('quotations', 'QuotationsController@index');

            // invoices
            Route::get('invoices/search', 'InvoicesController@search');
            Route::post('invoices/{invoice}/add_item', 'InvoicesController@ajax_add_item_process');
            Route::get('invoices/{invoice}/buildlinks', 'InvoicesController@buildlinks');
            Route::get('invoices/{invoice}/add_item', 'InvoicesController@ajax_add_item');
            Route::get('invoices/{invoice}/items', 'InvoicesController@ajax_list_items');
            Route::delete('invoices/{invoice}/items/{item}/remove', 'InvoicesController@ajax_remove_item');
            Route::patch('invoices/{invoice}/build', 'InvoicesController@update');
            Route::get('invoices/{invoice}/build', 'InvoicesController@build');
            Route::get('invoices/{invoice}/preview', 'InvoicesController@preview');
            Route::get('invoices/{invoice}/download', 'InvoicesController@preview');
            Route::delete('invoices/{invoice}/email', 'InvoicesController@preview');
            Route::delete('invoices/{invoice}/lockinvoice', 'InvoicesController@lockinvoice');
            Route::delete('invoices/{invoice}/cashreceipt', 'InvoicesController@cashreceipt');
            Route::get('invoices/create/{customer}', 'InvoicesController@create');
            Route::post('invoices/create', 'InvoicesController@store');
            Route::get('invoices/create', 'InvoicesController@create');
            Route::get('invoices', 'InvoicesController@index');

            // custom invoice fields
            Route::delete('custom_invoice_fields/{field}', 'Custom_invoice_fieldsController@destroy');
            Route::patch('custom_invoice_fields/{field}/edit', 'Custom_invoice_fieldsController@update');
            Route::get('custom_invoice_fields/{field}/edit', 'Custom_invoice_fieldsController@edit');
            Route::post('custom_invoice_fields/create', 'Custom_invoice_fieldsController@store');
            Route::get('custom_invoice_fields/create', 'Custom_invoice_fieldsController@create');
            Route::get('custom_invoice_fields', 'Custom_invoice_fieldsController@index');

            // credit notes
            Route::get('credit_notes/search', 'Credit_notesController@search');
            Route::get('credit_notes/{credit_note}/buildlinks', 'Credit_notesController@buildlinks');
            Route::patch('credit_notes/{credit_note}/build', 'Credit_notesController@update');
            Route::get('credit_notes/{credit_note}/build', 'Credit_notesController@build');
            Route::get('credit_notes/{credit_note}/preview', 'Credit_notesController@preview');
            Route::get('credit_notes/{credit_note}/download', 'Credit_notesController@preview');
            Route::delete('credit_notes/{credit_note}/email', 'Credit_notesController@preview');
            Route::delete('credit_notes/{credit_note}/lock', 'Credit_notesController@lock');
            Route::get('credit_notes/create/{customer}', 'Credit_notesController@create');
            Route::get('credit_notes/create', 'Credit_notesController@create');
            Route::post('credit_notes/create', 'Credit_notesController@store');
            Route::get('credit_notes', 'Credit_notesController@index');

            // subscriptions
            Route::get('subscriptions/{subscription}/add_item', 'SubscriptionsController@ajax_add_item');
            Route::post('subscriptions/{subscription}/add_item', 'SubscriptionsController@ajax_add_item_process');
            Route::get('subscriptions/{subscription}/items', 'SubscriptionsController@ajax_list_items');
            Route::delete('subscriptions/{subscription}/items/{item}/remove', 'SubscriptionsController@ajax_remove_item');
            Route::get('subscriptions/search', 'SubscriptionsController@search');
            Route::get('subscriptions/{subscription}/buildlinks', 'SubscriptionsController@buildlinks');
            Route::patch('subscriptions/{subscription}/build', 'SubscriptionsController@update');
            Route::get('subscriptions/{subscription}/build', 'SubscriptionsController@build');
            Route::delete('subscriptions/{subscription}/activate', 'SubscriptionsController@activate');
            Route::delete('subscriptions/{subscription}/cancel', 'SubscriptionsController@cancel');
            Route::get('subscriptions/create/{customer}', 'SubscriptionsController@create');
            Route::get('subscriptions/create', 'SubscriptionsController@create');
            Route::post('subscriptions/create', 'SubscriptionsController@store');
            Route::get('subscriptions', 'SubscriptionsController@index');

            // payments
            Route::get('payments/search', 'PaymentsController@search');
            Route::get('payments/{payment}/buildlinks', 'PaymentsController@buildlinks');
            Route::patch('payments/{payment}/build', 'PaymentsController@update');
            Route::get('payments/{payment}/build', 'PaymentsController@build');
            Route::get('payments/{payment}/preview', 'PaymentsController@preview');
            Route::get('payments/{payment}/download', 'PaymentsController@preview');
            Route::delete('payments/{payment}/email', 'PaymentsController@preview');
            Route::delete('payments/{payment}/lock', 'PaymentsController@lock');
            Route::get('payments/create/{customer}', 'PaymentsController@create');
            Route::get('payments/create', 'PaymentsController@create');
            Route::post('payments/create', 'PaymentsController@store');
            Route::get('payments', 'PaymentsController@index');

            // payment transaction
            Route::get('payment_transactions/{payment}', 'Payment_transactionsController');

            // appointments
            Route::get('appointments/{agenda}', 'AppointmentsController@index');
            Route::post('appointments/schedule/{rs?}', 'AppointmentsController@schedule');
            Route::post('appointments/confirm/{rs?}', 'AppointmentsController@confirm');
            Route::get('appointments/{agenda}/branch/{time}/customer/{customer}/{rs?}', 'AppointmentsController@create_branch_select');
            Route::get('appointments/{agenda}/slot/{branch}/{time}/customer/{customer}/{rs?}', 'AppointmentsController@create_duration_select');
            Route::get('appointments/{agenda}/schedule/{time}', 'AppointmentsController@select_customer');
            Route::get('appointments/{agenda}/reschedule/{reference}', 'AppointmentsController@rescheduleselect');
            Route::get('appointments/{agenda}/search/{time}', 'AppointmentsController@search_customer');
            Route::post('appointments/daterange/{agenda}', 'AppointmentsController@daterange');
            Route::delete('appointments/{agenda}/cancel/{reference}', 'AppointmentsController@cancel');
            Route::delete('appointments/{agenda}/accept/{reference}', 'AppointmentsController@accept');
            Route::delete('appointments/{agenda}/reject/{reference}', 'AppointmentsController@reject');

            Route::post('appointments/{agenda}/change_status/{appointment}', 'AppointmentsController@change_status_process');
            Route::get('appointments/{agenda}/change_status/{appointment}', 'AppointmentsController@change_status');
            Route::get('appointments/{agenda}/appointment_information/{appointment}', 'AppointmentsController@menu_appointment_information');
            Route::get('appointments/{agenda}/notification_history/{appointment}', 'AppointmentsController@menu_notification_history');
            Route::get('appointments/{agenda}/past_appointments/{customer}', 'AppointmentsController@menu_past_appointments');
            Route::get('appointments/{agenda}/upcoming_appointments/{customer}', 'AppointmentsController@menu_upcoming_appointments');

            // branches
            Route::get('branches/create', 'BranchesController@create');
            Route::patch('branches/{branch}', 'BranchesController@update');
            Route::delete('branches/{branch}', 'BranchesController@destroy');
            Route::get('branches/{branch}', 'BranchesController@view');
            Route::get('branches/{branch}/edit', 'BranchesController@edit');
            Route::get('branches', 'BranchesController@index');
            Route::post('branches', 'BranchesController@store');

            // location_planner
            Route::get('location_planner/create', 'Location_plannersController@create');
            Route::get('location_planner', 'Location_plannersController@index');
            Route::post('location_planner', 'Location_plannersController@store');

        });
    });

    Route::get('/', function () {
        return redirect('/profilecontrol/dashboard');
    });

    Route::get('/home', function () {
        return redirect('/profilecontrol/dashboard');
    });

    Route::get('/login', 'ProfilecontrolAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'ProfilecontrolAuth\LoginController@login');

    Route::post('/password/email', 'ProfilecontrolAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'ProfilecontrolAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'ProfilecontrolAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'ProfilecontrolAuth\ResetPasswordController@showResetForm');

});
