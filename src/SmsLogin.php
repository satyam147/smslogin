<?php

namespace Satyam147\Smslogin;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SmsLogin
{
    // https://smslogin.co/v3/api.php?username=SSAPPS&apikey=a2379ee063a3c07e10b0&senderid=xxxxxxxx&mobile=xxxxxxxxx&message=
    private string $url;
    private string $username;
    private string $apiKey;
    private string $senderId;

    public function __construct(string $senderId = null)
    {
        $this->url = config('smslogin.SMSLOGIN_URL');
        $this->username = config('smslogin.SMSLOGIN_USERNAME');
        $this->apiKey = config('smslogin.SMSLOGIN_API_KEY');
        $this->senderId = $senderId ?? config('smslogin.SMSLOGIN_SENDER_ID');
    }

    /**
     * @throws ConnectionException
     */
    public function sendSms(array|string $mobile, string $message, string $templateId): PromiseInterface|Response
    {
        if (is_array($mobile)) {
            $mobile = implode(',', $mobile);
        }
        $message = urlencode($message);
        return Http::get($this->url, [
            'username' => $this->username,
            'apikey' => $this->apiKey,
            'senderid' => $this->senderId,
            'mobile' => $mobile,
            'message' => $message,
            'templateid' => $templateId
        ]);
    }
}
