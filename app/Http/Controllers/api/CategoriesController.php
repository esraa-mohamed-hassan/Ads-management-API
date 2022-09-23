<?php

namespace App\Http\Controllers\api;

use App\Models\api\Categories;
use App\Http\Requests\CategoriesStoreRequest;
use App\Http\Controllers\API\BaseController as BaseController;

class CategoriesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = Categories::get();
            return $this->sendResponse($categories, 'All Categories');
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
        }
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
     * @param  \App\Http\Requests\CategoriesStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesStoreRequest $request)
    {
        try {
            $validator = $request->validated();

            $category = $request->all();
            $new_category = Categories::create($category);
            return $this->sendResponse($new_category, 'Added new category successfully.');
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
        }
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
     * @param  \App\Http\Requests\CategoriesStoreRequest  $request
     * @param  \App\Models\api\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesStoreRequest $request, Categories $categories, $id)
    {
        try {
            if (!empty($categories::find($id))) {
                $validator = $request->validated();
                $category = $request->all();
                $categories->whereId($id)->update($category);
                $after_updated = $categories::find($id);
                return $this->sendResponse($after_updated, 'Updated category successfully.');
            } else {
                return $this->sendError('No Data to update for this ID:' . $id);
            }
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
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
        try {
            if (!empty($categories::find($id))) {
                $categories->whereId($id)->delete();
                return $this->sendResponse([], 'Deleted category successfully.');
            } else {
                return $this->sendError('No Data to delete for this ID:' . $id);
            }
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
        }
    }
}
