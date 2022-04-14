<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getAllStudents()
    {
        $customer = Customer::get()->toJson(JSON_PRETTY_PRINT);
        return response($customer, 200);
    }

    public function createStudent(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mt5 = $request->mt5;
        $customer->validate = $request->validate;
        $customer->save();

        return response()->json([
            "message" => "customer record created"
        ], 201);
    }


    public function getStudent($mt5)
    {
        if (Customer::where('mt5', $mt5)->exists()) {
            $customer = Customer::where('mt5', $mt5)->get()->toJson(JSON_PRETTY_PRINT);
            return response($customer, 200);
        } else {
            return response()->json([
                "message" => "customer not found"
            ], 404);
        }
    }

    public function updateStudent(Request $request, $id)
    {
        if (Customer::where('id', $id)->exists()) {
            $customer = Customer::find($id);
            $customer->name = is_null($request->name) ? $customer->name : $request->name;
            $customer->email = is_null($request->email) ? $customer->email : $request->email;
            $customer->mt5 = is_null($request->mt5) ? $customer->mt5 : $request->mt5;
            $customer->validate = is_null($request->validate) ? $customer->validate : $request->validate;
            $customer->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "customer not found"
            ], 404);
        }
    }

    public function deleteStudent($id)
    {
        if (Customer::where('id', $id)->exists()) {
            $customer = Customer::find($id);
            $customer->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "customer not found"
            ], 404);
        }
    }
}
