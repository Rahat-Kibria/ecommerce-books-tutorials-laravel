<?php

namespace App\Http\Controllers\backend;

use App\Models\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourierController extends Controller
{
    public function couriers_list()
    {
        // $courier = Courier::all();
        $courier = Courier::paginate(3);
        // dd($courier);
        return view('backend.pages.courier.courier_list', compact('courier'));
    }
    public function courier_form()
    {
        return view('backend.pages.courier.courier_form');
    }
    public function courier_form_submit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'filled | max:30',
            'address' => 'required | max:200 | string:couriers',
            'contact_number' => 'required | digits:11 | numeric:couriers',
            'nid_number' => 'required | digits:10 | numeric:couriers',
            'image' => 'mimes:png,jpg,jpeg,gif'
        ]);
        if ($request->hasFile('image')) {
            // dd("true");
            //generate name
            $fileName = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/uploads', $fileName);
        }
        // dd("false");
        Courier::create([
            //'database_column_name' => $request->form_column_name_or_value
            'name' => $request->name,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'nid_number' => $request->nid_number,
            'image' => $fileName
        ]);
        return redirect()->route('courier.list');
        // return redirect()->back();
    }
}
