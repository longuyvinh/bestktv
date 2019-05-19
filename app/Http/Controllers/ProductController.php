<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beats = Product::where('category','beat')->orderBy('created_at', 'DESC')->limit(10)->get();
        $karaokes = Product::where('category','karaoke')->orderBy('created_at', 'DESC')->limit(10)->get();
        return view('shop')->with('beats', $beats)
                            ->with('karaokes', $karaokes);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $resources = $product->resources->toArray();
        $url = $resources['path'];

        $whitelist = ['YouTube', 'Dailymotion'];

        $params = [
            'autoplay' => 1,
            'loop' => 0
        ];

        $attributes = [
            'type' => null,
            'class' => 'iframe-class',
            'data-html5-parameter' => true,
            'width' => '100%',
            'height' => '400'
        ];

        //get list singer
        $singers = $product->singers->toArray();
        $list_singer = [];
        foreach ($singers as $key => $value) {
            $list_singer[] = $value['id'];
        }
        $list_singer = implode(",", $list_singer);

        $types = $product->types->toArray();
        $albums = $product->albums->toArray();

        // get list beat and video of singer
        $sql = "SELECT *
                FROM
                (SELECT products.*,@category_rank := IF(@current_category = category, @category_rank + 1, 1) AS category_rank, @current_category := category
                FROM products
                LEFT JOIN product_singer ON (products.id = product_singer.product_id)
                WHERE products.id != '$product->id' AND product_singer.singer_id in ( $list_singer )
                ORDER BY products.created_at DESC
                ) ranked
                WHERE category_rank <= 8";
        $listing = \DB::select( \DB::raw($sql) );

        $list_by_singer = [];
        foreach ($listing as $key => $value) {
            $id = $value->id;
            $prolist = Product::find($id);
            $value->singers = $prolist->singers;

            if($value->category == 'beat'){
                $list_by_singer['beats'][] = $value;
            }else{
                $list_by_singer['karaokes'][] = $value;
            }
        }
        // get list beat and video of singer EOF

        // get list of genre
        $list_by_genre = Product::where('id','!=', $product->id)
                            ->where('category', $product->category)
                            ->limit(20)->inRandomOrder()->get();
        // get list of genre EOF

        $list_singer_text = "";
        foreach($singers as $key=>$sing){
            $list_singer_text .= $sing['name'].', ';
        }

        $list_singer_text = substr($list_singer_text, 0, -2);
        return view('detail')->with(['product'      => $product,
                                    'singers'       => $singers,
                                    'list_singer_text'   => $list_singer_text,
                                    'types'         => $types,
                                    'albums'        => $albums,
                                    'url'           => $url,
                                    'whitelist'     => $whitelist,
                                    'attributes'    => $attributes,
                                    'params'        => $params,
                                    'list_by_genre' => $list_by_genre,
                                    'list_by_singer'=> $list_by_singer]);
    }

    public function singerDetail($slug){
        return view('detail_singer')->with(['product'      => $product,
                                    'singers'       => $singers,
                                    'types'         => $types,
                                    'albums'        => $albums,
                                    'list_by_genre' => $list_by_genre,
                                    'list_by_singer'=> $list_by_singer]);
    }

    public function albumDetail($slug){
        return view('detail_album')->with(['product'      => $product,
                                    'singers'       => $singers,
                                    'types'         => $types,
                                    'albums'        => $albums,
                                    'list_by_genre' => $list_by_genre,
                                    'list_by_singer'=> $list_by_singer]);
    }

    public function genreDetail($slug){
        return view('detail_genre')->with(['product'      => $product,
                                    'singers'       => $singers,
                                    'types'         => $types,
                                    'albums'        => $albums,
                                    'list_by_genre' => $list_by_genre,
                                    'list_by_singer'=> $list_by_singer]);
    }

}
