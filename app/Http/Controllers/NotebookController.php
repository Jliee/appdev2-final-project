<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotebookRequest;
use App\Http\Resources\ThisNotebookResource;
use App\Models\Notebook;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\NotebookResource;

class NotebookController extends Controller
{
    use HttpResponses;

    public function index()
    {

        $notebooks = Notebook::where('user_id', Auth::id())->get();

        return NotebookResource::collection($notebooks);
    }

    public function store(StoreNotebookRequest $request)
    {
        $request->validated($request->all());

        $notebook = Notebook::create([
            'user_id' => Auth::user()->id, 
            'title' => $request->title
        ]);

        return new NotebookResource($notebook);
    }

    public function show(Notebook $notebook)
    {
        // Ensure the authenticated user owns the notebook
        if (Auth::id() !== $notebook->user_id) {
            return response()->json(['error' => 'You are not authorized to view this notebook'], 403);
        }

        $notebook->load('pages'); // Load the related pages

        return new ThisNotebookResource($notebook);
    }

    public function update(Request $request, Notebook $notebook)
    {
        if (Auth::user()->id !== $notebook->user_id){
            return $this->error('', 'You are not authorized to view this notebook', 403);
        }

        $notebook->update($request->all());
        
        
        return new NotebookResource($notebook);
        
    }

    public function destroy(Notebook $notebook)
    {
        if (Auth::user()->id !== $notebook->user_id){
            return $this->error('', 'You are not authorized to delete this notebook', 403);
        }

        $notebook->delete(); 
       
        return $this->success(null, 'Notebook deleted successfully', 200);
        
    }
}
