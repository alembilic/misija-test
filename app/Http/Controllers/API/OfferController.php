<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Offer::query();

        if (!empty($request->q))
            $query->where('title', 'LIKE', '%' . $request->q . '%')
                ->orWhere('description', 'LIKE', '%' .  $request->q . '%')
                ->orWhere('introduction', 'LIKE', '%' .  $request->q . '%');

        if (!empty($request->withRelationships))
            if ($request->withRelationships)
                $query->with(['author', 'section']);

        return response(['data' => OfferResource::collection($query->paginate(20)), 'message' => 'Retrieved successfully'], 200);
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
            'title' => 'required|max:255',
            'published' => 'required|max:1',
            'introduction' => 'required|max:10000',
            'description' => 'required|max:10000',
            'authour_id' => 'required',
            'section_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Please provide a valid input'], 400);
        }

        $data['slug'] = Str::slug($request->title, '-');

        $offer = Offer::create($data);

        return response(['data' => new OfferResource($offer), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        return response(['data' => new OfferResource($offer), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'published' => 'required|max:1',
            'introduction' => 'required|max:10000',
            'description' => 'required|max:10000',
            'authour_id' => 'required',
            'section_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Please provide a valid input'], 400);
        }

        $data['slug'] = Str::slug($request->title, '-');

        $offer->update($data);

        return response(['data' => new OfferResource($offer), 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return response(['message' => 'Deleted']);
    }
}
