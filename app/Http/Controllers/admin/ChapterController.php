<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use App\Models\Stories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\MessageStatus;

class ChapterController extends Controller
{
    use MessageStatus;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $story = Stories::where('id', $id)->first();
        $chapters = Chapters::where('story_id', $id)->get();
        return view('admin.chapter.chapter', compact('chapters', 'story'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $chapter = Chapters::count('name') +1;
        return view('admin.chapter.add_chapter', compact('chapter', 'story'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => ['required' ,'string'],
            'alias' => ['required' ,'string'],
            'subname' => ['required' ,'string'],
            'content' => ['required' ,'string'],
        ]);

        if($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }

        $chapter = Chapters::create([
            'name' => $data['name'],
            'alias' => $data['alias'],
            'view' => 0,
            'subname' => $data['subname'],
            'content' => $data['content'],
            'story_id' => $id
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chapter = Chapters::where('id', $id)->first();
        return view('admin.chapter.edit_chapter', compact('chapter'));
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

        $validator = Validator::make($data, [
            'name' => ['string'],
            'alias' => ['string'],
            'subname' => ['string'],
            'content' => ['string'],
        ]);

        if($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }

        $chapter = Chapters::where('id', $id)->first();

        if(!$chapter) {
            return MessageStatus::notFound();
        }

        $chapter->name = isset($data['name']) && $data['name'] ? $data['name'] : $chapter->name;
        $chapter->alias = isset($data['alias']) && $data['alias'] ? $data['alias'] : $chapter->alias;
        $chapter->subname = isset($data['subname']) && $data['subname'] ? $data['subname'] : $chapter->subname;
        $chapter->content = isset($data['content']) && $data['content'] ? $data['content'] : $chapter->content;
        $chapter->save();

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
        //
    }
}
