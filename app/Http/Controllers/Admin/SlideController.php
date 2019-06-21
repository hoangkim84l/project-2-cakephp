<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use View;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $slide = \App\Slide::paginate(10);
        //return view('admin/slide/', compact('slide'));
        return View::make('admin.slide.index')
            ->with('slide', $slide);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('admin/slide/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //save image
        if ($request->hasfile('filename')) {
            $file = $request->file('filename');
            $name = time() . $file->getClientOriginalName();
            $file->move(storage_path() . '/app/public/slide/', $name);
        }
        //save slide
        $slide              = new \App\Slide;
        $slide->name        = $request->get('name');
        $slide->link        = $request->get('link');
        $slide->image_link  = $name;
        $slide->save();

        //return redirect()->route('admin.slide.index')->with('success', 'Information has been added');
        Session::flash('success', 'Successfully created slide!');
        return Redirect::to('admin/slide');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the slide
        $slide = \App\Slide::find($id);

        // show the view and pass the nerd to it
        return View::make('admin.slide.show')
            ->with('slide', $slide);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get slide by id
        $slide = \App\slide::find($id);
        // show the edit form
        return View::make('admin.slide.edit')
            ->with('slide', $slide);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //get slide by id
        $slide = \App\Slide::find($id);
        //get link image
        if ($request->hasfile('filename')) {
            $file = $request->file('filename');
            $name = time() . $file->getClientOriginalName();
            $file->move(storage_path() . '/app/public/slide/', $name);
        } else {
            $name = $slide->image_link;
        }

        $slide->name        = $request->get('name');
        $slide->link        = $request->get('link');
        $slide->image_link  = $name;
        $slide->save();

        Session::flash('success', 'Successfully update the slide!');
        return Redirect::to('admin/slide');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete slide by id
        $slide = \App\Slide::find($id);
        $slide->delete();
        //delete image in slide
        $image_link = storage_path() . '/app/public/slide/' . $slide->filename;
        if (file_exists($image_link)) {
            unlink($image_link);
        }
        Session::flash('success', 'Successfully deleted the slide!');
        return Redirect::to('admin/slide');
    }
}
