<?php

namespace Tests\Unit;

use Faker\Provider\Internet;
use Faker\Provider\Lorem;
use Faker\Provider\Person;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class isStep2DataSend extends TestCase
{


    public function testIt()
    {
        print "\n\n";
        print "\n---\n";
        print "@@@ isStep2DataSend.php @@@\n\n";




        $db_connection = 'mysql';
        print "√ Start testing with ". $db_connection." \n";

        $db_host = Internet::localIpv4();
        $db_port = '3306';
        $db_database = Lorem::word();
        $db_username = Person::firstNameMale();
        $db_password = Lorem::word();

        print "√ Post to Route ".route("setupStep2"). "\n";

        $response = $this->call('POST', route("setupStep2"), array(
            '_token' => csrf_token(),
            'db_connection' => $db_connection,
            'db_host' => $db_host,
            'db_port' => $db_port,
            'db_database' => $db_database,
            'db_username' => $db_username,
            'db_password' => $db_password,
        ));

        print "√ Check if Post went through with ". $db_connection ."\n";


        //Check if Post went through
        $this->assertEquals(200, $response->getStatusCode());

        //Check if Session has the right values
        $response->assertSessionHas(['env.DB_CONNECTION' => $db_connection]);
        $response->assertSessionHas(['env.DB_HOST' => $db_host]);
        $response->assertSessionHas(['env.DB_PORT' => $db_port]);
        $response->assertSessionHas(['env.DB_DATABASE' => $db_database]);
        $response->assertSessionHas(['env.DB_USERNAME' => $db_username]);
        $response->assertSessionHas(['env.DB_PASSWORD' => $db_password]);



        $db_connection = 'postgresql';
        print "√ Start testing with ". $db_connection." \n";

        $db_host = Internet::localIpv4();
        $db_port = '5432';
        $db_database = Lorem::word();
        $db_username = Person::firstNameMale();
        $db_password = Lorem::word();


        print "√ Post to Route ".route("setupStep2"). "\n";

        $response = $this->call('POST', route("setupStep2"), array(
            '_token' => csrf_token(),
            'db_connection' => $db_connection,
            'db_host' => $db_host,
            'db_port' => $db_port,
            'db_database' => $db_database,
            'db_username' => $db_username,
            'db_password' => $db_password,
        ));

        print "√ Check if Post went through with ". $db_connection ."\n";


        //Check if Post went through
        $this->assertEquals(200, $response->getStatusCode());

        //Check if Session has the right values
        $response->assertSessionHas(['env.DB_CONNECTION' => $db_connection]);
        $response->assertSessionHas(['env.DB_HOST' => $db_host]);
        $response->assertSessionHas(['env.DB_PORT' => $db_port]);
        $response->assertSessionHas(['env.DB_DATABASE' => $db_database]);
        $response->assertSessionHas(['env.DB_USERNAME' => $db_username]);
        $response->assertSessionHas(['env.DB_PASSWORD' => $db_password]);



        $db_connection = 'sqlite';
        print "√ Start testing with ". $db_connection." \n";

        $db_database = Lorem::word();


        print "√ Post to Route ".route("setupStep2"). "\n";


        $response = $this->call('POST', route("setupStep2"), array(
            '_token' => csrf_token(),
            'db_connection' => $db_connection,
            'db_database' => $db_database,
        ));

        print "√ Check if Post went through with ". $db_connection ."\n";


        //Check if Post went through
        $this->assertEquals(200, $response->getStatusCode());

        //Check if Session has the right values
        $response->assertSessionHas(['env.DB_CONNECTION' => $db_connection]);
        $response->assertSessionHas(['env.DB_DATABASE' => $db_database]);

        //Check if SQLite File exists
        print "√ Check if SQLite File exist in folder \n";
        $fileExist = File::exists(database_path().DIRECTORY_SEPARATOR.$db_database.'.sqlite');

        $this->assertTrue($fileExist);

        $fileExist ?   print "√ File exists and will be deleted after Unit Test ". $db_connection ."\n" : false;
        $fileExist ? File::delete(database_path().DIRECTORY_SEPARATOR.$db_database.'.sqlite') : false;

        print "\n---";

    }




}

