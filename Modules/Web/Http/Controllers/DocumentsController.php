<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use  \Modules\Web\Entities\User;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $web_user =User::where('id', \Auth::guard(web_guard)->user()->id)->first();
        return view('web::documents.index', compact('web_user'));
    }

    

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $error = null;
        $request->validate([
//            'tenth_maximum_mark'=>'required|numeric',
//            'tenth_mark'=>'required|numeric',
//            'tenth_board'=>'required|numeric',
//            
//            'plus_one_maximum_mark'=>'required|numeric',
//            'plus_one_mark'=>'required|numeric',
//            'plus_one_board'=>'required|numeric',
           
            "tenth_mark_list"     => 'mimes:jpg,png,jpeg,JPG,PNG,JPEG|max:6000', // max 6mb, 
            "plus_one_mark_list"     => 'mimes:jpg,png,jpeg,JPG,PNG,JPEG|max:6000' ,// max 6mb, 
            "plus_two_mark_list"     => 'mimes:jpg,png,jpeg,JPG,PNG,JPEG|max:6000' ,// max 6mb, 
            "iti_diploma_mark_list"     => 'mimes:jpg,png,jpeg,JPG,PNG,JPEG|max:6000' // max 6mb, 
            
        ]);
         
         $user =  \Auth::guard(web_guard)->user();
//          $data = [];
//         ALTER TABLE `users` ADD `plus_two_board` VARCHAR(255) NULL DEFAULT NULL AFTER `iti_diploma_mark_list`, ADD `plus_two_stream` VARCHAR(255) NULL DEFAULT NULL AFTER `plus_two_board`, ADD `technical_courses` VARCHAR(255) NULL DEFAULT NULL AFTER `plus_two_stream`;
         $data = [
//            'tenth_mark' => $request->tenth_mark,
//            'tenth_board' => $request->tenth_board,
//            'tenth_maximum_mark' => $request->tenth_maximum_mark,
//            'plus_one_mark' => $request->plus_one_mark,
//            'plus_one_board' => $request->plus_one_board,
//            'plus_one_maximum_mark' => $request->plus_one_maximum_mark,
////             'plus_two_maximum_mark' => $request->plus_two_maximum_mark,
////            'plus_two_mark' => $request->plus_two_mark, 
            'plus_two_board' => $request->plus_two_board, 
             'plus_two_stream' => $request->plus_two_stream, 
             'technical_courses' => $request->technical_courses, 
            
        ];
       
            $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG'];
            $path = public_path().'/uploads/users/'.$user->id;
            
            if($request->exists('tenth_mark_list') && $request->tenth_mark_list !=null ): 
                $tenth_mark_list = \App\Helpers\FileHelper::upload($request->tenth_mark_list, $path, $allowedfileExtension);
                $data['tenth_mark_list'] = '/uploads/users/'.$user->id.'/'.$tenth_mark_list['file_name'];
            endif;
            if($request->exists('plus_one_mark_list') && $request->plus_one_mark_list !=null ): 
                $plus_one_mark_list = \App\Helpers\FileHelper::upload($request->plus_one_mark_list, $path, $allowedfileExtension);
                $data['plus_one_mark_list'] = '/uploads/users/'.$user->id.'/'.$plus_one_mark_list['file_name'];
            endif;
            
            if($request->exists('plus_two_mark_list') && $request->plus_two_mark_list !=null ): 
                $plus_two_mark_list = \App\Helpers\FileHelper::upload($request->plus_two_mark_list, $path, $allowedfileExtension);
                $data['plus_two_mark_list'] = '/uploads/users/'.$user->id.'/'.$plus_two_mark_list['file_name'];
            endif;
            
            if($request->exists('iti_diploma_mark_list') && $request->iti_diploma_mark_list !=null ): 
                $iti_diploma_mark_list = \App\Helpers\FileHelper::upload($request->iti_diploma_mark_list, $path, $allowedfileExtension);
                $data['iti_diploma_mark_list'] = '/uploads/users/'.$user->id.'/'.$iti_diploma_mark_list['file_name'];
            endif; 
          
            
        if($user):
            try{ User::where('id', $user->id)->update($data); }catch(Exception $ex){$error = $ex->getMessage();}
            if($error == null):
                $request->session()->flash('flash-success-message', ' Documents Submitted Successfully.');
            else:
                $request->session()->flash('flash-error-message', 'Sorry ! something went wrong please try again.<br/>'.$error);
            endif;
            return \Redirect::back(); 
        else:
            return redirect()->route('loginView');
        endif;
        
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
