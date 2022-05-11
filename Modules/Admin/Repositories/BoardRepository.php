<?php

namespace Modules\Admin\Repositories;

use Illuminate\Database\Eloquent\Model;
use Exception;
class BoardRepository implements RepositoryInterface
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
   
}
