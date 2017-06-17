<?php
/**
 * Created by unkown ide ps.
 * User: phantom
 * Date Time: 6/14/17 4:04 PM
 */
namespace Aop\ThirdParty;

class BaseRequest
{

    /**
     * api
     * @var string
     */
    protected $api_url;

    /**
     * 异步通知地址
     * @var string
     */
    protected $notify_url;

    /**
     * 回跳地址
     * @var string
     */
    protected $redirect_url;

    /**
     * http 请求方法
     * @var string
     */
    protected $http_method = 'POST';

    protected $response_format = 'json';

    protected $header = array();

    protected $ssl_encrypt = false;

    public function setSSLEncrypt(bool $ssl_encrypt)
    {
        $this->ssl_encrypt = $ssl_encrypt;
    }

    public function getSSLEncrypt()
    {
        return $this->ssl_encrypt;
    }

    public function setHeader($name, $value)
    {
        $this->header[$name] = $value;
    }

    public function delHeader($name)
    {
        if (isset($this->header[$name])) {
            unset($this->header[$name]);
        }
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    public function setParams(array $extra_params)
    {
        $this->params = array_merge($extra_params, $this->params);
    }

    /**
     * 请求参数
     * @var array
     */
    protected $params = array();


    public function getApiParams()
    {
        return $this->params;
    }

    public function setApiUrl($api_url)
    {
        $this->api_url = $api_url;
    }

    public function getApiUrl()
    {
        return $this->api_url;
    }

    public function setNotifyUrl($notify_url)
    {
        $this->notify_url = $notify_url;
    }

    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    public function setHttpMethod($http_method)
    {
        $this->http_method = $http_method;
    }

    public function getHttpMethod()
    {
        return strtoupper($this->http_method);
    }


    public function setRedirectUrl($redirect_url)
    {
        $this->redirect_url = $redirect_url;
    }

    public function getRedirectUrl()
    {
        return $this->redirect_url;
    }

    public function setResponseFormat($response_format)
    {
        $this->response_format = $response_format;
    }

    public function getResponseFormat()
    {
        return strtolower($this->response_format);
    }

}
