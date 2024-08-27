<?php

namespace App\Http\Controllers;

use App\Models\ImageStore;
use App\Http\Requests\StoreImageStoreRequest;
use App\Http\Requests\UpdateImageStoreRequest;

class ImageStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ImageStore $imageStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImageStore $imageStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageStoreRequest $request, ImageStore $imageStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageStore $imageStore)
    {
        //
    }
}
