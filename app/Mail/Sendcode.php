<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Sendcode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $code=rand(100000,999999);
        $body="你的验证码为".$code."五分钟后失效，请勿泄露他人";
        return $this->from('2281401451@qq.com')
            ->view('emails.email1',['body'=>$body]);
        //return $this->view('view.name');
    }
}
