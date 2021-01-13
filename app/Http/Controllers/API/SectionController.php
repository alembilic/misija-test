<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Section::query();

        if (!empty($request->withSectionCount))
            if ($request->withSectionCount)
                $query->withCount('offers');

        return response(['data' => SectionResource::collection($query->paginate(20)), 'message' => 'Retrieved successfully'], 200);
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
            'name' => 'required|max:255',
            'published' => 'required',
            'is_on_front' => 'required',
            'order' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Please provide a valid input'], 400);
        }

        $data['slug'] = Str::slug($request->title, '-');

        $section = Section::create($data);

        return response(['data' => new SectionResource($section), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section, Request $request)
    {
        if (!empty($request->withRelationsips))
            if ($request->withRelationsips)
                $section = Section::where('id', $section->id)->with('offers.author')->get();

        return response(['data' => new SectionResource($section), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'published' => 'required',
            'is_on_front' => 'required',
            'order' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Please provide a valid input'], 400);
        }

        $data['slug'] = Str::slug($request->title, '-');

        $section->update($data);

        return response(['data' => new SectionResource($section), 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return response(['message' => 'Deleted']);
    }
}
