<?php

namespace App\Http\Controllers;

use App\Models\User;

class DatatableController extends Controller
{
    public function getUsers()
    {
        return datatables()->of(User::get())->toJson();
    }
}
