<?php
namespace App\Services\Blog;

use App\Repository\Blog\BlogRepositoryInterface;
use Illuminate\Http\Request;

class BlogService{

    private BlogRepositoryInterface $repo;

    public function __construct(BlogRepositoryInterface $repo){
        $this->repo = $repo;
    }

    public function index(Request $request){
        return $this->repo->index($request->all());
    }

    public function show(int $id){
        return $this->repo->show($id);
    }

    public function store(array $data){

        return $this->repo->store($data);
    }

    public function update(int $id, array $data){
        return $this->repo->update($id, $data);
    }

    public function destroy(int $id){
        return $this->repo->destroy($id);
    }

}