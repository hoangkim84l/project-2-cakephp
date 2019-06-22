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

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news = \App\News::paginate(7);
        //return view('admin/news/', compact('news'));
        return View::make('admin.news.index')
            ->with('news', $news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('admin/news/create');
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
            $file->move(storage_path() . '/app/public/news/', $name);
        }
        //save news
        $news           = new \App\News;
        $news->name     = $request->get('name');
        $news->content  = $request->get('content');
        $news->views   = '1';
        $date           = date_create($request->get('date'));
        $format         = date_format($date, "Y-m-d");
        $news->date     = strtotime($format);
        $news->filename = $name;
        $news->save();

        //return redirect()->route('admin.news.index')->with('success', 'Information has been added');
        Session::flash('success', 'Successfully created news!');
        return Redirect::to('admin/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the news
        $news = \App\News::find($id);

        // show the view and pass the nerd to it
        return View::make('admin.news.show')
            ->with('news', $news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get news by id
        $news = \App\News::find($id);
        // show the edit form
        return View::make('admin.news.edit')
            ->with('news', $news);
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
        //get news by id
        $news = \App\News::find($id);
        //get link image
        if ($request->hasfile('filename')) {
            $file = $request->file('filename');
            $name = time() . $file->getClientOriginalName();
            $file->move(storage_path() . '/app/public/news/', $name);
        } else {
            $name = $news->filename;
        }

        $news->name     = $request->get('name');
        $news->content  = $request->get('content');
        $news->filename = $name;
        $news->save();

        Session::flash('success', 'Successfully update the news!');
        return Redirect::to('admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete news by id
        $news = \App\News::find($id);
        $news->delete();
        //delete image in news
        $image_link = storage_path() . '/app/public/news/' . $news->filename;
        if (file_exists($image_link)) {
            unlink($image_link);
        }
        Session::flash('success', 'Successfully deleted the news!');
        return Redirect::to('admin/news');
    }
}
