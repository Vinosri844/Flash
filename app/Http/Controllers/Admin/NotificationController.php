<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use App\NotificationLogs;
use App\NotificationUsers;
use App\SmsTemplate;
use Illuminate\Http\Request;
use App\Library\CommonLib;
use CommonHelper, Image, File, Carbon, DB, Validator;


class NotificationController extends Controller
{
    public function index()
    {
        $notifications = NotificationLogs::with('customer')->orderby('notification_logs_id','desc')->get();

        return view('notification.notifications')->with('notifications', $notifications);
    }

    public function send_notification(Request $request){
        try{
            if($request->isMethod('post')){
                if($request->user_id == "All" ){

                    $notification_users = DB::table('customer_master')
                        ->leftjoin('notification_users','notification_users.customer_id','=','customer_master.customer_id')
                        ->where('notification_users.notification_user_id','!=',null)
                        ->groupby('customer_master.customer_id')
                        ->get();;
                    DB::beginTransaction();
                   // $notification_user = NotificationUsers::Where('customer_id',$request->user_id);
                    foreach ($notification_users as $notification_user){
                        $notificationlog = new NotificationLogs();
                        $notificationlog->notification_user_id = $notification_user->notification_user_id;
                        $notificationlog->customer_id = $notification_user->customer_id;
                        $notificationlog->message = $request->message;
                        $notificationlog->title = $request->title;
                        $notificationlog->user_type_id = 1;
                        $notificationlog->isactive = 1;
                        if($request->hasFile('image')) {
                            $photo = $request->file('image');
                            if(isset($photo) && !empty($photo) && $photo->isValid()) {
                                $rules = array('photo' => 'required|mimes:png,jpg,jpeg');
                                $validator = Validator::make(array('photo'=> $photo), $rules);
                                if($validator->passes()) {
                                    $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', "Notimg").'_'.time().'.'.$photo->getClientOriginalExtension();
                                    $file_path = public_path(config('constants.notification_img_path').$file_name);
                                    $file_path1 = public_path(config('constants.notification_img_path1').$file_name);
                                    $file_path2 = public_path(config('constants.notification_img_path2').$file_name);

                                    $save_photo = Image::make($photo->getRealPath())->save($file_path);
                                    $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                                    // Resize Image
                                    $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);

                                    $notificationlog->image = $file_name;
                                }
                            }
                        }

                        $notificationlog->save();

                        $notification_user = NotificationUsers::where('customer_id',$request->user_id)->first();
                        $fields = array(
                            'registration_ids' => array($notification_user->customer_device_token),
                            'priority'         => "High",
                            'sound'            => "default",
                            'data'             => array(
                                "title" => $request->title,
                                "message" => $request->message,
                                "detail" => $request->message,
                                "body" => $request->message,
                                "image"=>$notificationlog->image,
                                "android_channel_id" => "flash",
                                "type"=>$request->hasFile('image') ? 7 : 8,
                                //"json_data"=>$json_data
                            ),
                            'notification'          => array(
                                "title" => $request->title,
                                "message" => $request->message,
                                "detail" => $request->message,
                                "body" => $request->message,
                                "image"=>$notificationlog->image,
                                "android_channel_id" => "flash",
                                "type"=>$request->hasFile('image') ? 7 : 8,
                                // "json_data"=>$json_data
                            )
                        );
                        $check = CommonLib::send_new_fcm($fields);
                    }


                    DB::commit();
                    flash()->success('Notification Send Successfully!');
                    return redirect()->route('notifications');
                }else{
                    DB::beginTransaction();
                    $notification_user = NotificationUsers::Where('customer_id',$request->user_id)->first();
                    $notificationlog = new NotificationLogs();
                    $notificationlog->notification_user_id = $notification_user->notification_user_id;
                    $notificationlog->customer_id = $request->user_id;
                    $notificationlog->message = $request->message;
                    $notificationlog->title = $request->title;
                    $notificationlog->user_type_id = 1;
                    $notificationlog->isactive = 1;
                    if($request->hasFile('image')) {
                        $photo = $request->file('slider_image');
                        if(isset($photo) && !empty($photo) && $photo->isValid()) {
                            $rules = array('photo' => 'required|mimes:png,jpg,jpeg');
                            $validator = Validator::make(array('photo'=> $photo), $rules);
                            if($validator->passes()) {
                                $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', "Slider").'_'.time().'.'.$photo->getClientOriginalExtension();
                                $file_path = public_path(config('constants.notification_img_path').$file_name);
                                $file_path1 = public_path(config('constants.notification_img_path1').$file_name);
                                $file_path2 = public_path(config('constants.notification_img_path2').$file_name);

                                $save_photo = Image::make($photo->getRealPath())->save($file_path);
                                $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                                // Resize Image
                                $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);

                                $notificationlog->image = $file_name;
                            }
                        }
                    }

                    $notificationlog->save();
                   // dd($notificationlog);
                    $notification_user = NotificationUsers::where('customer_id',$request->user_id)->first();
                    $fields = array(
                        'registration_ids' => array($notification_user->customer_device_token),
                        'priority'         => "High",
                        'sound'            => "default",
                        'data'             => array(
                            "title" => $request->title,
                            "message" => $request->message,
                            "detail" => $request->message,
                            "body" => $request->message,
                            "image"=>$notificationlog->image,
                            "android_channel_id" => "flash",
                            "type"=>$request->hasFile('image') ? 7 : 8,
                            //"json_data"=>$json_data
                        ),
                        'notification'          => array(
                            "title" => $request->title,
                            "message" => $request->message,
                            "detail" => $request->message,
                            "body" => $request->message,
                            "image"=>$notificationlog->image,
                            "android_channel_id" => "flash",
                            "type"=>$request->hasFile('image') ? 7 : 8,
                           // "json_data"=>$json_data
                        )
                    );
                    $check = CommonLib::send_new_fcm($fields);

                    DB::commit();
                    flash()->success('Notification Send Successfully!');
                    return redirect()->route('notifications');
                }

            }else{
                $data['users'] = DB::table('customer_master')
                    ->leftjoin('notification_users','notification_users.customer_id','=','customer_master.customer_id')
                    ->groupby('customer_master.customer_id')
                    ->get();
                return view('notification.send_notification', $data ?? NULL);
            }
        }catch(\Exception $exception){
           //  dd($exception);
            DB::rollback();
            return redirect()->route('notifications')->with('error', $exception->getMessage());
        }
    }

    public function resend_notification(Request $request){
        try{
                    DB::beginTransaction();
                    $notificationlog = NotificationLogs::find($request->id);
                    $notification_user = NotificationUsers::find($notificationlog->notification_user_id);
                    $fields = array(
                        'registration_ids' => array($notification_user->customer_device_token),
                        'priority'         => "High",
                        'sound'            => "default",
                        'data'             => array(
                            "title" => $notificationlog->title,
                            "message" => $notificationlog->message,
                            "detail" => $notificationlog->message,
                            "body" => $notificationlog->message,
                            "image"=>$notificationlog->image,
                            "android_channel_id" => "flash",
                            "type"=>$notificationlog->image ? 7 : 8,
                            //"json_data"=>$json_data
                        ),
                        'notification'          => array(
                            "title" => $notificationlog->title,
                            "message" => $notificationlog->message,
                            "detail" => $notificationlog->message,
                            "body" => $notificationlog->message,
                            "image"=>$notificationlog->image,
                            "android_channel_id" => "flash",
                            "type"=>$notificationlog->image ? 7 : 8,
                            // "json_data"=>$json_data
                        )
                    );
                    $check = CommonLib::send_new_fcm($fields);
                    DB::commit();
                    flash()->success('Notification Send Successfully!');
        }catch(\Exception $exception){
            // dd($exception);
            DB::rollback();
            return redirect()->route('notifications')->with('error', $exception->getMessage());
        }
    }
}
