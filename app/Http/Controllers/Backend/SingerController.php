<?php

namespace App\Http\Controllers\Backend;

use App\Models\Singer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Image;
use Validator;
use Carbon\Carbon;

class SingerController extends Controller
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
    public function index(Request $request)
    {
        if( $request->get('keyword') != NULL ){
            $keyword = str_replace(" ", "-", trim($request->keyword));
            $singers = Singer::where('slug', 'like', '%'.$keyword.'%')->orderBy('updated_at','desc')->paginate(15);
        }else{
            $singers = Singer::orderBy('updated_at','desc')->paginate(15);
        }

        return view('backend.singers.listing', ['singers'=>$singers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.singers.addnew');
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
            'slug' => 'required|unique:singers',
            'gender' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else {
            if( $request->file('image') ){
                $image = $request->file('image');
                $input['imageName'] = $request->get('slug').'-'.time().'-'.config('image.thumnail_with').'x'.config('image.thumnail_height').'.'.$image->getClientOriginalExtension();
                $input['imageNameOrigin'] = $request->get('slug').'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/singers');

                $img = Image::make($image->getRealPath());
                $img->resize(config('image.thumnail_with'), config('image.thumnail_height'), function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imageName']);

                /*After Resize Add this Code to Upload Image*/
                //$destinationPath = public_path('/');
                $image->move($destinationPath, $input['imageNameOrigin']);
            }

            if( $request->file('image_bg') ){
                $image = $request->file('image_bg');
                $input['imageBgName'] = $request->get('slug').'-bg-'.time().'-'.config('image.background_with').'x'.config('image.background_height').'.'.$image->getClientOriginalExtension();
                $input['imageBgNameOrigin'] = $request->get('slug').'-bg-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/singers');

                $img = Image::make($image->getRealPath());
                $img->resize(config('image.background_with'), config('image.background_height'), function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imageBgName']);

                /*After Resize Add this Code to Upload Image*/
                //$destinationPath = public_path('/');
                $image->move($destinationPath, $input['imageBgNameOrigin']);
            }

            $singer = new Singer([
                                    'name'          => $request->get('name'),
                                    'slug'          => $request->get('slug'),
                                    'gender'        => $request->get('gender'),
                                    'image'         => ($input['imageName'] != '') ? $input['imageName'] : '',
                                    'background'    => ($input['imageBgName'] != '') ? $input['imageBgName'] : '',
                                    'description'   => $request->get('description')
                                ]);

            $singer->save();
            return redirect()->route('admin.singer.listing')->with('status', 'Created successful');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Singer  $singer
     * @return \Illuminate\Http\Response
     */
    public function show(Singer $singer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Singer  $singer
     * @return \Illuminate\Http\Response
     */
    public function edit($singer_id)
    {
        $singer = Singer::find($singer_id);
        return view('backend.singers.edit',compact('singer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Singer  $singer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $singer_id)
    {
        $singer = Singer::find($singer_id);

        if($singer->slug === $request->get('slug')){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'gender' => 'required',
                //'image' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
                //'image_bg' => 'required',
                'image_bg.*' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'slug' => 'required|unique:singers',
                'gender' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else {
            $destinationPath = public_path('/images/singers');
            // var_dump( $request->file('image') );
            // var_dump( $request->file('image_bg') );
            // var_dump( $singer->image );
            // var_dump( $singer->background );
            // $old_image = $destinationPath.'/'.$singer->image;
            // if( file_exists( $old_image ) ) echo "exist image avatar";
            // die('bug');

            if( $request->file('image') !== NULL ){
                $image = $request->file('image');
                $input['imageName'] = $request->get('slug').'-'.time().'-'.config('image.thumnail_with').'x'.config('image.thumnail_height').'.'.$image->getClientOriginalExtension();
                $input['imageNameOrigin'] = $request->get('slug').'-'.time().'.'.$image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->resize(config('image.thumnail_with'), config('image.thumnail_height'), function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imageName']);

                /*After Resize Add this Code to Upload Image*/
                //$destinationPath = public_path('/');
                $image->move($destinationPath, $input['imageNameOrigin']);

                $old_image = $destinationPath.'/'.$singer->image;
                if (file_exists($old_image)) {
                   @unlink($old_image);
                }
            }else{
                $input['imageName'] = $singer->image;
            }

            if( $request->file('image_bg') !== NULL ){
                $image = $request->file('image_bg');
                $input['imageBgName'] = $request->get('slug').'-bg-'.time().'-'.config('image.background_with').'x'.config('image.background_height').'.'.$image->getClientOriginalExtension();
                $input['imageBgNameOrigin'] = $request->get('slug').'-bg-'.time().'.'.$image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->resize(config('image.background_with'), config('image.background_height'), function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imageBgName']);

                /*After Resize Add this Code to Upload Image*/
                //$destinationPath = public_path('/');
                $image->move($destinationPath, $input['imageBgNameOrigin']);

                $old_bg = $destinationPath.'/'.$singer->background;
                if (file_exists($old_bg)) {
                   @unlink($old_bg);
                }
            }else{
                $input['imageBgName'] = $singer->background;
            }

            //'name', 'slug', 'gender','description','image','background'
            $singer->name = $request->get('name');
            $singer->slug = $request->get('slug');
            $singer->description = $request->get('description');
            $singer->image = $input['imageName'];
            $singer->background = $input['imageBgName'];
            $singer->updated_at = Carbon::now()->toDateTimeString();
            $singer->save();

            return redirect()->route('admin.singer.listing')->with('status', 'Edited successful');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Singer  $singer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Singer $singer)
    {
        //
    }

    public function deleteAjax(Request $request)
    {
        Singer::find($request->singer_id)->delete();
        return 'delete successful';
    }
}
