<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Service\ElasticSearchService;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    private $esService;
    public function __construct(ElasticSearchService $esService)
    {
        $this->esService = $esService;
    }


    // Your methods will go here
    public function search(Request $request)
    {
        $query = $request->get('query') ?: '';
        
        $result = House::search($query)
            ->withTrashed()
            ->paginate(10);

        return response()->json($result);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $result = House::create($data);
        return response()->json($result, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $house = House::findOrFail($id);
        $house->update($data);

        return response()->json($house, 200);
    }

    public function destroy($id)
    {
        $house = House::findOrFail($id);
        $result = $house->delete();
        return response()->json($result, 200);
    }
}