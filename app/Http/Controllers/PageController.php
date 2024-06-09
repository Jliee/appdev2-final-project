<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Database\Factories\PageFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PageResource;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Page::all();
        return PageResource::collection(
            Page::where('notebook_id', Auth::user()->id)->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json('Added a new page!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json('Specifically showing this page'); 
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json('Edited this page'); 
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json('page wasak'); 
        
    }
}
