<?php

namespace Modules\Admin\Repositories;

use Illuminate\Database\Eloquent\Model;
use Exception;
class QuizQuestionsRepository implements RepositoryInterface
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
        $response =  [
            'data' => null,
            'error' => null
        ];
        $answers =[];$insert = []; 
        try {  
            if(isset($data['_token'])): unset($data['_token']); endif; 
            if(isset($data['quiz'])):$data['quiz_id'] = $data['quiz']; unset($data['quiz']);endif; 
            // if(isset($data['answers'])): $answers = $data['answers'];  unset($data['answers']); endif;
       
            $record = $this->model->create($data); 
            $response["data"] = $record;
            // if($record): 
            //     foreach ($answers as $key => $value):
            //         $insert[$key]['answer']=$value; 
            //         $insert[$key]['quiz_question_id']=$record->id; 
            //     endforeach;
            //     if(!empty($insert)): 
            //         \Modules\Admin\Entities\QuizAnswers::insert($insert);
            //     endif;
            // endif;  
        } catch (Exception $ex) { $response["error"] = $ex->getMessage(); }
        return  $response;
        
         
    }


    // update record in the database
    public function update(array $data, $record)
    {
        $response =  null ;$answers =[];$insert = [];  
        if(isset($data['_token'])): unset($data['_token']); endif; 
        if(isset($data['quiz'])):$data['quiz_id'] = $data['quiz']; unset($data['quiz']);endif; 
        // if(isset($data['answers'])): $answers = $data['answers'];  unset($data['answers']); endif;
        
        try
        {
            $update = $record->update($data);
            // if($update): 
            //     foreach ($answers as $key => $value):
            //         $insert[$key]['answer']=$value; 
            //         $insert[$key]['quiz_question_id']=$record->id; 
            //     endforeach;
            //     if(!empty($insert)): 
            //             \Modules\Admin\Entities\QuizAnswers::where('quiz_question_id',$record->id)->delete();
            //         \Modules\Admin\Entities\QuizAnswers::insert($insert);
            //     endif;
            // endif;
        } catch (Exception $ex) { $response = $ex->getMessage(); } 
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
   
}
