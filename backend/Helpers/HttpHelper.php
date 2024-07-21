<?php

namespace App\Helpers;

class HttpHelper
{
    private $authUrl;

    public function __construct(
        private string $baseUrl,
        private string $authPath,
        private string $clientId,
        private string $clientSecret
    )
    {
        $this->authUrl = $this->baseUrl . $this->authPath;
    }

    private function getToken()
    {
        $ch = curl_init($this->authUrl);
        $payload = json_encode([
            'clientId' => $this->clientId,
            'clientSecret' => $this->clientSecret
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: application/json',
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POST, true);
        $result = curl_exec($ch);
        curl_close($ch);

        try {
            return json_decode($result)->access_token;

        } catch (\Throwable $th) {
            throw new \Exception("Error Processing Request", 1);
        }
    }

    public function post($path, $data)
    {
        $ch = curl_init($this->baseUrl . $path);
        $payload = json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer ' . $this->getToken()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function get($path)
    {
        $ch = curl_init($this->baseUrl . $path);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->getToken()
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['$top' => 10, '$skip' => 0]));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}