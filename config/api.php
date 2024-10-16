<?php

return [
  'elastisearch' => [
    'host' => env('ELASTICSEARCH_HOST', 'localhost'),
    'port' => env('ELASTICSEARCH_PORT', 9200),
    'username'   => env('ELASTICSEARCH_USERNAME'),
    'password'    => env('ELASTICSEARCH_PASSWORD')
  ]
];

?>