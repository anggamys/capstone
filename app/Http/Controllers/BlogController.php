<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CategoryBlog;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blog::with(['category', 'admin']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('slug', 'like', '%' . $search . '%')
                  ->orWhereHas('category', function($catQuery) use ($search) {
                      $catQuery->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('admin', function($adminQuery) use ($search) {
                      $adminQuery->where('name', 'like', '%' . $search . '%');
                  });

                // Smart status mapping for Indonesian search keywords
                $lowerSearch = strtolower($search);
                if (str_contains($lowerSearch, 'tidak') || str_contains($lowerSearch, 'non') || str_contains($lowerSearch, 'draft')) {
                    $q->orWhere('status', 'draft');
                } elseif (str_contains($lowerSearch, 'publikasi') || str_contains($lowerSearch, 'terbit') || str_contains($lowerSearch, 'published')) {
                    $q->orWhere('status', 'published');
                }
            });
        }

        $blogs = $query->latest()->paginate(5)->withQueryString();
        return view('pages.admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryBlog::where('status', 'active')->orderBy('name')->get();
        return view('pages.admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        Blog::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $data = $request->validated();
        
        // Assign the currently authenticated admin/user
        $data['admin_id'] = Auth::id() ?? 1; // Fallback to 1 if not authenticated (should be authenticated by middleware)

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }

        Blog::create($data);

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = CategoryBlog::where('status', 'active')->orderBy('name')->get();
        return view('pages.admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, $id)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        Blog::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $blog = Blog::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = $blog->published_at ?? now();
        } else {
            $data['published_at'] = null;
        }

        $blog->update($data);

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::with(['category', 'admin'])->findOrFail($id);
        return view('pages.admin.blog.show', compact('blog'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog berhasil dihapus.');
    }
}
