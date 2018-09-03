<?php

namespace Tests\Unit;

use Faker\Provider\Internet;
use Faker\Provider\Lorem;
use Faker\Provider\Text;
use Illuminate\Support\Facades\Session;
use rowo\LaravelSimpleSetup\SetupController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class isStep3DataSend extends TestCase
{



    public function testIt()
    {
        print "\n\n";
        print "\n---\n";
        print "@@@ isStep3DataSend.php @@@\n\n";

        //Initialize some variables
        $broadcast_driver = Lorem::randomElement(['log','pusher','redis']);
        $cache_driver = Lorem::randomElement(['file','memcached','redis']);
        $session_driver = Lorem::randomElement(['file','memcached','redis']);
        $session_lifetime = random_int(60, 240);
        $queue_driver = Lorem::randomElement(['sync','beanstalkd','amazonsqs','redis']);

        $redis_host = Internet::localIpv4();
        $redis_password = Lorem::word();
        $redis_port = "6379";

        $mail_driver = Lorem::randomElement(['sendmail','smtp','mailgun','mandrill','sparkpost','amazonses']);
        $mail_host = Internet::localIpv4();
        $mail_port = "2525";
        $mail_username = Lorem::word();
        $mail_password = Lorem::word();
        $mail_encryption = Lorem::word();

        $pusher_app_id = random_int(1000000,9999999);
        $pusher_app_key = random_int(1000000,9999999);
        $pusher_app_secret = random_int(1000000,9999999);
        $pusher_app_cluster = "mt1";

        print "√ Post to Route ".route("setupStep3"). "\n";
        //Start Session and Post to Route
        Session::start();
        $response = $this->call('POST', route("setupStep3"), array(
            '_token' => csrf_token(),
            'broadcast_driver' => $broadcast_driver,
            'cache_driver' => $cache_driver,
            'session_driver' => $session_driver,
            'session_lifetime' => $session_lifetime,
            'queue_driver' => $queue_driver,
            'redis_host' => $redis_host,
            'redis_password' => $redis_password,
            'redis_port' => $redis_port,
            'mail_driver' => $mail_driver,
            'mail_host' => $mail_host,
            'mail_port' => $mail_port,
            'mail_username' => $mail_username,
            'mail_password' => $mail_password,
            'mail_encryption' => $mail_encryption,
            'pusher_app_id' => $pusher_app_id,
            'pusher_app_key' => $pusher_app_key,
            'pusher_app_secret' => $pusher_app_secret,
            'pusher_app_cluster' => $pusher_app_cluster,
        ));

        print "√ Check if Post went through \n";
        //Check if Post went through
        $this->assertEquals(200, $response->getStatusCode());

        print "√ Check if Session has the right values \n";
        //Check if Session has the right values
        $response->assertSessionHas(['env.BROADCAST_DRIVER' => $broadcast_driver]);
        $response->assertSessionHas(['env.CACHE_DRIVER' => $cache_driver]);
        $response->assertSessionHas(['env.SESSION_DRIVER' => $session_driver]);
        $response->assertSessionHas(['env.SESSION_LIFETIME' => $session_lifetime]);
        $response->assertSessionHas(['env.QUEUE_DRIVER' => $queue_driver]);
        $response->assertSessionHas(['env.REDIS_HOST' => $redis_host]);
        $response->assertSessionHas(['env.REDIS_PORT' => $redis_port]);
        $response->assertSessionHas(['env.MAIL_DRIVER' => $mail_driver]);
        $response->assertSessionHas(['env.MAIL_HOST' => $mail_host]);
        $response->assertSessionHas(['env.MAIL_PORT' => $mail_port]);
        $response->assertSessionHas(['env.MAIL_USERNAME' => $mail_username]);
        $response->assertSessionHas(['env.MAIL_PASSWORD' => $mail_password]);
        $response->assertSessionHas(['env.MAIL_ENCRYPTION' => $mail_encryption]);
        $response->assertSessionHas(['env.PUSHER_APP_ID' => $pusher_app_id]);
        $response->assertSessionHas(['env.PUSHER_APP_KEY' => $pusher_app_key]);
        $response->assertSessionHas(['env.PUSHER_APP_SECRET' => $pusher_app_secret]);
        $response->assertSessionHas(['env.PUSHER_APP_CLUSTER' => $pusher_app_cluster]);

        print "\n---";

    }





}

