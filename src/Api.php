<?php
namespace Luke\Uc;
use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    // 接口参数
    protected $app;
    protected $baseUrl;
    protected $appId;
    protected $secret;
    
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->baseUrl = $this->app->getConfig('base_url');
        $this->appId = $this->app->getConfig('app_id');
        $this->secret = $this->app->getConfig('secret');
    }
    
    /**
     * 接口请求
     * @param string $method
     * @param string $url
     * @param array $options
     * @return array
     */
    public function request($method, $url, $options)
    {
        $result = [
            'flag'      => false,
            'code'      => -1,
            'message'   => '连接失败',
            'data'      => []
        ];
        $response = null;
        try{
            $response = $this->getHttp()->request($method, $this->baseUrl.$url, $options);
        } catch (\GuzzleHttp\Exception\RequestException $e){
            if ($e->hasResponse()) {
                $response = $e->getResponse();
            }
        }
        if ($response) {
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                // 请求成功
                $result = \json_decode($response->getBody(), true);
            } else {
                // 请求失败
                $result['code'] = $statusCode;
                switch ($statusCode) {
                    case 400:
                        $result['message'] = '参数错误';
                        break;
                    case 401:
                        $result['message'] = '未授权';
                        break;
                    case 402:
                        $result['message'] = '授权过期';
                        break;
                    case 403:
                        $result['message'] = '授权禁止';
                        break;
                    case 429:
                        $result['message'] = '请求拒绝';
                        break;
                    case 500:
                        $result['message'] = '服务器错误';
                        break;
                    case 501:
                        $result['message'] = '功能未实现';
                        break;
                    case 503:
                        $result['message'] = '服务不可用';
                        break;
                    default:
                        $result['message'] = '未定义错误';
                }
            }
        }
        
        return $result;
    }
    
    
}