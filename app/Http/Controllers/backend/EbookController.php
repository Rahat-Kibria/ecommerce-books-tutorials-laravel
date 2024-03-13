<?php

namespace App\Http\Controllers\backend;

use App\Models\Ebook;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class EbookController extends Controller
{
    /**
     * Show Ebook lists
     */
    public function ebooks_list()
    {
        $ebooks = Ebook::with('product')->paginate(10);
        return view('backend.pages.ebook.ebooks_list', compact('ebooks'));
    }
    /**
     * Show Ebook Create Page
     */
    public function ebook_create()
    {
        $products = Product::all();
        return view('backend.pages.ebook.ebook_create', compact('products'));
    }
    /**
     * Store Ebook in Database
     */
    public function ebook_store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'ebook' => 'required|mimes:pdf',
        ]);
        $ebook_name = null;
        if ($request->hasFile('ebook')) {
            // create a name for the file with the path
            $extension = $request->file('ebook')->getClientOriginalExtension();
            $ebook_name = '/uploads/ebooks/' . date('YmdHis') . "." . $extension;
            // store in public path
            $request->file('ebook')->storeAs($ebook_name);
        }
        Ebook::create([
            'product_id' => $request->product_id,
            'ebook_path' => $ebook_name,
        ]);
        return back()->with('success', 'Successfully created an ebook');
    }
    /**
     * Read/view Ebook
     */
    public function view_ebook($ebook_id)
    {
        $ebook = Ebook::findOrFail($ebook_id);
        return view('backend.pages.ebook.ebook_view', compact('ebook'));
    }
    /**
     * Show Ebook edit page
     */
    public function edit_ebook($ebook_id)
    {
        $ebook = Ebook::findOrFail($ebook_id);
        $products = Product::all();
        return view('backend.pages.ebook.ebook_edit', compact('ebook', 'products'));
    }
    /**
     * Update Ebook in Database
     */
    public function update_ebook(Request $request, $ebook_id)
    {
        $request->validate([
            'product_id' => 'required',
        ]);
        $ebook = Ebook::findOrFail($ebook_id);
        if ($request->hasFile('ebook')) {
            // delete file from public path
            $find_ebook = public_path() . $ebook->ebook_path;
            File::delete($find_ebook);
            // create name and path for the database
            $extension = $request->file('ebook')->getClientOriginalExtension();
            $ebook_name = '/uploads/ebooks/' . date('YmdHis') . "." . $extension;
            // store in public path
            $request->file('ebook')->storeAs($ebook_name);
            // update
            $ebook->update([
                'product_id' => $request->product_id,
                'ebook_path' => $ebook_name,
            ]);
            return back()->with('success', 'Successfully updated the ebook');
        } else {
            // update
            $ebook->update([
                'product_id' => $request->product_id,
            ]);
            return back()->with('success', 'Successfully updated except the file');
        }
    }
    /**
     * Delete Ebook from database
     */
    public function delete_ebook($ebook_id)
    {
        $ebook = Ebook::findOrFail($ebook_id);
        if (!empty($ebook->ebook_path)) {
            $find_ebook = public_path() . $ebook->ebook_path;
            File::delete($find_ebook);
        }
        $ebook->delete();
        return redirect()->route('admin.ebooks.list')->with('success', 'Ebook deleted successfully');
    }
}
