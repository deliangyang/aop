<?php
/**
 * Created by unkown ide ps.
 * User: phantom
 * Date Time: 6/14/17 5:20 PM
 */
namespace Aop\Utils;

class Curl extends \Curl\Curl
{

    public function __construct()
    {
        parent::__construct();
    }

    public function setSSLVerify($ssl_verify = false, $ca_info = '', $ssl_cert = '', $ssl_password = '')
    {
        if (!$ssl_verify) {
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
        } else {
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, true);

            curl_setopt($this->curl, CURLOPT_CAINFO,  $ca_info);
            curl_setopt($this->curl, CURLOPT_SSLCERT, $ssl_cert);
            if ($ssl_password) {
                curl_setopt($this->curl, CURLOPT_SSLCERTPASSWD, $ssl_password);
            }
        }
    }
}
