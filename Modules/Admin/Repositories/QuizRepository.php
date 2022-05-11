<?php

namespace Modules\Admin\Repositories;

use Illuminate\Database\Eloquent\Model;
use Exception;
use \File;

class QuizRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    { 
        $response = null; 
        try {  
            if(isset($data['_token'])):
                unset($data['_token']);
            endif; 
            if(isset($data['image'])):
                $images = $this->upload($data['image']);  
                if(isset($images['file_name'])): 
                    $data['image'] = $images['file_name']; 
                endif; 
            endif; 

            if(isset($data['exam_completed_image'])):
                $images = $this->upload($data['exam_completed_image']);  
                if(isset($images['file_name'])): 
                    $data['exam_completed_image'] = $images['file_name']; 
                endif; 
            endif; 
            if(isset($data['exams'])):
                $exams = json_encode($data['exams']);
                unset($data['exams']);
                $data['exams'] = $exams; 
            endif;
            if(!isset($data['is_need_new_users'])):
                $data['is_need_new_users'] = 0; 
                $data['date_users_reg_re_exam'] = null;  
            endif;
            $data['open_or_close'] = 3;  
//            dd($data);
            $this->model->create($data); 
        } catch (Exception $ex) { $response = $ex->getMessage(); }
        return  $response;
        
         
    }

    // update record in the database
    public function update(array $data, $record)
    {
        $response = null; 
        if(isset($data['_token'])):
             unset($data['_token']);
        endif;
        if(isset($data['image'])):
            $images = $this->upload($data['image']);  
            if(isset($images['file_name'])): 
                $data['image'] = $images['file_name']; 
            endif; 
        endif; 

        if(isset($data['exam_completed_image'])):
            $images = $this->upload($data['exam_completed_image']);  
            if(isset($images['file_name'])): 
                $data['exam_completed_image'] = $images['file_name']; 
            endif; 
        endif; 
        if(isset($data['exams'])):
            $exams = json_encode($data['exams']);
            unset($data['exams']);
            $data['exams'] = $exams; 
        endif;
        
        if(isset($data['exam_type']) && $data['exam_type'] =='fresh'):
             
            unset($data['exams']);
            $data['exams'] = null; 
            
            unset($data['exams_status']);
            $data['exams_status'] = null; 
             
            unset($data['is_need_new_users']);
            $data['is_need_new_users'] = 0;
            
            unset($data['date_users_reg_re_exam']);
            $data['date_users_reg_re_exam'] = null;
           
        endif;
        
        if(!isset($data['is_need_new_users'])):
            $data['is_need_new_users'] = 0; 
            $data['date_users_reg_re_exam'] = null;  
        endif;
        
        try{$record->update($data); } 
        catch (Exception $ex) { $response = $ex->getMessage(); } 
        return $response; 
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model-findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
   

    public function upload($file)
    {
        $response = [];
        $path = public_path().'/uploads/quiz_image/';
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        $allowedfileExtension = ['jpg','png','jpeg','pdf','JPG','PNG','JPEG','PDF']; 
        $extension = $file->getClientOriginalExtension(); 
        if(in_array($extension,$allowedfileExtension)): 
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);  
              $fileNameToStore = $filename.'_'.date("Ymdhisa").'_'.rand().'.'.$extension;
           
            if($file->move($path,$fileNameToStore)): $response['file_name'] = $fileNameToStore; endif;
        endif;  
        return $response;
    }
}
