<?php
namespace Luke\Uc;

/**
 * 开放认证模块
 */
class Oauth extends Api
{
    /**
     * 获取用户token(密码模式)
     * @param string $username
     * @param string $password
     * @return array
     */
    public function getTokenByPassword($username, $password)
    {
        $options = [
            'json'  => [
                'clientId'      => $this->appId,
                'clientSecret'  => $this->secret,
                'grantType'     => 'pwd',
                'phone'         => $username,
                'password'      => $password
            ]
        ];
        return $this->request('POST', '/api/auth/token', $options);
    }
    
    /**
     * 获取用户token(手机验证码模式)
     * @param string $mobile
     * @param string $code
     * @return array
     */
    public function getTokenBySms($mobile, $code)
    {
        $options = [
            'json'  => [
                'clientId'      => $this->appId,
                'clientSecret'  => $this->secret,
                'grantType'     => 'sms',
                'phone'         => $mobile,
                'code'          => $code
            ]
        ];
        return $this->request('POST', '/api/auth/token', $options);
    }
    
    /**
     * 获取用户token(第三方绑定模式)
     * @param string $mobile
     * @param string $bindKey
     * @param string $bindSource
     * @return array
     */
    public function getTokenByBind($mobile, $bindKey, $bindSource)
    {
        $options = [
            'json'  => [
                'clientId'      => $this->appId,
                'clientSecret'  => $this->secret,
                'grantType'     => 'third_party',
                'phone'         => $mobile,
                'thirdType'     => $bindSource,
                'thirdKey'      => $bindKey
            ]
        ];
        return $this->request('POST', '/api/auth/token', $options);
    }
    
    /**
     * 刷新用户token
     * @param string $mobile
     * @param string $refreshToken
     * @return array
     */
    public function refreshToken($mobile, $refreshToken)
    {
        $options = [
            'json'  => [
                'clientId'      => $this->appId,
                'clientSecret'  => $this->secret,
                'grantType'     => 'refresh_token',
                'phone'         => $mobile,
                'refreshToken'  => $refreshToken
            ]
        ];
        return $this->request('POST', '/api/auth/token', $options);
    }
    
}