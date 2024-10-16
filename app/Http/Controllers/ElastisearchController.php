<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elastica\Client;
use Elastica\Query\MatchQuery;
use Elastica\Index;

class ElastisearchController extends Controller
{
    protected $elasticaClient;

    public function __construct(Client $client)
    {
        $this->elasticaClient = $client;
    }


    public function createIndex(Request $request)
    {
        $indexName = $request->input('index_name');

        if (!$indexName) {
            return response()->json(['error' => 'Index name is required'], 400);
        }
        // dd($this->elasticaClient->getStatus());
        // Create index
        $index = new Index($this->elasticaClient, $indexName);

        try {
            $index->create(['settings' => ['number_of_shards' => 1]]);
            return response()->json(['message' => "Index '{$indexName}' created successfully"], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create index: ' . $e->getMessage()], 500);
        }
    }


    public function index(Request $request)
    {
        $index = $this->elasticaClient->getIndex('posts');

        dd($index);

        $query = new MatchQuery();
        $query->setField('title', $request->input('search'));  // MatchQuery expects `setField`

        $resultSet = $index->search($query);

        $results = $resultSet->getResults();

        return response()->json($results);
    }
}
