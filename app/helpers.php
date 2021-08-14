<?php

function getAvatar($userId)
{
   $filename = public_path("storage/assets/images/users/user-${userId}.jpg");
    
    if (file_exists($filename)) {
        return "storage/assets/images/users/user-${userId}.jpg";
    } else {
        return "img/no-avatar.png";
    }
}