<?php
namespace App\Repository\Blog;
use App\Models\Blog;
use App\Helper\Helper;
use Illuminate\Support\Facades\Storage;


class BlogRepository implements BlogRepositoryInterface{

    private Blog $blog;

    public function __construct(Blog $blog){
        $this->blog = $blog;
    }

    public function index(array $request){
         $model = $this->blog;
         $user = auth()->user();
         if($user->hasRole('author')){
            $model = $model->where('author_id', $user->id);
         }
         return $model->paginate(isset($request['per_page']) ? $request['per_page']  : Helper::PAGINATE);
    }

    public function checkOwnerBlog(Blog $blog){
        $user = auth()->user();
        return $blog->author_id == $user->id;
    }

    public function show(int $id){
        $blog = $this->blog->findOrFail($id);
        $status = $this->checkOwnerBlog($blog);
        if(!$status){
            abort(404, 'Blog not found or you do not have permission to access it.');
        }

        return $blog;
    }

    public function store(array $data){
        $data['author_id'] = auth()->user()->id;
        return $this->blog->create($data);
    }

    public function update(int $id, array $data){
        $blog =  $this->blog->findOrFail($id);
        $status = $this->checkOwnerBlog($blog);
        if(!$status){
            abort(404, 'Blog not found or you do not have permission to access it.');
        }

        $path = 'uploads/blogs/';
        
        if(isset($data['image']) && Storage::exists($blog->image)){
            Storage::delete($blog->image);
        }
        $blog->update($data);
        return $blog->fresh();
    }

    public function destroy(int $id){
       $blog = $this->blog->findOrFail($id);
       $status = $this->checkOwnerBlog($blog);
        if(!$status){
            abort(404, 'Blog not found or you do not have permission to access it.');
        }
       $blog->delete();
    }
}