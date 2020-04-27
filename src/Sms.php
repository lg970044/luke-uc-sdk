<?php
namespace Luke\Uc;

/**
 * 短信模块
 */
class Sms extends Api
{
    // 发送验证码
    /**
     * 
     * @param string $mobile
     * @param string $type
     * @param string $platform
     * @return array
     */
    public function sendCode($mobile, $type = '', $platform = '')
    {
        $options = [
            'json'  => [
                'clientId'      => $this->appId,
                'clientSecret'  => $this->secret,
                'phone'         => $mobile,
                'type'          => $type,
                'sourcePlatform'=> $platform
            ]
        ];
        return $this->request('POST', '/api/user/smsCode', $options);
    }
    
}