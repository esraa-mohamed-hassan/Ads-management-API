<?php

namespace App\Http\Controllers\api;

use App\Models\api\Tags;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tags::get();
        return response()->json([
            'code' => '200',
            'msg' => 'success',
            'data' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = $request->all();
        $new_tag = Tags::create($tag);
        return response()->json([
            'code' => '200',
            'msg' => 'Added new Tag successfully',
            'data' => $new_tag
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\api\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function show(Tags $tags)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\api\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function edit(Tags $tags)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\api\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tags $tags, $id)
    {
        if (!empty($tags::find($id))) {
            $name = $request->input('name');
            $tags->whereId($id)->update(['name' => $name]);
            $after_updated = $tags::find($id);
            return response()->json([
                'code' => '200',
                'msg' => 'Updated Tag successfully',
                'data' => $after_updated
            ]);
        } else {
            return response()->json([
                'code' => '203',
                'msg' => 'No Data to update for this ID:' . $id,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\api\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tags $tags, $id)
    {
        if (!empty($tags::find($id))) {
            $tags->whereId($id)->delete();
            return response()->json([
                'code' => '200',
                'msg' => 'Deleted Tag successfully',
            ]);
        } else {
            return response()->json([
                'code' => '203',
                'msg' => 'No Data to delete for this ID:' . $id,
            ]);
        }
    }
}
