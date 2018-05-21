<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FixturesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FixturesTable Test Case
 */
class FixturesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FixturesTable
     */
    public $Fixtures;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fixtures',
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
        'app.teams',
        'app.team_as',
        'app.team_bs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Fixtures') ? [] : ['className' => 'App\Model\Table\FixturesTable'];
        $this->Fixtures = TableRegistry::get('Fixtures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Fixtures);

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
