<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class isSimpleSetupInstalled extends TestCase
{

    public function testIt()
    {
        print "\n\n";
        print "\n---\n";
        print "@@@ isSimpleSetupInstalled.php @@@\n\n";

        print "√ Check if SimpleSetup is installed and ready \n";
        $response = $this->get('/')->assertSee('Laravel Simple Setup');

        $response->assertStatus(200);

        print "\n---";
    }
}
