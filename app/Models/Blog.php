<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageHandler;

class Blog extends Model
{
    use HasFactory, ImageHandler;

    protected $fillable = ['title', 'slug', 'content', 'image', 'author_id'];

    public function author(){
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->image = $model->setFile($model->image, 'uploads/blogs');
        });
        static::updating(function ($model) {
            $model->image = $model->setFile($model->image, 'uploads/blogs');
        });
    }

    public function getImagePathAttribute(){
        return $this->getFile($this->attributes['image']);
    }
}
