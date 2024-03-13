<?php

namespace App\Http\Controllers\backend;

use App\Models\Audio;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AudioController extends Controller
{
    /**
     * Show Audio lists
     */
    public function audios_list()
    {
        $audios = Audio::with('product')->paginate(10);
        return view('backend.pages.audio.audios_list', compact('audios'));
    }
    /**
     * Show Audio Create Page
     */
    public function audio_create()
    {
        $products = Product::all();
        return view('backend.pages.audio.audio_create', compact('products'));
    }
    /**
     * Store Audio in Database
     */
    public function audio_store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'audio' => 'required|mimes:mp3',
        ]);
        $audio_name = null;
        if ($request->hasFile('audio')) {
            $extension = $request->file('audio')->getClientOriginalExtension();
            $audio_name = '/uploads/audios/' . date('YmdHis') . "." . $extension;
            $request->file('audio')->storeAs($audio_name);
        }
        Audio::create([
            'product_id' => $request->product_id,
            'audio' => $audio_name,
        ]);
        return back()->with('success', 'Successfully created an audio');
    }
    /**
     * Read/view Audio
     */
    public function view_audio($audio_id)
    {
        $audio = Audio::findOrFail($audio_id);
        return view('backend.pages.audio.audio_view', compact('audio'));
    }
    /**
     * Show Audio edit page
     */
    public function edit_audio($audio_id)
    {
        $audio = Audio::findOrFail($audio_id);
        $products = Product::all();
        return view('backend.pages.audio.audio_edit', compact('audio', 'products'));
    }
    /**
     * Update Audio in Database
     */
    public function update_audio(Request $request, $audio_id)
    {
        $request->validate([
            'product_id' => 'required',
        ]);
        $audio = Audio::findOrFail($audio_id);
        if ($request->hasFile('audio')) {
            // delete file from public path
            $find_audio = public_path() . $audio->audio;
            File::delete($find_audio);
            // create name and path for the database
            $extension = $request->file('audio')->getClientOriginalExtension();
            $audio_name = '/uploads/audios/' . date('YmdHis') . "." . $extension;
            // store in public path
            $request->file('audio')->storeAs($audio_name);
            // update
            $audio->update([
                'product_id' => $request->product_id,
                'audio' => $audio_name,
            ]);
            return back()->with('success', 'Successfully updated the audio');
        } else {
            // update
            $audio->update([
                'product_id' => $request->product_id,
            ]);
            return back()->with('success', 'Successfully updated except the file');
        }
    }
    /**
     * Delete Audio from database
     */
    public function delete_audio($audio_id)
    {
        $audio = Audio::findOrFail($audio_id);
        if (!empty($audio->audio)) {
            $find_audio = public_path() . $audio->audio;
            File::delete($find_audio);
        }
        $audio->delete();
        return redirect()->route('admin.audios.list')->with('success', 'Audio deleted successfully');
    }
}
