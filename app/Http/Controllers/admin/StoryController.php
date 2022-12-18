<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use App\Models\Categories;
use App\Models\Stories;
use App\Models\Story_Authors;
use App\Models\Story_Categories;
use App\Traits\MessageStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Stories::with('authors')->select("*")->get();

        return view('admin.story.story', compact('stories','stories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Authors::where('status', 1)->get();
        $categories = Categories::where('status', 1)->get();
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
            'content' => ['required', 'string'],
            'view' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'source' => ['required', 'string'],
            'image' => ['required', 'string'],
            'keyword' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'slug' => ['required', 'string']
        ]);

        if($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }

        $story = Stories::create([
            'name' => $data['name'],
            'alias' => $data['alias'],
            'content' => $data['content'],
            'status' => $data['status'],
            'source' => $data['source'],
            'image' => $data['image'],
            'keyword' => $data['keyword'],
            'description' => $data['description'],
            'slug' => $data['slug'],
            'user_id' => Auth()->user()->id,
            'created_at' => Carbon::now()->format('d-m-Y H:i:s')
        ]);

        $story_author = Story_Authors::create([
            'story_id' => $story->id,
            'author_id' => $data['author_id']
        ]);

        $story_category = Story_Categories::create([
            'story_id' => $story->id,
            'category_id' => $data['category_id']
        ]);

        return redirect()->route('admin/danh-sach-truyen');
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
        return view('admin.story.show_story', compact('story'));
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

        if(!$story) {
            return MessageStatus::notFound();
        }

        $validator = Validator::make($data, [
            'name' => ['string'],
            'alias' => ['string'],
            'content' => ['string'],
            'view' => ['nullable', 'string'],
            'status' => ['boolean'],
            'source' => ['string'],
            'image' => ['string'],
            'keyword' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'slug' => ['string']
        ]);

        if($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }

        $story->update([
           'name' => isset($data['name']) && $data['name'] ? $data['name'] : $story->name,
           'alias' => isset($data['alias']) && $data['alias'] ? $data['alias'] : $story->alias,
           'status' => isset($data['status']) && $data['status'] ? $data['status'] : $story->status,
           'source' => isset($data['source']) && $data['source'] ? $data['source'] : $story->source,
           'image' => isset($data['image']) && $data['image'] ? $data['image'] : $story->image,
           'keyword' => isset($data['keyword']) && $data['keyword'] ? $data['keyword'] : $story->keyword,
           'description' => isset($data['description']) && $data['description'] ? $data['description'] : $story->description,
           'slug' => isset($data['slug']) && $data['slug'] ? $data['slug'] : $story->slug,
           'updated_at' => Carbon::now()->format('d-m-Y H:i:s')
        ]);

        return redirect()->route('admin/danh-sach-truyen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
