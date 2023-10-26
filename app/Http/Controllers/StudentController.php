<?php

namespace App\Http\Controllers;
use App\Models\Student;    
use Illuminate\Http\Request;

use DataTables;
     
class StudentController extends Controller
{
 

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::select('*');
            return DataTables ::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('students');
    }*/

    public function index(Request $request)
{
    if ($request->ajax()) {
        $query = Student::select(['id', 'name', 'email']);

        // Filter by name
        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter by email
        if ($request->has('email') && !empty($request->email)) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        return DataTables::of($query)
            ->addColumn('action', 'students.datatables.action')
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('students');

}

 }


    









