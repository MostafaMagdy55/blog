<?php
namespace App\traits;



Trait images{

    public function saveimage($image,$path)

    {
        $photo=$image->getClientOriginalName();
        $photo_name=time().$photo;
        $image->move($path,$photo_name);
        return $photo_name;

    }

}
