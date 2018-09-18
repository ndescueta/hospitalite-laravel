<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HomeContent;
use App\Service;
use App\Event;

class HomeContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bannerTexts = HomeContent::where('txtTitle','Banner Text')->get();
        $bannerTextDescriptions = HomeContent::where('txtTitle','Banner Text Description')->get();

        $ServiceDescriptions = HomeContent::where('txtTitle','Services Description')->get();
        $Services = Service::all();

        $EventsDescriptions = HomeContent::where('txtTitle','News and Events Description')->get();
        $Events = Event::all();

        $Contacts = HomeContent::where('txtTitle','Contact Number')->get();
        $ContactDescriptions = HomeContent::where('txtTitle','Contact Us Description')->get();

      return view('admin.homepageView')->with(compact('bannerTexts','bannerTextDescriptions','ServiceDescriptions','Services','EventsDescriptions','Events','Contacts','ContactDescriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
      /*  $description = HomeContent::find($id);
        return view('admin.homepageView')->with('description',$description);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $id)
    {
        //


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id =$request->input('contentid');
        $data = HomeContent::find($id);
        //$data = HomeContent::where('intHomeContentId',$request->input('contentid'))->get();
        $data->txtDescription = $request->input('description');
        $data->save();

        return redirect('/admin/homepageView');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
