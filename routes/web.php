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
//    return view('home');
//});
Route::get('pae', 'PaeController@pae')->name('pae');


//for user ===========================================================================================================
//{
Auth::routes();
Route::get('/', 'HomeController@indexDash')->name('home');
Route::get('/home', 'HomeController@indexDash')->name('home');
Route::get('/indexDash', 'HomeController@indexDash')->name('indexDash');

//Admin Data CMU จากเป้
Route::get('/alldatacmu', 'HomeController@alldatacmu')->name('alldatacmu');

//dash
Route::get('/analyticDash', 'HomeController@analyticDash')->name('analyticDash');
Route::post('/analyticYear', 'HomeController@analyticYear')->name('analyticYear');

//====================================================================================================================
//---------------User-------------------------------------------------

// Route::get('/user', 'UserController@user_home')->name('user_home');
// Route::get('/user_editdata&{off_id}', 'UserController@user_editdata')->name('user_editdata');
// Route::post('/user_updatedata', 'UserController@user_updatedata')->name('user_updatedata');
//--------------------------------------------------------------------
//====================================================================================================================
//audit zone
//menu (สร้างรายงานใหม่)
Route::get('/admin_excel_menu&{off_id}', 'ExcelController@adminExcelMenu')->name('admin_excel_menu');
Route::post('/admin_excel_new_report', 'ExcelController@adminExcelNewReport')->name('admin_excel_new_report');

//------------------------------
//import_general(ข้อมูลทั่วไป)
Route::get('import_excel_view_general&{off_id}&{year}', 'ExcelController@importExcelViewGeneral')->name('import_excel_view_general');
Route::post('import_excel_general', 'ExcelController@importExcel_general')->name('import_excel_general');
Route::post('import_excel_edit_general', 'ExcelController@importExcelEditGeneral')->name('import_excel_edit_general');
Route::get('import_excel_del_general&{off_id}&{year}', 'ExcelController@importExcelDelGeneral')->name('import_excel_del_general');
//export_general(ข้อมูลทั่วไป)
Route::get('export_file_general&{off_id}&{year}', 'ExcelController@exportFileGeneral')->name('export_file_general');

//------------------------------
//import_person(ข้อมูลคน)
Route::get('import_excel_view_person&{off_id}&{year}', 'ExcelController@importExcelViewPerson')->name('import_excel_view_person');
Route::post('import_excel_insert_person', 'ExcelController@importExcelInsertPerson')->name('import_excel_insert_person');
Route::post('import_excel_edit_person', 'ExcelController@importExcelEditPerson')->name('import_excel_edit_person');

//------------------------------
//expenses(ข้อมูลค่าไฟ_t1)
Route::get('import_excel_view_expenses_t1&{off_id}&{year}', 'ExcelController@importExcelViewExpenses_t1')->name('import_excel_view_expenses_t1');
Route::post('import_excel_expenses_t1', 'ExcelController@importExcel_expenses_t1')->name('import_excel_expenses_t1');
Route::post('import_excel_edit_expenses_t1&{off_id}&{year}', 'ExcelController@importExcelEditExpenses_t1')->name('import_excel_edit_expenses_t1');
Route::get('import_excel_del_expenses_t1&{off_id}&{year}', 'ExcelController@importExcelDelExpenses_t1')->name('import_excel_del_expenses_t1');
//expenses(ข้อมูลค่าไฟ_t1)
Route::get('export_file_expenses_t1&{off_id}&{year}', 'ExcelController@exportFileExpenses_t1')->name('export_file_expenses_t1');

//------------------------------
//expenses(ข้อมูลค่าไฟ_t2)
Route::get('import_excel_view_expenses_t2&{off_id}&{year}', 'ExcelController@importExcelViewExpenses_t2')->name('import_excel_view_expenses_t2');
Route::post('import_excel_expenses_t2', 'ExcelController@importExcel_expenses_t2')->name('import_excel_expenses_t2');
Route::post('import_excel_edit_expenses_t2&{off_id}&{year}', 'ExcelController@importExcelEditExpenses_t2')->name('import_excel_edit_expenses_t2');
Route::get('import_excel_del_expenses_t2&{off_id}&{year}', 'ExcelController@importExcelDelExpenses_t2')->name('import_excel_del_expenses_t2');
//expenses(ข้อมูลค่าไฟ_t2)
Route::get('export_file_expenses_t2&{off_id}&{year}', 'ExcelController@exportFileExpenses_t2')->name('export_file_expenses_t2');

//------------------------------
//building(ข้อมูลลักษณะอาคาร)
Route::get('import_excel_view_building&{off_id}&{year}', 'ExcelController@importExcelViewBuilding')->name('import_excel_view_building');
Route::post('import_excel_building', 'ExcelController@importExcel_building')->name('import_excel_building');
Route::post('import_excel_edit_building&{off_id}&{year}', 'ExcelController@importExcelEditBuilding')->name('import_excel_edit_building');
Route::get('import_excel_del_building&{off_id}&{year}', 'ExcelController@importExcelDelBuilding')->name('import_excel_del_building');
//building(ข้อมูลลักษณะอาคาร)
Route::get('export_file_building&{off_id}&{year}', 'ExcelController@exportFileBuilding')->name('export_file_building');

//------------------------------
//equipment_t1(ข้อมูลอุปกรณ์เครื่องใช้สำนักงาน_t1)
Route::get('import_excel_view_equipment_t1&{off_id}&{year}', 'ExcelController@importExcelViewEquipment_t1')->name('import_excel_view_equipment_t1');
Route::post('import_excel_equipment_t1', 'ExcelController@importExcel_equipment_t1')->name('import_excel_equipment_t1');
Route::get('import_excel_del_equipment_t1&{off_id}&{year}', 'ExcelController@importExcelDelEquipment_t1')->name('import_excel_del_equipment_t1');
//equipment_t1(ข้อมูลอุปกรณ์เครื่องใช้สำนักงาน_t1)
Route::get('export_file_equipment_t1&{off_id}&{year}', 'ExcelController@exportFileEquipment_t1')->name('export_file_equipment_t1');

//------------------------------
//equipment_t2(ข้อมูลอุปกรณ์เครื่องใช้สำนักงาน_t2)
Route::get('import_excel_view_equipment_t2&{off_id}&{year}', 'ExcelController@importExcelViewEquipment_t2')->name('import_excel_view_equipment_t2');
Route::post('import_excel_equipment_t2', 'ExcelController@importExcel_equipment_t2')->name('import_excel_equipment_t2');
Route::post('import_excel_edit_equipment_t2&{off_id}&{year}', 'ExcelController@importExcelEditEquipment_t2')->name('import_excel_edit_equipment_t2');
Route::get('import_excel_del_equipment_t2&{off_id}&{year}', 'ExcelController@importExcelDelEquipment_t2')->name('import_excel_del_equipment_t2');
//equipment_t2(ข้อมูลอุปกรณ์เครื่องใช้สำนักงาน_t2)
Route::get('export_file_equipment_t2&{off_id}&{year}', 'ExcelController@exportFileEquipment_t2')->name('export_file_equipment_t2');

//------------------------------
//conditioner(ข้อมูลเครื่องปรับอากาศ_t1)
Route::get('import_excel_view_airconditioner_t1&{off_id}&{year}', 'ExcelController@importExcelViewAirconditioner_t1')->name('import_excel_view_airconditioner_t1');
Route::post('import_excel_airconditioner_t1', 'ExcelController@importExcel_airconditioner_t1')->name('import_excel_airconditioner_t1');
Route::get('import_excel_del_airconditioner_t1&{off_id}&{year}', 'ExcelController@importExcelDelAirconditioner_t1')->name('import_excel_del_airconditioner_t1');
//conditioner(ข้อมูลเครื่องปรับอากาศ_t1)
Route::get('export_file_airconditioner_t1&{off_id}&{year}', 'ExcelController@exportFileAirconditioner_t1')->name('export_file_airconditioner_t1');

//------------------------------
//conditioner(ข้อมูลเครื่องปรับอากาศ_t2)
Route::get('import_excel_view_airconditioner_t2&{off_id}&{year}', 'ExcelController@importExcelViewAirconditioner_t2')->name('import_excel_view_airconditioner_t2');
Route::post('import_excel_airconditioner_t2', 'ExcelController@importExcel_airconditioner_t2')->name('import_excel_airconditioner_t2');
Route::get('import_excel_del_airconditioner_t2&{off_id}&{year}', 'ExcelController@importExcelDelAirconditioner_t2')->name('import_excel_del_airconditioner_t2');
//conditioner(ข้อมูลเครื่องปรับอากาศ_t2)
Route::get('export_file_airconditioner_t2&{off_id}&{year}', 'ExcelController@exportFileAirconditioner_t2')->name('export_file_airconditioner_t2');

//------------------------------
//ข้อมูลเครื่องปรับอากาศแบบ Airchiller

Route::get('import_excel_view_airchiller_t1&{off_id}&{year}', 'ExcelController@importExcelViewAirchiller_t1')->name('import_excel_view_airchiller_t1');
Route::post('import_excel_airchiller_t1', 'ExcelController@importExcel_airchiller_t1')->name('import_excel_airchiller_t1');
Route::get('import_excel_del_airchiller_t1&{off_id}&{year}', 'ExcelController@importExcelDelAirchiller_t1')->name('import_excel_del_airchiller_t1');
//conditioner(ข้อมูลAirchiller_t1)
Route::get('export_file_airchiller_t1&{off_id}&{year}', 'ExcelController@exportFileAirchiller_t1')->name('export_file_airchiller_t1');

//------------------------------
//elamp_t1(ข้อมูลระบบแสงสว่าง_t1)
Route::get('import_excel_view_elamp_t1&{off_id}&{year}', 'ExcelController@importExcelViewElamp_t1')->name('import_excel_view_elamp_t1');
Route::post('import_excel_elamp_t1', 'ExcelController@importExcel_elamp_t1')->name('import_excel_elamp_t1');
Route::get('import_excel_del_elamp_t1&{off_id}&{year}', 'ExcelController@importExcelDelElamp_t1')->name('import_excel_del_elamp_t1');
//elamp_t1(ข้อมูลระบบแสงสว่าง_t1)
Route::get('export_file_elamp_t1&{off_id}&{year}', 'ExcelController@exportFileElamp_t1')->name('export_file_elamp_t1');

//------------------------------
//elamp_t2(ข้อมูลระบบแสงสว่าง_t2)
Route::get('import_excel_view_elamp_t2&{off_id}&{year}', 'ExcelController@importExcelViewElamp_t2')->name('import_excel_view_elamp_t2');
Route::post('import_excel_elamp_t2', 'ExcelController@importExcel_elamp_t2')->name('import_excel_elamp_t2');
Route::get('import_excel_del_elamp_t2&{off_id}&{year}', 'ExcelController@importExcelDelElamp_t2')->name('import_excel_del_elamp_t2');
//elamp_t2(ข้อมูลระบบแสงสว่าง_t2)
Route::get('export_file_elamp_t2&{off_id}&{year}', 'ExcelController@exportFileElamp_t2')->name('export_file_elamp_t2');

//------------------------------
//water_t1(ข้อมูลระบบน้ำ_t1)
Route::get('import_excel_view_water_t1&{off_id}&{year}', 'ExcelController@importExcelViewWater_t1')->name('import_excel_view_water_t1');
Route::post('import_excel_water_t1', 'ExcelController@importExcel_water_t1')->name('import_excel_water_t1');
Route::get('import_excel_del_water_t1&{off_id}&{year}', 'ExcelController@importExcelDelWater_t1')->name('import_excel_del_water_t1');
//elamp_t1(ข้อมูลระบบน้ำ_t1)
Route::get('export_file_water_t1&{off_id}&{year}', 'ExcelController@exportFileWater_t1')->name('export_file_water_t1');

//------------------------------
//oil_t1b(ข้อมูลระบบน้ำมัน benzine_t1b)
Route::get('import_excel_view_oil_t1b&{off_id}&{year}', 'ExcelController@importExcelViewOil_t1b')->name('import_excel_view_oil_t1b');
Route::post('import_excel_oil_t1b', 'ExcelController@importExcel_oil_t1b')->name('import_excel_oil_t1b');
Route::get('import_excel_del_oil_t1b&{off_id}&{year}', 'ExcelController@importExcelDelOil_t1b')->name('import_excel_del_oil_t1b');
//oil_t1b(ข้อมูลระบบน้ำมัน benzine_t1b)
Route::get('export_file_oil_t1b&{off_id}&{year}', 'ExcelController@exportFileOil_t1b')->name('export_file_oil_t1b');

//------------------------------
//oil_t2d(ข้อมูลระบบน้ำมัน diesel_t2d)
Route::get('import_excel_view_oil_t2d&{off_id}&{year}', 'ExcelController@importExcelViewOil_t2d')->name('import_excel_view_oil_t2d');
Route::post('import_excel_oil_t2d', 'ExcelController@importExcel_oil_t2d')->name('import_excel_oil_t2d');
Route::get('import_excel_del_oil_t2d&{off_id}&{year}', 'ExcelController@importExcelDelOil_t2d')->name('import_excel_del_oil_t2d');
//oil_t2d(ข้อมูลระบบน้ำมัน diesel_t2d)
Route::get('export_file_oil_t2d&{off_id}&{year}', 'ExcelController@exportFileOil_t2d')->name('export_file_oil_t2d');

//------------------------------
//generator_t1(ข้อมูลระบบเครื่องปั่นไฟ generator_t1)
Route::get('import_excel_view_generator_t1&{off_id}&{year}', 'ExcelController@importExcelViewGenerator_t1')->name('import_excel_view_generator_t1');
Route::post('import_excel_generator_t1', 'ExcelController@importExcel_generator_t1')->name('import_excel_generator_t1');
Route::get('import_excel_del_generator_t1&{off_id}&{year}', 'ExcelController@importExcelDelGenerator_t1')->name('import_excel_del_generator_t1');
//oil_t1b(ข้อมูลระบบเครื่องปั่นไฟ generator_t1)
Route::get('export_file_generator_t1&{off_id}&{year}', 'ExcelController@exportFileGenerator_t1')->name('export_file_generator_t1');

//------------------------------
//Analytic charts
Route::get('/analyticChart', 'HomeController@analyticChart')->name('analyticChart');
Route::get('/analyticChart_chart1', 'ChartsController@analyticChart_chart1')->name('analyticChart_chart1');

//All_charts ของนุ้ย
Route::get('view_all_charts&{off_id}&{year}', 'ChartsController@view_all_charts')->name('view_all_charts');

Route::get('/chart1&{off_id}&{year}', 'ChartsController@chart1')->name('chart1');
Route::get('/chart2&{off_id}&{year}', 'ChartsController@chart2')->name('chart2');
Route::get('/chart3&{off_id}&{year}', 'ChartsController@chart3')->name('chart3');
Route::get('/chart4&{off_id}&{year}', 'ChartsController@chart4')->name('chart4');
Route::get('/chart5&{off_id}&{year}', 'ChartsController@chart5')->name('chart5');
Route::get('/chart6&{off_id}&{year}', 'ChartsController@chart6')->name('chart6');
Route::get('/chart7&{off_id}&{year}', 'ChartsController@chart7')->name('chart7');
//------------------
Route::get('/table1&{off_id}&{year}', 'ChartsController@table1')->name('table1');
Route::get('/table2&{off_id}&{year}', 'ChartsController@table2')->name('table2');
Route::get('/table3&{off_id}&{year}', 'ChartsController@table3')->name('table3');
Route::get('/table4&{off_id}&{year}', 'ChartsController@table4')->name('table4');
Route::get('/table5&{off_id}&{year}', 'ChartsController@table5')->name('table5');


//All_charts ของเป้
// Route::get('/test', 'ChartsController@newTemplate');
Route::get('view_all_charts2&{off_id}&{year}', 'ChartsController@view_all_charts2')->name('view_all_charts2');
// Route::get('/mixchart&{off_id}&{year}', 'ChartsController@mixchart')->name('mixchart');
Route::get('/chart1Pae&{off_id}&{year}', 'ChartsController@chart1Pae')->name('chart1Pae');
Route::get('/chart2Pae&{off_id}&{year}', 'ChartsController@chart2Pae')->name('chart2Pae');
Route::get('/chart3Pae&{off_id}&{year}', 'ChartsController@chart3Pae')->name('chart3Pae');
Route::get('/chart4Pae&{off_id}&{year}', 'ChartsController@chart4Pae')->name('chart4Pae');
Route::get('/chart5Pae&{off_id}&{year}', 'ChartsController@chart5Pae')->name('chart5Pae');


Route::get('view_all_charts_realtime&{off_id}&{year_c}', 'ChartsController@view_all_charts_realtime')->name('view_all_charts_realtime');
Route::post('/calendar', 'ChartsController@calendar')->name('calendar');



//for public======================================================================================================================
//{
//--------------- Public Controller ------------------------------------------------
Route::get('/pub', 'PublicController@public_index')->name('publicDash');
Route::get('/public', 'HomePublicController@public_analyticChart')->name('public_analyticChart');
Route::get('/publicDash', 'HomePublicController@public_analyticChart')->name('public_analyticChart');

//------------------------------
//Pub dash
//Route::get('/public_analyticDash', 'HomePublicController@public_analyticDash')->name('public_analyticDash');
//------------------------------
//Pub Analytic charts
Route::get('/public_analyticChart', 'HomePublicController@public_analyticChart')->name('public_analyticChart');
Route::post('/public_analyticChartYear', 'HomePublicController@public_analyticChartYear')->name('public_analyticChartYear');
//------------------------------
//Pub All_charts
// Route::get('pubview_all_charts&{yearc}', 'PublicChartsController@pubview_all_charts')->name('pubview_all_charts');
Route::get('/pubchart1&{year}', 'PublicChartsController@pubchart1')->name('pubchart1');
Route::get('/pubchart2&{year}', 'PublicChartsController@pubchart2')->name('pubchart2');
Route::get('/pubchart3&{year}', 'PublicChartsController@pubchart3')->name('pubchart3');
Route::get('/pubchart4&{year}', 'PublicChartsController@pubchart4')->name('pubchart4');
Route::get('/pubchart5&{year}', 'PublicChartsController@pubchart5')->name('pubchart5');
Route::get('/pubchart6&{year}', 'PublicChartsController@pubchart6')->name('pubchart6');


//ech_pub_all_charts
Route::get('/each_pub_analyticDash', 'EachPubHomeController@each_pub_analyticDash')->name('each_pub_analyticDash');
Route::post('/each_pub_analyticYear', 'EachPubHomeController@each_pub_analyticYear')->name('each_pub_analyticYear');


Route::get('each_pub_all_charts&{off_id}&{year}', 'EachPubChartsController@each_pub_all_charts')->name('each_pub_all_charts');

Route::get('/each_pub_chart1&{off_id}&{year}', 'EachPubChartsController@each_pub_chart1')->name('each_pub_chart1');
Route::get('/each_pub_chart2&{off_id}&{year}', 'EachPubChartsController@each_pub_chart2')->name('each_pub_chart2');
Route::get('/each_pub_chart3&{off_id}&{year}', 'EachPubChartsController@each_pub_chart3')->name('each_pub_chart3');
Route::get('/each_pub_chart4&{off_id}&{year}', 'EachPubChartsController@each_pub_chart4')->name('each_pub_chart4');
Route::get('/each_pub_chart5&{off_id}&{year}', 'EachPubChartsController@each_pub_chart5')->name('each_pub_chart5');
Route::get('/each_pub_chart6&{off_id}&{year}', 'EachPubChartsController@each_pub_chart6')->name('each_pub_chart6');
Route::get('/each_pub_chart7&{off_id}&{year}', 'EachPubChartsController@each_pub_chart7')->name('each_pub_chart7');
//------------------
Route::get('/each_pub_table1&{off_id}&{year}', 'EachPubChartsController@each_pub_table1')->name('each_pub_table1');
Route::get('/each_pub_table2&{off_id}&{year}', 'EachPubChartsController@each_pub_table2')->name('each_pub_table2');
Route::get('/each_pub_table3&{off_id}&{year}', 'EachPubChartsController@each_pub_table3')->name('each_pub_table3');
Route::get('/each_pub_table4&{off_id}&{year}', 'EachPubChartsController@each_pub_table4')->name('each_pub_table4');
Route::get('/each_pub_table5&{off_id}&{year}', 'EachPubChartsController@each_pub_table5')->name('each_pub_table5');





//--------------------------------------------------------------------
Route::get('/public_menu&{off_id}', 'PublicController@publiclMenu')->name('public_menu');
//--------------------------------------------------------------------
//------------------------------
//general
Route::get('/public_general&{off_id}&{year}', 'PublicController@publicViewGeneral')->name('public_general');
//--------------------------------------------------------------------
//------------------------------
//expenses(ข้อมูลค่าไฟ_t1)
Route::get('public_expenses_t1&{off_id}&{year}', 'PublicController@publicViewExpenses_t1')->name('public_expenses_t1');
//------------------------------
//expenses(ข้อมูลค่าไฟ_t2)
Route::get('public_expenses_t2&{off_id}&{year}', 'PublicController@publicViewExpenses_t2')->name('public_expenses_t2');
//--------------------------------------------------------------------
//------------------------------
//building(ข้อมูลลักษณะอาคาร)
Route::get('public_building&{off_id}&{year}', 'PublicController@publicViewBuilding')->name('public_building');
//------------------------------
//--------------------------------------------------------------------
//------------------------------
//equipment_t1(ข้อมูลอุปกรณ์เครื่องใช้สำนักงาน_t1)
Route::get('public_equipment_t1&{off_id}&{year}', 'PublicController@publicViewEquipment_t1')->name('public_equipment_t1');
//------------------------------
//equipment_t2(ข้อมูลอุปกรณ์เครื่องใช้สำนักงาน_t2)
Route::get('public_equipment_t2&{off_id}&{year}', 'PublicController@publicViewEquipment_t2')->name('public_equipment_t2');
//--------------------------------------------------------------------
//------------------------------
//conditioner(ข้อมูลเครื่องปรับอากาศ_t1)
Route::get('public_airconditioner_t1&{off_id}&{year}', 'PublicController@publicViewAirconditioner_t1')->name('public_airconditioner_t1');
//------------------------------
//conditioner(ข้อมูลเครื่องปรับอากาศ_t2)
Route::get('public_airconditioner_t2&{off_id}&{year}', 'PublicController@publicViewAirconditioner_t2')->name('public_airconditioner_t2');
//--------------------------------------------------------------------
//------------------------------
//ข้อมูลเครื่องปรับอากาศแบบ Airchiller
Route::get('public_airchiller_t1&{off_id}&{year}', 'PublicController@publicViewAirchiller_t1')->name('public_airchiller_t1');
//--------------------------------------------------------------------
//------------------------------
//elamp_t1(ข้อมูลระบบแสงสว่าง_t1)
Route::get('public_elamp_t1&{off_id}&{year}', 'PublicController@publicViewElamp_t1')->name('public_elamp_t1');
//------------------------------
//elamp_t2(ข้อมูลระบบแสงสว่าง_t2)
Route::get('public_elamp_t2&{off_id}&{year}', 'PublicController@publicViewElamp_t2')->name('public_elamp_t2');
//--------------------------------------------------------------------
//------------------------------
//water_t1(ข้อมูลระบบน้ำ_t1)
Route::get('public_water_t1&{off_id}&{year}', 'PublicController@publicViewWater_t1')->name('public_water_t1');
//--------------------------------------------------------------------
//------------------------------
//oil_t1b(ข้อมูลระบบน้ำมัน benzine_t1b)
Route::get('public_oil_t1b&{off_id}&{year}', 'PublicController@publicViewOil_t1b')->name('public_oil_t1b');
//------------------------------
//oil_t2d(ข้อมูลระบบน้ำมัน diesel_t2d)
Route::get('public_oil_t2d&{off_id}&{year}', 'PublicController@publicViewOil_t2d')->name('public_oil_t2d');
//--------------------------------------------------------------------
//------------------------------
//generator_t1(ข้อมูลระบบเครื่องปั่นไฟ generator_t1)
Route::get('public_generator_t1&{off_id}&{year}', 'PublicController@publicViewGenerator_t1')->name('public_generator_t1');
//--------------------------------------------------------------------



//}
//for public======================================================================================================================











//wash_aircon zone
//====================================================================================================================
//------------------------------
Route::get('customer_new', 'WashAirConController@customer_form')->name('customer_nwe');
Route::post('customer_insert', 'WashAirConController@customer_insert')->name('customer_insert');
Route::get('customer_edit&{id}', 'WashAirConController@customer_edit')->name('customer_edit');
Route::post('customer_update', 'WashAirConController@customer_update')->name('customer_update');


Route::get('customer_report_year&{id}', 'WashAirConController@customer_report_year')->name('customer_report_year');
Route::post('customer_report_new', 'WashAirConController@customer_report_new')->name('customer_report_new');

Route::get('customer_report_year_detail&{id}&{year}', 'WashAirConController@customer_report_year_detail')->name('customer_report_year_detail');
Route::get('customer_report_form&{id}&{year}', function (){ return view('WashAirCon.customer_report_form'); });
Route::post('customer_report_form_insert', 'WashAirConController@customer_report_form_insert')->name('customer_report_form_insert');

Route::get('customer_operation_date&{id}&{opdate}', 'WashAirConController@customer_operation_date')->name('customer_operation_date');
Route::post('customer_excel_measure_performance', 'WashAirConController@customer_excel_measure_performance')->name('customer_excel_measure_performance');

Route::post('customer_excel_solution_insert', 'WashAirConController@customer_excel_solution_insert')->name('customer_excel_solution_insert');
Route::post('customer_excel_solution_update', 'WashAirConController@customer_excel_solution_update')->name('customer_excel_solution_update');

Route::get('customer_excel_del_measure_performance&{id}&{opdate}', 'WashAirConController@customer_excel_del_measure_performance')->name('customer_excel_del_measure_performance');

Route::post('customer_sugest_insert', 'WashAirConController@customer_sugest_insert')->name('customer_sugest_insert');
Route::post('customer_sugest_update', 'WashAirConController@customer_sugest_update')->name('customer_sugest_update');


Route::get('customer_picture_building_new&{id}&{opdate}', 'WashAirConController@customer_picture_building_new')->name('customer_picture_building_new');
Route::get('customer_picture_building_insert', 'WashAirConController@customer_picture_building_insert')->name('customer_picture_building_insert');

Route::get('customer_picture_place_new&{id}&{opdate}', 'WashAirConController@customer_picture_place_new')->name('customer_picture_place_new');
Route::get('customer_picture_place_insert', 'WashAirConController@customer_picture_place_insert')->name('customer_picture_place_insert');

// Route::get('customer_picture_place', 'WashAirConController@customer_picture_place')->name('customer_picture_place');



//------------------------------
//====================================================================================================================
//}
//end for user====================================================================================================================








//====================================================================================================================