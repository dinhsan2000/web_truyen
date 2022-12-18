<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\MessageStatus;
use App\Models\Categories;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::where('status', 1)->get();
        return view('admin.categories.category',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.add_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => ['required', 'string'],
            'alias' => ['string', 'nullable'],
            'description' => ['required', 'string'],
            'keyword' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'status' => ['boolean', 'string']
        ]);

        if($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }

        Categories::create($data);

        return redirect('admin/danh-sach-the-loai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Categories::where('id', $id)->first();
        return view('admin.categories.show_category',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::where('id', $id)->first();
        return view('admin.categories.edit_category',compact('category'));
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
        $data = $request->all();
        $category = Categories::where('id', $id)->first();

        if (!$category) {
            return MessageStatus::notFound();
        }

        $validator = Validator::make($data, [
            'name' => ['string'],
            'alias' => ['string', 'nullable'],
            'description' => ['string'],
            'keyword' => ['string'],
            'slug' => ['string'],
            'status' => ['boolean', 'string']
        ]);

        if($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }
        $category->update($data);
        return redirect('admin/danh-sach-the-loai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::where('id', $id)->first;

        if(!$category) {
            return MessageStatus::notFound();
        }

        $category->delete();

        return redirect('admin/danh-sach-the-loai');
    }
}
