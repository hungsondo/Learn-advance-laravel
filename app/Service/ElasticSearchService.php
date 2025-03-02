<?php

namespace App\Service;

use \Elastic\Elasticsearch\ClientBuilder;

class ElasticSearchService
{
    private $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts(config('elasticsearch.hosts'))
            ->setBasicAuthentication(
                config('elasticsearch.username'),
                config('elasticsearch.password')
            )
            ->build();
    }

    public function indexDocument($index, $id, $body)
    {
        $params = [
            'index' => $index,
            'id'    => $id,
            'body'  => $body
        ];

        return $this->client->index($params);
    }

    public function getDocument($index, $id)
    {
        $params = [
            'index' => $index,
            'id'    => $id,
            // '_source' => ['firstname', 'lastname', 'address']
        ];

        return $this->client->get($params)->asArray();
    }

    public function search($index, $query)
    {
        if  (!$this->checkIndexExist($index)) {
            return response()->json(['message' => 'Index not found'], 404);
        }
        $params = [
            'index' => $index,
            'body'  => [
                'query' => [
                    'bool' => [
                        'must' => [
                            'multi_match' => [
                            'query'  => $query,
                            'fields' => ['firstname', 'lastname', 'address', 'email', 'city', 'state', 'employer'],
                            'fuzziness' => 'AUTO'
                            ]
                        ],
                        // 'should' => [
                        //     ['match' => ['firstname' => $query]],
                        //     ['match' => ['lastname' => $query]],
                        //     ['match' => ['address' => $query]],
                        //     ['match' => ['email' => $query]],
                        //     ['match' => ['city' => $query]],
                        //     ['match' => ['state' => $query]],
                        //     ['match' => ['employer' => $query]]
                        // ],
                        // 'filter' => [
                        //     'range' => [
                        //         'balance' => [
                        //             'gte' => 20000
                        //         ]
                        //     ]
                        // ],
                        
                    ]
                ],
                'highlight' => [
                    'pre_tags' => ['<b>'],
                    'post_tags' => ['</b>'],
                    'fields' => [
                        'firstname' => new \stdClass(),
                        'lastname' => new \stdClass(),
                        'address' => new \stdClass(),
                        'email' => new \stdClass(),
                        'city' => new \stdClass(),
                        'state' => new \stdClass(),
                        'employer' => new \stdClass()
                    ]
                ]
            ]
        ];

        $result = $this->client->search($params);

        return $this->client->search($params)->asArray();
    }

    public function deleteDocument($index, $id)
    {
        if  (!$this->checkIndexExist($index)) {
            return response()->json(['message' => 'Index not found'], 404);
        }

        $params = [
            'index' => $index,
            'id'    => $id
        ];

        return $this->client->delete($params);
    }

    public function checkIndexExist($index)
    {
        $params = [
            'index' => $index
        ];
        $indexExist = $this->client->indices()->exists($params);
        if ($indexExist->getStatusCode() !== 200) {
            return false;
        }

        return true;
    }

    public function updateDocument($index, $id, $body)
    {
        if  (!$this->checkIndexExist($index)) {
            return response()->json(['message' => 'Index not found'], 404);
        }

        $params = [
            'index' => $index,
            'id'    => $id,
            'body'  => [
                'doc' => $body,
            ]
        ];

        // $this->client->index($params); this is for full replace. Which mean if you have 3 fields in your document and you only pass 1 field in the body, the other 2 fields will be removed.
        // $this->client->update($params); this is for partial update. Which mean if you have 3 fields in your document and you only pass 1 field in the body, the other 2 fields will remain.
        return $this->client->update($params);
    }

    public function createDocument($index, $body)
    {
        if  (!$this->checkIndexExist($index)) {
            return response()->json(['message' => 'Index not found'], 404);
        }

        $params = [
            'index' => $index,  // Your index name
            // 'id'    => '1',     // Document ID, if not provided, Elasticsearch will generate one. if id exist, it will replace the document
            'body'  => $body
        ];

        return $this->client->index($params);
    }
}