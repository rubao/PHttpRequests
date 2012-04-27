<?php

namespace PHttpRequests\SimpleCurl;

class RequestInformation
{
    public $url = null;
    public $contentType = null;
    public $httpCode = null;
    public $requestSize = null;
    public $fileTime = null;
    public $sslVerifyResult = null;
    public $redirectCount = null;
    public $totalTime = null;
    public $nameLookupTime = null;
    public $connectTime = null;
    public $preTransferTime = null;
    public $sizeUpload = null;
    public $sizeDownload = null;
    public $speedDownload = null;
    public $speedUpload = null;
    public $downloadContentLength = null;
    public $uploadContentLength = null;
    public $startTransferTime = null;
    public $redirectTime = null;
    public $requestHeader = null;
    public $certificateInformation = null;

    private $requestInformationKeys = array(
        'certinfo',
        'connect_time',
        'content_type',
        'download_content_length',
        'filetime',
        'http_code',
        'namelookup_time',
        'pretransfer_time',
        'redirect_count',
        'redirect_time',
        'request_header',
        'request_size',
        'size_download',
        'size_upload',
        'speed_upload',
        'speed_download',
        'ssl_verify_result',
        'starttransfer_time',
        'total_time',
        'upload_content_length',
        'url'
    );

    public function __construct(array $requestInformation)
    {
        $requestInformation = $this->getSanitizedRequestInformationInputArray($requestInformation);

        $this->certificateInformation = $requestInformation['certinfo'];
        $this->connectTime = $requestInformation['connect_time'];
        $this->contentType = $requestInformation['content_type'];
        $this->downloadContentLength = $requestInformation['download_content_length'];
        $this->fileTime = $requestInformation['filetime'];
        $this->httpCode = $requestInformation['http_code'];
        $this->nameLookupTime = $requestInformation['namelookup_time'];
        $this->preTransferTime = $requestInformation['pretransfer_time'];
        $this->redirectCount = $requestInformation['redirect_count'];
        $this->redirectTime = $requestInformation['redirect_time'];
        $this->requestHeader = $requestInformation['request_header'];
        $this->requestSize = $requestInformation['request_size'];
        $this->sizeDownload = $requestInformation['size_download'];
        $this->sizeUpload = $requestInformation['size_upload'];
        $this->speedDownload = $requestInformation['speed_download'];
        $this->speedUpload = $requestInformation['speed_upload'];
        $this->sslVerifyResult = $requestInformation['ssl_verify_result'];
        $this->startTransferTime = $requestInformation['starttransfer_time'];
        $this->totalTime = $requestInformation['total_time'];
        $this->uploadContentLength = $requestInformation['upload_content_length'];
        $this->url = $requestInformation['url'];
    }

    private function getSanitizedRequestInformationInputArray(array $requestInformationInput)
    {
        $sanitizedInput = array();

        foreach($this->requestInformationKeys as $key) {
            if (!isset($requestInformationInput[$key])) {
                $sanitizedInput[$key] = null;
            } else {
                $sanitizedInput[$key] = $requestInformationInput[$key];
            }
        }

        return $sanitizedInput;
    }
}