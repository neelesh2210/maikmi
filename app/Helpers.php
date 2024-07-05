<?php

use App\Models\Serivces;
use App\Models\Notification;
use App\Models\WebsiteSetup;
use App\Models\AvailabilityHour;
use App\Firebase\FireBaseManager;
use App\Models\Admin\ImageUpload;
use Illuminate\Support\Facades\Auth;

if (!function_exists('websiteSetupValue')) {
    function websiteSetupValue($name) {
        return WebsiteSetup::where('name', $name)->first() ? WebsiteSetup::where('name', $name)->first()->value : "";
    }
}

if(!function_exists('dateTimeFormat')){
    function dateTimeFormat($datesTime){
        return date('d-M-Y h:i A', strtotime($datesTime));
    }
}

if(!function_exists('dateFormat')){
    function dateFormat($dates){
        return date('d-M-Y', strtotime($dates));
    }
}

if(!function_exists('timeFormat')){
    function timeFormat($time){
        return date('h:i A', strtotime($time));
    }
}

if(! function_exists('imageUrl')){
    function imageUrl($id){
        $imageUrl="";
        $data = ImageUpload::find($id);
        if($data && $data->image){
            $folder = $data->folder ?? 'images';
            $imageUrl = asset('admin_css/admin/'.$folder.'/'.$data->image);
        }
        return $imageUrl;
    }
}

if(! function_exists('compress')){
    function compress($src, $dist, $dis_width =500) {
        $img = '';
        $extension = strtolower(strrchr($src, '.'));
        switch($extension)
        {
            case '.jpg':
            case '.jpeg':
                $img = imagecreatefromjpeg($src);
                break;
            case '.gif':
                $img = imagecreatefromgif($src);
                break;
            case '.png':
                $img = imagecreatefrompng($src);
                break;
            case '.webp':
                $img = imagecreatefromwebp($src);
                break;
        }
        $width = imagesx($img);
        $height = imagesy($img);
        $dis_height = $dis_width * ($height / $width);
        $new_image = imagecreatetruecolor($dis_width, $dis_height);
        imagecopyresampled($new_image, $img, 0, 0, 0, 0, $dis_width, $dis_height, $width, $height);
        $imageQuality = 90;
        switch($extension)
        {
            case '.jpg':
            case '.jpeg':
                if (imagetypes() & IMG_JPG) {
                    imagejpeg($new_image, $dist, $imageQuality);
                }
                break;
            case '.gif':
                if (imagetypes() & IMG_GIF) {
                    imagegif($new_image, $dist);
                }
                break;
            case '.png':
                $scaleQuality = round(($imageQuality/100) * 9);
                $invertScaleQuality = 9 - $scaleQuality;
                if (imagetypes() & IMG_PNG) {
                    imagepng($new_image, $dist, $invertScaleQuality);
                }
                break;
        }
        imagedestroy($new_image);

    }
}

if(! function_exists('imageUpload')){
    function imageUpload($image, $folder="images", $compress=true)
    {
        $extension = $image->extension();
        $image_name = time().rand(10, 99).'.'.$extension;
        $path = $image->move(public_path('admin_css/admin/'.$folder.'/'),$image_name);
        $src = 'admin_css/admin/'.$folder.'/'.$image_name;

        if($compress){
            compress($src, $src, 500);
        }

        $data = new ImageUpload;
        $data->image = $image_name;
        $data->extension = $extension;
        $data->size = $path->getSize();
        $data->folder = $folder != null ? $folder : 'images';
        $data->save();

        return $data->id;
    }
}

if(! function_exists('sendNotification')){
    function sendNotification($title, $body, $token, $type = null)
    {
        $notificationArr = [
            'title'             => $title,
            'body'              => $body,
        ];

        if($type){
            $in_app_module = [
                "type"           => $type,
            ];
            FireBaseManager::sendMessage($notificationArr, $in_app_module, $token);

        }else{
            FireBaseManager::sendMessage($notificationArr, $token);
        }

    }
}

if(! function_exists('callNotification')){
    function callNotification($noti_title, $noti_body, $token, $user_data)
    {
        $notificationArr = [
            'title'             => $noti_title,
            'body'              => $noti_body,
        ];

        $in_app_module = [
            "title"          => $noti_title,
            "body"           => $noti_body,
            "type"           => "call",
            "user_data"      => $user_data
        ];
        FireBaseManager::sendMessage($notificationArr, $in_app_module, $token);
    }
}

if(! function_exists('activeRoute')){
    function activeRoute($routes=[])
    {
        foreach ($routes as $key => $route) {
            if(Route::currentRouteName() == $route){
                return true;
            }
        }
    }
}

if(! function_exists('availabilityHour')){
    function availabilityHour($salon_id, $day)
    {
        return AvailabilityHour::where('salon_id', $salon_id)->where('day', $day)->first();
    }
}

if(! function_exists('latLongDistanceCalculate')){
    function latLongDistanceCalculate($lat1, $lon1, $lat2, $lon2, $unit) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            $distance = ($miles * 1.609344);
        } else if ($unit == "N") {
            $distance =  ($miles * 0.8684);
        } else {
            $distance =  $miles;
        }

        return round($distance);
    }
}

?>
