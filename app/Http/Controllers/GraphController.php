<?php

namespace App\Http\Controllers;

use App\Models\Graph;
use App\Models\Node;
use App\Models\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class GraphController extends Controller
{
    //function to create empty graph
    public function createEmptyGraph()
    {
        $graph = new Graph();
        $graph->save();
        return response()->json($graph->fresh(), 201);
    }

    //update graph metaData
    public function updateMetaData(Request $request, Graph $graph)
    {
        $rules = [
            'name' => 'unique:graphs,name,' . $graph->id,
        ];
        $Validator = Validator::make($request->all(), $rules);
        if ($Validator->fails()) {
            return response()->json([
                'message' => $Validator->errors(),
                'success' => false
            ], 422);
        }
        if ($request->has('name')) $graph->setGraphName($request->name);
        if ($request->has('description')) $graph->setGraphDescription($request->description);
        $graph->save();
        return response()->json($graph->fresh(), 200);
    }

    //delete graph
    public function delete(Graph $graph)
    {
        $graph->deleteGraph();
        return response()->json([
            'message' => 'Item deleted successfully',
            'success' => true
        ], 200);
    }

    //get all graphs
    public function getGraphs()
    {
        $graphs = Graph::select('name', 'description')->get();
        return response()->json($graphs, 200);
    }

    //add node to specific graph
    public function addNodeToGraph(Graph $graph)
    {
        $node = new Node();
        $graph->addNodeToGraph($node);
        return response()->json($node, 201);
    }

    //add relation to graph
    public function addRelationToGraph(Graph $graph, Node $node, Node $child)
    {
        $relation = new Relation();
        $relation->setParent($node->id);
        $relation->setChild($child->id);
        $relation = $graph->addRelationToGraph($relation);
        return response()->json($relation, 201);
    }

    //update graph shape
    public function updateGraphShape(Graph $graph)
    {
        $graph->updateGraph();
        return $this->show($graph);

    }

    //show a single graph
    public function show(Graph $graph)
    {
        $graph = Graph::where('id', $graph->id)->with('nodes.relations')->get();
        return response()->json($graph, 200);
    }

    //delete node from graph
    public function deleteNode(Graph $graph, Node $node)
    {
        $graph->deleteNodefromGraph($node);
        return response()->json([
            'message' => 'Node deleted successfully',
            'success' => true
        ], 200);
    }
}
