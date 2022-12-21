<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use App\Models\Categories;
use App\Models\Stories;
use App\Models\Story_Categories;
use App\Traits\MessageStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Stories::get();
        return view('admin.story.story', compact('stories', 'stories'));
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
            'view' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'source' => ['required', 'string'],
            'image' => ['required', 'string'],
            'keyword' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'author_id' => ['required', 'integer']
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
            'slug' => Str::of($data['name'])->slug('-'),
            'user_id' => Auth()->user()->id,
            'author_id' => $data['author_id'],
            'created_at' => Carbon::now()->format('d-m-Y H:i:s')
        ]);

        if ($story) {

            $story_category = Story_Categories::create([
                'story_id' => $story->id,
                'category_id' => $data['category_id']
            ]);
        }

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
        $story = Stories::findOrFail($id);
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
        $story = Stories::findOrFail($id);
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

        $story = Stories::findOrFail($id);

        if (!$story) {
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
            'author_id' => ['integer']
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
        $story->slug = Str::of($data['name'])->slug('-');

        $story->save();
        if ($story) {

            $story_category = Story_Categories::where('story_id', $story->id)->delete();

            if(!$story_category) {
                return MessageStatus::notFound();
            }

            $story_category = Story_Categories::create([
                'story_id' => $story->id,
                'category_id' => $data['category_id']
            ]);
        }

        return redirect()->route('admin/danh-sach-truyen')->with(['success' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = Stories::findOrFail($id);

        if (!$story) {
            return MessageStatus::notFound();
        }

        $story->delete();

        return redirect('admin/danh-sach-truyen')->with(['success' => 'Deleted successfully']);
    }
}
