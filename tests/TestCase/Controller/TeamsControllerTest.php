<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TeamsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\TeamsController Test Case
 */
class TeamsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.teams',
        'app.tournaments',
        'app.competitions',
        'app.organisers',
        'app.winners',
        'app.entries',
        'app.users',
        'app.team1s',
        'app.teams_tournaments',
        'app.team2s',
        'app.team3s',
        'app.team4s',
        'app.team5s',
        'app.statuses',
        'app.fixtures'
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
