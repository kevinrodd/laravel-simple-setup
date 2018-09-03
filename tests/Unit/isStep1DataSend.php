<?php

namespace Tests\Unit;

use Faker\Provider\Lorem;
use Faker\Provider\Text;
use Illuminate\Support\Facades\Session;
use rowo\LaravelSimpleSetup\SetupController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class isStep1DataSend extends TestCase
{



    public function testIt()
    {
        print "\n\n";
        print "\n---\n";
        print "@@@ isStep1DataSend.php @@@\n\n";

        //Initialize some variables
        $app_name = Lorem::text(20);
        $app_env = Lorem::randomElement(['local','production','testing']);
        $app_debug = (bool)random_int(0, 1) == 1 ? 'true' : 'false';
        $app_auth = (bool)random_int(0, 1) == 1 ? 'true' : 'false';
        $app_key = (new \rowo\LaravelSimpleSetup\SetupController)->getNewAppKey();


        print "√ Start Session and Post to Route ".route("setupStep1"). "\n";
        //Start Session and Post to Route
        Session::start();
        $response = $this->call('POST', route("setupStep1"), array(
            '_token' => csrf_token(),
            'app_name' => $app_name,
            'app_env' => $app_env,
            'app_debug' => $app_debug,
            'app_auth' => $app_auth,
            'app_key' => $app_key,
        ));

        print "√ Check if Post went through \n";
        //Check if Post went through
        $this->assertEquals(200, $response->getStatusCode());

        print "√ Check if Session has the right values \n";
        //Check if Session has the right values
        $response->assertSessionHas(['env.APP_NAME' => '"'.$app_name.'"']);
        $response->assertSessionHas(['env.APP_ENV' => $app_env]);
        $response->assertSessionHas(['env.APP_DEBUG' => $app_debug]);
        $response->assertSessionHas(['env.APP_AUTH' => $app_auth]);
        $response->assertSessionHas(['env.APP_KEY' => $app_key]);

        print "\n---";

    }





}

