<?php

namespace App\Exports;

use App\Models\Blog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\DB;

class BlogExport implements FromCollection, WithHeadings, WithTitle
{
    /**
     * Return the data collection that you want to export.
     */
    public function collection()
    {
        return DB::table('blogs')
        ->join('users', 'blogs.author_id', '=', 'users.id') // Join `blogs` and `users` on `author_id`
        ->select('blogs.title', 'blogs.content', 'blogs.slug', 'users.name as author_name', 'blogs.created_at', 'blogs.updated_at')
        ->get();
    }

    /**
     * Define the headings for the exported file.
     */
    public function headings(): array
    {
        return [
            'Title', 
            'Content', 
            'Slug', 
            'Author Name', 
            'Created At'
        ];
    }

    /**
     * Define the title for the sheet.
     */
    public function title(): string
    {
        return 'Blogs';
    }
}