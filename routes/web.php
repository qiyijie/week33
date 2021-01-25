<?php

use Illuminate\Support\Facades\Route;

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

// 异步上传图片
Route::post('upload','BookController@upload')->name('book.upload');
// 验证唯一 图书名称
Route::get('unique','BookController@unique')->name('book.unique');
// 新书添加页面
Route::get('create','BookController@create')->name('book.create');
// 新书添加的方法
Route::post('store','BookController@store')->name('book.store');

// 书籍列表页
Route::get('list','BookController@index')->name('book.index');
Route::get('isshowupdate','BookController@isshowupdate')->name('book.isshowupdate');
//导出excel
Route::get('excel','BookController@excel')->name('book.excel');
// 前台首页
Route::get('homeindex','BookController@homeindex')->name('book.homeindex');
Route::get('homeprice','BookController@homeprice')->name('book.homeprice');
Route::get('hometime','BookController@hometime')->name('book.hometime');
Route::get('homepic','BookController@homepic')->name('book.homepic');
