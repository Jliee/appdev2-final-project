<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Database\Factories\PageFactory;
use App\Http\Resources\PageResource;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    public function index()
    {
        // Fetch all notebook IDs that belong to the authenticated user
        $notebookIds = Notebook::where('user_id', Auth::id())->pluck('id');

        // Fetch all pages that belong to these notebook IDs
        $pages = Page::whereIn('notebook_id', $notebookIds)->get();

        return PageResource::collection($pages);
    }

    public function store(Request $request, Notebook $notebook)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if (Auth::user()->id !== $notebook->user_id) {
            return response()->json(
                ['error' => 'You are not authorized to add a page to this notebook'],
                 403);
        }

        $page = Page::create([
            'notebook_id' => $notebook->id,
            'notebook_title' => $notebook->title,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return new PageResource($page);
    }

      // Show a specific page
      public function show(Notebook $notebook, Page $page)
      {
          // Ensure the authenticated user owns the notebook
          if (Auth::id() !== $notebook->user_id) {
              return response()->json(
                ['error' => 'You are not authorized to view this page'], 403);
          }
  
          // Ensure the page belongs to the specified notebook
          if ($page->notebook_id !== $notebook->id) {
              return response()->json(
                ['error' => 'This page does not belong to the specified notebook'], 404);
          }
  
          return new PageResource($page);
      }
        

    // Update a specific page
    public function update(Request $request, Notebook $notebook, Page $page)
    {
        // Ensure the authenticated user owns the notebook
        if (Auth::id() !== $notebook->user_id) {
            return response()->json(
                ['error' => 'You are not authorized to update this page'], 403);
        }

        // Ensure the page belongs to the specified notebook
        if ($page->notebook_id !== $notebook->id) {
            return response()->json(
                ['error' => 'This page does not belong to the specified notebook'], 404);
        }

        $page->update($request->all());


        return new PageResource($page);
    }

    // Delete a specific page
    public function destroy(Notebook $notebook, Page $page)
    {
        // Ensure the authenticated user owns the notebook
        if (Auth::id() !== $notebook->user_id) {
            return response()->json(
                ['error' => 'You are not authorized to delete this page'], 403);
        }

        // Ensure the page belongs to the specified notebook
        if ($page->notebook_id !== $notebook->id) {
            return response()->json(
                ['error' => 'This page does not belong to the specified notebook'], 404);
        }

        // Delete the page
        $page->delete();

        return response()->json(
            ['message' => 'Page deleted successfully'], 200);
    }

}
