<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Type;
use App\Models\Singer;
use App\Models\Album;
use App\Models\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;
use \Image;

class ProductController extends Controller
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
            $products = Product::where('slug', 'like', '%'.$keyword.'%')->orderBy('id','desc')->paginate(15);
        }else{
            $products = Product::orderBy('id','desc')->paginate(15);
        }
        
        return view('backend.product.listing', ['products' => $products]);
    }

    public function search(Request $request){
        echo $request->get('keyword');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $types = Type::get()->pluck('name', 'id');
        $singers = Singer::orderBy('name', 'asc')->get();
        $albums = Album::orderBy('name', 'asc')->get();
        return view('backend.product.addnew', ['types'=>$types, 'singers'=>$singers, 'albums'=>$albums] );
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
            'slug' => 'required|unique:products',
            'price_vnd' => 'required',
            'price_usd' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            if( $request->file('image') ){
                $image = $request->file('image');
                $input['imageName'] = $request->get('slug').'-'.time().'-'.config('image.thumnail_with').'x'.config('image.thumnail_height').'.'.$image->getClientOriginalExtension();
                //$input['imageNameOrigin'] = $request->get('slug').'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/products');

                $img = Image::make($image->getRealPath());
                $img->resize(config('image.thumnail_with'), config('image.thumnail_height'), function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imageName']);

                /*After Resize Add this Code to Upload Image*/
                //$destinationPath = public_path('/');
                //$image->move($destinationPath, $input['imageNameOrigin']);
            }else{
                $input['imageName'] = '';
            }

            $product = new Product([
                                    'category'      => $request->get('category'),
                                    'name'          => $request->get('name'),
                                    'slug'          => $request->get('slug'),
                                    'price_usd'     => $request->get('price_usd'),
                                    'price_vnd'     => $request->get('price_vnd'),
                                    'description'   => $request->get('description'),
                                    'image'         => $input['imageName']
                                ]);
            $product->save();

            if( $request->file('resource_file') ){
                //case for upload dirrect
                $file = $request->file('resource_file');
                $input['fileName'] = $request->get('slug').'-'.time().'.'.$file->getClientOriginalExtension();

                $now = Carbon::now();
                $month = $now->format('M');
                $year = $now->format('Y');
                $folderName = strtolower($month).'_'.$year;

                //check folder exist
                if( !\File::exists('/resources/'.$folderName) ){
                    //create new folder to contain file
                    Storage::makeDirectory('/resources/'.$folderName);
                }

                $destinationPath = public_path('/resources/'.$folderName);
                $file->move($destinationPath, $input['fileName']);

                $resource = new Resource([
                                    'pid'           => $product->id,
                                    'type'          => $request->get('resource_type'),
                                    'path'          => $folderName.'/'.$input['fileName'],
                                ]);
                $resource->save();
            }else{
                //case for upload link url
                $resource_from = $request->get('resource_from');
                $resource_url = $request->get('resource_url');

                $resource = new Resource([
                                    'pid'           => $product->id,
                                    'type'          => 'url',
                                    'from'          => $resource_from,
                                    'path'          => $resource_url,
                                ]);
                $resource->save();
            }

            if( $request->get('singer') != '' )
            {
                $listSinger = explode(',', $request->get('singer'));
                $product->singers()->attach( $listSinger );
            }
            
            if( $request->get('album') != '')
            {
                $listAlbum = explode(',', $request->get('album'));
                $product->albums()->attach( $listAlbum );
            }

            $product->types()->attach( $request->get('type') );

            return redirect()->route('admin.product.listing')->with('status', 'Created Successful');
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
    public function edit($product_id)
    {
        $product = Product::find($product_id);

        $resources = $product->resources;

        $types = $product->types->toArray(); 
        $list_type = "";
        foreach ($types as $item) {
            $list_type .= $item['name'].', ';
        }
        $list_type = substr($list_type,0, -2);

        $list_singers = $product->singers->toArray();
        $list_singers_name = '';
        foreach ($list_singers as $key => $value) {
            $list_singers_name .= $value['name'].', ';
        }
        $list_singers_name = substr($list_singers_name,0, -2);

        $list_albums = $product->albums->toArray();
        $list_albums_name = '';
        foreach ($list_albums as $key => $value) {
            $list_albums_name .= $value['name'].', ';
        }
        $list_albums_name = substr($list_albums_name,0, -2);
        
        $types = Type::pluck('name', 'id')->all();
        $types[0] = 'None';
        ksort($types);

        $singers = Singer::orderBy('name', 'asc')->get();
        $albums = Album::orderBy('name', 'asc')->get();
        
        return view('backend.product.edit', [
                                            'types'     => $types,
                                            'singers'   => $singers, 
                                            'albums'    => $albums, 
                                            'product'   => $product,
                                            'list_type' => $list_type,
                                            'list_singers' => $list_singers_name,
                                            'list_albums'  => $list_albums_name,
                                            'resources' => $resources
                                            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        $product = Product::find($product_id);

        if($product->slug === $request->get('slug')){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'price_vnd' => 'required',
                'price_usd' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'slug' => 'required|unique:products',
                'price_vnd' => 'required',
                'price_usd' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else {
            if($request->get('category') != ''){
                $product->category = $request->get('category');
            }

            
            if( $request->get('type') != '' )
            {
                $types = $product->types->toArray(); 
                foreach ($types as $item) {
                    $product->types()->detach( $item['id'] );
                }
                $product->types()->attach( $request->get('type') );
            }

            if( $request->get('singer') != '' )
            {
                $singers = $product->singers->toArray(); 
                foreach ($singers as $item) {
                    $product->singers()->detach( $item['id'] );
                }

                $listSinger = explode(',', $request->get('singer'));
                $product->singers()->attach( $listSinger );
            }
            
            if( $request->get('album') != '')
            {
                $albums = $product->albums->toArray(); 
                foreach ($albums as $item) {
                    $product->albums()->detach( $item['id'] );
                }
                
                $listAlbum = explode(',', $request->get('album'));
                $product->albums()->attach( $listAlbum );
            }

            if( $request->file('image') ){
                $image = $request->file('image');
                $input['imageName'] = $request->get('slug').'-'.time().'-'.config('image.thumnail_with').'x'.config('image.thumnail_height').'.'.$image->getClientOriginalExtension();
                //$input['imageNameOrigin'] = $request->get('slug').'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/products');

                $img = Image::make($image->getRealPath());
                $img->resize(config('image.thumnail_with'), config('image.thumnail_height'), function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imageName']);
            }else{
                $input['imageName'] = '';
            }

            $product->name = $request->get('name');
            $product->slug = $request->get('slug');
            $product->price_vnd = $request->get('price_vnd');
            $product->price_usd = $request->get('price_usd');
            $product->description = $request->get('description');

            if($input['imageName'] != ''){
                $product->image = $input['imageName'];
            }

            $product->save();
            return redirect()->route('admin.product.listing')->with('status', 'Edited successful');
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
        Product::find($request->pid)->delete();
        return 'delete successful';
    }

    public function getAlbum($album){
        // not working: please review relationship with model
        // $list = explode(',', $album);
        // $singer = Singer::find($list);
        // return $singer->albums->toArray();
    }
}
