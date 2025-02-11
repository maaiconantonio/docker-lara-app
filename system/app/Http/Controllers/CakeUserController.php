<?php

namespace App\Http\Controllers;

use App\Http\Requests\CakeUserRequest;
use App\Interfaces\CakeUserRepositoryInterface;
use App\Classes\ApiResponseClass as ResponseClass;
use App\Http\Resources\CakeUserResource;
use Illuminate\Support\Facades\DB;

class CakeUserController extends Controller
{
    private CakeUserRepositoryInterface $cakeUserRepositoryInterface;

    public function __construct(CakeUserRepositoryInterface $cakeUserRepositoryInterface)
    {
        $this->cakeUserRepositoryInterface = $cakeUserRepositoryInterface;
    }

    public function index()
    {
        $data = $this->cakeUserRepositoryInterface->index();
        return ResponseClass::sendResponse(CakeUserResource::collection($data), '', 200);
    }

    public function store(CakeUserRequest $request)
    {
        if (!$this->cakeUserRepositoryInterface->verifyCakeUser($request->user_id, $request->cake_id)) {
            return ResponseClass::sendResponse('User or Item not Found', '', 404);
        }
        if ($this->cakeUserRepositoryInterface->getCakeUser($request->user_id, $request->cake_id)) {
            return ResponseClass::sendResponse('User Already Interested in the Cake', '', 404);
        }
        $fields = [
            'user_id' => $request->user_id,
            'cake_id' => $request->cake_id,
        ];
        DB::beginTransaction();
        try {
            $cakeUser = $this->cakeUserRepositoryInterface->store($fields);
            DB::commit();
            return ResponseClass::sendResponse(new CakeUserResource($cakeUser), 'Interest Save Successful', 201);
        } catch(\Exception $ex) {
            return ResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
        $this->cakeUserRepositoryInterface->delete($id);
        return ResponseClass::sendResponse('Interest Remove Successful', '', 204);
    }
}
