<?php

namespace App\Http\Controllers\api;

use App\Models\api\Tags;
use App\Http\Requests\TagsStoreRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use Exception;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class TagsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tags = Tags::get();
            return $this->sendResponse($tags, 'All Tags.');
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
     * @param  \App\Http\Requests\TagsStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagsStoreRequest $request)
    {
        try {
            $validator = $request->validated();
            $tag = $request->all();
            $new_tag = Tags::create($tag);
            return $this->sendResponse($new_tag, 'Added new Tag successfully.');
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
        }
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
     * @param  \App\Http\Requests\TagsStoreRequest  $request
     * @param  \App\Models\api\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function update(TagsStoreRequest $request, Tags $tags, $id)
    {
        try {
            if (!empty($tags::find($id))) {
                $validator = $request->validated();
                $name = $request->input('name');
                $tags->whereId($id)->update(['name' => $name]);
                $after_updated = $tags::find($id);
                return $this->sendResponse($after_updated, 'Updated Tag successfully.');
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
     * @param  \App\Models\api\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tags $tags, $id)
    {
        try {
            if (!empty($tags::find($id))) {
                $tags->whereId($id)->delete();
                return $this->sendResponse([], 'Deleted Tag successfully.');
            } else {
                return $this->sendError('No Data to delete for this ID:' . $id);
            }
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
        }
    }
}
