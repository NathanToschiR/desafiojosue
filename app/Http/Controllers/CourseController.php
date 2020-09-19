<?php

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course();
        $categories = Category::all();
        return view('admin.courses.create',compact('course', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($request->hasfile('image')){
            $extension = $request->image->getClientOriginalExtension();
            $nameFile = "{$request->slug}.{$extension}";
            $request->image->storeAs('public/img',$nameFile);
            $data['image'] = 'img/'.$nameFile;
        }else{
            $data['image'] = "user.jpg";
        }
        $data['slug'] = Str::slug($request->name);
        Course::create($data);
        return redirect()->route('courses.index')->with('success',true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.show',compact('course','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit',compact('course','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $data = $request->all();
        $data['created_at'] = date('Y-m-d 00:00:00', strtotime($request->created_at));

        if($request->hasfile('image')){
            $extension = $request->image->getClientOriginalExtension();
            $nameFile = "{$request->slug}.{$extension}";
            $request->image->storeAs('public/img',$nameFile);
            $data['image'] = 'img/'.$nameFile;
        }else{
            unset($data['image']);
        }
        $data['slug'] = Str::slug($request->name);
        $course->update($data);
        return redirect()->route('courses.index')->with('success',true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success',true);
    }
}
