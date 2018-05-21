<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LeadersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\LeadersController Test Case
 */
class LeadersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.leaders',
        'app.entries',
        'app.competitions',
        'app.tournaments',
        'app.fixtures',
        'app.team_as',
        'app.teams_tournaments',
        'app.team_bs',
        'app.teams',
        'app.team1s',
        'app.team2s',
        'app.team3s',
        'app.team4s',
        'app.team5s',
        'app.statuses',
        'app.organisers',
        'app.winners',
        'app.users'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
