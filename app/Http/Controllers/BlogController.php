<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Blog\BlogService;
use App\Http\Requests\Blog\BlogRequest;
use App\Http\Requests\Blog\ImportBlogRequest;
use App\Imports\BlogImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BlogExport;

class BlogController extends Controller
{
    private BlogService $service;

    public function __construct(BlogService $service){
        $this->middleware('permission:view-blog')->only(['index']);
        $this->middleware('permission:create-blog')->only(['create', 'store']);
        $this->middleware('permission:edit-blog')->only(['edit', 'update']);
        $this->middleware('permission:delete-blog')->only('destroy');
        $this->middleware('permission:import-blog')->only('import');
        $this->middleware('permission:export-blog')->only('export');

        $this->service = $service;
    }

    public function index(Request $request){
        $blogs = $this->service->index($request);
        return view('dashboard.blog.index', compact('blogs'));
    }

    public function edit(int $id){
        $blog = $this->service->show($id);
        return view('dashboard.blog.edit', compact('blog'));
    }

    public function create(){
        return view('dashboard.blog.create');
    }

    public function store(BlogRequest $request){
        $this->service->store($request->validated());
        return redirect('/blogs')->with(['success' => __('messages.created')]); 
    }

    public function update(int $id, BlogRequest $request){
        $this->service->update($id, $request->validated());
        return redirect('/blogs')->with(['success' => __('messages.updated')]); 
    }

    public function destroy(int $id){
        $this->service->destroy($id);
        return redirect('/blogs')->with(['success' => __('messages.deleted')]); 
    }

    public function import(ImportBlogRequest $request)
    {
        Excel::Import(new BlogImport, $request->file('file'));

        return back()->with('success', 'Waiting for Blogs importing');
    }

    public function export()
    {
        return Excel::download(new BlogExport, 'blogs.xlsx');
    }
}
