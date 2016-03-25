<?php

namespace App\Logic\Mailers;

abstract class Mailer {
    public function sendTo($email, $subject, $fromEmail, $view, $data = [], $toAdmin = false)
    {
        \Mail::queue($view, $data, function($message) use($email, $subject, $fromEmail, $toAdmin)
        {
            $message->from($fromEmail, env('FROM_MAIL'));
            if($toAdmin){
              $message->to($email)
                  ->subject($subject)
                  ->bcc(env('FROM_MAIL'));
            }
            else{
              $message->to($email)
                  ->subject($subject);
            }
        });
    }
}
