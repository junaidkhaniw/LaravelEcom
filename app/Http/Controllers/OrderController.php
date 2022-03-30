<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Model

class OrderController extends Controller
{
    public function orders()
    {
        return view('admin.orders');
    }
}
