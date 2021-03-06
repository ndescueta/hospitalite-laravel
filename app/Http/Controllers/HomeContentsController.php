<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HomeContent;

use App\Service;
use App\Event;
use App\HomeContentImage;
use App\News;
use App\GeneralQuestion;

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

        $bannerImage = HomeContentImage::where('intHomeContentId','2')->get();
        $whoWeAreImage = HomeContentImage::where('intHomeContentId','11')->get();


        $ServiceDescriptions = HomeContent::where('txtTitle','Services Description')->get();
        $Services = Service::all();

        $EventsDescriptions = HomeContent::where('txtTitle','News and Events Description')->get();
        $News = News::all();
        $Events = Event::all();

        $Contacts = HomeContent::where('txtTitle','Contact Number')->get();
        $ContactDescriptions = HomeContent::where('txtTitle','Contact Us Description')->get();

        $WhoWeAreDesc = HomeContent::where('txtTitle','Who We Are')->get();

        $HomePageTitle = HomeContent::where('txtTitle', 'Home Page Title')->get();

        return view('admin.homepageView')->with(compact('bannerTexts','bannerTextDescriptions','ServiceDescriptions','Services','EventsDescriptions','Events','Contacts','ContactDescriptions','bannerImage','WhoWeAreDesc', 'HomePageTitle', 'whoWeAreImage', 'News'));

    }

    public function index2()
    {

        //
        $bannerTexts = HomeContent::where('txtTitle','Banner Text')->get();
        $bannerTextDescriptions = HomeContent::where('txtTitle','Banner Text Description')->get();

        $bannerImage = HomeContentImage::where('intHomeContentId','2')->get();
        $whoWeAreImage = HomeContentImage::where('intHomeContentId','11')->get();

        $ServiceDescriptions = HomeContent::where('txtTitle','Services Description')->get();
        $Services = Service::all();

        $EventsDescriptions = HomeContent::where('txtTitle','News and Events Description')->get();
        $News = News::all();
        $Events = Event::all();

        $Contacts = HomeContent::where('txtTitle','Contact Number')->get();
        $ContactDescriptions = HomeContent::where('txtTitle','Contact Us Description')->get();

        $WhoWeAreDesc = HomeContent::where('txtTitle','Who We Are')->get();

        $HomePageTitle = HomeContent::where('txtTitle', 'Home Page Title')->get();

        $generalQuestions = GeneralQuestion::all();
        
      return view('welcome')->with(compact('bannerTexts','bannerTextDescriptions','ServiceDescriptions','Services','EventsDescriptions','Events','Contacts','ContactDescriptions','bannerImage','WhoWeAreDesc', 'HomePageTitle', 'whoWeAreImage', 'News','generalQuestions'));

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

public function updateImage(Request $request)
{
  $this -> validate($request,[
    'image' => 'image|nullable|max:1999'
  ]);
  if($request->hasFile('image')){
  /*  $filenameWithExt = $request-> file('image')->getClientOriginalName();
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    $extension = $request-> file('image')->getClientOriginalExtension();
    $fileNameToStore = $filename.'_'.time().'.'.$extension;
    $path = $request-> file('image')->storeAs('public/cover_images',$fileNameToStore);*/
    $image = $request->file('image');
    $fileNameToStore = rand() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('HomeContentImages'),$fileNameToStore);

  }else{
    $fileNameToStore = '../img/header-img.png';
  }
    //
    $id =$request->input('contentid_img');
    $data = HomeContentImage::find($id);
    //$data = HomeContent::where('intHomeContentId',$request->input('contentid'))->get();
    $data->txtImageDirectory = $fileNameToStore;
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
