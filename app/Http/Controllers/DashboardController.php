<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        
        $customer = Customer::firstOrCreate(['customer_name' => 'Walk-In Customer']);
        return view('dashboard.index');
    }
}
