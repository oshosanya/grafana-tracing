<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function register(Request $request) {
        if ($request->has('delay')) {
            sleep(5);
        }

        $customer = new Customer();
        $customer->business_name = $request->input('business_name');
        $customer->reg_no = $request->input('reg_no');
        $customer->save();

        return redirect('/');
    }
}
