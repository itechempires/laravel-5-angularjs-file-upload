<?php


Route::get("/", "FilesController@files");

Route::post("upload/file", "FilesController@upload");

Route::get('/file/list', 'FilesController@listFiles');

Route::post("/delete/file", 'FilesController@delete');