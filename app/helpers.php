<?php
    use App\models\Activity;

function getAvatar($userId)
{
   $filename = public_path("storage/assets/images/users/user-${userId}.jpg");
    
    if (file_exists($filename)) {
        return "storage/assets/images/users/user-${userId}.jpg";
    } else {
        return "img/no-avatar.png";
    }
}

function LogActivity($userId, $model, $action, $value)
{
    $activity = new Activity;
    $activity->user_id = $userId;
    $activity->model = $model;
    $activity->action = $action;
    $activity->value = serialize($value);
    $activity->save();

}