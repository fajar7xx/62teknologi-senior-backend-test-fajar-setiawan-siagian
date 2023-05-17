<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessSearchRequest;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Resources\Business\BusinessCollection;

class SearchBusinessController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $location = $request->location;
        $term = $request->term;
        $limit = $request->limit ?? 30 ;
        $sortBy = $request->sort_by ?? 'id';
        $categories = $request->categories;

        $query = Business::query()->with([
                'categories:id,alias,title',
                'transactions:id,name',
                'location'
            ]);

        $query->when($location, function($query) use($location){
            $wildSearch = "%$location%";
        });

        $query->when($term, function($query) use($term){
           $wildSearch = "%$term%";
        });

        $query->when($categories, function($query) use($categories){

        });


        $business = $query->orderBy($sortBy, 'asc')->paginate($limit);

        return new BusinessCollection($business);
    }
}
