<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use App\Models\Categories;
use App\Models\Chapters;
use App\Models\Stories;
use App\Traits\MessageStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Stories::withCount('chapters')->get();
        return view('admin.story.story', compact('stories', 'stories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Authors::all();
        $categories = Categories::all();
        return view('admin.story.add_story', compact('authors', 'categories'));
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
            'alias' => ['nullable', 'string'],
            'view' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'source' => ['required', 'string'],
            'image' => ['required', 'string'],
            'keyword' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'author_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'publish' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }

        $story = Stories::create([
            'name' => $data['name'],
            'alias' => $data['alias'],
            'status' => $data['status'],
            'source' => $data['source'],
            'image' => $data['image'],
            'keyword' => $data['keyword'],
            'description' => $data['description'],
            'slug' => Str::slug($data['name']),
            'user_id' => Auth()->user()->id,
            'author_id' => $data['author_id'],
            'category_id' => $data['category_id'],
            'created_at' => Carbon::now()->format('d-m-Y H:i:s'),
            'publish' => $data['publish']
        ]);

        return redirect('admin/danh-sach-truyen')->with(['success' => 'Created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $story = Stories::find($id);
        return view('admin.story.show_story', compact('story'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $story = Stories::find($id);
        $category = Categories::all();
        $author = Authors::all();
        return view('admin.story.edit_story', compact('story', 'category', 'author'));
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

        $story = Stories::where('id', $id)->first();

        if (!$story) {
            return MessageStatus::notFound();
        }

        $validator = Validator::make($data, [
            'name' => ['string', Rule::unique('stories', 'name')->ignore($story->id)],
            'alias' => ['string'],
            'content' => ['string'],
            'view' => ['nullable', 'string'],
            'status' => ['boolean'],
            'source' => ['string'],
            'image' => ['string'],
            'keyword' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'author_id' => ['integer'],
            'publish' => ['integer'],
            'category_id' => ['integer']
        ]);

        if ($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }

        $story->name = isset($data['name']) && $data['name'] ? $data['name'] : $story->name;
        $story->alias = isset($data['alias']) && $data['alias'] ? $data['alias'] : $story->alias;
        $story->status = isset($data['status']) && $data['status'] ? $data['status'] : $story->status;
        $story->source = isset($data['source']) && $data['source'] ? $data['source'] : $story->source;
        $story->image = isset($data['image']) && $data['image'] ? $data['image'] : $story->image;
        $story->keyword = isset($data['keyword']) && $data['keyword'] ? $data['keyword'] : $story->keyword;
        $story->description = isset($data['description']) && $data['description'] ? $data['description'] : $story->description;
        $story->author_id = isset($data['author_id']) && $data['author_id'] ? $data['author_id'] : $story->author_id;
        $story->publish = isset($data['publish']) && $data['publish'] ? $data['publish'] : $story->publish;
        $story->category_id = isset($data['category_id']) && $data['category_id'] ? $data['category_id'] : $story->category_id;
        $story->slug = Str::slug($data['name']);

        $story->save();

        return redirect('admin/danh-sach-truyen')->with(['success' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = Stories::find($id);

        if (!$story) {
            return MessageStatus::notFound();
        }

        $story->delete();

        return redirect('admin/danh-sach-truyen')->with(['success' => 'Deleted successfully']);
    }
}
