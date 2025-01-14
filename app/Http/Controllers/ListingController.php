<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Offer;

class ListingController extends \Illuminate\Routing\Controller {

    public function index(Request $request): Response {

        Gate::authorize('viewAny', Listing::class);
        
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        return Inertia::render(
            'Listing/Index', 
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()
                ->filter($filters)
                ->withoutSold()
                ->paginate(10)
                ->withQueryString()
            ]
        );
    }

    public function show(Listing $listing): Response {
        
        Gate::authorize('view', $listing);
        
        $listing->load(['images']);
        $offer = !Auth::user() ? null : $listing->offers()->byMe()->first();
        return Inertia::render(
            'Listing/Show', 
            [
                'listing' => $listing,
                'offerMade' => $offer
            ]
        );
    }


}
