<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use App\Traits\MessageStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Authors::where('status', 1)->get();
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

        Authors::create($data);

        return redirect('admin/danh-sach-tac-gia');
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
        $validator = Validator::make($data, [
            'name' => ['string'],
            'alias' => ['nullable'],
            'description' => ['string'],
            'keyword' => ['string'],
            'slug' => ['string'],
            'status' => ['boolean', 'string']
        ]);

        if($validator->fails()) {
            return MessageStatus::displayInvalidInput($validator);
        }

        $author->update($data);

        return redirect('admin/danh-sach-tac-gia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Authors::where('id', $id)->first;

        if(!$author) {
            return MessageStatus::notFound();
        }

        $author->delete();
        return redirect()('admin/danh-sach-tac-gia');
    }
}
