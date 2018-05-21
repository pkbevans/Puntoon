<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TeamsTournamentsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\TeamsTournamentsController Test Case
 */
class TeamsTournamentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.teams_tournaments',
        'app.tournaments',
        'app.competitions',
        'app.organisers',
        'app.entries',
        'app.users',
        'app.team1s',
        'app.team2s',
        'app.team3s',
        'app.team4s',
        'app.team5s',
        'app.statuses',
        'app.winners',
        'app.fixtures',
        'app.team_as',
        'app.team_bs',
        'app.teams'
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
