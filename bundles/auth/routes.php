<?php

Route::get('login', 'auth::auth@login');
Route::post('login', 'auth::auth@login');
Route::get('register', 'auth::auth@register');
Route::post('register', 'auth::auth@register');
Route::get('logout', 'auth::auth@logout');