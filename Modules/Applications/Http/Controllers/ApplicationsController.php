<?php

namespace Modules\Applications\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Applications\Entities\NewApplications; 
use \Exception;
class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        
        if($request->slug  && $request->forms_college_id): 
            $decrypted_forms_college_id = \Crypt::decryptString($request->forms_college_id);
            $explode= explode('-', $decrypted_forms_college_id);
            
            if(!empty($explode) && count($explode)==2): 
                $result = \DB::table('colleges')
                        ->join('pivot_forms_college','pivot_forms_college.college_id' ,'=' ,'colleges.id')
                        ->join('forms','forms.id' ,'=' ,'pivot_forms_college.form_id')
                        ->select('colleges.id','colleges.name','colleges.application_heading','colleges.slug','forms.name as form_name','forms.slug as form_slug','forms.id as form_id')
                        ->where('colleges.id',$explode[0])
                        ->where('pivot_forms_college.id',$explode[1])
                        ->where('colleges.slug',$request->slug)
                        ->first ();
                if($result):
                    $include_form ='applications::forms.'.$result->form_slug;
                    return view('applications::index', compact('result','include_form','decrypted_forms_college_id','explode')); 
                else: abort(404); endif;    
            else: abort(404); endif;
        else: abort(404); endif;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function btech_regular_store(Request $request)
    {
       if($request->forms_college_id): 
            $decrypted_forms_college_id = \Crypt::decryptString($request->forms_college_id);
            $explode= explode('-', $decrypted_forms_college_id);
            
             $result = \DB::table('colleges')
                        ->join('pivot_forms_college','pivot_forms_college.college_id' ,'=' ,'colleges.id')
                        ->join('forms','forms.id' ,'=' ,'pivot_forms_college.form_id')
                        ->select('colleges.id','colleges.name','colleges.slug','forms.name as form_name','forms.slug as form_slug','forms.id as form_id')
                        ->where('colleges.id',$explode[0])
                        ->where('pivot_forms_college.id',$explode[1]) 
                        ->first ();
            if($result): 
                $data =$request->all();
                $data['form_id']=$result->form_id;
                $data['college_id']=$result->id;
                if(isset($data['_token'])): unset($data['_token']); endif;
                if(isset($data['photo'])): unset($data['photo']); endif;
                if(isset($data['signature_applicant'])): unset($data['signature_applicant']); endif;
                if(isset($data['signature_parent'])): unset($data['signature_parent']); endif;
                if(isset($data['subject'])): unset($data['subject']); endif;
                if(isset($data['mark_obtained'])): unset($data['mark_obtained']); endif;
                if(isset($data['maximum_marks'])): unset($data['maximum_marks']); endif;
                if(isset($data['grade'])): unset($data['grade']); endif;


                $databaseName = \Config::get('database.connections');
                $table = \DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '".$databaseName['mysql']['database']."' AND TABLE_NAME = 'new_applications'");
                if (!empty($table)) :
                    $AUTO_INCREMENT = $table[0]->AUTO_INCREMENT; 
                    $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG'];
                    $path = public_path().'/uploads/applications/'.$AUTO_INCREMENT;

                    if($request->exists('photo') && $request->photo !=null ): 
                        $photo = \App\Helpers\FileHelper::upload($request->photo, $path, $allowedfileExtension);
                        $data['photo'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$photo['file_name'];
                    endif;
                    if($request->exists('signature_applicant') && $request->signature_applicant !=null ): 
                        $signature_applicant = \App\Helpers\FileHelper::upload($request->signature_applicant, $path, $allowedfileExtension);
                        $data['signature_applicant'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_applicant['file_name'];
                    endif;

                    if($request->exists('signature_parent') && $request->signature_parent !=null ): 
                        $signature_parent = \App\Helpers\FileHelper::upload($request->signature_parent, $path, $allowedfileExtension);
                        $data['signature_parent'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_parent['file_name'];
                    endif;
                    
                    if($request->exists('plus_two_mark_list') && $request->plus_two_mark_list !=null ): 
                        $plus_two_mark_list = \App\Helpers\FileHelper::upload($request->plus_two_mark_list, $path, $allowedfileExtension);
                        $data['plus_two_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$plus_two_mark_list['file_name'];
                    endif;
                    
                    $subject = ($request->exists('subject')) ? $request->subject : [];
                    $mark_obtained = ($request->exists('mark_obtained')) ? $request->mark_obtained : [];
                    $maximum_marks = ($request->exists('maximum_marks')) ? $request->maximum_marks : [];
                    $grade = ($request->exists('grade')) ? $request->grade : [];
                    
                    $pivot=[];
                    if(
                            (count($subject) == count($mark_obtained )) &&
                            (count($mark_obtained) == count($maximum_marks )) &&
                            (count($maximum_marks) == count($grade )) &&
                            (count($grade) == count($subject ))
                            ):
                            $i=0;
                            foreach ($subject as $key => $value) :
                                if($value !=null && $mark_obtained[$key] !=null && $maximum_marks[$key] !=null && $grade[$key] !=null ):
                                    $pivot[$i]['subject']=$value;
                                    $pivot[$i]['mark_obtained']=$mark_obtained[$key];
                                    $pivot[$i]['maximum_marks']=$maximum_marks[$key];
                                    $pivot[$i]['grade']=$grade[$key];
                                    $i++;
                                endif;
                            endforeach;
                         
                    endif;
                endif; 
                $error=null;
                try
                {
                    if(!empty($pivot)): 
                        $create = NewApplications::create($data);
                        if($create):
                            $flagValue = $create->id;
                            $pivot = array_map(function($pivot) use ($flagValue){
                                return $pivot + ['new_applications_id' => $flagValue];
                            }, $pivot); 
                            \Modules\Applications\Entities\PivotApplicationsPlusTwo::insert($pivot);
                        endif; 
                        $request->session()->flash('flash-success-message','Your Application is submited successfully. Your application number is <div style="color: #ff0404;"> '.($create->id+1000).'</div>');
                    else:
                        $error ='Marks not enterd correctly';
//                        $request->session()->flash('flash-error-message','sorry, something went wrong !. please try again');
                    endif;
                } catch (Exception $ex) { $error = $ex->getMessage();} 
                if($error !=null):
                    $request->session()->flash('flash-error-message','sorry, something went wrong !. please try again.<br/>'.$error);
                endif;
                return \Redirect::back();
            else: abort(404); endif;
        else: abort(404); endif;
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function btech_lateral_store(Request $request)
    {
       if($request->forms_college_id): 
            $decrypted_forms_college_id = \Crypt::decryptString($request->forms_college_id);
            $explode= explode('-', $decrypted_forms_college_id); 
            $result = \DB::table('colleges')
                        ->join('pivot_forms_college','pivot_forms_college.college_id' ,'=' ,'colleges.id')
                        ->join('forms','forms.id' ,'=' ,'pivot_forms_college.form_id')
                        ->select('colleges.id','colleges.name','colleges.slug','forms.name as form_name','forms.slug as form_slug','forms.id as form_id')
                        ->where('colleges.id',$explode[0])
                        ->where('pivot_forms_college.id',$explode[1]) 
                        ->first ();
            if($result): 
                $data =$request->all();
                $data['form_id']=$result->form_id;
                $data['college_id']=$result->id;
                if(isset($data['_token'])): unset($data['_token']); endif;
                if(isset($data['photo'])): unset($data['photo']); endif;
                if(isset($data['signature_applicant'])): unset($data['signature_applicant']); endif;
                if(isset($data['signature_parent'])): unset($data['signature_parent']); endif;
         

                $error=null;
                $databaseName = \Config::get('database.connections');
                $table = \DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '".$databaseName['mysql']['database']."' AND TABLE_NAME = 'new_applications'");
                if (!empty($table)) :
                    $AUTO_INCREMENT = $table[0]->AUTO_INCREMENT; 
                    $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG'];
                    $path = public_path().'/uploads/applications/'.$AUTO_INCREMENT;

                    if($request->exists('photo') && $request->photo !=null ): 
                        $photo = \App\Helpers\FileHelper::upload($request->photo, $path, $allowedfileExtension);
                        $data['photo'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$photo['file_name'];
                    endif;
                    if($request->exists('signature_applicant') && $request->signature_applicant !=null ): 
                        $signature_applicant = \App\Helpers\FileHelper::upload($request->signature_applicant, $path, $allowedfileExtension);
                        $data['signature_applicant'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_applicant['file_name'];
                    endif;

                    if($request->exists('signature_parent') && $request->signature_parent !=null ): 
                        $signature_parent = \App\Helpers\FileHelper::upload($request->signature_parent, $path, $allowedfileExtension);
                        $data['signature_parent'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_parent['file_name'];
                    endif; 
                    
                     if($request->exists('diploma_mark_list') && $request->diploma_mark_list !=null ): 
                        $diploma_mark_list = \App\Helpers\FileHelper::upload($request->diploma_mark_list, $path, $allowedfileExtension);
                        $data['diploma_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$diploma_mark_list['file_name'];
                    endif;
                    
                    
                     if($request->exists('plus_two_mark_list') && $request->plus_two_mark_list !=null ): 
                        $plus_two_mark_list = \App\Helpers\FileHelper::upload($request->plus_two_mark_list, $path, $allowedfileExtension);
                        $data['plus_two_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$plus_two_mark_list['file_name'];
                    endif;
                    
                    
                     if($request->exists('sslc_mark_list') && $request->sslc_mark_list !=null ): 
                        $sslc_mark_list = \App\Helpers\FileHelper::upload($request->sslc_mark_list, $path, $allowedfileExtension);
                        $data['sslc_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$sslc_mark_list['file_name'];
                    endif;
                    
                    try
                    {
                        $create = NewApplications::create($data);
                        if(!empty($create)):  
                            $request->session()->flash('flash-success-message','Your Application is submited successfully. Your application number is <div style="color: #ff0404;"> '.($create->id+1000).'</div>');
                        else:
                            $error='Not created';  
                            //$request->session()->flash('flash-error-message','sorry, something went wrong !. please try again');
                        endif;
                    } catch (Exception $ex) { $error = $ex->getMessage();} 
                else:
                  $error='AUTO INCREMENT NOT FOUND';  
                endif;
                if($error !=null):
                    $request->session()->flash('flash-error-message','sorry, something went wrong !. please try again.<br/>'.$error);
                endif;
                return \Redirect::back();
            else: abort(404); endif;
        else: abort(404); endif;
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function polytechnic_regular_store(Request $request)
    {
        
       if($request->forms_college_id): 
            $decrypted_forms_college_id = \Crypt::decryptString($request->forms_college_id);
            $explode= explode('-', $decrypted_forms_college_id); 
            $result = \DB::table('colleges')
                        ->join('pivot_forms_college','pivot_forms_college.college_id' ,'=' ,'colleges.id')
                        ->join('forms','forms.id' ,'=' ,'pivot_forms_college.form_id')
                        ->select('colleges.id','colleges.name','colleges.slug','forms.name as form_name','forms.slug as form_slug','forms.id as form_id')
                        ->where('colleges.id',$explode[0])
                        ->where('pivot_forms_college.id',$explode[1]) 
                        ->first ();
            if($result): 
                $data = $request->all();
                $data['form_id']=$result->form_id;
                $data['college_id']=$result->id;
                if(isset($data['_token'])): unset($data['_token']); endif;
                if(isset($data['photo'])): unset($data['photo']); endif;
                if(isset($data['signature_applicant'])): unset($data['signature_applicant']); endif;
                if(isset($data['signature_parent'])): unset($data['signature_parent']); endif;
                if(isset($data['subject'])): unset($data['subject']); endif;
                if(isset($data['mark_obtained'])): unset($data['mark_obtained']); endif;
                if(isset($data['maximum_marks'])): unset($data['maximum_marks']); endif;
                if(isset($data['grade'])): unset($data['grade']); endif;
                if(isset($data['sslc_subject'])): unset($data['sslc_subject']); endif;
                if(isset($data['sslc_grade'])): unset($data['sslc_grade']); endif;

                
                
                $error=null; $create = false; 
                $databaseName = \Config::get('database.connections');
                $table = \DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '".$databaseName['mysql']['database']."' AND TABLE_NAME = 'new_applications'");
                if (!empty($table)) :
                    $AUTO_INCREMENT = $table[0]->AUTO_INCREMENT; 
                    $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG'];
                    $path = public_path().'/uploads/applications/'.$AUTO_INCREMENT;

                    if($request->exists('photo') && $request->photo !=null ): 
                        $photo = \App\Helpers\FileHelper::upload($request->photo, $path, $allowedfileExtension);
                        $data['photo'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$photo['file_name'];
                    endif;
                    if($request->exists('signature_applicant') && $request->signature_applicant !=null ): 
                        $signature_applicant = \App\Helpers\FileHelper::upload($request->signature_applicant, $path, $allowedfileExtension);
                        $data['signature_applicant'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_applicant['file_name'];
                    endif;

                    if($request->exists('signature_parent') && $request->signature_parent !=null ): 
                        $signature_parent = \App\Helpers\FileHelper::upload($request->signature_parent, $path, $allowedfileExtension);
                        $data['signature_parent'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_parent['file_name'];
                    endif;
                    
                     if($request->exists('plus_two_mark_list') && $request->plus_two_mark_list !=null ): 
                        $plus_two_mark_list = \App\Helpers\FileHelper::upload($request->plus_two_mark_list, $path, $allowedfileExtension);
                        $data['plus_two_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$plus_two_mark_list['file_name'];
                    endif;
                    
                    
                   if($request->exists('sslc_mark_list') && $request->sslc_mark_list !=null ): 
                        $sslc_mark_list = \App\Helpers\FileHelper::upload($request->sslc_mark_list, $path, $allowedfileExtension);
                        $data['sslc_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$sslc_mark_list['file_name'];
                    endif;
                    
                    $subject = ($request->exists('subject')) ? $request->subject : [];
                    $mark_obtained = ($request->exists('mark_obtained')) ? $request->mark_obtained : [];
                    $maximum_marks = ($request->exists('maximum_marks')) ? $request->maximum_marks : [];
                    $grade = ($request->exists('grade')) ? $request->grade : [];
                    
                    
                    $pivot_plus_two = [];
                    if(
                            (count($subject) == count($mark_obtained )) &&
                            (count($mark_obtained) == count($maximum_marks )) &&
                            (count($maximum_marks) == count($grade )) &&
                            (count($grade) == count($subject ))&&
                            (
                                count($subject) > 0 && count($mark_obtained) > 0 && 
                                count($maximum_marks) > 0 && count($grade) > 0
                            )
                    ):
                        $i=0;
                        foreach ($subject as $key => $value) :
                            if($value !=null && $mark_obtained[$key] !=null && $maximum_marks[$key] !=null && $grade[$key] !=null  ):
                                $pivot_plus_two[$i]['subject']=$value;
                                $pivot_plus_two[$i]['mark_obtained']=$mark_obtained[$key];
                                $pivot_plus_two[$i]['maximum_marks']=$maximum_marks[$key];
                                $pivot_plus_two[$i]['grade']=$grade[$key];
                                $i++;
                            endif;
                        endforeach;
                         
                    endif;
                    
                    $sslc_subject = ($request->exists('sslc_subject')) ? $request->sslc_subject : [];
                    $sslc_grade = ($request->exists('sslc_grade')) ? $request->sslc_grade : [];
                    $pivot_sslc=[]; $a=0;
                    if( count($sslc_subject) == count($sslc_grade )  ):
                        foreach ($sslc_subject as $sslc_key => $sslc_value) :
                            if( $sslc_value !=null && $sslc_grade[$sslc_key] !=null ):
                                $pivot_sslc[$a]['sslc_subject']=$sslc_value;
                                $pivot_sslc[$a]['sslc_grade']=$sslc_grade[$sslc_key];
                                $a++;
                            endif;
                        endforeach;
                    endif; 
                  
                    try
                    { 
                        if(!empty($pivot_sslc) ): 
                            $create = NewApplications::create($data);
                            if($create):
                                $flagValue = $create->id;
                            
                                $pivot_sslc = array_map(function($pivot_sslc) use ($flagValue){
                                    return $pivot_sslc + ['new_applications_id' => $flagValue];
                                }, $pivot_sslc); 
                                \Modules\Applications\Entities\PivotApplicationsSslc::insert($pivot_sslc);


                                if(!empty($pivot_plus_two)): 
                                    $pivot_plus_two = array_map(function($pivot_plus_two) use ($flagValue){
                                        return $pivot_plus_two + ['new_applications_id' => $flagValue];
                                    }, $pivot_plus_two); 
                                    \Modules\Applications\Entities\PivotApplicationsPlusTwo::insert($pivot_plus_two);
                                endif; 
                            endif;
                        endif; 
                    } catch (Exception $ex) { $error = $ex->getMessage();} 
                endif;  
               
                if($error ==null && $create):
                    $request->session()->flash('flash-success-message','Your Application is submited successfully. Your application number is <div style="color: #ff0404;"> '.($create->id+1000).'</div>');
                else:    
                    $request->session()->flash('flash-error-message','sorry, something went wrong !. please try again.<br/>'.$error);
                endif;
                return \Redirect::back();
            else: abort(404); endif;
        else: abort(404); endif;
        
    }
    
    
    
     /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function polytechnic_lateral_store(Request $request)
    {
       if($request->forms_college_id): 
            $decrypted_forms_college_id = \Crypt::decryptString($request->forms_college_id);
            $explode= explode('-', $decrypted_forms_college_id);
            
             $result = \DB::table('colleges')
                        ->join('pivot_forms_college','pivot_forms_college.college_id' ,'=' ,'colleges.id')
                        ->join('forms','forms.id' ,'=' ,'pivot_forms_college.form_id')
                        ->select('colleges.id','colleges.name','colleges.slug','forms.name as form_name','forms.slug as form_slug','forms.id as form_id')
                        ->where('colleges.id',$explode[0])
                        ->where('pivot_forms_college.id',$explode[1]) 
                        ->first ();
            if($result): 
                $data =$request->all();
                $data['form_id']=$result->form_id;
                $data['college_id']=$result->id;
                if(isset($data['_token'])): unset($data['_token']); endif;
                if(isset($data['photo'])): unset($data['photo']); endif;
                if(isset($data['signature_applicant'])): unset($data['signature_applicant']); endif;
                if(isset($data['signature_parent'])): unset($data['signature_parent']); endif;
                if(isset($data['subject'])): unset($data['subject']); endif;
                if(isset($data['mark_obtained'])): unset($data['mark_obtained']); endif;
                if(isset($data['maximum_marks'])): unset($data['maximum_marks']); endif;
                if(isset($data['grade'])): unset($data['grade']); endif;


                $databaseName = \Config::get('database.connections');
                $table = \DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '".$databaseName['mysql']['database']."' AND TABLE_NAME = 'new_applications'");
                if (!empty($table)) :
                    $AUTO_INCREMENT = $table[0]->AUTO_INCREMENT; 
                    $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG'];
                    $path = public_path().'/uploads/applications/'.$AUTO_INCREMENT;

                    if($request->exists('photo') && $request->photo !=null ): 
                        $photo = \App\Helpers\FileHelper::upload($request->photo, $path, $allowedfileExtension);
                        $data['photo'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$photo['file_name'];
                    endif;
                    if($request->exists('signature_applicant') && $request->signature_applicant !=null ): 
                        $signature_applicant = \App\Helpers\FileHelper::upload($request->signature_applicant, $path, $allowedfileExtension);
                        $data['signature_applicant'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_applicant['file_name'];
                    endif;

                    if($request->exists('signature_parent') && $request->signature_parent !=null ): 
                        $signature_parent = \App\Helpers\FileHelper::upload($request->signature_parent, $path, $allowedfileExtension);
                        $data['signature_parent'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_parent['file_name'];
                    endif;
                    
                    if($request->exists('plus_two_mark_list') && $request->plus_two_mark_list !=null ): 
                        $plus_two_mark_list = \App\Helpers\FileHelper::upload($request->plus_two_mark_list, $path, $allowedfileExtension);
                        $data['plus_two_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$plus_two_mark_list['file_name'];
                    endif;
                    if($request->exists('sslc_mark_list') && $request->sslc_mark_list !=null ): 
                        $sslc_mark_list = \App\Helpers\FileHelper::upload($request->sslc_mark_list, $path, $allowedfileExtension);
                        $data['sslc_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$sslc_mark_list['file_name'];
                    endif;
                    $subject = ($request->exists('subject')) ? $request->subject : [];
                    $mark_obtained = ($request->exists('mark_obtained')) ? $request->mark_obtained : [];
                    $maximum_marks = ($request->exists('maximum_marks')) ? $request->maximum_marks : [];
                    $grade = ($request->exists('grade')) ? $request->grade : [];
                    
                    $pivot=[];
                    if(
                            (count($subject) == count($mark_obtained )) &&
                            (count($mark_obtained) == count($maximum_marks )) &&
                            (count($maximum_marks) == count($grade )) &&
                            (count($grade) == count($subject ))
                            ):
                            $i=0;
                            foreach ($subject as $key => $value) :
                                if($value !=null && $mark_obtained[$key] !=null && $maximum_marks[$key] !=null && $grade[$key] !=null ):
                                    $pivot[$i]['subject']=$value;
                                    $pivot[$i]['mark_obtained']=$mark_obtained[$key];
                                    $pivot[$i]['maximum_marks']=$maximum_marks[$key];
                                    $pivot[$i]['grade']=$grade[$key];
                                    $i++;
                                endif;
                            endforeach;
                         
                    endif;
                endif; 
                $error=null;
                try
                {
                    if(!empty($pivot)): 
                        $create = NewApplications::create($data);
                        if($create):
                            $flagValue = $create->id;
                            $pivot = array_map(function($pivot) use ($flagValue){
                                return $pivot + ['new_applications_id' => $flagValue];
                            }, $pivot); 
                            \Modules\Applications\Entities\PivotApplicationsPlusTwo::insert($pivot);
                        endif; 
                        $request->session()->flash('flash-success-message','Your Application is submited successfully. Your application number is <div style="color: #ff0404;"> '.($create->id+1000).'</div>');
                    else:
//                        $request->session()->flash('flash-error-message','sorry, something went wrong !. please try again');
                        $error ='Marks not enterd correctly';
                    endif;
                } catch (Exception $ex) { $error = $ex->getMessage();} 
                if($error !=null):
                    $request->session()->flash('flash-error-message','sorry, something went wrong !. please try again.<br/>'.$error);
                endif;
                return \Redirect::back();
            else: abort(404); endif;
        else: abort(404); endif;
        
    }

    
    
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function b_pharm_regular_store(Request $request)
    {
       if($request->forms_college_id): 
            $decrypted_forms_college_id = \Crypt::decryptString($request->forms_college_id);
            $explode= explode('-', $decrypted_forms_college_id);
            
             $result = \DB::table('colleges')
                        ->join('pivot_forms_college','pivot_forms_college.college_id' ,'=' ,'colleges.id')
                        ->join('forms','forms.id' ,'=' ,'pivot_forms_college.form_id')
                        ->select('colleges.id','colleges.name','colleges.slug','forms.name as form_name','forms.slug as form_slug','forms.id as form_id')
                        ->where('colleges.id',$explode[0])
                        ->where('pivot_forms_college.id',$explode[1]) 
                        ->first ();
            if($result): 
                $data =$request->all();
                $data['form_id']=$result->form_id;
                $data['college_id']=$result->id;
                if(isset($data['_token'])): unset($data['_token']); endif;
                if(isset($data['photo'])): unset($data['photo']); endif;
                if(isset($data['signature_applicant'])): unset($data['signature_applicant']); endif;
                if(isset($data['signature_parent'])): unset($data['signature_parent']); endif;
                if(isset($data['subject'])): unset($data['subject']); endif;
                if(isset($data['mark_obtained'])): unset($data['mark_obtained']); endif;
                if(isset($data['maximum_marks'])): unset($data['maximum_marks']); endif;
                if(isset($data['grade'])): unset($data['grade']); endif;


                $databaseName = \Config::get('database.connections');
                $table = \DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '".$databaseName['mysql']['database']."' AND TABLE_NAME = 'new_applications'");
                if (!empty($table)) :
                    $AUTO_INCREMENT = $table[0]->AUTO_INCREMENT; 
                    $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG'];
                    $path = public_path().'/uploads/applications/'.$AUTO_INCREMENT;

                    if($request->exists('photo') && $request->photo !=null ): 
                        $photo = \App\Helpers\FileHelper::upload($request->photo, $path, $allowedfileExtension);
                        $data['photo'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$photo['file_name'];
                    endif;
                    if($request->exists('signature_applicant') && $request->signature_applicant !=null ): 
                        $signature_applicant = \App\Helpers\FileHelper::upload($request->signature_applicant, $path, $allowedfileExtension);
                        $data['signature_applicant'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_applicant['file_name'];
                    endif;

                    if($request->exists('signature_parent') && $request->signature_parent !=null ): 
                        $signature_parent = \App\Helpers\FileHelper::upload($request->signature_parent, $path, $allowedfileExtension);
                        $data['signature_parent'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_parent['file_name'];
                    endif;
                    
                    if($request->exists('plus_two_mark_list') && $request->plus_two_mark_list !=null ): 
                        $plus_two_mark_list = \App\Helpers\FileHelper::upload($request->plus_two_mark_list, $path, $allowedfileExtension);
                        $data['plus_two_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$plus_two_mark_list['file_name'];
                    endif;
                    if($request->exists('sslc_mark_list') && $request->sslc_mark_list !=null ): 
                        $sslc_mark_list = \App\Helpers\FileHelper::upload($request->sslc_mark_list, $path, $allowedfileExtension);
                        $data['sslc_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$sslc_mark_list['file_name'];
                    endif;
                    $subject = ($request->exists('subject')) ? $request->subject : [];
                    $mark_obtained = ($request->exists('mark_obtained')) ? $request->mark_obtained : [];
                    $maximum_marks = ($request->exists('maximum_marks')) ? $request->maximum_marks : [];
                    $grade = ($request->exists('grade')) ? $request->grade : [];
                    
                    $pivot=[];
                    if(
                            (count($subject) == count($mark_obtained )) &&
                            (count($mark_obtained) == count($maximum_marks )) &&
                            (count($maximum_marks) == count($grade )) &&
                            (count($grade) == count($subject ))
                            ):
                            $i=0;
                            foreach ($subject as $key => $value) :
                                if($value !=null && $mark_obtained[$key] !=null && $maximum_marks[$key] !=null && $grade[$key] !=null ):
                                    $pivot[$i]['subject']=$value;
                                    $pivot[$i]['mark_obtained']=$mark_obtained[$key];
                                    $pivot[$i]['maximum_marks']=$maximum_marks[$key];
                                    $pivot[$i]['grade']=$grade[$key];
                                    $i++;
                                endif;
                            endforeach;
                         
                    endif;
                endif; 
                $error=null;
                try
                {
                    if(!empty($pivot)): 
                        $create = NewApplications::create($data);
                        if($create):
                            $flagValue = $create->id;
                            $pivot = array_map(function($pivot) use ($flagValue){
                                return $pivot + ['new_applications_id' => $flagValue];
                            }, $pivot); 
                            \Modules\Applications\Entities\PivotApplicationsPlusTwo::insert($pivot);
                        endif; 
                        $request->session()->flash('flash-success-message','Your Application is submited successfully. Your application number is <div style="color: #ff0404;"> '.($create->id+1000).'</div>');
                    else:
//                        $request->session()->flash('flash-error-message','sorry, something went wrong !. please try again');
                        $error ='Marks not enterd correctly';
                    endif;
                } catch (Exception $ex) { $error = $ex->getMessage();} 
                if($error !=null):
                    $request->session()->flash('flash-error-message','sorry, something went wrong !. please try again.<br/>'.$error);
                endif;
                return \Redirect::back();
            else: abort(404); endif;
        else: abort(404); endif;
        
    }

    
    
    
    
    
    
    
    
    
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function m_tech_store(Request $request)
    {
        
       if($request->forms_college_id): 
            $decrypted_forms_college_id = \Crypt::decryptString($request->forms_college_id);
            $explode= explode('-', $decrypted_forms_college_id); 
            $result = \DB::table('colleges')
                        ->join('pivot_forms_college','pivot_forms_college.college_id' ,'=' ,'colleges.id')
                        ->join('forms','forms.id' ,'=' ,'pivot_forms_college.form_id')
                        ->select('colleges.id','colleges.name','colleges.slug','forms.name as form_name','forms.slug as form_slug','forms.id as form_id')
                        ->where('colleges.id',$explode[0])
                        ->where('pivot_forms_college.id',$explode[1]) 
                        ->first ();
            if($result): 
                $data = $request->all();
                $data['form_id']=$result->form_id;
                $data['college_id']=$result->id;
                if(isset($data['_token'])): unset($data['_token']); endif;
                if(isset($data['photo'])): unset($data['photo']); endif;
                if(isset($data['signature_applicant'])): unset($data['signature_applicant']); endif;
                if(isset($data['signature_parent'])): unset($data['signature_parent']); endif;
                if(isset($data['subject'])): unset($data['subject']); endif;
                if(isset($data['mark_obtained'])): unset($data['mark_obtained']); endif;
                if(isset($data['maximum_marks'])): unset($data['maximum_marks']); endif;
                if(isset($data['grade'])): unset($data['grade']); endif;
                if(isset($data['sslc_subject'])): unset($data['sslc_subject']); endif;
                if(isset($data['sslc_grade'])): unset($data['sslc_grade']); endif;

                
                
                $error=null; $create = false; 
                $databaseName = \Config::get('database.connections');
                $table = \DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '".$databaseName['mysql']['database']."' AND TABLE_NAME = 'new_applications'");
                if (!empty($table)) :
                    $AUTO_INCREMENT = $table[0]->AUTO_INCREMENT; 
                    $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG'];
                    $path = public_path().'/uploads/applications/'.$AUTO_INCREMENT;

                    if($request->exists('photo') && $request->photo !=null ): 
                        $photo = \App\Helpers\FileHelper::upload($request->photo, $path, $allowedfileExtension);
                        $data['photo'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$photo['file_name'];
                    endif;
                    if($request->exists('signature_applicant') && $request->signature_applicant !=null ): 
                        $signature_applicant = \App\Helpers\FileHelper::upload($request->signature_applicant, $path, $allowedfileExtension);
                        $data['signature_applicant'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_applicant['file_name'];
                    endif;

                    if($request->exists('signature_parent') && $request->signature_parent !=null ): 
                        $signature_parent = \App\Helpers\FileHelper::upload($request->signature_parent, $path, $allowedfileExtension);
                        $data['signature_parent'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_parent['file_name'];
                    endif;
                    
                     if($request->exists('plus_two_mark_list') && $request->plus_two_mark_list !=null ): 
                        $plus_two_mark_list = \App\Helpers\FileHelper::upload($request->plus_two_mark_list, $path, $allowedfileExtension);
                        $data['plus_two_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$plus_two_mark_list['file_name'];
                    endif;
                    
                    
                   if($request->exists('sslc_mark_list') && $request->sslc_mark_list !=null ): 
                        $sslc_mark_list = \App\Helpers\FileHelper::upload($request->sslc_mark_list, $path, $allowedfileExtension);
                        $data['sslc_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$sslc_mark_list['file_name'];
                    endif;
                    
                    
                    if($request->exists('btech_mark_list') && $request->btech_mark_list !=null ): 
                        $btech_mark_list = \App\Helpers\FileHelper::upload($request->btech_mark_list, $path, $allowedfileExtension);
                        $data['btech_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$btech_mark_list['file_name'];
                    endif;
                    
                  
                    try
                    { 
                          
                            $create = NewApplications::create($data);
                            
                        
                    } catch (Exception $ex) { $error = $ex->getMessage();} 
                endif;  
                 
                if($error ==null && $create):
                    $request->session()->flash('flash-success-message','Your Application is submited successfully. Your application number is <div style="color: #ff0404;"> '.($create->id+1000).'</div>');
                else:    
                    $request->session()->flash('flash-error-message','sorry, something went wrong !. please try again.<br/>'.$error);
                endif;
                return \Redirect::back();
            else: abort(404); endif;
        else: abort(404); endif;
        
    }
    
    
    
    
    
    
      /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function d_pharm_regular_store(Request $request)
    {
       if($request->forms_college_id): 
            $decrypted_forms_college_id = \Crypt::decryptString($request->forms_college_id);
            $explode= explode('-', $decrypted_forms_college_id);
            
             $result = \DB::table('colleges')
                        ->join('pivot_forms_college','pivot_forms_college.college_id' ,'=' ,'colleges.id')
                        ->join('forms','forms.id' ,'=' ,'pivot_forms_college.form_id')
                        ->select('colleges.id','colleges.name','colleges.slug','forms.name as form_name','forms.slug as form_slug','forms.id as form_id')
                        ->where('colleges.id',$explode[0])
                        ->where('pivot_forms_college.id',$explode[1]) 
                        ->first ();
            if($result): 
                $data =$request->all();
                $data['form_id']=$result->form_id;
                $data['college_id']=$result->id;
                if(isset($data['_token'])): unset($data['_token']); endif;
                if(isset($data['photo'])): unset($data['photo']); endif;
                if(isset($data['signature_applicant'])): unset($data['signature_applicant']); endif;
                if(isset($data['signature_parent'])): unset($data['signature_parent']); endif;
                if(isset($data['subject'])): unset($data['subject']); endif;
                if(isset($data['mark_obtained'])): unset($data['mark_obtained']); endif;
                if(isset($data['maximum_marks'])): unset($data['maximum_marks']); endif;
                if(isset($data['grade'])): unset($data['grade']); endif;


                $databaseName = \Config::get('database.connections');
                $table = \DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '".$databaseName['mysql']['database']."' AND TABLE_NAME = 'new_applications'");
                if (!empty($table)) :
                    $AUTO_INCREMENT = $table[0]->AUTO_INCREMENT; 
                    $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG'];
                    $path = public_path().'/uploads/applications/'.$AUTO_INCREMENT;

                    if($request->exists('photo') && $request->photo !=null ): 
                        $photo = \App\Helpers\FileHelper::upload($request->photo, $path, $allowedfileExtension);
                        $data['photo'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$photo['file_name'];
                    endif;
                    if($request->exists('signature_applicant') && $request->signature_applicant !=null ): 
                        $signature_applicant = \App\Helpers\FileHelper::upload($request->signature_applicant, $path, $allowedfileExtension);
                        $data['signature_applicant'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_applicant['file_name'];
                    endif;

                    if($request->exists('signature_parent') && $request->signature_parent !=null ): 
                        $signature_parent = \App\Helpers\FileHelper::upload($request->signature_parent, $path, $allowedfileExtension);
                        $data['signature_parent'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$signature_parent['file_name'];
                    endif;
                    
                    if($request->exists('plus_two_mark_list') && $request->plus_two_mark_list !=null ): 
                        $plus_two_mark_list = \App\Helpers\FileHelper::upload($request->plus_two_mark_list, $path, $allowedfileExtension);
                        $data['plus_two_mark_list'] = '/uploads/applications/'.$AUTO_INCREMENT.'/'.$plus_two_mark_list['file_name'];
                    endif;
                    
                    $subject = ($request->exists('subject')) ? $request->subject : [];
                    $mark_obtained = ($request->exists('mark_obtained')) ? $request->mark_obtained : [];
                    $maximum_marks = ($request->exists('maximum_marks')) ? $request->maximum_marks : [];
                    $grade = ($request->exists('grade')) ? $request->grade : [];
                    
                    $pivot=[];
                    if(
                            (count($subject) == count($mark_obtained )) &&
                            (count($mark_obtained) == count($maximum_marks )) &&
                            (count($maximum_marks) == count($grade )) &&
                            (count($grade) == count($subject ))
                            ):
                            $i=0;
                            foreach ($subject as $key => $value) :
                                if($value !=null && $mark_obtained[$key] !=null && $maximum_marks[$key] !=null && $grade[$key] !=null ):
                                    $pivot[$i]['subject']=$value;
                                    $pivot[$i]['mark_obtained']=$mark_obtained[$key];
                                    $pivot[$i]['maximum_marks']=$maximum_marks[$key];
                                    $pivot[$i]['grade']=$grade[$key];
                                    $i++;
                                endif;
                            endforeach;
                         
                    endif;
                endif; 
                $error=null;
                try
                {
                    if(!empty($pivot)): 
                        $create = NewApplications::create($data);
                        if($create):
                            $flagValue = $create->id;
                            $pivot = array_map(function($pivot) use ($flagValue){
                                return $pivot + ['new_applications_id' => $flagValue];
                            }, $pivot); 
                            \Modules\Applications\Entities\PivotApplicationsPlusTwo::insert($pivot);
                        endif; 
                        $request->session()->flash('flash-success-message','Your Application is submited successfully. Your application number is <div style="color: #ff0404;"> '.($create->id+1000).'</div>');
                    else:
                        $error ='Marks not enterd correctly';
//                        $request->session()->flash('flash-error-message','sorry, something went wrong !. please try again');
                    endif;
                } catch (Exception $ex) { $error = $ex->getMessage();} 
                if($error !=null):
                    $request->session()->flash('flash-error-message','sorry, something went wrong !. please try again.<br/>'.$error);
                endif;
                return \Redirect::back();
            else: abort(404); endif;
        else: abort(404); endif;
        
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
//    public function get_courses_category_colleges(Request $request)
//    {
//        $option ='<option value="">select</option>';
//        if($request->exists('college_id') && $request->exists('courses_category_id')):
//            $category =     \DB::table('pivot_assign_category_colleges')
//                            ->select('courses.*')
//                            ->join('courses','pivot_assign_category_colleges.course_id','courses.id')
//                            ->where('pivot_assign_category_colleges.college_id',$request->college_id)
//                            ->where('pivot_assign_category_colleges.courses_category_id',$request->courses_category_id)
//                            ->get();
//            $category = $category->unique('slug');
//            if($category->isNotEmpty()):
//                foreach ($category as $key => $value):
//                $option.='<option value="'.$value->id.'">'.$value->name.'</option>';
//                endforeach;
//            endif;                
//        endif;
//         return response()->json(['option'=>$option], 200);
//    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('applications::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('applications::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
