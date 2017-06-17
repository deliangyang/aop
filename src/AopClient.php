<?php
/**
 * Created by unkown ide ps.
 * User: phantom
 * Date Time: 6/14/17 2:45 PM
 */
namespace Aop;

use Aop\Exception\HttpMethodAffectiveException;
use Aop\Exception\ParseFormatNotExistException;
use Aop\ThirdParty\BaseRequest;
use Aop\Utils\AopEncrypt;
use Aop\Exception\AopEncryptException;
use Aop\Utils\Curl;
use Aop\Utils\Parse;

class AopClient
{

    /**
     * rename app id name
     * @var string
     */
    public $app_id_name;

    /**
     * 应用的ID
     * @var string
     */
    public $app_id;

    /**
     * rename app secret name
     * @var string
     */
    public $app_secret_name;

    /**
     * 应用的密钥
     * @var string
     */
    public $app_secret;

    /**
     * 是否需要提取data字段
     * @var bool
     */
    public $extract_data = false;

    /**
     * 参数
     * @var array
     */
    public $data = array();

    /**
     * 是否需要提取extra_data字段
     * @var bool
     */
    public $extract_extra_data = false;

    /**
     * 额外数据
     * @var array
     */
    public $extra_data = array();

    /**
     * 返回格式
     * @var string
     */
    public $format = 'xml';

    /**
     * 加密协议
     * @var string
     */
    public $sign_type = 'md5';

    /**
     * 数据是否需要加密
     * @var bool
     */
    public $need_sign = true;

    /**
     * 执行请求
     *
     * @param BaseRequest $request
     * @return string
     */
    public function execute(BaseRequest $request)
    {
        $params = $request->getApiParams();

        if ($this->need_sign) {
            // todo need sign
        }
        // prev parse params
        $sys_params = array();
        $params = array_merge($sys_params, $params);

        // request and get response
        $result = $this->curl($params, $request);

        // parse response
        if ($this->format == 'json') {
            if ($request->getResponseFormat() == 'xml') {
                $result = Parse::xml2json($result);
            }
        } else if ($this->format == 'xml') {
            if ($request->getResponseFormat() == 'json') {
                $result = Parse::json2xml($result);
            }
        }

        // 数据校验
        return $result;
    }

    /**
     * 数据加密
     *
     * @param $data
     * @param string $signType
     * @return mixed
     * @throws AopEncryptException
     */
    protected function sign($data, $signType = 'md5')
    {
        $encrypt = new AopEncrypt();

        if (!method_exists($encrypt, $signType)) {
            throw new AopEncryptException();
        }

        return $encrypt->{$signType}($data);
    }

    protected function curl($params, BaseRequest $request)
    {
        $curl = new Curl();

        // prev curl option
        foreach ($request->getHeader() as $name => $value) {
            $curl->setHeader($name, $value);
        }

        if (!$request->getSSLEncrypt()) {
            $curl->setSSLVerify(false);
        }


        $http_method = array('POST', 'GET', 'DELETE', 'PUT');
        $http_method = array_combine($http_method, $http_method);

        $method = $request->getHttpMethod();

        if (!isset($http_method[$method])
            || !method_exists($curl, $method)) {
            throw new HttpMethodAffectiveException();
        }

        $result = $curl->{$method}($request->getApiUrl(), $params);

        return $result->response;
    }

    /**
     * 校验$value是否非空
     *
     * @param $value
     * @return bool
     */
    protected function checkEmpty($value)
    {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;

        return false;
    }

}