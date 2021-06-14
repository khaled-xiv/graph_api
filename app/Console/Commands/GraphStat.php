<?php

namespace App\Console\Commands;

use App\Models\Graph;
use Exception;
use Illuminate\Console\Command;

class GraphStat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graph:stats {--gid=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display graph stats';

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
        $gid = $this->option('gid');
        try {
            $graph = Graph::findOrFail($gid);

            $nodeCount = $graph->nodes->count();
            $relationCount = $graph->nodes->reduce(function ($count, $node) {
                return $count + $node->relations->count();
            }, 0);

            $data = array(
                $graph->name,
                $graph->description,
                $nodeCount,
                $relationCount
            );


            $this->table(
                ['Name', 'Description', 'Node Count', 'Relation Count'],
                [
                    $data
                ]
            );
        } catch (Exception $e) {
            $this->error('Graph not found');
        }
        return 0;
    }
}
