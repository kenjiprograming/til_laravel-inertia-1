<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        return Inertia::render('News/Index', [
            'news' => $news,
        ]);
    }

    public function create()
    {
        return Inertia::render('News/Create', []);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required'],
            'body' => ['required'],
        ]);

        if ($image = $request->file('image')) {
            $validated['image'] = $image->store('upload');
        }

        News::create($validated);

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return Inertia::render('News/Show', [
            'news' => $news,
        ]);
    }

    public function edit(News $news)
    {
        return Inertia::render('News/Edit', [
            'news' => $news,
        ]);
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' =>'required',
            'body' => 'required',
            'registerd_image' => 'nullable'
        ]);

        // 以下追加
        if ($image = $request->file('image')) {
            $validated['image'] = $image->store('upload');

            if (!empty($validated['registerd_image'])) {
                unlink(storage_path('app/'). $validated['registerd_image']);
            }
        }
        unset($validated['registerd_image']);

        $news->update($validated);

        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')->with('message', 'News Deleted Successfully');
    }
}
