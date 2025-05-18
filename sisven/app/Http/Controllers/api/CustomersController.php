<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = DB::table('customers')
            ->select('customers.*')
            ->get();

        return json_encode(['customers' => $customers]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'document_number' => ['required', 'max:100', 'unique:customers,document_number'],
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'address' => ['nullable', 'max:80'],
            'birthday' => ['nullable', 'date'],
            'phone_number' => ['nullable', 'max:16'],
            'email' => ['nullable', 'email', 'max:100'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'errors' => $validate->errors(),
                'statusCode' => 400
            ], 400);
        }

        $customer = new Customers();
        $customer->document_number = $request->document_number;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->birthday = $request->birthday;
        $customer->phone_number = $request->phone_number;
        $customer->email = $request->email;
        $customer->save();

        return json_encode(['customers' => $customer]);
    }

    public function show($id)
    {
        $customer = Customers::find($id);

        if (is_null($customer)) {
            return abort(404);
        }

        return json_encode(['customers' => $customer]);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'document_number' => ['required', 'max:100', 'unique:customers,document_number,' . $id],
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'address' => ['nullable', 'max:80'],
            'birthday' => ['nullable', 'date'],
            'phone_number' => ['nullable', 'max:16'],
            'email' => ['nullable', 'email', 'max:100'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'errors' => $validate->errors(),
                'statusCode' => 400
            ], 400);
        }
        
        $customer = Customers::find($id);

        $customer->document_number = $request->document_number;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->birthday = $request->birthday;
        $customer->phone_number = $request->phone_number;
        $customer->email = $request->email;
        $customer->save();

        return json_encode(['customers' => $customer]);
    }


    public function destroy($id)
    {
        $customer = Customers::find($id);
        $customer->delete();

        $customers = DB::table('customers')
            ->select('customers.*')
            ->get();

        return json_encode(['customers' => $customers]);
    }
}
