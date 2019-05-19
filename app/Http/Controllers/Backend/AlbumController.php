<?php

namespace App\Http\Controllers\Backend;

use App\Models\Album;
use App\Models\Singer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use \Image;

class AlbumController extends Controller
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
        $albums = Album::orderBy('id', 'desc')->paginate(15);
        return view('backend.albums.listing', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $singers = Singer::orderBy('name', 'asc')->get();
        return view('backend.albums.addnew', ['singers'=>$singers]);
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
            'name' => 'required',
            'slug' => 'required|unique:albums',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else {
            if( $request->file('image') ){
                $image = $request->file('image');
                $input['imageName'] = $request->get('slug').'-'.time().'-'.config('image.thumnail_with').'x'.config('image.thumnail_height').'.'.$image->getClientOriginalExtension();
                $input['imageNameOrigin'] = $request->get('slug').'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/albums');

                $img = Image::make($image->getRealPath());
                $img->resize(config('image.thumnail_with'), config('image.thumnail_height'), function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imageName']);
                $image->move($destinationPath, $input['imageNameOrigin']);
            }

            $album = new Album([
                                    'name'          => $request->get('name'),
                                    'slug'          => $request->get('slug'),
                                    'images'        => ($input['imageName'] != '') ? $input['imageName'] : '', 
                                    'description'   => $request->get('description')
                                ]);
            $album->save();

            $listSinger = explode(',', $request->get('singer'));
            $album->singers()->attach( $listSinger );

            return redirect()->route('admin.album.index')->with('status', 'Created successful');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($album_id)
    {
        $album = Album::find($album_id);
        $singers = $album->singers->toArray();
        return view('backend.albums.edit', compact('album', 'singers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $album_id)
    {
        $album = Album::find($album_id);

        if($album->slug === $request->get('slug')){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'slug' => 'required|unique:albums',
            ]);
        }

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else {
            if( $request->file('image') ){
                $image = $request->file('image');
                $input['imageName'] = $request->get('slug').'-'.time().'-'.config('image.thumnail_with').'x'.config('image.thumnail_height').'.'.$image->getClientOriginalExtension();
                $input['imageNameOrigin'] = $request->get('slug').'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/albums');

                $img = Image::make($image->getRealPath());
                $img->resize(config('image.thumnail_with'), config('image.thumnail_height'), function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imageName']);
                $image->move($destinationPath, $input['imageNameOrigin']);
            }else{
                $input['imageName'] = '';
            }

            $album->name = $request->get('name');
            $album->slug = $request->get('slug');
            $album->description = $request->get('description');
            if($input['imageName'] != ''){
                $album->images = $input['imageName'];
            }
            $album->save();

            return redirect()->route('admin.album.index')->with('status', 'Edited successful');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        //
    }

    public function deleteAjax(Request $request)
    {
        Album::find($request->album_id)->delete();
        return 'delete successful';
    }
}
