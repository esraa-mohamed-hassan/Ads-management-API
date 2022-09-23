<?php

namespace App\Http\Controllers\api;

use App\Models\api\Advertisers;
use App\Http\Requests\AdvertisersStoreRequest;
use App\Http\Requests\AdvertisersUpdateRequest;
use App\Http\Controllers\API\BaseController as BaseController;

class AdvertisersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $advertisers = Advertisers::get();
            return $this->sendResponse($advertisers, 'All Advertisers.');
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
     * @param  \App\Http\Requests\AdvertisersStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisersStoreRequest $request)
    {
        try {
            $validator = $request->validated();

            $advertiser = $request->all();
            $new_advertiser = Advertisers::create($advertiser);

            return $this->sendResponse($new_advertiser, 'Added new advertiser successfully.');
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\api\Advertisers  $advertisers
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisers $advertisers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\api\Advertisers  $advertisers
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisers $advertisers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AdvertisersStoreRequest  $request
     * @param  \App\Models\api\Advertisers  $advertisers
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisersUpdateRequest $request, Advertisers $advertisers, $id)
    {
        try {

            if (!empty($advertisers::find($id))) {
                $validator = $request->validated();
                $advertiser = $request->all();
                $advertisers->whereId($id)->update($advertiser);
                $after_updated = $advertisers::find($id);
                return $this->sendResponse($after_updated, 'Updated advertiser successfully.');
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
     * @param  \App\Models\api\Advertisers  $advertisers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisers $advertisers, $id)
    {
        try {
            if (!empty($advertisers::find($id))) {
                $advertisers->whereId($id)->delete();
                return response()->json([
                    'code' => '200',
                    'msg' => 'Deleted category successfully',
                ]);
            } else {
                return $this->sendError('No Data to delete for this ID:' . $id);
            }
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
        }
    }
}
