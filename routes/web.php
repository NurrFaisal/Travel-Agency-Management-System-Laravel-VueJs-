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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'LoginController@login')->middleware('LoginMiddleware');
Route::post('/api/login-info', 'LoginController@loginInfo')->middleware('LoginMiddleware');

Route::group(['middleware' => ['AuthenticMiddleware']], function () {
    Route::get('/invoice-print', 'PrintController@invoicePrint');
    Route::get('/download-invoice', 'PrintController@downloadInvoice');

// airTicketInvoice
    Route::get('/invoice-print-air-ticket/{id}', 'PrintController@invoicePrintAirTicket');
    Route::get('/invoice-print-air-ticket-count/{id}', 'PrintController@invoicePrintAirTicketCount');
    Route::get('/invoice-print-visa/{id}', 'PrintController@invoicePrintVisa');
    Route::get('/invoice-print-visa-count/{id}', 'PrintController@invoicePrintVisaCount');
    Route::get('/invoice-print-hotel/{id}', 'PrintController@invoicePrintHotel');
    Route::get('/invoice-print-hotel-count/{id}', 'PrintController@invoicePrintHotelCount');
    Route::get('/invoice-print-package/{id}', 'PrintController@invoicePrintPackage');
    Route::get('/invoice-print-package-count/{id}', 'PrintController@invoicePrintPackageCount');
    Route::get('/invoice-print-money-receipt/{id}', 'PrintController@invoicePrintMoneyReceipt');
    Route::get('/invoice-print-money-receipt-count/{id}', 'PrintController@invoicePrintMoneyReceiptCount');
    Route::get('/invoice-print-debit-voucher/{id}', 'PrintController@invoicePrintDebitVoucher');
    Route::get('/invoice-print-contra-voucher/{id}', 'PrintController@invoicePrintContraVoucher');
    Route::get('/invoice-print-expense/{id}', 'PrintController@invoicePrintExpense');
    Route::get('/invoice-print-salary/{id}', 'PrintController@invoicePrintSalary');
    Route::get('/invoice-print-incentive/{id}', 'PrintController@invoicePrintIncentive');
// airTicketInvoice





//Vue JS Route Control
    Route::get('/{anypath}', 'DashboardController@index');
    Route::get('/edit-guest-title/{anypath}', 'DashboardController@index');
    Route::get('/edit-guest-designation/{anypath}', 'DashboardController@index');
    Route::get('/edit-staff-designation/{anypath}', 'DashboardController@index');
    Route::get('/edit-department/{anypath}', 'DashboardController@index');
    Route::get('/edit-staff/{anypath}', 'DashboardController@index');
    Route::get('/edit-guest/{anypath}', 'DashboardController@index');
    Route::get('/edit-guest-query/{anypath}', 'DashboardController@index');
    Route::get('/view-guest-query/{anypath}', 'DashboardController@index');
    Route::get('/edit-suplier/{anypath}', 'DashboardController@index');
    Route::get('/edit-air-line/{anypath}', 'DashboardController@index');
    Route::get('/edit-visa-category/{anypath}', 'DashboardController@index');
    Route::get('/edit-visa-agency/{anypath}', 'DashboardController@index');
    Route::get('/edit-visa-country/{anypath}', 'DashboardController@index');
    Route::get('/edit-received-visa/{anypath}', 'DashboardController@index');
    Route::get('/edit-work-and-notary-visa/{anypath}', 'DashboardController@index');
    Route::get('/edit-checked-by-asst-visa/{anypath}', 'DashboardController@index');
    Route::get('/edit-checked-by-officer-visa/{anypath}', 'DashboardController@index');
    Route::get('/edit-submited-visa/{anypath}', 'DashboardController@index');
    Route::get('/edit-collected-visa/{anypath}', 'DashboardController@index');
    Route::get('/edit-call-and-sms-visa/{anypath}', 'DashboardController@index');
    Route::get('/edit-delivery-visa/{anypath}', 'DashboardController@index');
    Route::get('/edit-package-query/{anypath}', 'DashboardController@index');
    Route::get('/edit-package-follow-up/{anypath}', 'DashboardController@index');
    Route::get('/edit-itinerary-cost-submit-date/{anypath}', 'DashboardController@index');
    Route::get('/edit-guest-reaction/{anypath}', 'DashboardController@index');
    Route::get('/edit-guest-confirmation-date/{anypath}', 'DashboardController@index');
    Route::get('/edit-confirm-mail-to-suplier/{anypath}', 'DashboardController@index');
    Route::get('/edit-package-visa-update/{anypath}', 'DashboardController@index');
    Route::get('/edit-drfdp/{anypath}', 'DashboardController@index');
    Route::get('/edit-pddin/{anypath}', 'DashboardController@index');
    Route::get('/edit-document-collection-by-guest/{anypath}', 'DashboardController@index');
    Route::get('/edit-date-of-journey/{anypath}', 'DashboardController@index');
    Route::get('/edit-air-ticket/{anypath}', 'DashboardController@index');
    Route::get('/edit-hotel-booking/{anypath}', 'DashboardController@index');
    Route::get('/edit-bank/{anypath}', 'DashboardController@index');
    Route::get('/edit-received/{anypath}', 'DashboardController@index');
    Route::get('/edit-payment/{anypath}', 'DashboardController@index');
    Route::get('/edit-contra/{anypath}', 'DashboardController@index');
    Route::get('/bank-book-by-id/{anypath}', 'DashboardController@index');
    Route::get('/edit-loan/{anypath}', 'DashboardController@index');
    Route::get('/installment/{anypath}', 'DashboardController@index');
    Route::get('/add-installment/{anypath}', 'DashboardController@index');
    Route::get('/edit-installment/{anypath}', 'DashboardController@index');
    Route::get('/view-staff/{anypath}', 'DashboardController@index');
    Route::get('/edit-expence-head/{anypath}', 'DashboardController@index');
    Route::get('/edit-expence/{anypath}', 'DashboardController@index');
    Route::get('/edit-incentive/{anypath}', 'DashboardController@index');
    Route::get('/edit-salary/{anypath}', 'DashboardController@index');
    Route::get('/edit-received-visa-updated/{anypath}', 'DashboardController@index');
    Route::get('/edit-work-and-notary-visa-update/{anypath}', 'DashboardController@index');
    Route::get('/edit-checked-by-asst-visa-updated/{anypath}', 'DashboardController@index');
    Route::get('/edit-checked-by-officer-visa-updated/{anypath}', 'DashboardController@index');
    Route::get('/edit-submited-visa-updated/{anypath}', 'DashboardController@index');
    Route::get('/edit-collected-visa-updated/{anypath}', 'DashboardController@index');
    Route::get('/edit-call-and-sms-visa-updated/{anypath}', 'DashboardController@index');
    Route::get('/edit-delivery-visa-updated/{anypath}', 'DashboardController@index');
    Route::get('/add-guest-confirmation/{anypath}', 'DashboardController@index');
    Route::get('/add-package-visa-update-new/{anypath}', 'DashboardController@index');
    Route::get('/package-net-price/{anypath}', 'DashboardController@index');
    Route::get('/edit-package-net-price/{anypath}', 'DashboardController@index');
    Route::get('/edit-received-loan-head/{anypath}', 'DashboardController@index');
    Route::get('/edit-received-loan/{anypath}', 'DashboardController@index');
    Route::get('/list-received-loan-installment/{anypath}', 'DashboardController@index');
    Route::get('/new-received-loan-installment/{anypath}', 'DashboardController@index');
    Route::get('/edit-received-loan-installment/{anypath}', 'DashboardController@index');
    Route::get('/edit-payment-loan/{anypath}', 'DashboardController@index');
    Route::get('/edit-payment-loan-installment/{anypath}', 'DashboardController@index');
    Route::get('/view-guest/{anypath}', 'DashboardController@index');
    Route::get('/view-suplier/{anypath}', 'DashboardController@index');
    Route::get('/view-package/{anypath}', 'DashboardController@index');
    Route::get('/edit-air-ticket-refund/{anypath}', 'DashboardController@index');
// Vue JS Route Control

    Route::get('/dashboard', 'DashboardController@index');

// laravel Login Controller Start


    Route::get('/api/logout', 'LoginController@logout');

// laravel Login Controller End




//Guest title Controller Start
    Route::post('/api/add-guest-title', 'GuestTitleController@addGuestTitle');
    Route::get('/api/get-all-guest-title', 'GuestTitleController@getAllGuestTitle');
    Route::get('/api/get-all-guest-title-for-select', 'GuestTitleController@getAllGuestTitleForSelect');
    Route::get('/api/delete-guest-title/{id}', 'GuestTitleController@deleteGuestTitle');
    Route::get('/api/edit-guest-title/{id}', 'GuestTitleController@editGuestTitle');
    Route::post('/api/update-guest-title', 'GuestTitleController@updateGuestTitle');


// new

//Guest Title Controller End


// Guest Designation Controller Start
    Route::post('/api/add-guest-designation', 'GuestDesignationController@addGuestDesignation');
    Route::get('/api/get-all-guest-designation', 'GuestDesignationController@allGuestDesignation');
    Route::get('/api/get-all-guest-designation-for-select', 'GuestDesignationController@allGuestDesignationForSelect');
    Route::get('/api/delete-guest-designation/{id}', 'GuestDesignationController@deleteGuestDesignation');
    Route::get('/api/edit-guest-designation/{id}', 'GuestDesignationController@editGuestDesignation');
    Route::post('/api/update-guest-designation', 'GuestDesignationController@updateGuestDesignation');
//Guest Designation Controller End

//Staff designation Start
    Route::post('/api/add-staff-designation', 'StaffDesignationController@addStaffDesignation');
    Route::get('/api/get-all-staff-designation', 'StaffDesignationController@allStaffDesignation');
    Route::get('/api/edit-staff-designation/{id}', 'StaffDesignationController@editStaffDesignation');
    Route::post('/api/update-staff-designation', 'StaffDesignationController@updateStaffDesignation');
    Route::get('/api/delete-staff-designation/{id}', 'StaffDesignationController@deleteStaffDesignation');
//Staff Designation End

// Department Start
    Route::post('/api/add-department', 'DepartmentController@addDepartment');
    Route::get('/api/get-all-department', 'DepartmentController@allDepartment');
    Route::get('/api/edit-department/{id}', 'DepartmentController@editDepartment');
    Route::post('/api/update-department', 'DepartmentController@updateDepartment');
    Route::get('/api/delete-department/{id}', 'DepartmentController@deleteDepartment');
// Department End

//staff-information start
    Route::post('/api/add-staff-information', 'StaffController@addStaff');
    Route::get('/api/get-all-staffs', 'StaffController@getAllStaff');
    Route::get('/api/get-all-staffs-for-select', 'StaffController@getAllStaffForSelect');
    Route::get('/api/delete-staff/{id}', 'StaffController@deleteStaff');
    Route::get('/api/edit-staff/{id}', 'StaffController@editeStaff');
    Route::get('/api/view-staff/{id}', 'StaffController@viewStaff');
    Route::post('/api/update-staff', 'StaffController@updateStaff');
    Route::get('/api/get-all-staff-profit/{id}', 'StaffController@getAllStaffProfit');
    Route::get('/api/get-all-staff-profit-search/{id}/{search}', 'StaffController@getAllStaffProfitSearch');
    Route::get('/api/get-all-staff-guest/{id}', 'StaffController@getAllStaffGuest');
    Route::get('/api/get-all-staff-transaction/{id}', 'StaffController@getAllStaffTransaction');
    Route::get('/api/get-all-staff-search/{search}', 'StaffController@getAllStaffSearch');
// Staff-information End

// new Start
    Route::get('/api/get-all-refernce-staff/{query}', 'StaffController@getAllStaffRefernce');
// new End

//staff-information end

//GuestController Start
    Route::post('/api/add-guest', 'GuestController@addGuest');
    Route::get('/api/get-all-guest', 'GuestController@getAllGuest');
    Route::get('/api/delete-guest/{id}', 'GuestController@deleteGuest');
    Route::get('/api/edit-guest/{id}', 'GuestController@editGuest');
    Route::post('/api/update-guest', 'GuestController@updateGuest');
    Route::get('/api/get-all-guests/{query}', 'GuestController@getAllGuestRefernce');
    Route::get('/api/get-all-guest-transaction/{id}', 'GuestController@getAllGuestTransaction');
    Route::get('/api/get-all-staff-transaction-search/{id}/{search}', 'GuestController@getAllGuestTransactionSearch');
    Route::get('/api/get-all-guest-search/{search}', 'GuestController@getAllGuestSearch');
//GuestControler End

//Guest Query Controller Start
    Route::post('/api/add-guest-query', 'GuestQueryController@addGuestQuery');
    Route::get('/api/get-all-guest-query', 'GuestQueryController@getAllguestQuery');
    Route::get('/api/edit-guest-query/{id}', 'GuestQueryController@editGuestQuery');
    Route::post('/api/update-guest-query', 'GuestQueryController@updateGuestQuery');
    Route::get('/api/delete-guest-query/{id}', 'GuestQueryController@deleteGuestQuery');
//Guest Query Controller End


//// Agency (Suplier) Controller Start
//
//Route::post('/api/add-suplier', 'AgencyController@addSuplier');
//Route::get('/api/get-all-agency', 'AgencyController@getAllAgency');
//Route::get('/api/edit-suplier/{id}', 'AgencyController@editSuplier');
//Route::post('/api/update-suplier', 'AgencyController@updateSuplier');
//Route::get('/api/delete-suplier/{id}', 'AgencyController@deleteSuplier');
//
//// Agency (Suplier) Controller End


// AirLine Controller Start

    Route::post('/api/add-air-line', 'AirLineController@addAirLine');
    Route::get('/api/get-all-air-line', 'AirLineController@getAllAirLine');
    Route::get('/api/edit-air-line/{id}', 'AirLineController@editAirLine');
    Route::post('/api/update-air-line', 'AirLineController@updateAirLine');
    Route::get('/api/delete-air-line/{id}', 'AirLineController@deleteAirLine');

// AirLine Controller End


// VisaCategoryController Start

    Route::post('/api/add-visa-category', 'VisaCategoryController@addVisaCategory');
    Route::get('/api/get-all-visa-category', 'VisaCategoryController@getAllVisaCategory');
    Route::get('/api/edit-visa-category/{id}', 'VisaCategoryController@editVisaCategory');
    Route::post('/api/update-visa-category', 'VisaCategoryController@updateVisaCategory');
    Route::get('/api/delete-visa-category/{id}', 'VisaCategoryController@deleteVisaCategory');

// VisaCategoryController End


// VisaAgencyController Start

    Route::post('/api/add-visa-agency', 'VisaAgencyController@addVisaAgency');
    Route::get('/api/get-all-visa-agency', 'VisaAgencyController@getAllVisaAgency');
    Route::get('/api/delete-visa-agency/{id}', 'VisaAgencyController@deleteVisaAgency');
    Route::get('/api/edit-visa-agency/{id}', 'VisaAgencyController@editVisaAgency');
    Route::post('/api/update-visa-agency', 'VisaAgencyController@updateVisaAgency');

// Visa AgencyController End

// Visa CountryCountroller Start

    Route::post('/api/add-visa-country', 'VisaCountryController@addVisaCountry');
    Route::get('/api/get-all-visa-country', 'VisaCountryController@getAllVisaCountry');
    Route::get('/api/delete-visa-country/{id}', 'VisaCountryController@deleteVisaCountry');
    Route::get('/api/edit-visa-country/{id}', 'VisaCountryController@editVisaCountry');
    Route::post('/api/update-visa-country', 'VisaCountryController@updateVisaCountry');

// Visa CountryController End



// Suplier Controller Start
    Route::post('/api/add-suplier', 'SuplierController@addSuplier');
    Route::get('/api/get-all-supliers', 'SuplierController@getAllSuplier');
    Route::get('/api/get-all-suplier-search/{search}', 'SuplierController@getAllSuplierSearch');
    Route::get('/api/edit-suplier/{id}', 'SuplierController@editSuplier');
    Route::post('/api/update-suplier', 'SuplierController@updateSuplier');
    Route::get('/api/get-all-active-suplier', 'SuplierController@getAllActiveSuplier');
    Route::get('/api/get-all-suplier-transaction/{id}', 'SuplierController@getAllSuplierTransaction');
    Route::get('/api/get-all-suplier-transaction-search/{id}/{search}', 'SuplierController@getAllSuplierTransactionSearch');


// Suplier controller End

// Visa Controller Start

    Route::post('/api/add-visa', 'VisaController@addVisa');
    Route::get('/api/get-all-recieved-visa', 'VisaController@getAllRecievedVisa');
    Route::get('/api/get-all-work-visa', 'VisaController@getAllWorkVisa');
    Route::get('/api/get-all-checked-by-asst-visa', 'VisaController@getAllCheckedByAsstVisa');
    Route::get('/api/get-all-checked-by-offcer-visa', 'VisaController@getAllCheckedByOfficerVisa');
    Route::get('/api/get-all-submit-visa', 'VisaController@getAllSubmitVisa');
    Route::get('/api/get-all-collected-visa', 'VisaController@getAllCollectedVisa');
    Route::get('/api/get-all-gcs-visa', 'VisaController@getAllGCSVisa');
    Route::get('/api/get-all-delevered-visa', 'VisaController@getAllDeleveredVisa');

    Route::post('/api/add-visa-work-and-notary', 'VisaController@addVisaWorkAndNotary');
    Route::post('/api/add-checked-asst-by', 'VisaController@addCheckedByAsst');
    Route::post('/api/add-checked-by-officer', 'VisaController@addCheckedByOfficer');
    Route::post('/api/add-visa-submit', 'VisaController@addVisaSubmit');
    Route::post('/api/add-visa-collected', 'VisaController@addVisaCollected');
    Route::post('/api/add-visa-guest-call-and-sms', 'VisaController@addVisaGuestCallAndSms');
    Route::post('/api/add-visa-delevered', 'VisaController@addVisaDelevered');


    Route::get('/api/edit-received-visa/{id}', 'VisaController@editReceivedVisa');
    Route::post('/api/update-received-visa', 'VisaController@updateReceivedVisa');

    Route::get('/api/edit-work-and-notary-visa/{id}', 'VisaController@editWorkAndNotaryVisa');
    Route::post('/api/update-work-and-notary-visa', 'VisaController@updateWorkAndNotaryVisa');

    Route::get('/api/edit-checked-by-asst/{id}', 'VisaController@editCheckedByAsst');
    Route::post('/api/update-checked-by-asst', 'VisaController@updateCheckedByAsst');

    Route::get('/api/edit-checked-by-officer/{id}', 'VisaController@editCheckedByOfficer');
    Route::post('/api/update-checked-by-officer', 'VisaController@updateCheckedByOfficer');

    Route::get('/api/edit-submit-visa/{id}', 'VisaController@editSubmitedVisa');
    Route::post('/api/update-submit-visa', 'VisaController@updateSubmitVisa');

    Route::get('/api/edit-collected-visa/{id}', 'VisaController@editCollectedVisa');
    Route::post('/api/update-collected-visa', 'VisaController@updateCollectedVisa');

    Route::get('/api/edit-call-and-sms-visa/{id}', 'VisaController@editCallAndSmsVisa');
    Route::post('/api/update-call-and-sms-visa', 'VisaController@updateCallAndSmsVisa');

    Route::get('/api/edit-delevered-visa/{id}', 'VisaController@editDeleveredVisa');
    Route::post('/api/update-delevered-visa', 'VisaController@updateDeleveredVisa');




// Visa Controller End


// Package Controller Start

    Route::post('/api/add-package-query', 'PackageController@addPackageQuery');
    Route::get('/api/get-all-package-query', 'PackageController@getAllPackageQuery');
    Route::get('/api/edit-package-query/{id}', 'PackageController@editPackageQuery');
    Route::post('/api/update-package-query', 'PackageController@updatePackageQuery');
    Route::get('/api/get-all-package-search/{search}', 'PackageController@getAllPackageSearch');
    Route::get('/api/view-package/{id}', 'PackageController@ViewPackageById');


// package query follow up start

    Route::post('/api/add-package-follow-up', 'PackageFollowUpController@addPackageFollowUp');
    Route::get('/api/get-all-package-follow-up', 'PackageFollowUpController@getAllPackageFollowUp');
    Route::get('/api/edit-package-follow-up/{id}', 'PackageFollowUpController@editPackageFollowUp');
    Route::post('/api/update-package-follow-up', 'PackageFollowUpController@updatePackageFollowUp');

// package query follow up end

// package itinery submit cost date start

    Route::post('/api/add-itinery-cost-submit-date', 'ItineryCostSubmitController@addItineryCostSubmitDate');
    Route::get('/api/get-all-itinerary-cost-submit-date', 'ItineryCostSubmitController@getAllItineraryCostSubmitDate');
    Route::get('/api/edit-itinerary-cost-submit-date/{id}', 'ItineryCostSubmitController@editItineraryCostSubmitDate');
    Route::post('/api/update-itinerary-cost-submit-date', 'ItineryCostSubmitController@UpdateItineraryCostSubmitDate');

// package itinery submit cost date End

// GuestReactionController Start

    Route::get('/api/get-all-package-guest-reaction', 'GuestReactionController@getAllPackageGuestReaction');
    Route::post('/api/add-guest-reaction', 'GuestReactionController@addGuestReaction');
    Route::get('/api/edit-guest-reaction/{id}', 'GuestReactionController@editGuestReaction');
    Route::post('/api/update-guest-reaction', 'GuestReactionController@updateGuestReaction');

// GuestReactionController End


// GuestConfirmDateController Start
    Route::get('/api/get-all-package-confirm-date', 'GuestConfirmDateController@getAllPackageConfirmDate');
    Route::post('/api/add-guest-confirm', 'GuestConfirmDateController@addGuestConfirmation');
    Route::get('/api/edit-guest-confirmation/{id}', 'GuestConfirmDateController@editGuestConfirmation');
    Route::post('/api/update-guest-confirmation', 'GuestConfirmDateController@updateGuestConfirmation');
// GuestConfirmDateController End


// PackageNetPriceController Start
    Route::post('/api/add-package-net-price', 'PackageNetPriceController@addPackageNetPrice');
    Route::get('/api/get-all-package-net-price', 'PackageNetPriceController@getAllPackageNetPrice');
    Route::get('/api/edit-package-net-price/{id}', 'PackageNetPriceController@editPackageNetPrice');
    Route::post('/api/update-package-net-price', 'PackageNetPriceController@updatePackageNetPrice');
// PackageNetPriceController End

// ConfirmMailToSuplierController Start
    Route::get('/api/get-all-confirm-mail-to-suplier', 'ConfirmMailToSuplierController@getAllPackageCMTS');
    Route::post('/api/add-confirm_mail_to_suplier', 'ConfirmMailToSuplierController@addConfirmMailToSuplier');
    Route::get('/api/edit-confirm-mail-to-suplier/{id}', 'ConfirmMailToSuplierController@editConfirmMailToSuplier');
    Route::post('/api/update-confirm-mail-to-suplier', 'ConfirmMailToSuplierController@updateConfirmMailToSuplier');

// ConfirmMailToSuplierController End

// PackageVisaUpdateController Start

    Route::get('/api/get-all-package-visa-update', 'PackageVisaUpdateController@getAllPackageVisaUpdate');
    Route::post('/api/add-package-visa-new', 'PackageVisaUpdateController@addVisaUpdateDate');
    Route::get('/api/edit-package-visa-update/{id}', 'PackageVisaUpdateController@editPackageUpdateVisa');
    Route::post('/api/update-package-visa-update', 'PackageVisaUpdateController@updatPackageVisaUpdate');

// PackageVisaUpdateController End

// PackageTicketController Start
    Route::get('/api/get-all-package-ticket', 'PackageTicketController@getAllPackageTicket');
    Route::post('/api/add-package-ticket-date', 'PackageTicketController@addPackageTicketDate');
    Route::get('/api/edit-package-ticket/{id}', 'PackageTicketController@EditPackageTicket');
    Route::post('/api/update-package-ticket', 'PackageTicketController@updatePackageTicket');
// PackageTicketController End

// DRFDPController Start
    Route::get('/api/get-all-document-ready', 'DRFDPController@getAllDRFDP');
    Route::post('/api/add-document-ready', 'DRFDPController@addDocumentReady');
    Route::get('/api/edit-drfdp/{id}', 'DRFDPController@editDRFDP');
    Route::post('/api/update-drfdp', 'DRFDPController@updateDrfdp');
// DRFDPController End





// DocumentCollectionByGuestController Start

    Route::get('/api/get-all-document-collection-by-guest', 'DocumentCollectionByGuestController@getAllDocumentCollectionByGuest');
    Route::post('/api/add-document-delivery', 'DocumentCollectionByGuestController@addDocumentCollection');
    Route::get('/api/edit-document-collection-by-guest/{id}', 'DocumentCollectionByGuestController@editDocumentCollectionByGuest');
    Route::post('/api/update-document-collection-by-guest', 'DocumentCollectionByGuestController@updateDocumentCollectionByGuest');

// DocumentCollectionByGuestController End




// DateOfJourneyController Start

    Route::get('/api/get-all-date-of-journey', 'DateOfJourneyController@getAllDateOfJourney');
    Route::post('/api/add-date-of-journey', 'DateOfJourneyController@addDateOfJourney');
    Route::get('/api/edit-date-of-journey/{id}', 'DateOfJourneyController@editDateOfJourney');
    Route::post('/api/update-date-of-journey', 'DateOfJourneyController@updateDateOfJourney');
// DateOfJourneyController End


// PackageInvoiceController Start
    Route::get('/api/get-all-invoice', 'PackageInvoiceController@getAllInvoice');
// PackageInvoiceController End

// Package Controller End



// AirTicketController Start

    Route::post('/api/add-air-ticket', 'AirTicketController@addAirTicket');
    Route::get('/api/get-all-air-ticket', 'AirTicketController@getAllAirTicket');

    Route::get('/api/edit-air-ticket/{id}', 'AirTicketController@editAirTicket');
    Route::post('/api/update-air-ticket', 'AirTicketController@updateAirTicket');

    Route::get('/api/get-all-air-ticket-search/{search}', 'AirTicketController@getAllAirTicketSearch');

// AirTicketController End

// TicketController Start
    Route::get('/api/get-all-ticket', 'TicketController@getAllAirTicket');
    Route::get('/api/get-all-ticket-search/{search}', 'TicketController@getAllTicketSearch');
// TicketController End

// HotelBookingController Start

    Route::post('/api/add-hotel-booking', 'HotelBookingController@addHotelBooking');
    Route::get('/api/get-all-hotel-booking', 'HotelBookingController@getAllHotelBooking');
    Route::get('/api/get-all-hotel-booking-search/{search}', 'HotelBookingController@getAllHotelBookingSearch');
    Route::get('/api/edit-hotel-booking/{id}', 'HotelBookingController@editHotelBooking');
    Route::post('/api/updated-hotel-booking', 'HotelBookingController@updateHotelBooking');

// HotelBookingController End

// HotelController Start
    Route::get('/api/get-all-hotel', 'HotelController@getAllHotel');
    Route::get('/api/get-all-hotel-search/{search}', 'HotelController@getAllHotelSearch');
// HotelController End



// GuestController Start for Guest Select

//Route::get('/api/get-all-guest-for-select', 'GuestController@getAllGuestForSelect');

// GuestController Start For Guest Select


// ModuleController Start

    Route::get('/api/get-all-air-ticket-staff', 'ModuleController@getAllAirTicketStarff');

// ModuleController End



// ReceivedController Start

    Route::post('/api/add-received', 'ReceivedController@addReceived');
    Route::get('/api/get-all-received', 'ReceivedController@getAllReceived');
    Route::get('/api/edit-received/{id}', 'ReceivedController@editReceived');
    Route::post('/api/update-received', 'ReceivedController@updateReceived');

    Route::get('/api/get-guest-last-balance/{id}', 'ReceivedController@getGuestLastBalance');

    Route::get('/api/get-all-received-search/{search}', 'ReceivedController@getAllReceivedSearch');

// ReceivedController End


//PaymentController Start

    Route::post('/api/add-payment', 'PaymentController@addPayment');
    Route::get('/api/get-all-payment', 'PaymentController@getAllPayment');
    Route::get('/api/edit-payment/{id}', 'PaymentController@editPayment');
    Route::post('/api/update-payment', 'PaymentController@updatePayment');
    Route::get('/api/get-all-payment-search/{search}', 'PaymentController@getAllPaymentSearch');

//PaymentController End


//ContranController Start

    Route::post('/api/add-contra', 'ContraController@addContra');
    Route::get('/api/get-all-contra', 'ContraController@getAllContra');
    Route::get('/api/edit-contra/{id}', 'ContraController@editContra');
    Route::post('/api/update-contra', 'ContraController@updateContra');
    Route::get('/api/get-all-contra-search/{search}', 'ContraController@getAllContraSearch');

//ContraController End


//CashBookController Start

    Route::get('/api/get-all-cash-book', 'CashBookController@getAllCashBook');

//CashBookController End

// BankBookController Start
    Route::get('/api/get-all-bank-book', 'BankBookController@getAllBankBook');
    Route::get('/api/get-all-bank-book-details/{id}', 'BankBookController@getAllBankBookDetails');
// BankBookController End

// ChequeBookController Start

    Route::get('/api/get-all-cheque', 'ChequeBookController@getAllCheque');
    Route::post('/api/clear-cheque', 'ChequeBookController@clearCheque');
    Route::get('/api/get-all-clear-cheque', 'ChequeBookController@getAllClearCheque');

// ChequeBookController End

// OthersController Start
    Route::get('/api/get-all-others', 'OthersController@getAllOthers');
// OthersController End


// LoanController Start
    Route::post('/api/add-loan', 'LoanController@addLoan');
    Route::get('/api/get-all-loans', 'LoanController@getAllLoans');
    Route::get('/api/edit-loan/{id}', 'LoanController@editLoan');
    Route::post('/api/update-loan', 'LoanController@updateLoan');
// LoanController End


// InstallmentController Start
    Route::post('/api/add-installment', 'InstallmentController@addInstallment');
    Route::get('/api/get-all-installment/{id}', 'InstallmentController@getAllInstallment');
    Route::get('/api/edit-installment/{id}', 'InstallmentController@editInstallment');
    Route::post('/api/update-installment', 'InstallmentController@updateInstallment');
// InstallmentController End



// BankController Start
    Route::post('/api/add-bank', 'BankController@addBank');
    Route::get('/api/get-all-bank', 'BankController@getAllBank');
    Route::get('/api/edit-bank/{id}', 'BankController@editBank');
    Route::post('/api/update-bank', 'BankController@updateBank');
    Route::get('/api/delete-bank/{id}', 'BankController@deleteBank');
    Route::get('/api/get-all-module-banks', 'BankController@getAllModuleBank');
// BankController End


// ExpenceHeadController Start

    Route::post('/api/add-expence-head', 'ExpenceHeadController@addExpenceHead');
    Route::get('/api/get-all-expence-head', 'ExpenceHeadController@getAllExpenceHead');
    Route::get('/api/edit-expence-head/{id}', 'ExpenceHeadController@editExpenceHead');
    Route::post('/api/update-expence-head', 'ExpenceHeadController@updateExpenceHead');

// ExpenceHeadController End


// ExpenceController Start


    Route::get('/api/get-expence-head', 'ExpenceController@getExpenceHead');
    Route::post('/api/add-expence', 'ExpenceController@addExpence');
    Route::get('/api/get-all-expences', 'ExpenceController@getAllExpence');
    Route::get('/api/edit-expence/{id}', 'ExpenceController@editExpence');
    Route::post('/api/update-expence', 'ExpenceController@updateExpence');
    Route::get('/api/get-all-expence-search/{search}', 'ExpenceController@getAllExpenceSearch');

// ExpenceController End


// IncentiveController Start

    Route::get('/api/get-incentive-staff', 'IncentiveController@getIncentiveStaff');
    Route::post('/api/add-incentive', 'IncentiveController@addIncentive');
    Route::get('/api/get-all-incentives', 'IncentiveController@getAllIncentive');
    Route::get('/api/edit-incentive/{id}', 'IncentiveController@editIncentive');
    Route::post('/api/update-incentive', 'IncentiveController@updateIncentive');
    Route::get('/api/get-all-incentive-search/{search}', 'IncentiveController@getAllIncentiveSearch');

// IncentiveController End

// SalaryController Start

    Route::get('/api/get-salary-staff', 'SalaryController@getSalaryStaff');
    Route::post('/api/add-salary', 'SalaryController@addSalary');
    Route::get('/api/get-all-salarys', 'SalaryController@getAllSalarys');
    Route::get('/api/edit-salary/{id}', 'SalaryController@editSalary');
    Route::post('/api/update-salary', 'SalaryController@updateSalary');
    Route::get('/api/get-all-salary-search/{search}', 'SalaryController@getAllSalarySearch');

// SalaryController End


// VisaUpdatedController Start

    Route::post('/api/add-visa-updated', 'VisaUpdatedController@addVisaUpdated');
    Route::get('/api/get-all-recieved-visa-updated', 'VisaUpdatedController@getAllReceivedVisaUpdated');
    Route::get('/api/edit-received-visa-updated/{id}', 'VisaUpdatedController@editReceivedVisaUpdated');
    Route::post('/api/update-visa-updated', 'VisaUpdatedController@updateVisaUpdated');

    Route::post('/api/add-visa-updated-work-and-notary', 'VisaUpdatedController@addVisaUpdatedWorkAndNotary');
    Route::get('/api/get-all-work-visa-updated', 'VisaUpdatedController@getAllWorkVisaUpdated');
    Route::post('/api/update-visa-updated-work-and-notary', 'VisaUpdatedController@updateVisaUpdatedWorkAndNotary');

    Route::post('/api/add-checked-asst-by-visa-updated', 'VisaUpdatedController@addCheckedAsstByVisaUpdate');
    Route::get('/api/get-all-checked-by-asst-visa-updated', 'VisaUpdatedController@getAllCheckedByAsstVisaUpdated');
    Route::post('/api/update-visa-updated-checked-by-asst', 'VisaUpdatedController@updateVisaUpdatedCheckedByAsst');
    Route::get('/api/get-all-checked-by-offcer-visa-updated', 'VisaUpdatedController@getAllCheckedByOfficerVisaUpdated');
    Route::post('/api/add-checked-by-officer-updated', 'VisaUpdatedController@addCheckedByOfficerUpdated');
    Route::post('/api/update-visa-updated-checked-by-officer', 'VisaUpdatedController@updateCheckedByOfficerUpdated');
    Route::post('/api/add-visa-submit-updated', 'VisaUpdatedController@addVisaSubmitUpdated');
    Route::get('/api/get-all-submit-visa-updated', 'VisaUpdatedController@getAllSubmitVisaUpdated');
    Route::post('/api/add-visa-collected-updated', 'VisaUpdatedController@addVisaCollectedUpdated');
    Route::get('/api/get-all-collected-visa-updated', 'VisaUpdatedController@getAllCollectedVisaUpdated');
    Route::post('/api/update-visa-updated-submit-by', 'VisaUpdatedController@updateVisaUpdatedSubmitBy');
    Route::post('/api/update-visa-updated-collected-by', 'VisaUpdatedController@updateVisaUpdatedCollectedBy');
    Route::post('/api/add-visa-guest-call-and-sms-updated', 'VisaUpdatedController@addVisaGuestCallAndSmsUpdated');
    Route::get('/api/get-all-gcs-visa-updated', 'VisaUpdatedController@getAllGCSVisaUpdated');
    Route::post('/api/update-visa-updated-gcs-by', 'VisaUpdatedController@updateVisaUpdatedGCSBy');
    Route::post('/api/add-visa-delevered-updated', 'VisaUpdatedController@addVisaDeleveredUpdated');
    Route::get('/api/get-all-delevered-visa-updated', 'VisaUpdatedController@getAllDeleveredVisaUpdated');
    Route::post('/api/update-visa-updated-delevered-by', 'VisaUpdatedController@updateVisaUpdatedDeleveredBy');
    Route::get('/api/get-all-staff', 'VisaUpdatedController@getAlltaff');
    Route::get('/api/get-all-visa-search/{search}', 'VisaUpdatedController@getAllVisaSearch');

    Route::get('/api/get-all-visa-staffs-by', 'VisaUpdatedController@getAllVisaStaffsBy');

// VisaUPdatedController End



// NewLoan Start


// ReceivedLoanController Start
    Route::post('/api/add-received-loan', 'ReceivedLoanController@addReceivedLoan');
    Route::get('/api/get-all-received-loan', 'ReceivedLoanController@getAllReceivedLoan');
    Route::get('/api/edit-received-loan/{id}', 'ReceivedLoanController@editReceivedLoan');
    Route::post('/api/update-received-loan', 'ReceivedLoanController@updateReceivedLoan');
    Route::get('/api/get-all-received-loan-search/{search}', 'ReceivedLoanController@getAllReceivedLoanSearch');
// ReceivedLoanController End

// RLInstallment Start
    Route::post('/api/add-received-loan-installment', 'RLInstallmentController@addReceivedLoanInstallment');
    Route::get('/api/get-all-received-loan-name', 'RLInstallmentController@getAllReceivedLoanName');
    Route::get('/api/get-all-rl-installment', 'RLInstallmentController@getAllRLInstallment');
    Route::get('/api/edit-rl-installment/{id}', 'RLInstallmentController@editRLInstallment');
    Route::post('/api/update-received-loan-installment', 'RLInstallmentController@updateRLInstallment');
    Route::get('/api/get-all-rl-installment-search/{search}', 'RLInstallmentController@getAllRLInstallmentSearch');
// RLInstallment End


// PaymentLoanController Start
    Route::post('/api/add-payment-loan', 'PaymentLoanController@addPaymentLoan');
    Route::get('/api/get-all-payment-loan', 'PaymentLoanController@getAllPaymentLoans');
    Route::get('/api/edit-payment-loan/{id}', 'PaymentLoanController@editPaymentLoan');
    Route::post('/api/update-payment-loan', 'PaymentLoanController@updatePaymentLoan');
    Route::get('/api/get-all-payment-loan-search/{search}', 'PaymentLoanController@getAllPaymentLoanSearch');
// PaymentLoanController End
// PLInstallment Start
    Route::get('/api/get-all-payment-loan-name', 'PLInstallmentController@getAllPaymentLoanName');
    Route::post('/api/add-payment-loan-installment', 'PLInstallmentController@addPaymentLoanInstallment');
    Route::get('/api/get-all-payment-loan-installment', 'PLInstallmentController@getAllPaymentLoanInstallment');
    Route::get('/api/edit-payment-loan-installment/{id}', 'PLInstallmentController@editPaymentLoanInstallment');
    Route::post('/api/update-payment-loan-installment', 'PLInstallmentController@udpatePaymentLoanInstallment');
    Route::get('/api/get-all-pl-installment-search/{search}', 'PLInstallmentController@getAllPLLoanInstallment');
// PLInstallment End


// NewLoan End

// AirTicketRefundController Start
    Route::post('/api/add-air-ticket-refund', 'AirTicketRefundController@addAirTicketRefund');
    Route::get('/api/get-all-air-ticket-refund', 'AirTicketRefundController@getAllAirTicketRefund');
    Route::get('/api/edit-air-ticket-refund/{id}', 'AirTicketRefundController@editAirTicketRefund');
    Route::post('/api/update-air-ticket-refund', 'AirTicketRefundController@updateAirTicketRefund');
// AirTicketRefundController End

// AtAGlanceController Start
    Route::get('/api/view-at-a-glance', 'AtAGlanceController@viewAtAGlance');
    Route::get('/api/view-at-a-glance-search/{search}', 'AtAGlanceController@viewAtAGlanceSearch');
// AtAGlanceController End

});





