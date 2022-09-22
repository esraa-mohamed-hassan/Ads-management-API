<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\api\Advertisers;
use Illuminate\Http\Request;

class AdvertisersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisers = Advertisers::get();
        return response()->json([
            'code' => '200',
            'msg' => 'success',
            'data' => $advertisers
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
        $advertiser = $request->all();
        $new_advertiser = Advertisers::create($advertiser);
        return response()->json([
            'code' => '200',
            'msg' => 'Added new advertiser successfully',
            'data' => $new_advertiser
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\api\Advertisers  $advertisers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisers $advertisers, $id)
    {
        if (!empty($advertisers::find($id))) {
        $advertiser = $request->all();
        $advertisers->whereId($id)->update($advertiser);
        $after_updated = $advertisers::find($id);
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
     * @param  \App\Models\api\Advertisers  $advertisers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisers $advertisers , $id)
    {
        if (!empty($advertisers::find($id))) {
            $advertisers->whereId($id)->delete();
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
