<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

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

        try{
            // Get the file from the request
            $file = $request->file('file');

            $filePath = public_path('path/to/your/storage/folder/') . $file->getClientOriginalName();

            // Move the uploaded file to the specified path
            $file->move(public_path('path/to/your/storage/folder/'), $file->getClientOriginalName());

            // Load the Excel file
            $spreadsheet = IOFactory::load($filePath);

            // Get the first worksheet
            $worksheet = $spreadsheet->getActiveSheet();

            // Convert the worksheet data to an array
            $data = $worksheet->toArray();
            // Load the Excel file using Laravel Excel

            // Get the imported data

            $count = 0 ;

            // Save the data to the database
            foreach ($data as $row) {
                if ($count > 0)
                {

                    // Assuming your data has columns 'employee_id', 'schedule_id', 'check_in', and 'check_out'
                    $entry = new \App\Models\Attendance();
                    $entry->employee_id = $row['0'];
                    $entry->schedule_id = $row['1'];
                    $entry->check_in =  Carbon::parse($row['2']);
                    $entry->check_out = Carbon::parse($row['3']);
                    $entry->save();
                }
                $count++;

            }

            // Return a success response
            return response()->json(['message' => 'Data uploaded successfully'], Response::HTTP_OK);

        }catch (\Exception $ex)
        {
            return response()->json(['message' => 'Unexpected Error Occured'], Response::HTTP_EXPECTATION_FAILED);
        }


    }

    public function WorkingHours()
    {
        $employess = Employee::all();

        // Get the attendance records from the database
        $attendances = \App\Models\Attendance::all();

        // Initialize an array to store the total working hours for each employee
        $totalWorkingHours = [];

        // Loop through each attendance record
        foreach ($employess as $employee) {

            $attendance = \App\Models\Attendance::where('employee_id',$employee->id)->get();
            $sum = 0;

            foreach ($attendance as $attend)
            {
                // Get the check-in and check-out times
                $checkIn = Carbon::parse($attend->check_in);
                $checkOut = Carbon::parse($attend->check_out);
                $workingHours = $checkOut->diffInHours($checkIn);
                $sum = $sum + $workingHours;
            }

            $employee->working_hours = $sum;
        }

        // Return the total working hours for each employee
        return $employess;
    }
}
