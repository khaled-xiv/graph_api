<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function graph()
    {
        return $this->belongsTo(Graph::class);
    }
    
    public function relations()
    {
        return $this->hasMany(Relation::class,'parent_id');
    }
    
    public function parentRelations()
    {
        return $this->hasMany(Relation::class,'parent_id');
    }
    
    public function childRelations()
    {
        return $this->hasMany(Relation::class,'child_id');
    }

    
}
