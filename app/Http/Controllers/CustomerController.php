<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('pages.customers.index', compact('customers'));
    }

    public function show(string $id)
    {
        $customer = Customer::findOrFail(decrypt($id));
        return view('pages.customers.show', compact('customer'));
    }
}