<?php

namespace App\Http\Controllers\backend;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::latest()->paginate(10);
        return view('backend.pages.tag.tags_list', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.tag.tag_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags,name',
            'slug' => 'required'
        ]);
        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug(trim($request->slug)),
            'description' => $request->description,
        ]);
        session()->flash('success', 'Created 1 tag successfully');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('backend.pages.tag.tag_view', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('backend.pages.tag.tag_edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);
        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug(trim($request->slug)),
            'description' => $request->description,
        ]);
        session()->flash('success', 'Updated 1 tag successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tag_id)
    {
        Tag::findOrFail($tag_id)->delete();
        session()->flash('success', 'Deleted 1 tag successfully');
        return back();
    }
}
