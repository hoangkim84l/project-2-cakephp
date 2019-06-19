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

class AdsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ads = \App\Ads::paginate(7);
        //return view('admin/ads/', compact('ads'));
        return View::make('admin.ads.index')
            ->with('ads', $ads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('admin/ads/create');
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
            $file->move(storage_path() . '/app/public/ads/', $name);
        }
        //save ads
        $ads           = new \App\Ads;
        $ads->name     = $request->get('name');
        $ads->content  = $request->get('content');
        $ads->views   = '1';
        $date           = date_create($request->get('date'));
        $format         = date_format($date, "Y-m-d");
        $ads->date     = strtotime($format);
        $ads->filename = $name;
        $ads->save();

        //return redirect()->route('admin.ads.index')->with('success', 'Information has been added');
        Session::flash('success', 'Successfully created ads!');
        return Redirect::to('admin/ads');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the ads
        $ads = \App\Ads::find($id);

        // show the view and pass the nerd to it
        return View::make('admin.ads.show')
            ->with('ads', $ads);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get ads by id
        $ads = \App\ads::find($id);
        // show the edit form
        return View::make('admin.ads.edit')
            ->with('ads', $ads);
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
        //get ads by id
        $ads = \App\Ads::find($id);
        //get link image
        if ($request->hasfile('filename')) {
            $file = $request->file('filename');
            $name = time() . $file->getClientOriginalName();
            $file->move(storage_path() . '/app/public/ads/', $name);
        } else {
            $name = $ads->filename;
        }

        $ads->name     = $request->get('name');
        $ads->content  = $request->get('content');
        $ads->filename = $name;
        $ads->save();

        Session::flash('success', 'Successfully update the ads!');
        return Redirect::to('admin/ads');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete ads by id
        $ads = \App\AdsCategory::find($id);
        $ads->delete();
        //delete image in ads
        $image_link = storage_path() . '/app/public/ads/' . $ads->filename;
        if (file_exists($image_link)) {
            unlink($image_link);
        }
        Session::flash('success', 'Successfully deleted the ads!');
        return Redirect::to('admin/ads');
    }
}
