<?php

namespace App\Http\Services;
use App\Http\Services\Service;
use App\Models\Category;

class ApplicationService extends Service
{
    public function addCategory (array $data): array
    {
        try {
            Category::create([
                'name'=>$data['name'],
                'description'=>$data['description'],
                'slug'=>strtolower(str_replace(' ','-',$data['name'])),
            ]);

            return $this->responseSuccess("Category added successfully",['name'=>$data['name']]);
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
            return $this->responseSuccess('edit Category page ',['data'=>$data]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function updateCategory(array $data): array
    {
        try{
            Category::where('id',$data['id'])->update(['name'=>$data['name'],'description'=>$data['description']]);
            return $this->responseSuccess('Category updated successfully');
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
}
