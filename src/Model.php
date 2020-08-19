<?php

namespace App\API;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Model
{
    public $definition;

    /**
     * Model constructor.
     *
     * @param $definition
     */
    public function __construct($definition)
    {
        $this->definition = $definition;
    }

    public function createModel(array $definition)
    {
        $stub = File::get(app_path('API/stubs/Model.stub'));

        $fields = '';
        foreach ($definition['fields'] as $key => $item) {
            $tab = '    ';
            $def = $tab .'/**' . PHP_EOL;
            $def .= $tab . ' * @var ' . $item . PHP_EOL;
            $def .= $tab . ' */' . PHP_EOL;
            $def .= $tab . 'public $' . $key . ';' . PHP_EOL . PHP_EOL;

            $fields .= $def;
        }

        $stub = str_replace(
            array(
                'DummyClass',
                "dummyNamespace;\n",
                "dummyMethods"
            ),
            [
                ucfirst(Str::camel($definition['name'])),
                ''
            ],
            $stub
        );

        $class = str_replace('dummyProperties', $fields, $stub);

        dd($class);
    }
}
