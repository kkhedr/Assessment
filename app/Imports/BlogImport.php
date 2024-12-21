<?php
namespace App\Imports;

use App\Models\Blog;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; 

class BlogImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Process each chunk of data.
     */
    public function collection(Collection $rows)
    {
        try{
            // Prepare an array of data for batch insertion
        $data = [];

        foreach ($rows as $index => $row) {
            if (!$row['title'] || !$row['content'] || !$row['slug'] || !$row['image'] || !$row['author_id']) {
                Log::error('Blog row skipped', [
                    'error' => 'invalid data',
                ]);
                continue;
            }
           
            $data = [
                'title' => $row['title'],
                'content' => $row['content'],
                'slug' => $row['slug'],
                'image' => $row['image'],
                'author_id' => $row['author_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            Blog::create($data);
            Log::info("Blog row imported", [
                'message' => "blog num {$index} was created",
            ]);
        }
        
        }catch(\Exception $exception){
            Log::error('Blog import failed', [
                'error' => $exception->getMessage(),
                'stack' => $exception->getTraceAsString(),
            ]);
        }
    }

    /**
     * Define the chunk size for reading.
     */
    public function chunkSize(): int
    {
        return 100;
    }
}