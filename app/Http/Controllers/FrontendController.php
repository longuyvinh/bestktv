<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Album;
use App\Models\Page;
use App\Models\Singer;
use App\Models\Type;
use App\Mail\Contact;
use Validator;

class FrontendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listing = \DB::select(
                        \DB::raw("SELECT *
                            FROM
                            (SELECT *,@category_rank := IF(@current_category = category, @category_rank + 1, 1) AS category_rank, @current_category := category
                            FROM products
                            ORDER BY category ASC, created_at DESC
                            ) ranked
                            WHERE category_rank <= 50")
                    );

        $output = [];

        foreach ($listing as $key => $value) {
            $id = $value->id;
            $product = Product::find($id);
            $value->singers = $product->singers;
            if($value->category == 'beat'){
                $output['beat'][] = $value;
            }else{
                $output['karaoke'][] = $value;
            }
        }
        return view('welcome')->with('output', $output);
    }

    public function listBeat(){
        $products = Product::where('category','beat')->orderBy('id','desc')->paginate( config('settings.items_per_page') );
        return view('listing', ['products' => $products, 'type'=>'beat']);
    }

    public function listKaraoke(){
        $products = Product::where('category','karaoke')->orderBy('id','desc')->paginate( config('settings.items_per_page') );
        return view('listing', ['products' => $products, 'type'=>'karaoke']);
    }

    public function listSearch($keyword){
        $products = Product::where('slug','like', '%'.$keyword.'%')->orderBy('id','desc')->paginate( config('settings.items_per_page') );
        return view('listing', ['products' => $products, 'type'=>'search']);
    }

    public function searching(Request $request){
        $keyword = str_replace(" ", "-", trim($request->keyword));
        return redirect()->route('search', $keyword);
    }

    public function getListSearch(Request $request){
        $keyword = str_replace(" ", "-", trim($request->keyword));

        $beats = Product::where('slug','like', '%'.$keyword.'%')->where('category','beat')->orderBy('id','desc')->limit(10)->get();
        $albums = Album::where('slug', 'like', '%'.$keyword.'%')->orderBy('id','desc')->limit(10)->get();
        $karaokes = Product::where('slug','like', '%'.$keyword.'%')->where('category','karaoke')->orderBy('id','desc')->limit(10)->get();
        echo '<div class="row" id="search-list">';
        echo '<div class="col-md-4 col-sm-12 col-xs-12">
                <h5>Beats</h5>
                <ul>';
                if(count($beats) > 0){
                    foreach($beats as $item) {
                        // $singers = $item->singers->toArray();
                        // $list_singer = [];
                        // foreach ($singers as $key => $value) {
                        //     $list_singer[] = $value['id'];
                        // }
                        // $list_singer = implode(",", $list_singer);
                        echo '<li>';
                        if($item->image !== null && $item->image !== ""){
                            echo '<img src="/images/products/'. $item->image .'" width="30" style="margin-right: 5px;">';
                        }
                        else{
                            echo '<img src="/images/beat_icon.png" width="30" style="margin-right: 5px;">';
                        }

                        echo '<a href="'.route('detail', $item->slug).'">'.$item->name.'</a> - ';
                        foreach($item->singers as $key=>$sing){
                            if($key>0){
                                echo ',<a class="related_link" href="'. route('singer.detail', $sing['slug']) .'">'. $sing['name'] .'</a>';
                            }
                            else{
                                echo '<a class="related_link" href="'. route('singer.detail', $sing['slug']) .'">'. $sing['name'] .'</a>';
                            }
                        }
                        echo '</li>';
                    }
                }else{
                    echo '<li>Not found any beat</li>';
                }

            echo '</ul>';
        echo '</div>';

        echo '<div class="col-md-4 col-sm-12 col-xs-12">
                <h5>Albums</h5>
                <ul>';
                if(count($albums) > 0){
                    foreach($albums as $item) {
                        echo '<li><a href="'.route('detail', $item->slug).'">'.$item->name.'</a></li>';
                    }
                }else{
                    echo '<li>Not found any album</li>';
                }

            echo '</ul>';
        echo '</div>';

        echo '<div class="col-md-4 col-sm-12 col-xs-12">
                <h5>Karaokes</h5>
                <ul>';
                if(count($karaokes) > 0){
                    foreach($karaokes as $item) {
                        echo '<li><a href="'.route('detail', $item->slug).'">'.$item->name.'</a></li>';
                    }
                }else{
                    echo '<li>Not found any karaoke</li>';
                }

            echo '</ul>';
        echo '</div>';
        echo '</div>';

        /*
        echo '<ul id="search-list">';

        if(count($products) > 10){
            $products = array_slice($products, 10);
        }

        foreach($products as $item) {
            echo '<li onClick="selectCountry(\''.$item->slug.'\', \''.$item->name.'\')">'.$item->name.'</li>';
        }
        echo '</ul>';
        /*
        return response()->json([
            'code' => 'success',
            'message' => 'Add item in your cart successfully',
            'count' => Cart::count()
        ]);*/
    }

    public function pageDetail($slug){
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('pagedetail')->with(['page' => $page,]);
    }

    public function pageContact(){
        return view('contact');
    }

    public function storeContact(Request $request){
        $validator = Validator::make($request->all(), [
          'message' => 'required',
          'email' => 'email|required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        \Mail::to( config('settings.mail_admin') )->send(new Contact($request));

        // check for failures
        if (\Mail::failures()) {
            // return response showing failed emails
            return redirect()->back()->withErrorsMessage('Have problem with mail server !!!');
        }
        return redirect()->back()->withSuccessMessage('Thank you for your contacting');
    }

    public function pageDatbai(){
        return view('datbai');
    }

    public function storeDatbai(Request $request){
        $validator = Validator::make($request->all(), [
          'email' => 'email|required',
          'phone' => 'require',
          'song' => 'require',
          'singer' => 'require',
          'link' => 'require'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        \Mail::to('issacnguyen.az@gmail.com')->send(new Datbai($request));
        return redirect()->back()->withSuccessMessage('Thank you for your contacting');
    }

    public function storeSubscriber(Request $request){
        //$page = Page::where('slug', $slug)->firstOrFail();
        //return view('pagedetail')->with(['page' => $page,]);
    }

    public function singers(){
        $singers = Singer::orderBy('created_at','desc')->paginate( config('settings.items_per_page') );
        return view('singers', ['singers' => $singers]);
    }

    public function singerDetail(Request $request){
        $slug = $request->slug;
        $singer = Singer::where('slug',$slug)->firstOrFail();
        $sid = $singer->id;

        $list_singer = Singer::all()->where('id', '!=', $sid)->random(10);

        $listing = \DB::select(
                        \DB::raw("SELECT *
                            FROM
                            (SELECT *,@category_rank := IF(@current_category = category, @category_rank + 1, 1) AS category_rank, @current_category := category
                            FROM products
                            LEFT JOIN product_singer
                            ON products.id = product_singer.product_id
                            WHERE product_singer.singer_id = $sid
                            ORDER BY products.category ASC, products.created_at DESC
                            ) ranked
                            WHERE category_rank <= 50")
                    );

        $output = [];

        foreach ($listing as $key => $value) {
            $id = $value->id;
            $product = Product::find($id);
            $value->singers = $product->singers;
            if($value->category == 'beat'){
                $output['beat'][] = $value;
            }else{
                $output['karaoke'][] = $value;
            }
        }

        return view('singerdetail', ['singer' => $singer, 'output' => $output, 'lsinger'=>$list_singer]);
    }

    public function albums(){

    }

    public function genres(){
        $types = Type::orderBy('name', 'asc')->paginate( config('settings.items_per_page') );
        return view('genres', ['genres' => $types]);
    }

    public function genreDetail(Request $request){
        $slug = $request->slug;
        $genre = Type::where('slug',$slug)->firstOrFail();
        $gid = $genre->id;

        $list_genre = Type::all()->where('id', '!=', $gid)->random(10);

        $listing = \DB::select(
                        \DB::raw("SELECT *
                            FROM
                            (SELECT *,@category_rank := IF(@current_category = category, @category_rank + 1, 1) AS category_rank, @current_category := category
                            FROM products
                            LEFT JOIN product_type
                            ON products.id = product_type.product_id
                            WHERE product_type.type_id = $gid
                            ORDER BY products.category ASC, products.created_at DESC
                            ) ranked
                            WHERE category_rank <= 50")
                    );

        $output = [];

        foreach ($listing as $key => $value) {
            $id = $value->id;
            $product = Product::find($id);
            $value->singers = $product->singers;
            if($value->category == 'beat'){
                $output['beat'][] = $value;
            }else{
                $output['karaoke'][] = $value;
            }
        }

        return view('genredetail', ['genre' => $genre, 'output' => $output, 'lgenre'=>$list_genre]);
    }
}
