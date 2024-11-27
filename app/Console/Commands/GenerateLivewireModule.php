<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class GenerateLivewireModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:livewire-module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Livewire module with model, migration, Livewire components, and basic CRUD setup';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $this->info("Generating Livewire Module: $name");

        // Step 1: Create Model and Migration
        $this->info('Creating Model and Migration...');
        Artisan::call("make:model $name -m");
        $this->info(Artisan::output());

        // Step 2: Create Livewire Components (Form and Table)
        $this->info('Creating Livewire Components...');
        Artisan::call("make:livewire {$name}Form");
        $this->info(Artisan::output());
        Artisan::call("make:livewire {$name}Table");
        $this->info(Artisan::output());

        // Step 3: Create Controller for API or web routes if necessary
        $this->info('Creating Controller...');
        Artisan::call("make:controller {$name}Controller");
        $this->info(Artisan::output());

        // Step 4: Add basic routes to web.php
        $this->info('Adding routes to web.php...');
        $routePath = base_path('routes/web.php');
        $routeDefinition = "\n// Routes for $name Module\n";
        $routeDefinition .= "Route::get('/$name', App\\Http\\Livewire\\{$name}Table::class)->name('$name.index');\n";
        $routeDefinition .= "Route::get('/$name/create', App\\Http\\Livewire\\{$name}Form::class)->name('$name.create');\n";
        File::append($routePath, $routeDefinition);

        $this->info("Routes for $name module added successfully!");

        // Step 5: Provide a message that the module was successfully created
        $this->info("Livewire Module $name generated successfully!");

        return Command::SUCCESS;
    }
}
