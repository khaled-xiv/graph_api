<?php

namespace App\Console\Commands;

use App\Models\Graph;
use App\Models\Node;
use App\Models\Relation;
use Illuminate\Console\Command;

class GenerateGraph extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graph:gen  {--nbNodes=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command create an empty graph with nbNodes nodes and relations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $nbNodes = $this->option('nbNodes');
        Graph::factory()->has(Node::factory()->count($nbNodes), 'nodes')->create();
        
        $last_record=Node::orderby('id','desc')->get()->first()->id;
        $min = $last_record - $nbNodes + 1;
        $max = $last_record;

        for ($i=0; $i < $nbNodes; $i++) { 
            Relation::factory()
            ->create( ['parent_id' => rand($min, $max), 'child_id' => rand($min, $max)]);
        }
        
        return 0;
    }
}
