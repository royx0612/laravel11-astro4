<?php

namespace App\Http\Controllers\Api;

use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    #[OA\Get(
        path: '/api/user',
        summary: '個人資訊',
        security: ["sanctum" => []],
        responses: [new OA\Response(
            response: 200,
            description: 'Successful response',
            content: new OA\MediaType(
                mediaType: 'application/json',
                schema: new OA\Schema(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'string'
                        )
                    ]
                )
            )
        )]
    )]
    public function user(Request $request)
    {
        return $request->user();
    }
}
