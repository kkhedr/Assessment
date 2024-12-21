<?php
namespace App\Repository\Blog;

interface BlogRepositoryInterface{
    public function index(array $request);
    public function show(int $id);
    public function store(array $data);
    public function update(int $id, array $data);
    public function destroy(int $id);
}