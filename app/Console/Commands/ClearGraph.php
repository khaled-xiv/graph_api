<?php

namespace App\Console\Commands;

use App\Models\Graph;
use Illuminate\Console\Command;

class ClearGraph extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graph:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear empty graph';

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
        Graph::doesnthave('nodes')->each(function ($graph, $key) {
            $graph->delete();
        });
        return 0;
    }
}
