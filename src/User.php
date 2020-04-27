<?php
namespace Luke\Uc;

/**
 * 用户模块
 */
class User extends Api
{
    /**
     * 注册用户
     * @param string $mobile
     * @param string $code
     * @param string $password
     * @param string $platform
     * @param array $expand
     * @return array
     */
    public function regist($mobile, $code, $password, $platform = '', $expand = [])
    {
        $options = [
            'json'  => [
                'clientId'      => $this->appId,
                'clientSecret'  => $this->secret,
                'sourceClientId'=> $this->appId,
                'sourcePlatform'=> $platform,
                'phone'         => $mobile,
                'code'          => $code,
                'password'      => $password,
                'email'         => $expand['email'] ?: '',
                'nickName'      => $expand['nickname'] ?: '',
                'headPic'       => $expand['headpic'] ?: '',
                'sex'           => $expand['sex'] ?: '',
                'birthday'      => $expand['birthday'] ?: ''
            ]
        ];
        return $this->request('POST', '/api/user/register', $options);
    }
    
    /**
     * 获取用户信息
     * @param string $accessToken
     * @return array
     */
    public function getInfo($accessToken)
    {
        $options = [
            'headers'   => [
                'Authorization' => 'Bearer '.$accessToken
            ]
        ];
        return $this->request('GET', '/api/user/info', $options);
    }
    
    /**
     * 修改用户信息
     * @param string $accessToken
     * @param string $expand
     * @return array
     */
    public function updateInfo($accessToken, $expand)
    {
        $options = [
            'headers'   => [
                'Authorization' => 'Bearer '.$accessToken
            ],
            'json'  => []
        ];
        if (!empty($expand['email'])) {
            $options['json']['email'] = $expand['email'];
        }
        if (!empty($expand['nickName'])) {
            $options['json']['nickName'] = $expand['nickName'];
        }
        if (!empty($expand['headPic'])) {
            $options['json']['headPic'] = $expand['headPic'];
        }
        if (!empty($expand['sex'])) {
            $options['json']['sex'] = $expand['sex'];
        }
        if (!empty($expand['birthday'])) {
            $options['json']['birthday'] = $expand['birthday'];
        }
        return $this->request('POST', '/api/user/info', $options);
    }
    
    /**
     * 绑定第三方开放平台
     * @param string $accessToken
     * @param string $bindKey
     * @param string $bindSource
     * @return array
     */
    public function bindOpenPlatform($accessToken, $bindKey, $bindSource)
    {
        $options = [
            'headers'   => [
                'Authorization' => 'Bearer '.$accessToken
            ],
            'json'  => []
        ];
        switch ($bindSource) {
            case 'wechat':
                $options['json']['wechatThirdKey'] = $bindKey;
                break;
            case 'qq':
                $options['json']['qqThirdKey'] = $bindKey;
                break;
            case 'wechat':
                $options['json']['appleThirdKey'] = $bindKey;
                break;
        }
        return $this->request('POST', '/api/user/info', $options);
    }
    
    /**
     * 修改用户密码(验证旧密码)
     * @param string $accessToken
     * @param string $old
     * @param string $new
     * @return array
     */
    public function updateUserPassword($accessToken, $old, $new)
    {
        $options = [
            'headers'   => [
                'Authorization' => 'Bearer '.$accessToken
            ],
            'json'  => [
                'oldPw' => $old,
                'newPw' => $new
            ]
        ];
        return $this->request('POST', '/api/user/resetByOldPw', $options);
    }
    
    /**
     * 忘记密码(验证手机验证码)
     * @param string $mobile
     * @param string $code
     * @param string $password
     * @return array
     */
    public function forgetPassword($mobile, $code, $password)
    {
        $options = [
            'json'  => [
                'clientId'      => $this->appId,
                'clientSecret'  => $this->secret,
                'phone'         => $mobile,
                'code'          => $code,
                'password'      => $password
            ]
        ];
        return $this->request('POST', '/api/user/resetByCode', $options);
    }
    
}