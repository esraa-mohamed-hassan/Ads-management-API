<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\api\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::get();
        return response()->json([
            'code' => '200',
            'msg' => 'success',
            'data' => $categories
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
        $category = $request->all();
        $new_category = Categories::create($category);
        return response()->json([
            'code' => '200',
            'msg' => 'Added new category successfully',
            'data' => $new_category
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\api\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\api\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\api\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories, $id)
    {
        if (!empty($categories::find($id))) {
            $category = $request->all();
            $categories->whereId($id)->update($category);
            $after_updated = $categories::find($id);
            return response()->json([
                'code' => '200',
                'msg' => 'Updated category successfully',
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
     * @param  \App\Models\api\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories, $id)
    {
        if (!empty($categories::find($id))) {
            $categories->whereId($id)->delete();
            return response()->json([
                'code' => '200',
                'msg' => 'Deleted category successfully',
            ]);
        } else {
            return response()->json([
                'code' => '203',
                'msg' => 'No Data to delete for this ID:' . $id,
            ]);
        }
    }
}
