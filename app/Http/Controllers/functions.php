<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ambulance;
use Illuminate\Support\Facades\Validator;
use App\Models\devicelocation;
use App\Models\alerts;
use Illuminate\Support\Facades\DB;
class functions extends Controller
{
    //Get All Active transportation
    function getAllActive(Request $request)
    {
        try {
            $CurrentMenu = ambulance::where('currentstatus', 'Active')->get();
            return response()->json(['Data' => $CurrentMenu]);
        } catch (\Exception $ex) {
            return response()->json(['Status' => false, 'message' => $ex->getMessage(), 'data' => []], 200);
        }
    }
    function updateposition(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'DeviceID' => 'required',
                'DeviceLat' => 'required',
                'DeviceLng' => 'required',
            ]);
            if ($validator->fails()) {
                $error = $validator->errors()->all()[0];
                return response()->json(['status' => false, 'message' => $error, 'data' => []], 422);
            } else {
                $SpecificDevice = ambulance::where('Deviceid', $request->DeviceID)->first();
                if ($SpecificDevice) {
                    $location = devicelocation::where('Deviceid', $SpecificDevice->DeviceID);
                    $location->update([
                        'Lat' => $request->DeviceLat,
                        'Lng' => $request->DeviceLng
                    ]);
                    response()->json(['status' => 'Success'], 200);
                }else{
                    return response()->json(['status' => false, 'Data'=>"No Emergency vehicle is available"], 404);
                }


            }

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage(), 'data' => []], 404);
        }
    }
    function ifregisted(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'Email' => 'required',
            ]);
            if ($validator->fails()) {
                $error = $validator->errors()->all()[0];
                return response()->json(['status' => false, 'message' => $error, 'data' => []], 422);
            } else {
                $Car = ambulance::where('email', $request->Email)->first();
                if ($Car) {
                    return response()->json(['status' => 'Success'], 200);
                } else {
                    return response()->json(['status' => false, 'message'=>' No Emergency vehicle is available with that email '], 404);
                }
            }
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage(), 'data' => []], 200);
        }
    }
    function getAllAlerts(Request $request)
    {
        try {
            $alerts = alerts::get();
            if ($alerts) {
                return response()->json(['status' => false, 'Data' => $alerts], 200);
            }
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage(), 'data' => []], 404);
        }
    }
    function getallcompany(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'Email' => 'required',
            ]);
            if ($validator->fails()) {
                $error = $validator->errors()->all()[0];
                return response()->json(['status' => false, 'message' => $error, 'data' => []], 422);
            } else {
                $Status = DB::statement('select * FROM ambulances WHERE email = ?',[$request->Email]);
                //ambulance::where('email', $request->Email)->get();
                if($Status){
                    $checker = DB::statement('select * FROM ambulances WHERE isadmin = ?',["True"]);
                if($checker){
                    $AllCompanies = DB::statement('select * FROM ambulances WHERE companyid = ?', ['123']);
                    return response()->json(['status' => true, 'Data'=> $AllCompanies], 200);
                }else{
                    return response()->json(['status' => false, 'Data'=>"not an admin"], 404);
                }
            }
        }
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage(), 'data' => []], 200);
        }
    }
}