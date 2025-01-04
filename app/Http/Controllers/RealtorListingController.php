<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;

class RealtorListingController extends Controller {

    public function index(Request $request): Response {
        Gate::authorize('viewAny', Listing::class);

        $filters = [
            'deleted' => $request->boolean('deleted'),
            ... $request->only(['by', 'order'])
        ];

        return Inertia::render('Realtor/Index', [
            'filters' => $filters,
            'listings' => Auth::user()
                ->listings()
                ->filter($filters)
                ->withCount('images')
                ->paginate(5)
                ->withQueryString()
                
        ]);
    }

    public function create(): Response {
        return Inertia::render('Realtor/Create');
    }

    public function store(Request $request) {
        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:1|max:20',
                'baths' => 'required|integer|min:1|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|integer|min:1|max:3000',
                'price' => 'required|integer|min:1|max:20000000'
            ])
        );
        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing created successfully.')
            ->withInput();
    }    

    public function edit(Listing $listing): Response {
        return Inertia::render(
            'Realtor/Edit', 
            [
                'listing' => $listing
            ]
        );
    }

    public function update(Request $request, Listing $listing) {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:1|max:20',
                'baths' => 'required|integer|min:1|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|integer|min:1|max:3000',
                'price' => 'required|integer|min:1|max:20000000'
            ])
        );
        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing updated successfully.')
            ->withInput();
    }

    public function destroy(Listing $listing) {
        Gate::authorize('delete', $listing); 
        $listing->deleteOrFail();
        return redirect()->back()
            ->with('success', 'Listing deleted successfully.');
    }    

    public function restore(Listing $listing) {
        //Gate::authorize('restore', $listing);
        $listing->restore();
        return redirect()->back()
            ->with('success', 'Listing restored successfully.');
    }
}
