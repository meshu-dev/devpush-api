<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Actions\{WpCategoryImportAction, WpPostImportAction};

class WpImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wp:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import wp data to RequireDev API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (app()->make(WpCategoryImportAction::class))->execute();
        (app()->make(WpPostImportAction::class))->execute();
    }
}
