<?php
/**
 * Created by unkown ide ps.
 * User: phantom
 * Date Time: 6/14/17 2:55 PM
 */
require_once __DIR__ . '/../vendor/autoload.php';

class IpRequest extends \Aop\ThirdParty\BaseRequest
{

    protected $api_url = 'https://dm-81.data.aliyun.com/rest/160601/ip/getIpInfo.json';

    protected $http_method = 'GET';

    protected $ssl_encrypt = false;

}

use Aop\AopClient;
$aop = new AopClient();

$req = new IpRequest();
$req->setHeader('Authorization', 'APPCODE ' . '40489272c9a24ba3b483f8ecc37cb846');
$req->setParam('ip', '125.82.186.212');
$result = $aop->execute($req);


var_dump($result);