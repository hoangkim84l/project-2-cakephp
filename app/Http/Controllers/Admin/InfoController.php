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

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $info = \App\Info::paginate(10);
        return View::make('admin.info.index')
            ->with('info', $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get info by id
        $info = \App\Info::find($id);
        // show the edit form
        return View::make('admin.info.edit')
            ->with('info', $info);
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
        //get info by id
        $info = \App\Info::find($id);
        //get list image

        if ($request->hasfile('filename')) {
            $image_list = array();
            $file       = $request->file('filename');
            $image_list = time() . $file->getClientOriginalName();
            $file->move(storage_path() . '/app/public/info/', $image_list);
            $image_list = json_encode($image_list);
        } else {
            $image_list = $info->image_list;
        }

        $info->title_vn     = $request->get('title_vn');
        $info->title_en     = $request->get('title_en');
        $info->title_cn     = $request->get('title_cn');
        $info->image_list   = $image_list;
        $info->content_vn   = $request->get('content_vn');
        $info->content_en   = $request->get('content_en');
        $info->content_cn   = $request->get('content_cn');
        $info->meta_key     = $request->get('meta_key');
        $info->meta_desc    = $request->get('meta_desc');

        $info->save();

        Session::flash('success', 'Successfully update the info!');
        return Redirect::to('admin/info');
    }
}
