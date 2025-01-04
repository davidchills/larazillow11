<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller{

    public function create(Listing $listing) : Response {

        $listing->load(['images']);
        return Inertia::render(
            'Realtor/ListingImage/Create', 
            ['listing' => $listing]
        );
    }

    public function store(Listing $listing, Request $request) {

        if ($request->hasFile('images')) {
            $request->validate([
                'images.*' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:5000'
            ], 
            [
                'images.*.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg, webp.'
            ]);
            foreach($request->file('images') as $file) {
                $path = $file->store('images', 'public');
                $listing->images()->save(new ListingImage(['filename' => $path]));
            }
        }
       
        return redirect()->back()->with('success', 'Image uploaded successfully.'); 
    }

    public function destroy(Listing $listing, ListingImage $image) {
        Storage::disk('public')->delete($image->filename);
        $image->delete();
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
