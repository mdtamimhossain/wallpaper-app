<?php

namespace App\Http\Controllers;
use App\Http\Requests\application\AddCategoryRequest;
use App\Http\Requests\application\LoginRequest;
use App\Http\Requests\application\searchWallpaperRequest;
use App\Http\Requests\application\updateCategoryRequest;
use App\Http\Requests\application\uploadWallpaperRequest;
use App\Http\Services\ApplicationService;
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
    public function updateCategoryImage (updateCategoryRequest $request): JsonResponse
    {

        return response()->json($this->service->updateCategoryImage($request->all()));

    }
    public function deleteCategory ($id): JsonResponse
    {

        return response()->json($this->service->deleteCategory($id));

    }
    public function uploadWallpaper (uploadWallpaperRequest $request): JsonResponse
    {

        return response()->json($this->service->uploadWallpaper($request->all()));

    }
    public function wallpaperByCategory ($id): JsonResponse
    {

        return response()->json($this->service->wallpaperByCategory($id));

    }
    public function searchWallpaper (searchWallpaperRequest $request): JsonResponse
    {

        return response()->json($this->service->searchWallpaper($request->all()));

    }
    public function deleteWallpaper ($id): JsonResponse
    {

        return response()->json($this->service->deleteWallpaper($id));

    }
    public function likeWallpaper ($id): JsonResponse
    {

        return response()->json($this->service->likeWallpaper($id));

    }
    public function login (LoginRequest $request): JsonResponse
    {

        return response()->json($this->service->processLogin($request->all()));

    }

}
