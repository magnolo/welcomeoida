<?php
namespace App\Logic\Mailers;
class UserMailer extends Mailer {
    public function verify($email, $data)
    {
        $view       = 'emails.activate-link';
        $subject    = $data['subject'];
        $fromEmail  = env('FROM_MAIL');
        $this->sendTo($email, $subject, $fromEmail, $view, $data);
    }
    public function passwordReset($email, $data)
    {
        $view       = 'emails.password-reset';
        $subject    = $data['subject'];
        $fromEmail  = env('FROM_MAIL');
        $this->sendTo($email, $subject, $fromEmail, $view, $data);
    }
    public function newEvent($email, $data){
      $view       = 'emails.new-event';
      $subject    = $data['subject'];
      $fromEmail  = env('FROM_MAIL');
      $this->sendTo($email, $subject, $fromEmail, $view, $data, true);
    }
    public function publicEvent($email, $data){
      $view       = 'emails.public-event';
      $subject    = $data['subject'];
      $fromEmail  = env('FROM_MAIL');
      $this->sendTo($email, $subject, $fromEmail, $view, $data, true);
    }
    public function newPartner($email, $data){
      $view       = 'emails.new-partner';
      $subject    = $data['subject'];
      $fromEmail  = env('FROM_MAIL');
      $this->sendTo($email, $subject, $fromEmail, $view, $data, true);
    }
    public function newPartnerAdmin($partner, $data){
      $view       = 'emails.new-partner-admin';
      $subject    = $data['subject'];
      $fromEmail  = env('FROM_MAIL');
      $this->sendTo($fromEmail, $subject, $fromEmail, $view, $partner->toArray(), true);
    }
    public function publicPartner($email, $data){
      $view       = 'emails.public-partner';
      $subject    = $data['subject'];
      $fromEmail  = env('FROM_MAIL');
      $this->sendTo($email, $subject, $fromEmail, $view, $data, true);
    }
}
