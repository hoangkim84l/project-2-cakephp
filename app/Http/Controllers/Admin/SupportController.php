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
use Carbon\Carbon;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $support = \App\Support::paginate(10);
        return View::make('admin.support.index')
            ->with('support', $support);
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
            $file->move(storage_path() . '/app/public/support/', $name);
        }
        //save support
        $support           = new \App\Support;
        $support->name     = $request->get('name');
        $support->content  = $request->get('content');
        $support->views   = '1';
        $date           = date_create($request->get('date'));
        $format         = date_format($date, "Y-m-d");
        $support->date     = strtotime($format);
        $support->filename = $name;
        $support->save();

        //return redirect()->route('admin.support.index')->with('success', 'Information has been added');
        Session::flash('success', 'Successfully created support!');
        return Redirect::to('admin/support');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get support by id
        $support = \App\Support::find($id);
        // show the edit form
        return View::make('admin.support.edit')
            ->with('support', $support);
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
        //get support by id
        $support = \App\Support::find($id);
        //get link image
        if ($request->hasfile('filename')) {
            $file = $request->file('filename');
            $name = time() . $file->getClientOriginalName();
            $file->move(storage_path() . '/app/public/support/', $name);
        } else {
            $name = $support->logo;
        }

        $support->name      = $request->get('name');
        $support->gmail     = $request->get('gmail');
        $support->skype     = $request->get('skype');
        $support->hotline   = $request->get('hotline');
        $support->site_title = $request->get('site_title');
        $support->meta_key  = $request->get('meta_key');
        $support->meta_desc = $request->get('meta_desc');
        $support->zalo      = $request->get('zalo');
        $support->facebook  = $request->get('facebook');
        $support->logo      = $name;
        $support->address   = $request->get('address');
        $support->chat_zalo = $request->get('chat_zalo');
        $support->chat_facebook = $request->get('chat_facebook');
        $support->updated_at = Carbon::now()->timestamp;
        $support->save();

        Session::flash('success', 'Successfully update the support!');
        return Redirect::to('admin/support');
    }
}
