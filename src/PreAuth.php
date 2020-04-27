<?php
namespace Luke\Uc;

class PreAuth extends Api
{
    private $app;
    
    public function __construct($app)
    {
        $this->app = $app;
        $this->baseUrl = $this->app->getConfig('base_url');
        $this->appId = $this->app->getConfig('app_id');
        $this->secret = $this->app->getConfig('secret');
    }
    

}