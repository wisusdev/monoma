<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Http\Resources\LeadResources;
use App\Models\Lead;
use Symfony\Component\HttpFoundation\JsonResponse;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkUserRole:manager')->only('store');
    }

    public function index(): JsonResponse
    {
        $user = auth()->user();

        if ($user->role === 'manager') {
            $leads = Lead::all();
        } else {
            $leads = Lead::where('owner', $user->id)->get();
        }

        $leadsResource = LeadResources::collection($leads)->resolve();

        return response()->json([
            'meta' => [
                'success' => true,
                'errors' => []
            ],
            'data' => $leadsResource
        ]);
    }

    public function store(LeadRequest $request): JsonResponse
    {
        $data = $request->validated();

        $lead = Lead::create([
            'name' => $data->name,
            'source' => $data->source,
            'owner' => $data->owner,
            'created_by' => $request->user()->id,
        ]);

        return response()->json([
            'meta' => [
                'success' => true,
                'errors' => []
            ],
            'data' => LeadResources::make($lead)->resolve()
        ]);
    }

    public function show(Lead $lead): JsonResponse
    {
        return response()->json([
            'meta' => [
                'success' => true,
                'errors' => []
            ],
            'data' => LeadResources::make($lead)->resolve()
        ]);
    }
}
