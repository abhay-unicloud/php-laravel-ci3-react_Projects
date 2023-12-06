<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;

class UserController extends Controller
{
    public function index()
    {
        $stud = Student::paginate(5);
return view('Excel', compact('stud'));
    }

    public function export($type)
    {
        $students = Student::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set headers
        $headers = ['id', 'name', 'email', 'class', 'section', 'address', 'gender','date'];
        $columnIndex = 1;

        foreach ($headers as $header) {
            $sheet->setCellValueByColumnAndRow($columnIndex, 1, $header);
            $columnIndex++;
        }

        // Set data
        $rowIndex = 2;

        foreach ($students as $studentDetails) {
            $columnIndex = 1;

foreach ($headers as $header) {
                if ($header === 'date') {
                    // Format the date as per your requirement
                    $cellValue = $studentDetails->created_at->format('Y-m-d H:i:s');
                } else {
                    $cellValue = $studentDetails->{$header};
                }
                //$cellValue = $studentDetails->{$header};
                $sheet->setCellValueByColumnAndRow($columnIndex, $rowIndex, $cellValue);
                $columnIndex++;
            }
            $rowIndex++;
        }

        $fileName = "stud." . $type;
        $exportPath = storage_path('app/public/export/' . $fileName);

        if ($type == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
        } elseif ($type == 'xls') {
            $writer = new Xls($spreadsheet);
        }

        $writer->save($exportPath);

        return response()->download($exportPath)->deleteFileAfterSend();
    }
    public function import(Request $request){
        //we validate our file here..
        $request->validate([

            'file' => 'required|mimes:xlsx,xls|max:2048'
        ]);
        //getting uploaded file...
        $file= $request->file('file');
        //loading the spreadsheet
        $spreadsheet=IOFactory::load($file);
        //getting the activesheet 
        $sheet=$spreadsheet->getActiveSheet();
        // Get the highest row number and column letter
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        // Iterate through each row and insert data into the database
        for ($row = 2; $row <= $highestRow; ++$row) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false)[0];

            // Assuming the order of columns in the Excel file is the same as in the database
            $studentData = [
               // 'id' => $rowData[0],
                'name' => $rowData[1],
                'email' => $rowData[2],
                'class' => $rowData[3],
                'section' => $rowData[4],
                'address' => $rowData[5],
                'gender' => $rowData[6],
            ];

            // Create or update the student record in the database
            Student::updateOrCreate(['id' => $studentData['id']], $studentData);
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data imported successfully.');
    }

    }



