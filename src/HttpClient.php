<?php

namespace Jscorptech;


class HttpClient implements ClientInterface
{
    private $account;
    private $base_url;
    private $session;

    public function __construct(Credentials $account, $base_url)
    {
        $this->account = $account;
        $this->base_url = $base_url;
        $this->session = curl_init(); // Placeholder for an HTTP client
    }

    public function send_sms(SMS $sms, Timing $timing = null): void
    {
        $this->send_sms_batch([$sms], $timing);
    }

    public function send_sms_batch(array $sms_batch, Timing $timing = null): void
    {
        $messages = [];

        foreach ($sms_batch as $sms) {
            $messages[] = [
                'message-id' => $sms->id,
                'recipient' => $sms->recipient,
                'sms' => [
                    'originator' => $sms->sender,
                    'content' => ['text' => $sms->text],
                ],
            ];
        }

        $payload = ['messages' => $messages];

        if ($timing !== null) {
            $payload['timing'] = [
                'start-datetime' => $timing->start_at->format('Y-m-d H:i'),
                'end-datetime' => $timing->end_at->format('Y-m-d H:i'),
                'send-evenly' => (int)$timing->evenly,
            ];
        }

        $this->_fetch('/broker-api/send', $payload);
    }

    private function _fetch($path, $json): void
    {
        $url = $this->base_url . $path;
        curl_setopt($this->session, CURLOPT_URL, $url);
        curl_setopt($this->session, CURLOPT_POST, 1);
        curl_setopt($this->session, CURLOPT_POSTFIELDS, json_encode($json));
        curl_setopt($this->session, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($this->account->username . ':' . $this->account->password),
        ]);
        curl_setopt($this->session, CURLOPT_RETURNTRANSFER, True);

        $response = curl_exec($this->session);
        $status = curl_getinfo($this->session, CURLINFO_HTTP_CODE);

        if ($status >= 400) {
            $error = $status === 400 ? json_decode($response, true) : null;
            throw new RequestError($status, $error);
        }
    }
}





