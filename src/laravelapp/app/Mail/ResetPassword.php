<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $token;

    /**
     * Create a new message instance.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            // subject('')メソッド メールのタイトルを指定、subject('お問い合わせ')
            ->subject('パスワード再設定')
            // view('ビュー')メール本文となるビューを指定、view('emails.text')
            // view('フォルダ名.ファイル名', 使いたい配列)
            ->view('mail.password-reset')
            // with([])	データを渡す with(['orderName' => $this->order->name])
            ->with(['token' => $this->token,]);
    }
}