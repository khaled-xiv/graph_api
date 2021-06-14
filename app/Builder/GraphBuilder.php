<?php
namespace App\Builder;


interface GraphBuilder{

    public function setGraphName($name);
    public function setGraphDescription($description);
    public function deleteGraph();
    public function addNodeToGraph($node);
    public function addRelationToGraph($relation);
    public function updateGraph();
    public function deleteNodefromGraph($node);

}