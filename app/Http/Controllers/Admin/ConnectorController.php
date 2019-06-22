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

class ConnectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //display list connector with 10 record/page
        $connector = \App\Connector::paginate(10);
        return View::make('admin.connector.index')
            ->with('connector', $connector);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('admin/connector/create');
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
            $file->move(storage_path() . '/app/public/connector/', $name);
        }
        //save connector
        $connector              = new \App\Connector;
        $connector->name        = $request->get('name');
        $connector->image_link  = $name;
        $connector->intro_vn    = $request->get('intro_vn');
        $connector->intro_en    = $request->get('intro_en');
        $connector->intro_cn    = $request->get('intro_cn');
        $connector->phone       = $request->get('phone');
        $connector->email       = $request->get('email');
        $connector->address     = $request->get('address');
        $connector->position    = $request->get('position');
        $connector->save();

        Session::flash('success', 'Successfully created connector!');
        return Redirect::to('admin/connector');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the connector
        $connector = \App\Connector::find($id);

        // show the view and pass the nerd to it
        return View::make('admin.connector.show')
            ->with('connector', $connector);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get connector by id
        $connector = \App\Connector::find($id);
        // show the edit form
        return View::make('admin.connector.edit')
            ->with('connector', $connector);
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
        //get connector by id
        $connector = \App\Connector::find($id);
        //get link image
        if ($request->hasfile('filename')) {
            $file = $request->file('filename');
            $name = time() . $file->getClientOriginalName();
            $file->move(storage_path() . '/app/public/connector/', $name);
        } else {
            $name = $connector->image_link;
        }

        $connector->name        = $request->get('name');
        $connector->image_link  = $name;
        $connector->intro_vn    = $request->get('intro_vn');
        $connector->intro_en    = $request->get('intro_en');
        $connector->intro_cn    = $request->get('intro_cn');
        $connector->phone       = $request->get('phone');
        $connector->email       = $request->get('email');
        $connector->address     = $request->get('address');
        $connector->position    = $request->get('position');

        $connector->save();

        Session::flash('success', 'Successfully update the connector!');
        return Redirect::to('admin/connector');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete connector by id
        $connector = \App\connector::find($id);
        $connector->delete();
        //delete image in connector
        $image_link = storage_path() . '/app/public/connector/' . $connector->filename;
        if (file_exists($image_link)) {
            unlink($image_link);
        }
        Session::flash('success', 'Successfully deleted the connector!');
        return Redirect::to('admin/connector');
    }
}
