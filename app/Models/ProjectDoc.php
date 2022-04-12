<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDoc extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'project_docs';
    protected $fillable = [
        'project_id',
        'title',
        'name'
    ];
}
