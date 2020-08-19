<?php

namespace App\API\Definition;

class Base
{
    public $name;

    public $version;

    public $description;

    public $endpoint;

    public $db_prefix;

    public $authentication;

    public $events;

    /**
     * @var Endpoint[]
     */
    public $api;

    public $throttle;

    public $rate_limit;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if ($key === 'api') {
                    $apis = [];
                    foreach ($value as $field => $v) {
                        $apis[$v['name']] = new Endpoint($v);
                    }
                    $value = $apis;
                }

                $this->$key = $value;
            }
        }
    }
}
