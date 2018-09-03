<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class isStep1Loaded extends TestCase
{

    public function testIt()
    {

        print "\n\n";
        print "\n---\n";
        print "@@@ isStep1Loaded.php @@@\n\n";


        print "√ Check if Step1 View is loaded \n";
        $response = $this->get('/setup')->assertSee('Name your Application');

        $response->assertStatus(200);

        print "\n---";
    }
}
