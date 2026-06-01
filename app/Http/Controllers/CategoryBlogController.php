<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use App\Http\Requests\CategoryBlogRequest;
use Illuminate\Http\Request;

class CategoryBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CategoryBlog::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('slug', 'like', '%' . $search . '%');
                
                // Smart status mapping for Indonesian search keywords
                $lowerSearch = strtolower($search);
                if (str_contains($lowerSearch, 'tidak') || str_contains($lowerSearch, 'non') || str_contains($lowerSearch, 'inactive')) {
                    $q->orWhere('status', 'inactive');
                } elseif (str_contains($lowerSearch, 'aktif') || str_contains($lowerSearch, 'active')) {
                    $q->orWhere('status', 'active');
                }
            });
        }
        $categories = $query->paginate(5)->withQueryString();
        return view('pages.admin.kategori-blog.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.kategori-blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryBlogRequest $request)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        CategoryBlog::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        CategoryBlog::create($request->validated());

        return redirect()
            ->route('admin.kategori-blog.index')
            ->with('success', 'Kategori blog baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = CategoryBlog::findOrFail($id);
        return view('pages.admin.kategori-blog.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryBlogRequest $request, $id)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        CategoryBlog::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $category = CategoryBlog::findOrFail($id);
        $category->update($request->validated());

        return redirect()
            ->route('admin.kategori-blog.index')
            ->with('success', 'Kategori blog berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = CategoryBlog::findOrFail($id);
        return view('pages.admin.kategori-blog.show', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = CategoryBlog::findOrFail($id);
        
        // Prevent deleting category if it has active blog posts linked to it
        if ($category->blogs()->count() > 0) {
            return redirect()
                ->route('admin.kategori-blog.index')
                ->with('error', 'Kategori ini tidak dapat dihapus karena memiliki blog yang terhubung.');
        }

        $category->delete();

        return redirect()
            ->route('admin.kategori-blog.index')
            ->with('success', 'Kategori blog berhasil dihapus.');
    }
}
