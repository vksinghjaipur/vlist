<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DB, File;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students=db::table('students')->get();
        //echo '<pre>';print_r($students);die();
        return view('student.index',compact('students'));
    }


    public function create()
    {

        return view('student.create');
    }

    public function store(Request $request)
    {
        
        $imageName='';
        if($request->photo){
            $imageName=time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $imageName);
        }

        $data= new Student;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->age = $request->age;
        $data->city = $request->city;
        $data->photo = $imageName;
        $data->save();

        return redirect()->route('student.index')->with('success', 'Student has been added successfully.');
    }

    public function edit($id=NULL)
    {
        $result=Student::find($id);
        return view('student.edit',compact('result'));
    }

    public function update(Request $request, $id)
    {
        $result=Student::find($id);

       
        if($request->hasfile('photo'))
        {
            $destination = 'uploads/'.$result->photo;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/',$filename);
            $result->photo = $filename;
        }

        $result->first_name=$request->first_name;
        $result->last_name=$request->last_name;
        $result->age=$request->age;
        $result->city=$request->city;
        $result->update();

        return redirect()->route('student.index');
    }

    
}
