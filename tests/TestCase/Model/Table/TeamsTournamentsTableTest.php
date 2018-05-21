<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TeamsTournamentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TeamsTournamentsTable Test Case
 */
class TeamsTournamentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TeamsTournamentsTable
     */
    public $TeamsTournaments;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TeamsTournaments') ? [] : ['className' => 'App\Model\Table\TeamsTournamentsTable'];
        $this->TeamsTournaments = TableRegistry::get('TeamsTournaments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TeamsTournaments);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
