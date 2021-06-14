<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function parent()
    {
        return $this->belongsTo(Node::class,'parent_id');
    }
    
    public function child()
    {
        return $this->belongsTo(Node::class,'child_id');
    }

    public function setParent($parent)
    {
        $this->parent_id=$parent;
    }

    public function setChild($child)
    {
        $this->child_id=$child;
    }
}
