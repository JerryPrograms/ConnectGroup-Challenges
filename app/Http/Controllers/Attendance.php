<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;

class Attendance extends Controller
{
    public function UploadAttendance(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        // Get the file from the request
        $file = $request->file('file');

        // Load the Excel file using Laravel Excel
//        $import = new DataImport;
        $data = Excel::toArray([], $file)[0];
        dd($data);

        // Get the imported data
        $data = $import->getData();

        // Save the data to the database
        foreach ($data as $row) {
            // Assuming your data has columns 'employee_id', 'schedule_id', 'check_in', and 'check_out'
            $entry = new YourModel;
            $entry->employee_id = $row['employee_id'];
            $entry->schedule_id = $row['schedule_id'];
            $entry->check_in = $row['check_in'];
            $entry->check_out = $row['check_out'];
            $entry->save();
        }

        // Return a success response
        return response()->json(['message' => 'Data uploaded successfully'], Response::HTTP_OK);
    }
}
