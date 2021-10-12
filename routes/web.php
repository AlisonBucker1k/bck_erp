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


Route::get('/','HomeController@index');
//route to url access
Route::get('/account','AccountController@index');
Route::get('/account/index','AccountController@index');
Route::get('/account/detail/{id}','AccountController@detail');
Route::get('/account/getdatadetail/{id}','AccountController@getdatadetail');
Route::get('/account/accountbalancebymonth/{id}','AccountController@accountbalancebymonth');
Route::get('/account/getaccounttransaction/{id}','AccountController@getaccounttransaction');
Route::get('/account/getdata','AccountController@getdata');
Route::post('/account/save','AccountController@save');
Route::post('/account/delete','AccountController@delete');
Route::post('/account/getedit','AccountController@getedit');
Route::post('/account/edit','AccountController@saveedit');
Route::resource('account','AccountController');

Route::get('/income','IncomeTransactionController@dashboard');
Route::get('/income/index','IncomeTransactionController@dashboard');
Route::get('/income/getdata','IncomeTransactionController@getdata');
Route::get('/income/getdatacalendar','IncomeTransactionController@getdatacalendar');
Route::get('/income/gettotal','IncomeTransactionController@total');
Route::post('/income/save','IncomeTransactionController@save');
Route::post('/income/delete','IncomeTransactionController@delete');
Route::post('/income/getedit','IncomeTransactionController@getedit');
Route::post('/income/edit','IncomeTransactionController@saveedit');
Route::post('/income/gettotalfilterdate','IncomeTransactionController@gettotalfilterdate');


Route::get('/upcomingincome','IncomeTransactionController@upcomingincome');
Route::get('/upcomingincome/index','IncomeTransactionController@upcomingincome');
Route::get('/upcomingincome/getdataupcoming','IncomeTransactionController@getdataupcoming');
Route::post('/upcomingincome/saveupcoming','IncomeTransactionController@saveupcoming');
Route::post('/upcomingincome/getedit','IncomeTransactionController@geteditupcoming');
Route::post('/upcomingincome/edit','IncomeTransactionController@saveeditupcoming');
Route::get('/upcomingincome/gettotal','IncomeTransactionController@totalupcoming');
Route::post('/upcomingincome/dopay','IncomeTransactionController@dopay');


Route::get('/upcomingexpense','ExpenseTransactionController@upcomingincome');
Route::get('/upcomingexpense/index','ExpenseTransactionController@upcomingincome');
Route::get('/upcomingexpense/getdataupcoming','ExpenseTransactionController@getdataupcoming');
Route::post('/upcomingexpense/saveupcoming','ExpenseTransactionController@saveupcoming');
Route::post('/upcomingexpense/getedit','ExpenseTransactionController@geteditupcoming');
Route::post('/upcomingexpense/edit','ExpenseTransactionController@saveeditupcoming');
Route::get('/upcomingexpense/gettotal','ExpenseTransactionController@totalupcoming');
Route::post('/upcomingexpense/dopay','ExpenseTransactionController@dopay');



Route::get('/reports/allreports','ReportsController@allreports');
Route::get('/reports/income','ReportsController@incomereports');
Route::get('/reports/upcomingincome','ReportsController@upcomingincomereports');
Route::get('/reports/expense','ReportsController@expensereports');
Route::get('/reports/upcomingexpense','ReportsController@upcomingexpensereports');
Route::get('/reports/gettransactionsupcoming','ReportsController@gettransactionsupcoming');
Route::get('/reports/incomevsexpense','ReportsController@incomevsexpensereports');
Route::get('/reports/gettransactions','ReportsController@gettransactions');
Route::get('/reports/getaccounttransaction','ReportsController@getaccounttransaction');
Route::get('/reports/account','ReportsController@accountreports');
Route::get('/reports/incomemonth','ReportsController@incomemonth');
Route::get('/reports/expensemonth','ReportsController@expensemonth');
Route::get('/reports/getincomemonthly','ReportsController@getincomemonthly');
Route::get('/reports/getexpensemonthly','ReportsController@getexpensemonthly');
Route::get('/reports/getbalance','ReportsController@getbalance');
Route::resource('reports','ReportsController');


Route::get('/expense','ExpenseTransactionController@dashboard');
Route::get('/expense/index','ExpenseTransactionController@dashboard');
Route::get('/expense/getdata','ExpenseTransactionController@getdata');
Route::get('/expense/getdatacalendar','ExpenseTransactionController@getdatacalendar');
Route::get('/expense/gettotal','ExpenseTransactionController@total');
Route::post('/expense/save','ExpenseTransactionController@save');
Route::post('/expense/delete','ExpenseTransactionController@delete');
Route::post('/expense/getedit','ExpenseTransactionController@getedit');
Route::post('/expense/edit','ExpenseTransactionController@saveedit');


Route::get('/upcomingexpense','ExpenseTransactionController@upcomingexpense');
Route::get('/upcomingexpense/index','ExpenseTransactionController@upcomingexpense');




Route::get('/incomecategory','CategoryController@incomeindex');
Route::get('/incomecategory/index','CategoryController@incomeindex');
Route::get('/incomecategory/getdata','CategoryController@incomegetdata');
Route::post('/incomecategory/save','CategoryController@incomesave');
Route::post('/incomecategory/delete','CategoryController@incomedelete');
Route::post('/incomecategory/getedit','CategoryController@incomegetedit');
Route::post('/incomecategory/edit','CategoryController@incomesaveedit');

Route::get('/incomecategory/subgetdata','CategoryController@incomesubgetdata');
Route::post('/incomecategory/subgetdatabycat','CategoryController@incomesubcategorybycat');
Route::post('/incomecategory/subsave','CategoryController@incomesubsave');
Route::post('/incomecategory/subdelete','CategoryController@incomesubdelete');
Route::post('/incomecategory/subgetedit','CategoryController@incomesubgetedit');
Route::post('/incomecategory/subedit','CategoryController@incomesubsaveedit');



Route::get('/expensecategory','ExpenseCategoryController@expenseindex');
Route::get('/expensecategory/index','ExpenseCategoryController@expenseindex');
Route::get('/expensecategory/getdata','ExpenseCategoryController@expensegetdata');
Route::post('/expensecategory/save','ExpenseCategoryController@expensesave');
Route::post('/expensecategory/delete','ExpenseCategoryController@expensedelete');
Route::post('/expensecategory/getedit','ExpenseCategoryController@expensegetedit');
Route::post('/expensecategory/edit','ExpenseCategoryController@expensesaveedit');

Route::get('/expensecategory/subgetdata','ExpenseCategoryController@expensesubgetdata');
Route::post('/expensecategory/subgetdatabycat','ExpenseCategoryController@expensesubcategorybycat');
Route::post('/expensecategory/subsave','ExpenseCategoryController@expensesubsave');
Route::post('/expensecategory/subdelete','ExpenseCategoryController@expensesubdelete');
Route::post('/expensecategory/subgetedit','ExpenseCategoryController@expensesubgetedit');
Route::post('/expensecategory/subedit','ExpenseCategoryController@expensesubsaveedit');



Route::get('/budget','BudgetController@index');
Route::get('/budget/index','BudgetController@index');
Route::get('/budget/getdata','BudgetController@getdata');
Route::post('/budget/save','BudgetController@save');
Route::post('/budget/delete','BudgetController@deleteitem');
Route::post('/budget/getedit','BudgetController@budgetgetedit');
Route::post('/budget/edit','BudgetController@saveedit');
Route::post('/budget/gettransactionbydate','BudgetController@gettransactionbydate');
Route::resource('budget','BudgetController');


Route::get('/goals','GoalController@index');
Route::get('/goals/index','GoalController@index');
Route::get('/goals/getdata','GoalController@getdata');
Route::post('/goals/save','GoalController@save');
Route::post('/goals/delete','GoalController@deleteitem');
Route::post('/goals/getedit','GoalController@goalsgetedit');
Route::post('/goals/edit','GoalController@saveedit');
Route::post('/goals/deposit','GoalController@deposit');
Route::resource('goals','GoalController');

Route::get('/calendar/index','CalendarController@index');

Route::resource('calendar','CalendarController');

Route::get('/transaction','IncomeTransactionController@index');
Route::get('/transaction/index','IncomeTransactionController@index');
Route::post('/transaction/saveincome','IncomeTransactionController@saveincome');
Route::post('/transaction/saveexpense','ExpenseTransactionController@saveexpense');
Route::get('/transaction/downloadcsv','IncomeTransactionController@downloadcsv');
Route::post('/transaction/importcsv','IncomeTransactionController@importcsv');
Route::post('/transaction/importcsv2','ExpenseTransactionController@importcsv');

Route::get('/settings/application','SettingController@applicationindex');
Route::get('/settings/getapplication','SettingController@getapplication');
Route::post('/settings/saveapplication','SettingController@saveapplication');
Route::post('/settings/insertrole','SettingController@insertrole');
Route::get('/settings/getrole','SettingController@getrole');
Route::get('/settings/getprofile','UserController@getprofile');
Route::get('/settings/profile','UserController@profile');
Route::get('/settings/allusers','UserController@allusers');
Route::get('/settings/getuser','UserController@getuser');
Route::post('/settings/getuseredit','UserController@getedit');
Route::get('/settings/totalusers','UserController@totalusers');
Route::post('/settings/saveuser','UserController@save');
Route::post('/settings/deleteuser','UserController@delete');
Route::post('/settings/saveprofile','UserController@saveprofile');
Route::post('/settings/saveprofilebyadmin','UserController@saveprofilebyadmin');
Route::resource('settings','SettingController');


Route::get('logout', 'Auth\LoginController@logout');
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@authenticate');
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@authenticate']);

Route::get('/home/incomevsexpense','HomeController@incomevsexpense');
Route::get('/home/totalbalance','HomeController@totalbalance');
Route::get('/home/expensebycategory','HomeController@expensebycategory');
Route::get('/home/incomebycategory','HomeController@incomebycategory');
Route::get('/home/expensebycategoryyearly','HomeController@expensebycategoryyearly');
Route::get('/home/incomebycategoryyearly','HomeController@incomebycategoryyearly');
Route::get('/home/upcomingexpensebycategoryyearly','HomeController@upcomingexpensebycategoryyearly');
Route::get('/home/upcomingincomebycategoryyearly','HomeController@upcomingincomebycategoryyearly');
Route::get('/home/budgetlist','HomeController@budgetlist');
Route::get('/home/accountbalance','HomeController@accountbalance');
Route::get('/home/latestincome','HomeController@latestincome');
Route::get('/home/latestexpense','HomeController@latestexpense');
Route::resource('home','HomeController');


Route::get('/home', 'HomeController@index')->name('home');
