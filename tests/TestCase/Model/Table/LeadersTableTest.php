<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeadersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeadersTable Test Case
 */
class LeadersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LeadersTable
     */
    public $Leaders;

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
        'app.statuses',
        'app.teams',
        'app.organisers',
        'app.winners',
        'app.users',
        'app.team1s',
        'app.team2s',
        'app.team3s',
        'app.team4s',
        'app.team5s'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Leaders') ? [] : ['className' => 'App\Model\Table\LeadersTable'];
        $this->Leaders = TableRegistry::get('Leaders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Leaders);

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
