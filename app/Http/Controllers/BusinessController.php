<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use App\Models\Business;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\Business\BusinessCollection;
use App\Http\Resources\Business\BusinessResource;
use App\Models\Location;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): BusinessCollection
    {
        $businesses = Business::query()
            ->with([
                'categories:id,alias,title',
                'transactions:id,name',
                'location'
            ])
            ->paginate();
        return new BusinessCollection($businesses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBusinessRequest $request)
    {
        $imageUrl = null;

        if($request->hasFile('image')){
            $imageUrl = $request->file('image')->store('bphoto', 'public');
        }

        DB::beginTransaction();
        try {
            // create business
            $business = Business::create([
                'alias'         => \Str::slug($request->name),
                'name'          => $request->name,
                'image_url'     => $imageUrl,
                'is_closed'     => $request->is_closed,
                'url'           => "url_none",
                'lattitude'     => $request->lattitude,
                'longtitude'    => $request->longtitude,
                'price'         => $request->price,
                'phone'         => $request->phone,
                'display_phone' => $request->display_phone,
                'distance'      => $request->distance
            ]);

            // create location business
            $business->location()->create([
                'address1' => $request->address1,
                'address2' => $request->address2,
                'address3' => $request->address3,
                'city'     => $request->city,
                'zip_code' => $request->zip_code,
                'country'  => $request->country,
                'state'    => $request->state,
            ]);

            $business->categories()->attach($request->categories);
            $business->transactions()->attach($request->transactions);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }

        return new BusinessResource($business->load([
            'categories:id,alias,title',
            'transactions:id,name',
            'location'
        ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business): BusinessResource
    {
        return new BusinessResource(
            $business->load([
                'categories:id,alias,title',
                'transactions:id,name',
                'location'
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusinessRequest $request, Business $business)
    {
        $imageUrl = null;

        if($request->hasFile('image')){
            $imageUrl = $request->file('image')->store('bphoto', 'public');
        }

        DB::beginTransaction();
        try{
            $business->alias         = \Str::slug($request->name);
            $business->name          = $request->name;

            if($request->hasFile('image')){
                $business->image_url     = $imageUrl;
            }

            $business->is_closed     = $request->is_closed;
            $business->url           = "url_none";
            $business->lattitude     = $request->lattitude;
            $business->longtitude    = $request->longtitude;
            $business->price         = $request->price;
            $business->phone         = $request->phone;
            $business->display_phone = $request->display_phone;
            $business->distance      = $request->distance;
            $business->save();

            $location = Location::query()->where('business_id', $business->id)->firstOrFail();
            $location->address1 = $request->address1;
            $location->address2 = $request->address2;
            $location->address3 = $request->address3;
            $location->city     = $request->city;
            $location->zip_code = $request->zip_code;
            $location->country  = $request->country;
            $location->state    = $request->state;
            $location->save();

            $business->categories()->sync($request->categories);
            $business->transactions()->sync($request->transactions);

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage());
        }

        return new BusinessResource($business);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        $business->delete();
        return new BusinessResource($business);
    }
}
