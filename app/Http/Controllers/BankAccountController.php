<?php

namespace App\Http\Controllers;

use App\Service\ElasticSearchService;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    private $esService;
    public function __construct(ElasticSearchService $esService)
    {
        $this->esService = $esService;
    }

    // Your methods will go here
    public function search(Request $request)
    {
        $result = $this->esService->search('bank', $request->get('query'));
        return response()->json($result);
    }

    public function getById($id, Request $request)
    {
        $result = $this->esService->getDocument('bank', $id);
        return response()->json($result);
    }

    public function delete($id)
    {
        $result = $this->esService->deleteDocument('bank', $id);
        return response()->json($result);
    }

    public function update($id, Request $request)
    {
        $result = $this->esService->updateDocument('bank', $id, $request->all());
        return response()->json($result);
    }

    public function create(Request $request)
    {
        $result = $this->esService->createDocument('bank', $request->all());
        return response()->json($result);
    }

}