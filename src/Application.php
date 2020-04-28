<?php
namespace Luke\Uc;
use Hanson\Foundation\Foundation;

/**
 * Class Application
 * @package Luke\Uc
 *
 * @property \Luke\Uc\Sms       $sms
 * @property \Luke\Uc\User      $user
 * @property \Luke\Uc\Oauth     $oauth
 */
class Application extends Foundation
{
    protected $providers = [
        ServiceProvider::class
    ];
}