<?php

use Illuminate\Support\Facades\Route;

Route::get('/okane-html', function () {
    return include resource_path('views/home.blade.php');
});
