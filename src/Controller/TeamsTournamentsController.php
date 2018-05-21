<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * TeamsTournaments Controller
 *
 * @property \App\Model\Table\TeamsTournamentsTable $TeamsTournaments
 */
class TeamsTournamentsController extends AppController
{
	/**
	 * byTournament method
	 *
	 * @return void
	 */
	public function byTournament($tournament_id = NULL) {
		$tournament = TableRegistry::get('Tournaments')->find()->where(['id'=>$tournament_id])->first();
		$this->set('tournament', $tournament);
		
		$this->paginate = [
			'limit' => 10,
			'conditions' => ['TeamsTournaments.tournament_id' => $tournament_id],
			'contain' => ['Teams']
		];
		$this->set('teamsTournaments', $this->paginate($this->TeamsTournaments));
		$this->set('_serialize', ['teamstournaments']);
	}
	
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tournaments', 'Teams']
        ];
        $teamsTournaments = $this->paginate($this->TeamsTournaments);

        $this->set(compact('teamsTournaments'));
        $this->set('_serialize', ['teamsTournaments']);
    }

    /**
     * View method
     *
     * @param string|null $id Teams Tournament id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($tournament_id = null, $team_id = null)
    {
    	$query = TableRegistry::get('TeamsTournaments');
    	$teamsTournament = $query->find()->where(['tournament_id'=>$tournament_id, 'team_id'=>$team_id])
    	->contain(['Tournaments', 'Teams'])
    	->first();

        $this->set('teamsTournament', $teamsTournament);
        $this->set('_serialize', ['teamsTournament']);
        // Paginate the Fixtures
        $this->paginate = [
        		'Fixtures' => [
            			'contain' => [
            				'Tournaments'=>['fields'=>['id','name']], 
            				'TeamAs'=>['fields'=>['id','name']], 
            				'TeamBs'=>['fields'=>['id','name']],
            				'Statuses'=>['fields'=>['id','name']]
						],
        				'limit'=>10,
        				'order'=>['date asc'],
        				'conditions' =>
        				['Fixtures.tournament_id' => $tournament_id,
        						'(Fixtures.team_a_id = '. $team_id . ' or Fixtures.team_b_id = '. $team_id .')'
        				]
        		]
        ];
        $fixtures = $this->paginate('Fixtures');
        // Make Fixtures available to the view
        $this->set(compact('fixtures'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $teamsTournament = $this->TeamsTournaments->newEntity();
        if ($this->request->is('post')) {
            $teamsTournament = $this->TeamsTournaments->patchEntity($teamsTournament, $this->request->data);
            if ($this->TeamsTournaments->save($teamsTournament)) {
                $this->Flash->success(__('The teams tournament has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The teams tournament could not be saved. Please, try again.'));
            }
        }
        $tournaments = $this->TeamsTournaments->Tournaments->find('list', ['limit' => 200]);
        $teams = $this->TeamsTournaments->Teams->find('list', ['limit' => 200]);
        $team1s = $this->TeamsTournaments->Team1s->find('list', ['limit' => 200]);
        $team2s = $this->TeamsTournaments->Team2s->find('list', ['limit' => 200]);
        $team3s = $this->TeamsTournaments->Team3s->find('list', ['limit' => 200]);
        $team4s = $this->TeamsTournaments->Team4s->find('list', ['limit' => 200]);
        $team5s = $this->TeamsTournaments->Team5s->find('list', ['limit' => 200]);
        $teamAs = $this->TeamsTournaments->TeamAs->find('list', ['limit' => 200]);
        $teamBs = $this->TeamsTournaments->TeamBs->find('list', ['limit' => 200]);
        $this->set(compact('teamsTournament', 'tournaments', 'teams', 'team1s', 'team2s', 'team3s', 'team4s', 'team5s', 'teamAs', 'teamBs'));
        $this->set('_serialize', ['teamsTournament']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Teams Tournament id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $teamsTournament = $this->TeamsTournaments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $teamsTournament = $this->TeamsTournaments->patchEntity($teamsTournament, $this->request->data);
            if ($this->TeamsTournaments->save($teamsTournament)) {
                $this->Flash->success(__('The teams tournament has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The teams tournament could not be saved. Please, try again.'));
            }
        }
        $tournaments = $this->TeamsTournaments->Tournaments->find('list', ['limit' => 200]);
        $teams = $this->TeamsTournaments->Teams->find('list', ['limit' => 200]);
        $this->set(compact('teamsTournament', 'tournaments', 'teams'));
        $this->set('_serialize', ['teamsTournament']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Teams Tournament id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teamsTournament = $this->TeamsTournaments->get($id);
        if ($this->TeamsTournaments->delete($teamsTournament)) {
            $this->Flash->success(__('The teams tournament has been deleted.'));
        } else {
            $this->Flash->error(__('The teams tournament could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
