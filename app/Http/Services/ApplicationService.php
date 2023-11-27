<?php

namespace App\Http\Services;
use App\Http\Services\Service;
use App\Models\Category;
use App\Models\User;
use App\Models\Wallpaper;
use Illuminate\Support\Facades\Storage;

class ApplicationService extends Service
{
    public function addCategory (array $data): array
    {
        try {
            $imagePath = $data['image']->store('public/category/image');
            Category::create([
                'name'=>$data['name'],
                'image'=>$imagePath
            ]);
            return $this->responseSuccess("Category added successfully");
        }
        catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
    public function allCategory(): array
    {
        try{
            $data=Category::all();
            if($data->count()==0)
            {
                return $this->responseError('No category available');
            }
            return $this->responseSuccess('all Category',['data'=>$data]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function getCategory($id): array
    {
        try{
            $data=Category::find($id);
            return $this->responseSuccess('Category Information',['data'=>$data]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function updateCategoryImage(array $data): array
    {
        try{
            $imagePath = $data['image']->store('public/category/image');
            Category::where('id',$data['id'])->update(
                [
                    'image'=>$imagePath
                ]
            );
            return $this->responseSuccess('Category Image updated successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function deleteCategory($id): array
    {
        try{
            $category=Category::find($id);
            $category->delete();
            return $this->responseSuccess('Category deleted successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function uploadWallpaper(array $data): array
    {
        try{
            $imagePath = $data['image']->store('public/wallpaper/image');
            $sizeInKb = (Storage::size($imagePath))/1024;
            Wallpaper::create([
               'image'=>$imagePath,
                'image_size'=>$sizeInKb,
                'category_id'=>$data['category_id'],
            ]);
            return $this->responseSuccess('Wallpaper uploaded successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function wallpaperByCategory($id): array
    {
        try{
            $wallpapers=Wallpaper::where('category_id',$id)->get();
            return $this->responseSuccess('All wallpaper in this category',['data'=>$wallpapers]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function deleteWallpaper($id): array
    {
        try{
            $wallpaper=Wallpaper::find($id);
            $wallpaper->delete();
            return $this->responseSuccess('Wallpaper deleted successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function likeWallpaper($id): array
    {
        try{
            $wallpaper=Wallpaper::find($id);
            $wallpaper->update(['likes' => $wallpaper->likes + 1]);
            return $this->responseSuccess('Wallpaper liked successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function removelike($id): array
    {
        try{
            $wallpaper=Wallpaper::find($id);
            if ($wallpaper && $wallpaper->like > 0) {
                $wallpaper->decrement('like');

                // Save the changes
                $wallpaper->save();
            }
            return $this->responseSuccess('Wallpaper liked successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function searchWallpaper(array $data): array
    {
        try{
            $searchString=$data['searchString'];
            $category = Category::where('name', 'LIKE', "%$searchString%")->first();
            if($category){
                $wallpapers=Wallpaper::where("category_id",$category->id)->get();
            }
            else
            {
               $wallpapers=Wallpaper::where('name', 'LIKE', "%$searchString%")->get();
            }
            if(!$wallpapers){
                return $this->responseError("No related wallpaper");
            }
            return $this->responseSuccess('Search wallpapers',['data'=>$wallpapers]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
}
