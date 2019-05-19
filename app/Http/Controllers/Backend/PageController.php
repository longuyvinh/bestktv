<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Validator;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::orderBy('id','desc')->paginate(15);
        return view('backend.page.listing', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('backend.page.addnew');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required|unique:pages',
            'body' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            $page = new Page([
                            'author_id' => \Auth::user()->id,
                            'title'     => $request->get('title'),
                            'body'      => $request->get('body'),
                            'slug'      => $request->get('slug'),
                            'status'    => Page::STATUS_ACTIVE,
                        ]);
            $page->save();
            return redirect()->route('admin.page.listing')->with('status', 'Created Successful');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($pid)
    {
        $page = Page::find($pid);

        //$resources = $page->resources;
        
        return view('backend.page.edit', [ 'page' => $page ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pid)
    {
        $page = Page::find($pid);

        if($page->slug === $request->get('slug')){
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'slug' => 'required|unique:pages',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else {
            
            $page->title = $request->get('title');
            $page->slug = $request->get('slug');
            $page->body = $request->get('body');

            $page->save();
            return redirect()->route('admin.page.listing')->with('status', 'Edited successful');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function deleteAjax(Request $request){
        Page::find($request->pid)->delete();
        return 'delete successful';
    }
}
