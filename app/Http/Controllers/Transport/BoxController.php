<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoxController extends Controller
{
     public function show()
    {
        return view('/admin/transport/box/box');
    }
}
