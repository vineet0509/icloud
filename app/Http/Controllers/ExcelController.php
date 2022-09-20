<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelController extends Controller
{
    //
    function index(Request $request){
      // dd($request->all());
      if ($request->hasFile('file')) {
        $image = $request->file('file');
        $teaser_image = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = base_path('/images');
        $image->move($destinationPath, $teaser_image);

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        $spreadsheet = $reader->load(base_path('/images/').$teaser_image);

       // dd($spreadsheet);
        //print_r(base_path('/images/').$teaser_image);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
 
        dd($sheetData);
            } else {
                return redirect()->back()->with('error', 'Select a File');
        }
       


    }
}
