<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\MessageStatus;
use App\Models\Categories;
use App\Models\Stories;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::all();
        return view('admin.categories.category', compact('categories'));
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
            'name' => ['required', 'string','unique:categories'],
            'alias' => ['string', 'nullable'],
            'description' => ['required', 'string'],
            'keyword' => ['required', 'string'],
            'status' => ['boolean', 'string']
        ]);

        if ($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }

        $categories = Categories::create([
            'name' => $data['name'],
            'alias' => $data['alias'],
            'description' => $data['description'],
            'keyword' => $data['keyword'],
            'slug' => Str::slug($data['name']),
            'status' => $data['status']
        ]);

        return redirect('admin/danh-sach-the-loai')->with(['success' => 'Created successfully']);
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
        return view('admin.categories.show_category', compact('category'));
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
        return view('admin.categories.edit_category', compact('category'));
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
            'name' => ['string', Rule::unique('authors', 'name')->ignore($category->id)],
            'alias' => ['string', 'nullable'],
            'description' => ['string'],
            'keyword' => ['string'],
            'status' => ['boolean', 'string']
        ]);

        if ($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }
        $category->name = isset($data['name']) && $data['name'] ? $data['name'] : $category->name;
        $category->alias = isset($data['alias']) && $data['alias'] ? $data['alias'] : $category->alias;
        $category->description = isset($data['description']) && $data['description'] ? $data['description'] : $category->description;
        $category->keyword = isset($data['keyword']) && $data['keyword'] ? $data['keyword'] : $category->keyword;
        $category->slug = Str::slug($data['name']);
        $category->status = isset($data['status']) && $data['status'] ? $data['status'] : $category->status;

        $category->save();
        return redirect('admin/danh-sach-the-loai')->with(['success' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::where('id', $id)->first();

        if (!$category) {
            return MessageStatus::notFound();
        }

        $story = Stories::where('category_id', $category->id)->first();

        if ($story) {
            return MessageStatus::notFound();
        }

        $category->delete();

        return redirect('admin/danh-sach-the-loai');
    }
}
