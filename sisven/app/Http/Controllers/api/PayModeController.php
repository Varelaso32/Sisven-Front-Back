<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayMode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PayModeController extends Controller
{

    public function index()
    {
        $payModes = DB::table('pay_mode')
            ->select('pay_mode.*')
            ->get();

        return json_encode(['pay_modes' => $payModes]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'max:50'],
            'observation' => ['nullable', 'max:200'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'errors' => $validate->errors(),
                'statusCode' => 400
            ], 400);
        }

        $payMode = new PayMode();
        $payMode->name = $request->name;
        $payMode->observation = $request->observation;
        $payMode->save();

        return json_encode(['pay_modes' => $payMode]);
    }

    public function show($id)
    {
        $payMode = PayMode::find($id);

        if (is_null($payMode)) {
            return abort(404);
        }

        return json_encode(['pay_modes' => $payMode]);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'max:50'],
            'observation' => ['nullable', 'max:200'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'errors' => $validate->errors(),
                'statusCode' => 400
            ], 400);
        }

        $payMode = PayMode::find($id);

        if (is_null($payMode)) {
            return abort(404);
        }

        $payMode->name = $request->name;
        $payMode->observation = $request->observation;
        $payMode->save();

        return json_encode(['pay_modes' => $payMode]);
    }

    public function destroy($id)
    {
        $payMode = PayMode::find($id);

        if (is_null($payMode)) {
            return abort(404);
        }

        $payMode->delete();

        $payModes = DB::table('pay_mode')
            ->select('pay_mode.*')
            ->get();

        return json_encode(['pay_modes' => $payModes]);
    }
}
