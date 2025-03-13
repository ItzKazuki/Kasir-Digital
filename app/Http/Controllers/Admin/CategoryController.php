<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Categories";
        $categories = Category::paginate(10);
        return view('dashboard.categories.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Categories";
        return view('dashboard.categories.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'string'
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah ada.',
            'description.string' => 'Deskripsi harus berupa teks.'
        ]);

        Category::create($request->all());

        Sweetalert::success('berhasil menabah kategori baru', 'Tambah Kategori Berhasil!');
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $title = "Edit Categories";
        return view('dashboard.categories.edit', compact('title', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'description' => 'string'
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah ada.',
            'description.string' => 'Deskripsi harus berupa teks.'
        ]);

        $category->update($request->all());

        Sweetalert::success('berhasil mengubah kategori baru', 'Ubah Kategori Berhasil!');
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        Sweetalert::success('berhasil menghapus kategori ' . $category->name, 'Hapus Berhasil');
        return redirect()->route('dashboard.categories.index');
    }
}
