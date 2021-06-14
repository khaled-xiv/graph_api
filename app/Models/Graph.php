<?php

namespace App\Models;

use App\Builder\GraphBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graph extends Model implements GraphBuilder
{
    use HasFactory;

    protected $guarded=['id'];

    
    public function setGraphName($name){
        $this->name=$name;
    }
    public function setGraphDescription($description){
        $this->description=$description;

    }
    public function deleteGraph(){
        $this->delete();
    }
    public function addNodeToGraph($node){
        $this->nodes()->save($node);
    }
    public function addRelationToGraph($relation){
        $relation= Relation::firstOrNew(['parent_id'=>$relation->parent_id,'child_id'=>$relation->child_id]);
        $relation->save();
        return $relation->fresh();
    }
    public function updateGraph(){
        $this->nodes()->delete();
        $nbNodes = rand(1, 10);
        Node::factory()->count($nbNodes)->for($this)->create();
        $last_record=Node::orderby('id','desc')->get()->first()->id;
        $min = $last_record - $nbNodes + 1;
        $max = $last_record;

        for ($i = 0; $i < $nbNodes; $i++) {
            Relation::factory()
                ->create(['parent_id' => rand($min, $max), 'child_id' => rand($min, $max)]);
        }
    }

    public function deleteNodefromGraph($node){
        $node->delete();
    }

    public function nodes()
    {
        return $this->hasMany(Node::class);
    }
    
    

}
