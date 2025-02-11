<?php

namespace App\Http\Controllers;

use App\Http\Requests\CakeRequest;
use App\Interfaces\CakeRepositoryInterface;
use App\Interfaces\CakeUserRepositoryInterface;
use App\Classes\ApiResponseClass as ResponseClass;
use App\Http\Resources\CakeResource;
use Illuminate\Support\Facades\DB;
use App\Models\Cake;
use App\Models\User;
use App\Jobs\SendInterestNotification;

class CakeController extends Controller
{
    private CakeRepositoryInterface $cakeRepositoryInterface;
    private CakeUserRepositoryInterface $cakeUserRepositoryInterface;

    public function __construct(
        CakeRepositoryInterface $cakeRepositoryInterface,
        CakeUserRepositoryInterface $cakeUserRepositoryInterface
    )
    {
        $this->cakeRepositoryInterface = $cakeRepositoryInterface;
        $this->cakeUserRepositoryInterface = $cakeUserRepositoryInterface;
    }

    public function index()
    {
        $data = $this->cakeRepositoryInterface->index();
        return ResponseClass::sendResponse(CakeResource::collection($data), '', 200);
    }

    public function store(CakeRequest $request)
    {
        $fields = [
            'description' => $request->description,
            'weight' => $request->weight,
            'price' => $request->price,
            'qty_avail' => $request->qty_avail,
        ];
        DB::beginTransaction();
        try {
             $cake = $this->cakeRepositoryInterface->store($fields);

             DB::commit();
             return ResponseClass::sendResponse(new CakeResource($cake), 'Item Create Successful', 201);

        } catch(\Exception $ex) {
            return ResponseClass::rollback($ex);
        }
    }

    public function show($id)
    {
        $cake = $this->cakeRepositoryInterface->getById($id);
        return ResponseClass::sendResponse(new CakeResource($cake), '', 200);
    }

    public function update(CakeRequest $request, $id)
    {
        $fields = [
            'description' => $request->description,
            'weight' => $request->weight,
            'price' => $request->price,
            'qty_avail' => $request->qty_avail,
        ];

        $sendMail = false;
        $cake = $this->cakeRepositoryInterface->getById($id);
        if (
            $cake->qty_avail <= 0 &&
            $request->qty_avail > 0
        ) {
            $sendMail = true;
        }

        DB::beginTransaction();
        try {
            $cake = $this->cakeRepositoryInterface->update($fields, $id);
            $interesteds = $this->cakeUserRepositoryInterface->getByCake($id);
            if (
                $sendMail &&
                count($interesteds) > 0
            ) {
                $cake = Cake::find($id);
                foreach($interesteds as $interested) {
                    $user = User::find($interested->user_id);
                    SendInterestNotification::dispatch($user, $cake);
                }
            }

            DB::commit();
            return ResponseClass::sendResponse('Item Update Successful', '', 201);

        } catch(\Exception $ex) {
            return ResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
        $this->cakeRepositoryInterface->delete($id);
        return ResponseClass::sendResponse('Item Delete Successful', '', 204);
    }
}
