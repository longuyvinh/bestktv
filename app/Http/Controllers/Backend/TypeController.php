<?php

namespace App\Http\Controllers\Backend;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class TypeController extends Controller
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
        $types = Type::orderBy('id','desc')->paginate(15);
        return view('backend.styles.listing', ['types'=>$types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.styles.addnew');
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
            'slug' => 'required|unique:types'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else {
            // vali
            $type = new Type([
                'name' => $request->get('name'),
                'slug' => $request->get('slug'),
                'description' => $request->get('description')
            ]);

            $type->save();
            return redirect()->route('admin.style.listing')->with('status', 'Đã tạo mới thành công thể loại nhac');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($type_id)
    {
        $type = Type::find($type_id);
        return view('backend.styles.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type_id)
    {
        $type = Type::find($type_id);

        if($type->slug === $request->get('slug')){
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'slug' => 'required|unique:types'
            ]);
        }
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else {
            
            $type->name = $request->get('name');
            $type->slug = $request->get('slug');
            $type->description = $request->get('description');
            $type->save();
            return redirect()->route('admin.style.listing')->with('status', 'Đã edit thành công thể loại nhac');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        //
    }

    public function deleteAjax(Request $request)
    {
        Type::find($request->type_id)->delete();
        return 'delete successful';
    }
}
