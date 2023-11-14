<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\addUserInfoRequest;
use App\Http\Requests\admin\courseUploadRequest;
use App\Http\Requests\admin\getwayInformationRequest;
use App\Http\Requests\admin\resultUploadRequest;
use App\Http\Requests\admin\searchResultRequest;
use App\Http\Requests\admin\searchUserRequest;
use App\Http\Requests\admin\updateUserInfoRequest;
use App\Http\Requests\admin\uploadVideoRequest;
use App\Http\Requests\payment\searchPaymentRequest;
use App\Http\Requests\student\courseEnrollRequest;
use App\Http\Requests\student\postCommentRequest;
use App\Http\Requests\teacher\courseRequest;
use App\Http\Services\admin\adminService;
use App\Http\Services\ApplicationService;
use App\Http\Services\student\studentService;
use Illuminate\Http\JsonResponse;
class applicationController extends Controller
{
    private ApplicationService $service;
    function __construct(ApplicationService $service)
    {
        $this->service=$service;
    }
    public function addCategory (AddCategoryRequest $request): JsonResponse
    {

        return response()->json($this->service->addCategory($request->all()));

    }
    public function allCategory (): JsonResponse
    {

        return response()->json($this->service->allCategory());

    }
    public function getCategory ($id): JsonResponse
    {

        return response()->json($this->service->getCategory($id));

    }
    public function updateCategory (editCategoryRequest $request): JsonResponse
    {

        return response()->json($this->service->updateCategory($request->all()));

    }
    public function deleteCategory ($id): JsonResponse
    {

        return response()->json($this->service->deleteCategory($id));

    }


}
