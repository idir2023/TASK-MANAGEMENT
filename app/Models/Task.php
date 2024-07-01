<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    

    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'description', 'assigned_to', 'due_date', 'priority', 'status', 'project_id'];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
