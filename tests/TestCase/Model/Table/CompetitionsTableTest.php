<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompetitionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompetitionsTable Test Case
 */
class CompetitionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CompetitionsTable
     */
    public $Competitions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.competitions',
        'app.tournaments',
        'app.fixtures',
        'app.teams',
        'app.teams_tournaments',
        'app.organisers',
        'app.winners',
        'app.entries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Competitions') ? [] : ['className' => 'App\Model\Table\CompetitionsTable'];
        $this->Competitions = TableRegistry::get('Competitions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Competitions);

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
