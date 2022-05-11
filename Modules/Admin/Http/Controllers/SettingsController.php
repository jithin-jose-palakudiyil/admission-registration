<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\Admin\Entities\Settings;
use \File;

class SettingsController extends Controller
{
       
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title= 'Settings' ;  $active='settings';  $breadcrumb_title = 'Settings';  
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Settings', "active" => 1,"url" => 'javascript: void(0);' ), //only last add active page array
                           ); 
        return view('admin::settings.index', compact('breadcrumb_title','page_title','active','breadcrumb'));
    
    }

     
     
     

   

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateQuizNotification(Request $request)
    { 
        $rules = [
            'notification_exist_text'=> 'max:255',
            'exam_start_time' => 'max:255',
            'notification_exist_image'=> $request->exists('notify')? 'required|mimes:jpg,jpeg,png,JPG,JPEG,PNG' : 'mimes:jpg,jpeg,png,JPG,JPEG,PNG' 
          ];
            $messages = [
                ];
            $attributes = [
              'notification_exist_text'=> 'Note',
              'exam_start_time' => 'Exam start time',
              'notification_exist_image'=>'image' 
            ];
            $request->validate($rules,$messages,$attributes);

        $error= null;
        $data = $request->all();
        if(isset($data['_token'])):unset($data['_token']); endif;
        if(isset($data['notify'])):unset($data['notify']); endif;

        if(isset($data['notification_exist_image'])):
            $images = $this->upload($data['notification_exist_image']);  
            if(isset($images['file_name'])): 
                $data['notification_exist_image'] = $images['file_name']; 
            endif; 
        endif; 
           
            $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG'];
            $path = public_path().'/uploads/documents_image/';
            if($request->exists('documents_image') && $request->documents_image !=null ): 
                $documents_image = \App\Helpers\FileHelper::upload($request->documents_image, $path, $allowedfileExtension);
                $data['documents_image'] = '/uploads/documents_image/'.$documents_image['file_name'];
            endif;
 
        try
        {   
            $settings = Settings::find(1);
            if($settings == null):
                Settings::create($data);
            else:
                $settings->update($data);
            endif;
     
        } catch (Exception $ex) { $error = $ex->getMessage(); }
        if($error == null): 
            $request->session()->flash('flash-success-message','Settings changed successfully');
        else: 
            $request->session()->flash('flash-error-message','Settings not changed successfully <br/> '.$error);
        endif;
        return \Redirect::back();
      
    }



    public function updateNotification(Request $request)
    { 
        
        $rules = [
            'notification_not_exist_image'=> $request->exists('notify_not')? 'required|mimes:jpg,jpeg,png,JPG,JPEG,PNG': 'mimes:jpg,jpeg,png,JPG,JPEG,PNG' ,
            'notification_not_exist_text' => 'max:255',

          ];
            $messages = [
                ];
            $attributes = [
              'notification_not_exist_image'=>'Image' ,
              'notification_not_exist_text' => 'Note',

            ];
            $request->validate($rules,$messages,$attributes);

        $error= null;
        $data = $request->all();
        if(isset($data['_token'])):unset($data['_token']); endif;

        
        if(isset($data['notification_not_exist_image'])):
            $image = $this->upload($data['notification_not_exist_image']);  
            if(isset($image['file_name'])): 
                $data['notification_not_exist_image'] = $image['file_name']; 
            endif; 
        endif; 

                
        try
        {   
            $settings = Settings::find(1);
            if($settings == null):
                Settings::create($data);
            else:
                $settings->update($data);
            endif;
     
        } catch (Exception $ex) { $error = $ex->getMessage(); }
        if($error == null): 
            $request->session()->flash('flash-success-message','Settings changed successfully');
        else: 
            $request->session()->flash('flash-error-message','Settings not changed successfully <br/> '.$error);
        endif;
        return \Redirect::back();
      
    }


    public function updateQuizSettings(Request $request)
    { 
        
        $rules = [
            'quiz_not_exist_image'=> $request->exists('notify_not')? 'required|mimes:jpg,jpeg,png,JPG,JPEG,PNG': 'mimes:jpg,jpeg,png,JPG,JPEG,PNG' ,
            'quiz_not_exist_text' => 'max:255',

          ];
            $messages = [
                ];
            $attributes = [
              'quiz_not_exist_image'=>'Image' ,
              'quiz_not_exist_text' => 'Note',

            ];
            $request->validate($rules,$messages,$attributes);

        $error= null;
        $data = $request->all();
        if(isset($data['_token'])):unset($data['_token']); endif;

        
        if(isset($data['quiz_not_exist_image'])):
            $image = $this->upload($data['quiz_not_exist_image']);  
            if(isset($image['file_name'])): 
                $data['quiz_not_exist_image'] = $image['file_name']; 
            endif; 
        endif; 

                
        try
        {   
            $settings = Settings::find(1);
            if($settings == null):
                Settings::create($data);
            else:
                $settings->update($data);
            endif;
     
        } catch (Exception $ex) { $error = $ex->getMessage(); }
        if($error == null): 
            $request->session()->flash('flash-success-message','Settings changed successfully');
        else: 
            $request->session()->flash('flash-error-message','Settings not changed successfully <br/> '.$error);
        endif;
        return \Redirect::back();
      
    }
    
    

    public function upload($file)
    {
        $response = [];
        $path = public_path().'/uploads/settings_image/';
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
