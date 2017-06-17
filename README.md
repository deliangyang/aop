
### API网关
实现了一个API的网关，方便用户集成自己的第三方API

### [demo](https://github.com/deliangyang/aop/blob/master/test/AopTest.php)
```
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
```

BaseRequest 是一个基类，里面封装了一些公共的方法，和标准参数，

AopClient 是一个Aop的请求客户端，放置一些公共参数，数据加密，数据校验，http请求，response parse的工作
