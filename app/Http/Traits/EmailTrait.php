<?php
namespace App\Http\Traits;


trait EmailTrait{

    public function sendEmail($to, $sender, $subject, $content, $view){
        return $view;
    }

}

?>
