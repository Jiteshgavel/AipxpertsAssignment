<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Employee;
class EmployeeController extends Controller
{


 public function getRecord()
 {
     $result =  Employee::with('designation')->get();
   
      $res_json = json_decode(json_encode($result), true);

        if (count($res_json) > 0) {
            return response()->json(['status' => 200, 'data' => $res_json]);
        } else {

            return response()->json(['status' => 500, 'msg' => 'Record not found']);
        }
 }

    public function updateStatus(Request $request)
    {
        if(!empty($request->id) and count($request->id) and !empty($request->status))
        {
            foreach ($request->id as $key => $value) {
            $updateRecord = Employee::find($value);
            $updateRecord->status = $request->status;
            $updateRecord->save();
             }
             return response()->json(['status' => 200, 'msg' => 'Employee Status updated successfully.']);
        }else{
            return response()->json(['status' => 500, 'msg' => 'Something went wrong, try again after some time']);
        }

    }
}
