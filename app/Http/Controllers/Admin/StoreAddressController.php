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

class StoreAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $storeAddress = \App\StoreAddress::paginate(10);
        return View::make('admin.storeAddress.index')
            ->with('storeAddress', $storeAddress);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('admin/storeAddress/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //save storeAddress
        $storeAddress           = new \App\storeAddress;
        $storeAddress->phone    = $request->get('phone');
        $storeAddress->email    = $request->get('email');
        $storeAddress->address  = $request->get('address');
        $storeAddress->save();

        //return redirect()->route('admin.storeAddress.index')->with('success', 'Information has been added');
        Session::flash('success', 'Successfully created storeAddress!');
        return Redirect::to('admin/storeAddress');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the storeAddress
        $storeAddress = \App\StoreAddress::find($id);

        // show the view and pass the nerd to it
        return View::make('admin.storeAddress.show')
            ->with('storeAddress', $storeAddress);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get storeAddress by id
        $storeAddress = \App\StoreAddress::find($id);
        // show the edit form
        return View::make('admin.storeAddress.edit')
            ->with('storeAddress', $storeAddress);
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
        //get storeAddress by id
        $storeAddress = \App\StoreAddress::find($id);
        //get and store data
        $storeAddress->phone    = $request->get('phone');
        $storeAddress->email    = $request->get('email');
        $storeAddress->address  = $request->get('address');
        $storeAddress->save();

        Session::flash('success', 'Successfully update the storeAddress!');
        return Redirect::to('admin/storeAddress');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete storeAddress by id
        $storeAddress = \App\StoreAddress::find($id);
        $storeAddress->delete();

        Session::flash('success', 'Successfully deleted the storeAddress!');
        return Redirect::to('admin/storeAddress');
    }
}
