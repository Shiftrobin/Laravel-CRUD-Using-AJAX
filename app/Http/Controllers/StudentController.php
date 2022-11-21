<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentModel;

class StudentController extends Controller
{
    public function addStudent(Request $request){

        $file = $request->file('file');
        $fileName = time().''.$file->getClientOriginalName();
        $filePath = $file->storeAs('images',$fileName,'public');

        $student = new StudentModel();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->image = $filePath;
        $student->save();

        return response()->json(['res'=>'Student Created Successfully']);
    }

    public function getStudent(){
        $students = StudentModel::all();
        return response()->json(['students'=>$students]);
    }

    public function getStudentData($id){
       $student = StudentModel::where('id',$id)->get();
       return view('edit-student',['student'=>$student]);
    }

    public function updateStudent(Request $request){

       $student = StudentModel::find($request->id);
       $student->name = $request->name;
       $student->email = $request->email;

       if($request->file('file')){
            $file = $request->file('file');
            $fileName = time().''.$file->getClientOriginalName();
            $filePath = $file->storeAs('images',$fileName,'public');

            $student->image = $filePath;
       }

       $student->save();

       return response()->json(['result'=>'Student Updated Successfully.']);
    }

    public function deleteData($id){
        StudentModel::where('id',$id)->delete();
        return response()->json(['result'=>'Student Deleted']);
    }
}
