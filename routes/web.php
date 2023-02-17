<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceBillItemController;
use App\Http\Controllers\ServiceBillAmountController;
use App\Http\Controllers\ProjectLeaderController;
use App\Http\Controllers\ProjectActivitiesController;
use App\Http\Controllers\ProjectEstimationController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\ServiceCatagoryController;
use App\Http\Controllers\ActivitiesCatagoryController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\EquipmentCatagoryController;
use App\Http\Controllers\EquipmentsController;


use App\Http\Controllers\ExpensesFromEquipmentController;
use App\Http\Controllers\ExpensesStaffController;
use App\Http\Controllers\IncomeFromEquipmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SuppliersController;

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


// authorization

Route::get('/register', function () {
    return view('frontend.adduser.register');
});

Route::post('/userregister', [AddUserController::class, 'createAccount'])->name('registerAccount');



Route::post('/userlogin', [AddUserController::class, 'loginAccount'])->name('loginAccount');

Route::get('/login', function () {
    return view('frontend.adduser.login');
});








Route::get('/logout', function () {
    // dd(session()->get('sessionUserId'));
    session()->forget('sessionUserId');

    return redirect('/login');
});








// end 





Route::get('/', function () {

    return view('frontend.home');
});

Route::get('/customer/list', function () {
    return view('frontend.customer.list');
});
Route::get('/staff/add', function () {
    return view('frontend.staff.add');
});
Route::get('/staff/list', function () {
    return view('frontend.staff.list');
});
Route::get('/suppliers/list', function () {
    return view('frontend.suppliers.list');
});

Route::get('/customer/add', function () {
    return view('frontend.customer.add');
});
Route::get('/service/list', function () {
    return view('frontend.service.list');
});


Route::get('/servicebillitems/list', function () {
    return view('frontend.servicebillitems.list');
});
Route::get('/adduser', function () {
    return view('frontend.adduser.adduser');
});

Route::get('/addcompany', function () {
    return view('frontend.company.add');
});


Route::get('/servicebillitemsreport', function () {
    return view('frontend.report.servicebillitem');
});
// Route::get('/projectactivitiesreport', function () {
//     return view('frontend.report.projectactivities');
// });
Route::get('/staffexpensesreport', function () {
    return view('frontend.report.staffreport');
});
Route::get('/projectestimationreport', function () {
    return view('frontend.report.projectestimation');
});
Route::get('/customerwise', function () {
    return view('frontend.report.servicebiiling');
});

Route::get('/invoice', function () {
    return view('frontend.invoice.invoice');
});
// Route::get('/projectwise', function () {
//     return view('frontend.report.projectwise');
// });


Route::get('/servicecatagory/list', function () {
    return view('frontend.servicecatagory.list');
});

Route::get('/servicecatagory/add', function () {
    return view('frontend.servicecatagory.add');
});
// Route::get('/servicebillamount/list', function () {
//     return view('frontend.servicebillamount.list');
// }); 

// Route::get('/servicebillamount/add', function () {
//     return view('frontend.servicebillamount.add');
// });
Route::get('/project/list', function () {
    return view('frontend.project.list');
});
Route::get('/project/list', function () {
    return view('frontend.project.list');
});

Route::get('/manageuser', function () {
    return view('frontend.manageuser.list');
});

Route::get('/projectleader/add', function () {
    return view('frontend.projectleader.add');
});
Route::get('/projectactivities/list', function () {
    return view('frontend.projectactivities.list');
});

Route::get('/activities/add', function () {
    return view('frontend.activities.add');
});

Route::get('/activities/list', function () {
    return view('frontend.activities.list');
});
Route::get('/activitiescatagory/list', function () {
    return view('frontend.activitiescatagory.list');
});
Route::get('/activitiescatagory/add', function () {
    return view('frontend.activitiescatagory.add');
});

Route::get('/service/add', function () {
    return view('frontend.service.add');
});
Route::get('/suppliers/add', function () {
    return view('frontend.suppliers.add');
});
Route::get('/equipment/add', function () {
    return view('frontend.equipment.add');
});
Route::get('/equipment/list', function () {
    return view('frontend.equipment.list');
});
Route::get('/equipmentcatagory/add', function () {
    return view('frontend.equipmentcatagory.add');
});
Route::get('/equipmentcatagory/list', function () {
    return view('frontend.equipmentcatagory.list');
});
Route::get('/incomeequipment/list', function () {
    return view('frontend.equipment.list');
});
Route::get('/incomeequipment/add', function () {
    return view('frontend.incomefromequipment.add');
});
Route::get('/incomefromequipment/list', function () {
    return view('frontend.incomefromequipment.list');
});
Route::get('/expensesequipment/add', function () {
    return view('frontend.expensesfromequipment.add');
});
Route::get('/expensesfromequipment/list', function () {
    return view('frontend.expensesfromequipment.list');
});
Route::get('/expensesstaff/add', function () {
    return view('frontend.expensesfromstaff.add');
});
Route::get('/expensesfromstaff/list', function () {
    return view('frontend.expensesfromstaff.list');
});



Route::get('/service/add', [ServiceController::class, 'index']);

Route::get('/servicebillitems/add', [ServiceBillItemController::class, 'index']);

Route::get('/projectactivities/add', [ProjectActivitiesController::class, 'index']);

Route::get('/projectestimation/add', [ProjectEstimationController::class, 'index']);

Route::get('/projectprogress/add', [ProjectEstimationController::class, 'progressIndex']);

Route::get('/suppliers/list', [SuppliersController::class, 'index']);



Route::post('/post/customer', [CustomerController::class, 'postCustomerData'])->name('postCustomerData');

Route::post('/postStaffData', [StaffController::class, 'store']);

Route::post('/adduser', [AddUserController::class, 'store'])->name('store');


Route::post('/addcompany', [InvoiceController::class, 'store']);

Route::post('/addequipment', [EquipmentsController::class, 'store'])->name('equipmentadd');

Route::post('/manageuser', [ManagementUserController::class, 'store']);

Route::get('/manageuser/{id}', [ManagementUserController::class, 'edit']);



Route::post('/addincomeequipment', [IncomeFromEquipmentController::class, 'store'])->name('addincomeequipment');

Route::post('/addexpensesequipment', [ExpensesFromEquipmentController::class, 'store'])->name('addexpensesequipment');

Route::post('/addexpensestaff', [ExpensesStaffController::class, 'store'])->name('addexpensesstaff');

Route::post('/addequipmentcatagory', [EquipmentCatagoryController::class, 'store'])->name('addequipmentCatagory');

Route::post('/post/project', [ProjectController::class, 'postProjectData'])->name('postProjectData');

Route::post('/post/projectdata', [ProjectController::class, 'postProject'])->name('postProject');

Route::post('/post/service', [ServiceController::class, 'postServiceData'])->name('postServiceData');

Route::post('/post/servicebillitems', [ServiceBillItemController::class, 'postServieBillItemsData'])->name('postServiceBillItemsData');

Route::post('/update/servicebillitems', [ServiceBillItemController::class, 'updateServieBillItemsData'])->name('updateServiceBillItemsData');

// Route::post('/post/servicebillamount', [ServiceBillAmountController::class, 'postServieBillAmountData'])->name('postServiceBillAmountData');

Route::post('/post/projectleader', [ProjectLeaderController::class, 'postProjectLeaderData'])->name('postProjectLeaderData');

Route::post('/post/projectactivites', [ProjectActivitiesController::class, 'postProjectActivitiesData'])->name('postProjectActivitiesData');

Route::post('/post/projectestimation', [ProjectEstimationController::class, 'postProjectEstimationData'])->name('postProjectEstimationData');

Route::post('/post/projectprogress', [ProjectEstimationController::class, 'postProjectProgressData'])->name('postProjectProgressData');

Route::post('/update/projectactivites', [ProjectActivitiesController::class, 'updateProjectActivitiesData'])->name('updateProjectActivitiesData');

Route::post('/update/projectestimation', [ProjectEstimationController::class, 'updateProjectEstimationData'])->name('updateProjectEstimationData');

Route::post('/post/activites', [ActivitiesController::class, 'postActivitiesData'])->name('postActivitiesData');

Route::post('/post/servicecatagory', [ServiceCatagoryController::class, 'postServiceCatagoryData'])->name('postServiceCatagoryData');

Route::post('/post/activitiescatagory', [ActivitiesCatagoryController::class, 'postActivitiesCatagoryData'])->name('postActivitiesCatagoryData');

Route::post('/post/suppliers', [SuppliersController::class, 'store']);



Route::get('/customer/list', [CustomerController::class, 'getCustomerData'])->name('getCustomerData');

Route::get('/adduser', [AddUserController::class, 'index'])->name('index');

Route::get('/manageuser', [ManagementUserController::class, 'index']);

Route::get('/addcompany', [InvoiceController::class, 'index']);






Route::get('/viewequipment', [EquipmentsController::class, 'showEquipment']);

Route::get('/showincomeequipment', [IncomeFromEquipmentController::class, 'showIncome'])->name('showIncome');

Route::get('/incomereport', [IncomeFromEquipmentController::class, 'showIncomeReport'])->name('showIncomeReport');

Route::get('/expensesreport', [ExpensesFromEquipmentController::class, 'showExpensesReport']);

Route::get('/staff/list', [StaffController::class, 'show']);




Route::get('/showexpensesequipment', [ExpensesFromEquipmentController::class, 'showExpenses'])->name('showExpenses');


Route::get('/expensesfromstaff/list', [ExpensesStaffController::class, 'show']);

Route::get('/suppliers/list', [SuppliersController::class, 'show']);





Route::get('/showequipmentCatagory', [EquipmentCatagoryController::class, 'show'])->name('showCatagory');


Route::get('/service/list', [ServiceController::class, 'getServiceData'])->name('getServiceData');

Route::get('/servicebillitems/list', [ServiceBillItemController::class, 'getServiceBillItemData'])->name('getServiceBillItemData');

Route::get('/servicebillitemsreport', [ServiceBillItemController::class, 'getServiceBillItemsData'])->name('getServiceBillItemsData');

Route::get('/customerwise', [ServiceBillItemController::class, 'getCustomerWiseData'])->name('getCustomerWiseData');

Route::get('/singleprojectdetails/{id}/{projectname}', [ProjectActivitiesController::class, 'getSingleWiseData']);

Route::get('/singlesuppliersdetails/{id}/{fullname}', [ProjectActivitiesController::class, 'getSuppliersSingleWiseData']);

Route::get('/', [ServiceBillItemController::class, 'totalData']);



Route::get('/invoice/{id}', [ServiceBillItemController::class, 'forinvoiceData'])->name('forinvoiceData');

Route::get('/invoice-income', [IncomeFromEquipmentController::class, 'forinvoiceData'])->name('forinvoiceIncome');

Route::get('/invoice-expenses', [ExpensesFromEquipmentController::class, 'forexpenseData'])->name('forexpensesIncome');




Route::get('/project-activities', [ProjectActivitiesController::class, 'forProjectActivitiesData'])->name('forProjectActivitiesData');

Route::get('/service-activities', [ServiceBillItemController::class, 'forServiceInvoiceData'])->name('forServiceInvoiceData');

Route::get('/staff-activities', [StaffController::class, 'forStaffInvoice'])->name('forStaffInvoice');

Route::get('/activities/list', [ActivitiesController::class, 'getActivityData'])->name('getActivityData');

Route::get('/servicebillamount/list', [ServiceBillAmountController::class, 'getServiceBillAmountData'])->name('getServiceBillAmountData');

Route::get('/project/list', [ProjectController::class, 'getProjectData'])->name('getProjectData');

Route::get('/projectwise', [ProjectController::class, 'getProjectWise']);

Route::get('/supplierswise', [SuppliersController::class, 'getSuppliersWise']);

Route::get('/projectactivities/list', [ProjectActivitiesController::class, 'getProjectActivitiesData'])->name('getProjectActivitiesData');


Route::get('/projectestimation/list', [ProjectEstimationController::class, 'getProjectEstimationData'])->name('getProjectEstimationData');

Route::get('/projectprogress/list', [ProjectEstimationController::class, 'getProjectProgressData'])->name('getProjectProgressData');

Route::get('/projectestimationreport', [ProjectEstimationController::class, 'estimationReport'])->name('estimationReport');

Route::get('/projectactivitiesreport', [ProjectActivitiesController::class, 'getProjectActivitiesReport'])->name('getProjectActivitiesReport');


Route::get('/searchSuppliersReport', [ProjectActivitiesController::class, 'getSuppliersActivitiesReport']);



Route::get('/staffexpensesreport', [ExpensesStaffController::class, 'getStaffExpensesReport']);




Route::get('/projectleader/list', [ProjectLeaderController::class, 'getProjectLeaderData'])->name('getProjectLeaderData');

// 



Route::get('/servicecatagory/list', [ServiceCatagoryController::class, 'getServiceCatgoryData'])->name('getServiceCatgoryData');


Route::get('/activitiescatagory/list', [ActivitiesCatagoryController::class, 'getActivitiesCatagoryData'])->name('getActivitiesCatagoryData');




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/admin/service/manage', [App\Http\Controllers\SiteController::class, 'getServiceManage'])->name('getServiceManage');


//CRUD method for the customer//
// Route::get('/customer/list', [CustomersController::class, 'index']);



Route::get('delete-customer/{id}', [CustomerController::class, 'deleteCustomer'])->name('deleteCustomer');

Route::get('delete-staff/{id}', [StaffController::class, 'destroy']);



Route::get('delete-user/{id}', [AddUser::class, 'destroy'])->name('destroy');

Route::get('delete-equipment/{id}', [EquipmentsController::class, 'destroy']);

Route::get('delete-equipmentcatagory/{id}', [EquipmentCatagoryController::class, 'destroy']);

Route::get('delete-equipmentincome/{id}', [IncomeFromEquipmentController::class, 'destroy']);

Route::get('delete-equipmentexpenses/{id}', [ExpensesFromEquipmentController::class, 'destroy']);

Route::get('delete-staffexpenses/{id}', [ExpensesStaffController::class, 'destroy']);

Route::get('delete-suppliers/{id}', [SuppliersController::class, 'destroy']);


Route::get('edit-customer/{id}', [CustomerController::class, 'EditCustomer']);

Route::get('edit-staff/{id}', [StaffController::class, 'edit']);

Route::get('edit-suppliers/{id}', [SuppliersController::class, 'edit']);

Route::get('edit-equipment/{id}', [EquipmentsController::class, 'edit']);

Route::get('edit-equipmentcatagory/{id}', [EquipmentCatagoryController::class, 'edit']);



Route::get('edit-fromincomeequipment/{id}', [IncomeFromEquipmentController::class, 'edit']);

Route::post('update-fromincomeequipment/{id}', [IncomeFromEquipmentController::class, 'update']);

Route::post('update-equipmentcatagory/{id}', [EquipmentCatagoryController::class, 'update']);

Route::get('edit-fromexpensesequipment/{id}', [ExpensesFromEquipmentController::class, 'edit']);

Route::get('edit-forstaffexpenses/{id}', [ExpensesStaffController::class, 'edit']);

Route::post('update-fromexpensesequipment/{id}', [ExpensesFromEquipmentController::class, 'update']);

Route::post('update-forstaffexpenses/{id}', [ExpensesStaffController::class, 'update']);

Route::post('update-equipment/{id}', [EquipmentsController::class, 'update'])->name('updateEquipment');

Route::get('edit-user/{id}', [AddUserController::class, 'edit']);

Route::get('edit-managementuser/{id}', [ManagementUserController::class, 'edit']);

Route::get('edit-company/{id}', [InvoiceController::class, 'edit']);

Route::post('update-customer/{id}', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');

Route::post('update-staff/{id}', [StaffController::class, 'update'])->name('updateStaff');

Route::post('update-user/{id}', [AddUserController::class, 'update'])->name('update');

Route::post('update-company/{id}', [InvoiceController::class, 'update']);

Route::post('update-suppliers/{id}', [SuppliersController::class, 'update']);

Route::GET('/customersearch', [CustomerController::class, 'search']);

Route::GET('/staffsearch', [StaffController::class, 'search']);

Route::GET('/supplierssearch', [SuppliersController::class, 'search']);

Route::GET('/staffnamesearch', [ExpensesStaffController::class, 'search']);

Route::GET('/incomesearch', [IncomeFromEquipmentController::class, 'search']);

Route::GET('/expensessearch', [ExpensesFromEquipmentController::class, 'search']);

Route::get('/equipmentsearch', [EquipmentsController::class, 'search']);

Route::get('/equipmentcatagorysearch', [EquipmentCatagoryController::class, 'search']);

Route::get('customer-export', [CustomerController::class, 'export'])->name('customer.export');

Route::get('equipment-export', [EquipmentsController::class, 'export']);

Route::get('equipmentcatagory-export', [EquipmentCatagoryController::class, 'export']);

Route::get('income-export', [IncomeFromEquipmentController::class, 'export']);

Route::get('expenses-export', [ExpensesFromEquipmentController::class, 'export']);



//CRUD for the service//

Route::get('delete-service/{id}', [ServiceController::class, 'deleteService'])->name('deleteService');

Route::get('edit-service/{id}', [ServiceController::class, 'EditService']);

Route::post('update-service/{id}', [ServiceController::class, 'updateService'])->name('updateService');

Route::POST('/servicesearch', [ServiceController::class, 'search']);

Route::get('service-export', [ServiceController::class, 'export'])->name('service.export');

Route::get('/service/add', [ServiceController::class, 'index']);

Route::get('/equipment/add', [EquipmentsController::class, 'index']);



//CRUD for the service bill amount//

Route::get('edit-servicebillamount/{id}', [ServiceBillAmountController::class, 'editServiceBillAmount'])->name('editServiceBillAmount');

Route::get('edit-servicebilling/{id}', [ServiceBillAmountController::class, 'editServiceBilling'])->name('editServiceBilling');

Route::get('delete-servicebillamount/{id}', [ServiceBillAmountController::class, 'deleteServiceBillAmount'])->name('deleteServiceBillAmount');

Route::post('update-servicebillamount/{id}', [ServiceBillAmountController::class, 'updateServiceBillAmount'])->name('updateServiceBillAmount');





Route::get('servicebillamount-export', [ServiceBillAmountController::class, 'export'])->name('servicebillamount.export');


//CRUD for service bill items //

Route::get('servicebillitems-delete/{id}', [ServiceBillItemController::class, 'deleteServiceBillItems'])->name('deleteServiceBillItems');

Route::get('edit-servicebillitem/{id}', [ServiceBillItemController::class, 'editServiceBillItems'])->name('editServiceBillItems');

Route::post('update-servicebillitem/{id}', [ServiceBillItemController::class, 'updateServiceBillItems'])->name('updateServiceBillItems');



Route::GET('/servicebillitemssearch', [ServiceBillItemController::class, 'search']);

Route::get('servicebillitem-export', [ServiceBillItemController::class, 'export'])->name('servicebillitem.export');

// CRUD for project

Route::get('delete-project/{id}', [ProjectController::class, 'deleteProject'])->name('deleteProject');

Route::get('edit-project/{id}', [ProjectController::class, 'editProject'])->name('editProject');

Route::post('update-project/{id}', [ProjectController::class, 'updateProject'])->name('updateProject');


Route::GET('/projectsearch', [ProjectController::class, 'search']);

Route::get('project-export', [ProjectController::class, 'export'])->name('project.export');


Route::get('/project/add', [ProjectController::class, 'index']);



//CRUD for project leader//
Route::get('delete-projectleader/{id}', [ProjectLeaderController::class, 'deleteProjectLeader'])->name('deleteProjectLeader');

Route::get('edit-projectleader/{id}', [ProjectLeaderController::class, 'editProjectLeader'])->name('editProjectLeader');

Route::post('update-projectleader/{id}', [ProjectLeaderController::class, 'updateProjectLeader'])->name('updateProjectLeader');

Route::GET('/projectleadersearch', [ProjectLeaderController::class, 'search']);

Route::get('projectleader-export', [ProjectLeaderController::class, 'export'])->name('projectleader.export');



Route::get('projectestimation-delete/{projectestimation_id}', [ProjectEstimationController::class, 'deleteProjectEstimation'])->name('deleteProjectEstimation');

Route::get('projectestimation-edit/{tcode}', [ProjectEstimationController::class, 'editProjectEstimation'])->name('editProjectEstimation');




//CRUD for project activities

Route::get('projectactivities-delete/{projectactivities_id}', [ProjectActivitiesController::class, 'deleteProjectActivity'])->name('deleteProjectActivity');

Route::get('projectactivities-edit/{tcode}', [ProjectActivitiesController::class, 'editProjectActivity'])->name('editProjectActivity');

Route::get('projectactivities-show/{id}', [ProjectActivitiesController::class, 'showProjectActivity'])->name('showProjectActivity');

// Route::post('projectactivities-update/{id}', [ProjectActivitiesController::class, 'updateProjectActivity'])->name('updateProjectActivity');

Route::POST('/projectactivitiessearch', [ProjectActivitiesController::class, 'search']);

Route::POST('/projectestimationsearch', [ProjectEstimationController::class, 'search'])->name('projectEstimation');

Route::get('projectactivities-export', [ProjectActivitiesController::class, 'export'])->name('projectactivities.export');
//CRUD for activity

Route::get('delete-activities/{id})', [ActivitiesController::class, 'deleteActivities'])->name('deleteActivities');

Route::get('edit-activities/{id})', [ActivitiesController::class, 'editActivities'])->name('editActivities');

Route::post('update-activities/{id})', [ActivitiesController::class, 'updateActivities'])->name('updateActivities');

Route::GET('/activitiessearch', [ActivitiesController::class, 'search']);

Route::get('activity-export', [ActivitiesController::class, 'export'])->name('activity.export');


Route::get('/activities/add', [ActivitiesController::class, 'index']);

Route::get('/projectactivities/add', [ActivitiesController::class, 'activitiesCatagories']);

Route::get('/projectprogress/add', [ActivitiesController::class, 'activitiesCatagoriesForProjectProgress']);

Route::get('/projectestimation/add', [ActivitiesController::class, 'activitiesCatagoriesForProjectEstimation']);


Route::get('/incomeequipment/add', [IncomeFromEquipmentController::class, 'index']);



Route::get('/expensesequipment/add', [ExpensesFromEquipmentController::class, 'index']);





//CRUD for activity catagory

Route::get('delete-activitycatagory/{id}', [ActivitiesCatagoryController::class, 'deleteActivityCatagory'])->name('deleteActivityCatagory');

Route::get('edit-activitycatagory/{id}', [ActivitiesCatagoryController::class, 'editActivityCatagory'])->name('editActivityCatagory');

Route::post('update-activitycatagory/{id}', [ActivitiesCatagoryController::class, 'updateActivitiesCatagory'])->name('updateActivitiesCatagory');

Route::GET('/activtiescatagorysearch', [ActivitiesCatagoryController::class, 'search']);

Route::get('activitycatagory-export', [ActivitiesCatagoryController::class, 'export'])->name('activitycatagory.export');




//CRUD for service catagory//
Route::get('delete-servicecatagory/{id}', [ServiceCatagoryController::class, 'deleteServiceCatagory'])->name('deleteServiceCatagory');

Route::get('edit-servicecatagory/{id}', [ServiceCatagoryController::class, 'editServiceCatagory'])->name('editServiceCatagory');

Route::post('update-servicecatagory/{id}', [ServiceCatagoryController::class, 'updateServiceCatagory'])->name('updateServiceCatagory');

Route::GET('/servicecatagorysearch', [ServiceCatagoryController::class, 'search']);

Route::get('servicecatagory-export', [ServiceCatagoryController::class, 'export'])->name('servicecatagory.export');



// search customer id using ajax from customer table

Route::get('/searchCustomerForCustomerId/{searchKey}', [CustomerController::class, 'searchCustomer']);

Route::get('/searchstaffForstaffId/{StaffName}', [StaffController::class, 'searchStaff']);


Route::get('/searchEquipmentForEquipmentId/{searchKey}', [EquipmentsController::class, 'searchEquipment']);




// search customer id using ajax from project leader table
Route::get('/searchProjectLeaderForLeaderId/{searchKey}', [ProjectLeaderController::class, 'searchProjectLeader']);


Route::get('/searchServiceForServiceId/{searchKey}', [ServiceController::class, 'searchService']);

Route::get('/searchProjectForProjectId/{searchKey}', [ProjectController::class, 'searchProject']);

Route::get('/searchSuppliersForSuppliersId/{searchKey}', [SuppliersController::class, 'searchSuppliers']);

Route::get('/searchActivityForActivityId/{searchKey}', [ActivitiesController::class, 'searchActivities']);

Route::get('/searchServiceItems/{tCode}', [ServiceBillItemController::class, 'serviceItems']);

Route::get('/searchDate', [ProjectActivitiesController::class, 'searchDate']);

Route::get('/estimationReport', [ProjectEstimationController::class, 'estimationReport']);

Route::get('/searchDateInExpenses', [ExpensesFromEquipmentController::class, 'searchDateInExpenses']);

Route::get('/searchDateInIncome', [IncomeFromEquipmentController::class, 'searchDateInIncome']);

Route::get('/searchBillItemDate', [ServiceBillItemController::class, 'searchBillDate']);

Route::get('/searchBillDateWithCustomer', [ServiceBillItemController::class, 'searchBillDateWithCustomer']);

Route::get('/searchStaffDate', [ExpensesStaffController::class, 'searchDateWithStaff']);

Route::get('/searchDateWithProject', [ProjectActivitiesController::class, 'searchProject']);

Route::get('/searchDateWithSuppliers', [ProjectActivitiesController::class, 'getSuppliersActivitiesReport']);


