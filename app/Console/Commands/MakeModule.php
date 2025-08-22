<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Create Model, Controller, Interface and Repository in one command';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $modelName = $name;
        $controllerName = $name . 'Controller';
        $interfaceName = $name . 'RepositoryInterface';
        $repositoryName = $name . 'Repository';

        // 1. Make Model
        Artisan::call("make:model {$modelName} -m");
        $this->info("Model created: {$modelName}");

        // 2. Make Controller
        Artisan::call("make:controller {$controllerName} --resource --model={$modelName}");
        $this->info("Controller created: {$controllerName}");

        // 3. Create Interface folder if not exist
        if (!File::exists(app_path('Interfaces'))) {
            File::makeDirectory(app_path('Interfaces'), 0755, true);
        }

        // 4. Create Repository folder if not exist
        if (!File::exists(app_path('Repositories'))) {
            File::makeDirectory(app_path('Repositories'), 0755, true);
        }

        // 5. Create Interface
        $interfacePath = app_path("Interfaces/{$interfaceName}.php");
        $interfaceContent = "<?php

namespace App\Interfaces;

interface {$interfaceName}
{
    public function all();
    public function find(\$id);
    public function create(array \$data);
    public function update(\$id, array \$data);
    public function delete(\$id);
}
";
        File::put($interfacePath, $interfaceContent);
        $this->info("Interface created: {$interfaceName}");

        // 6. Create Repository
        $repositoryPath = app_path("Repositories/{$repositoryName}.php");
        $repositoryContent = "<?php

namespace App\Repositories;

use App\Interfaces\\{$interfaceName};
use App\Models\\{$modelName};

class {$repositoryName} implements {$interfaceName}
{
    public function all()
    {
        return {$modelName}::all();
    }

    public function find(\$id)
    {
        return {$modelName}::findOrFail(\$id);
    }

    public function create(array \$data)
    {
        return {$modelName}::create(\$data);
    }

    public function update(\$id, array \$data)
    {
        \$model = {$modelName}::findOrFail(\$id);
        \$model->update(\$data);
        return \$model;
    }

    public function delete(\$id)
    {
        return {$modelName}::destroy(\$id);
    }
}
";
        File::put($repositoryPath, $repositoryContent);
        $this->info("Repository created: {$repositoryName}");

        $this->info("✅ Module {$name} created successfully!");
    }
}
