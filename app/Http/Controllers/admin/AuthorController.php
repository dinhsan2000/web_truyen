<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use App\Models\Stories;
use App\Traits\MessageStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Authors::all();
        return view('admin.author.author',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.add_author');
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
            'name' => ['required', 'string', 'unique:authors'],
            'alias' => ['string', 'nullable'],
            'description' => ['required', 'string'],
            'keyword' => ['required', 'string'],
            'status' => ['boolean', 'string']
        ]);

        if($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }

        Authors::create([
            'name' => $data['name'],
            'alias' => $data['alias'],
            'description' => $data['description'],
            'keyword' => $data['keyword'],
            'slug' => Str::slug($data['name']),
            'status' => $data['status']
        ]);

        return redirect('admin/danh-sach-tac-gia')->with(['success' => 'Created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Authors::where('id', $id)->first();
        return view('admin.author.show_author',compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Authors::where('id', $id)->first();
        return view('admin.author.edit_author',compact('author'));
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

        $author = Authors::where('id', $id)->first();

        if (!$author) {
            return MessageStatus::notFound();
        }

        $validator = Validator::make($data, [
            'name' => ['string', Rule::unique('categories', 'name')->ignore($author->id)],
            'alias' => ['nullable'],
            'description' => ['string'],
            'keyword' => ['string'],
            'status' => ['boolean', 'string']
        ]);

        if($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }

        $author->name = isset($data['name']) && $data['name'] ? $data['name'] : $author->name;
        $author->alias = isset($data['alias']) && $data['alias'] ? $data['alias'] : $author->alias;
        $author->description = isset($data['description']) && $data['description'] ? $data['description'] : $author->description;
        $author->slug = Str::slug($data['name']);
        $author->keyword = isset($data['keyword']) && $data['keyword'] ? $data['keyword'] : $author->keyword;
        $author->status = isset($data['status']) && $data['status'] ? $data['status'] : $author->status;
        $author->save();

        return redirect('admin/danh-sach-tac-gia')->with(['success' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Authors::where('id', $id)->first();

        if(!$author) {
            return MessageStatus::notFound();
        }

        $story = Stories::where('author_id', $author->id)->first();

        if($story) {
            return MessageStatus::notFound();
        }

        $author->delete();
        return redirect()('admin/danh-sach-tac-gia')->with(['success' => 'Deleted successfully']);
    }
}
