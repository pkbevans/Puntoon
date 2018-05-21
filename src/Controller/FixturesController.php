<?php
namespace App\Controller;


use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Http\Client;
use Cake\Datasource\ConnectionManager;


/**
 * Fixtures Controller
 *
 * @property \App\Model\Table\FixturesTable $Fixtures
 */
class FixturesController extends AppController
{
	/**
	 * byTournament method
	 *
	 * @return void
	 */
	public function byTournament($tournamentId = NULL) {
	    // Only visible to administrators
    	if($this->Auth->User('role')!= 'admin'){
    		$this->Flash->error(__('Sorry. You do not have permission!'));
    		return $this->redirect($this->referer());
    	}

    	// Filtering...
    	if($this->request->query('showAll')){
			$conditions = ['Fixtures.tournament_id' => $tournamentId];
       		$this->set('showAll', 1);
    	}
    	else{
			$conditions = ['Fixtures.tournament_id' => $tournamentId, 'Fixtures.status_id<2'];
       	}
       	
		$this->paginate = [
				'conditions' => $conditions,
				'limit' => 5,
				'order' => ['date asc'],
            'contain' => ['Tournaments', 'TeamAs', 'TeamBs', 'Statuses']				
		];
		$fixtures = $this->paginate ( $this->Fixtures);
		$this->set ( 'fixtures', $fixtures );
		// Set Tournament details
		$tournament = TableRegistry::get('Tournaments')->find()->where(['id'=>$tournamentId])->first();
		$this->set('tournament', $tournament);
	}
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
    	// Only visible to administrators
    	if($this->Auth->User('role')!= 'admin'){
    		$this->Flash->error(__('Sorry. You do not have permission!'));
    		return $this->redirect($this->referer());
    	}
    		
    	// Filtering...
    	if($this->request->query('showAll')){
    		$conditions='';
    		$this->set('showAll', 1);
       	}
    	else{
    		$conditions='Fixtures.status_id<2';
    	}
    	$this->paginate = [
        	'conditions'=>$conditions,
    		'limit' => 10,
        	'contain' => ['Tournaments', 'TeamAs', 'TeamBs', 'Statuses'],
			'order' => ['date asc, TeamAs.name']
		];
        $fixtures = $this->paginate($this->Fixtures);

        $this->set(compact('fixtures'));
        $this->set('_serialize', ['fixtures']);
        // set up Tournaments - for selector
		$this->set('tournaments', $this->Fixtures->Tournaments->find('list'));
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function all()
    {
		// Only visible to administrators
		if($this->Auth->User('role')!= 'admin'){
			$this->Flash->error(__('Sorry. You do not have permission!'));
			return $this->redirect($this->referer());
		}

		$this->paginate = [
			'limit' =>999,
			'contain' => ['Tournaments', 'TeamAs', 'TeamBs', 'Statuses'],
			'order' => ['date asc, TeamAs.name']
			];
		$fixtures = $this->paginate($this->Fixtures);

		$this->set(compact('fixtures'));
		$this->set('_serialize', ['fixtures']);
		// set up Tournaments - for selector
    	$this->set('tournaments', $this->Fixtures->Tournaments->find('list'));
    }
    
    
    /**
     * View method
     *
     * @param string|null $id Fixture id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fixture = $this->Fixtures->get($id, [
            'contain' => ['Tournaments', 'TeamAs', 'TeamBs', 'Statuses']
        ]);

        $this->set('fixture', $fixture);
        $this->set('_serialize', ['fixture']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($pageNo = null)
    {
        $fixture = $this->Fixtures->newEntity();
        if ($this->request->is('post')) {
            $fixture = $this->Fixtures->patchEntity($fixture, $this->request->data);
            if ($this->Fixtures->save($fixture)) {
                $this->Flash->success(__('The fixture has been saved.'));

                return $this->redirect(['action' => 'index', 'page' => $pageNo]);
            } else {
                $this->Flash->error(__('The fixture could not be saved. Please, try again.'));
            }
        }
        $tournaments = $this->Fixtures->Tournaments->find('list', ['limit' => 200]);
        $teamAs = $this->Fixtures->TeamAs->find('list', ['limit' => 200]);
        $teamBs = $this->Fixtures->TeamBs->find('list', ['limit' => 200]);
        $statuses = $this->Fixtures->Statuses->find('list', ['limit' => 200]);
        $this->set(compact('fixture', 'tournaments', 'teamAs', 'teamBs', 'statuses'));
        $this->set('_serialize', ['fixture']);
    }

    /**
     * results method
     *
     * @return void
     */
    public function results($tournamentId = NULL) {
    	// Only visible to administrators
    	if($this->Auth->User('role')!= 'admin'){
    		$this->Flash->error(__('Sorry. You do not have permission!'));
    		return $this->redirect($this->referer());
    	}
        // Filtering...
    	if($this->request->query('showAll')){
    		$conditions = [];
    		$this->set('showAll', 1);
       	}
    	else{
    		$conditions='Fixtures.status_id<2';
    	}
    	$this->paginate = [
	    	'conditions' => $conditions,
    		'limit' => 5,
    		'order' => ['date asc'],
    		'contain' => ['Tournaments', 'TeamAs', 'TeamBs', 'Statuses']
    	];
    	$fixtures = $this->paginate ( $this->Fixtures);
    	$this->set ( 'fixtures', $fixtures );
    	// Set Tournament details
    	$tournament = TableRegistry::get('Tournaments')->find()->where(['id'=>$tournamentId])->first();
    	$this->set('tournament', $tournament);
    }
    
    
    /**
     * editResult method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function editResult($id = null, $pageNo = null, $showAll = null) {
        	// Only visible to administrators
    	if($this->Auth->User('role')!= 'admin'){
    		$this->Flash->error(__('Sorry. You do not have permission!'));
    		return $this->redirect($this->referer());
    	}
    	$fixture = $this->Fixtures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$fixture = $this->Fixtures->patchEntity($fixture, $this->request->data);
            $fixture->status_id = 2;	// FULL TIME
        	if ($this->Fixtures->save($fixture)) {
    			$tournamentId = $fixture->tournament_id;
    			$this->Flash->success(__('The fixture has been saved.'));
    
    			return $this->redirect(array('action' => 'results',$tournamentId, '?' => ['page' => $pageNo, 'showAll' => $showAll]));
        	} else {
        		$this->Flash->error(__('The fixture could not be saved. Please, try again.'));
        		debug($fixture->errors());
        	}
        }
        
    	$this->set(compact('fixture'));
    	 
    	$tournament = TableRegistry::get('Tournaments')->find()->where(['id'=>$fixture->tournament_id])->first();
    	$teamA = TableRegistry::get('Teams')->find()->where(['id'=>$fixture->team_a_id])->first();
    	$teamB = TableRegistry::get('Teams')->find()->where(['id'=>$fixture->team_b_id])->first();
    	$statuses = $this->Fixtures->Statuses->find('list');
    	$this->set(compact('tournament', 'teamA', 'teamB', 'statuses'));
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Fixture id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fixture = $this->Fixtures->get($id);
        if ($this->Fixtures->delete($fixture)) {
            $this->Flash->success(__('The fixture has been deleted.'));
        } else {
            $this->Flash->error(__('The fixture could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    /**
     * editResult method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null, $pageNo = null) {
        	// Only visible to administrators
    	if($this->Auth->User('role')!= 'admin'){
    		$this->Flash->error(__('Sorry. You do not have permission!'));
    		return $this->redirect($this->referer());
    	}
    	$fixture = $this->Fixtures->get($id, [
    			'contain' => []
    			]);
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		$fixture = $this->Fixtures->patchEntity($fixture, $this->request->data);
    		if ($this->Fixtures->save($fixture)) {
    			$this->Flash->success(__('The fixture has been saved.'));
    			return $this->redirect(array('action' => 'index','page' => $pageNo));
       		} else {
    			$this->Flash->error(__('The fixture could not be saved. Please, try again.'));
    			debug($fixture->errors());
    		}
    	}
    
    	$this->set(compact('fixture'));
    
    	$tournaments = TableRegistry::get('Tournaments')->find('list');
    	$teamA = TableRegistry::get('Teams')->find()->where(['id'=>$fixture->team_a_id])->first();
    	$teamB = TableRegistry::get('Teams')->find()->where(['id'=>$fixture->team_b_id])->first();
    	$statuses = $this->Fixtures->Statuses->find('list');
    	$this->set(compact('tournaments', 'teamA', 'teamB', 'statuses'));
    }
    public function autoUpdate(){
 		// Only visible to administrators
    	if($this->Auth->User('role')!= 'admin'){
    		$this->Flash->error(__('Sorry. You do not have permission!'));
    		return $this->redirect($this->referer());
    	}

    	if ($this->request->is(['post'])) {
//     		debug($this->request);
//	426
    		$league=$this->request->data['comp'];
    		$days=$this->request->data['days'];
    		if($days>0){
	    		if($this->request->data['future']){
	    			$direction="n";
	    		}else{
    				$direction="p";
    			}
    			$timeframe="?timeFrame=".$direction.$days;
    		}else{
    			$timeframe="";
    		}
//     		debug($timeframe);
    		$apiKey='2df7e1f5e2654abd9abe9fd0f79efffa';
    		$uri = 'https://api.football-data.org/v1/competitions/' . $league . '/fixtures'.$timeframe;
   			$http = new Client();
//     		Simple get with querystring & additional headers
    		$response = $http->get($uri, null, [
    				'headers' => ['X-Auth-Token' => $apiKey]
    		]);
    		$fixtures  = $response->json['fixtures'];
// 			$fixtures = [
// 					["_links"=>["self"=>["href"=>"http://api.football-data.org/v1/fixtures/150841"],"competition"=>["href"=>"http://api.football-data.org/v1/competitions/426"],"homeTeam"=>["href"=>"http://api.football-data.org/v1/teams/332"],"awayTeam"=>["href"=>"http://api.football-data.org/v1/teams/338"]],"date"=>"2016-08-13T11:30:00Z","status"=>"FINISHED","matchday"=>1,"homeTeamName"=>"Hull City FC","awayTeamName"=>"Leicester City FC","result"=>["goalsHomeTeam"=>2,"goalsAwayTeam"=>1],"odds"=>["homeWin"=>3.25,"draw"=>3.25,"awayWin"=>2.2]]];
			$index=0;
			foreach ($fixtures as $fixture){
// 				debug($fixture);
				$ret = $this->updateFixture($fixture, $league);
				// Add the action into the Fixtures array
				$fixtures[$index]['action']=$this->actions[$ret];
// 				debug($fixture);
				$index++;
			}
// 			debug($fixtures);
		
    		$this->set(compact('fixtures'));
    	}
    }

    public $NO_UPDATE = 0;
    public $ERROR = 1;
    public $DATE_UPDATED = 2;
    public $SCORE_UPDATED = 3;
    public $NEW_FIXTURE = 4;
    public $SCORE_NOT_UPDATED = 5;
    public $SCORE_MISMATCH = 6;
    public $NO_TOURNAMENT = 7;
    public $BAD_TEAM = 8;
    public $STATUS_FULL_TIME = 2;
    public $STATUS_NEW_FIXTURE = 9;	// Must be same as entry in db.statuses table
    public $actions = ["No Update","ERROR", "Date Updated", "Score Updated", "New Fixture","Score Not Updated", "Score Mismatch","No Tournament", "Unknown Team"];
    
    /*	function updateFixture($apiFixture)
     * 
     *  This function updates either the date OR the score OR no update.
     *  It NEVER updates both at the same time.
     *  
     *  Return values:
     *  	0=no upate
     *  	1=ERROR
     *  	2=date changed
     *  	3=result updated
	 *		4=new fixture added (score not updated)
     *  	5=score not updated (status == 9)
     *  	6=Score mismatch
     *  	7=No Tournament
     *  	8=Unknown Team
     */
    function updateFixture($apiFixture = NULL, $league = NULL){
    	// Get API team Ids
    	$url=$apiFixture['_links']['homeTeam']['href'];
    	$apiTeamAId=substr($url, strrpos($url, "/") + 1);
//     	debug("home:".$apiTeamAId);
    	$url=$apiFixture['_links']['awayTeam']['href'];
    	$apiTeamBId=substr($url, strrpos($url, "/") + 1);
//     	debug("away:".$apiTeamBId);
    	// Get corresponding puntoon team Ids
    	$teamA = TableRegistry::get('Teams')->find()->where(['api_id'=>$apiTeamAId])->first();
    	if($teamA == null){
    		debug("Cant get team id for:".$apiTeamAId);
    		return $this->BAD_TEAM;
    	}
    	$teamB = TableRegistry::get('Teams')->find()->where(['api_id'=>$apiTeamBId])->first();
        	if($teamB == null){
    			debug("Cant get team id for:".$apiTeamBId);
    		return $this->BAD_TEAM;
    	}
    	$ret = $this->NO_UPDATE;
    	// Find the puntoon fixture with the given teams
    	$fixture2 = TableRegistry::get('Fixtures')->find()->where(['team_a_id'=>$teamA->id, 'team_b_id'=>$teamB->id, 'api_league'=>$league])->first();
// 		debug("Hello d2=". $apiDate);
    	if($fixture2 == null){
    		// Can't find it, so add it in
// debug("no fixture");
			// Convert API Date into db form
//     		$apiDate = date('Y-m-d',strtotime($apiFixture['date']));
			$tId = $this->getTournamentId(date('Y-m-d',strtotime($apiFixture['date'])), $teamA->id, $teamB->id);
			if($tId < 0 ){
				return $this->NO_TOURNAMENT;
			}
    	    $fixture2 = $this->Fixtures->newEntity();
    	    $fixture2->date = date('Y-m-d H:i',strtotime($apiFixture['date']));
    	    $fixture2->tournament_id=$tId; 
    	    $fixture2->team_a_id = $teamA->id;
    	    $fixture2->team_b_id = $teamB->id;
    	    $fixture2->team_a_score = 0;
    	    $fixture2->team_b_score = 0;
    	    $fixture2->status_id = 0;
    	    $fixture2->description = "NEW FiXTURE";
    	    $fixture2->api_league = $league;
			$ret=$this->NEW_FIXTURE;
    	}
		else{
// debug($fixture2);
	   		// if status in puntoon is complete
	   		if($fixture2->status_id == $this->STATUS_FULL_TIME){
	   			// check scores are the same
	   			if($fixture2->team_a_score != $apiFixture['result']['goalsHomeTeam'] ||
	   				$fixture2->team_b_score != $apiFixture['result']['goalsAwayTeam']){
	   				$ret=$this->SCORE_MISMATCH;
   				}
   			}
   			else{
   				// Check dates
    			$apiDate = date('Y-m-d H:i',strtotime($apiFixture['date']));
   				$dbDate = date('Y-m-d H:i',strtotime($fixture2->date));
//     			debug("Hello d1=". $dbDate);
    			if($dbDate != $apiDate){
    				// update Date
    				$fixture2->date = $apiDate;
    				// Get appropriate tournament
    				// Convert API Date into db form
    				$apiDate2 = date('Y-m-d',strtotime($apiFixture['date']));
    				$tId = $this->getTournamentId($apiDate2, $teamA->id, $teamB->id);
    				if($tId < 0 ){
    					return $this->NO_TOURNAMENT;
    				}
// debug("updating date");
					$ret = $this->DATE_UPDATED;
    			}
    			else{
   	 				// If api status is complete then update puntoon score
    				// as long as status is NOT NEW FIXTURE (9)
	    			if($apiFixture['status']== "FINISHED" ){
						if($fixture2->status_id == $this->STATUS_NEW_FIXTURE){
// 						debug("STATUS STILL NEW");
			    			$ret = $this->SCORE_NOT_UPDATED;
						}
						else{
// 						debug("updating score: ".$fixture2->status_id. " - ". $this->STATUS_NEW_FIXTURE);
							$fixture2->team_a_score = $apiFixture['result']['goalsHomeTeam'];
		   		 			$fixture2->team_b_score = $apiFixture['result']['goalsAwayTeam'];
		   	 				$fixture2->status_id = $this->STATUS_FULL_TIME;	// FULL TIME
		    				$ret = $this->SCORE_UPDATED;
						}
	    			}
	    			else{
// debug("api status no FINISHED");
	    			}
    			}
   			}
		}
		if($ret > $this->ERROR){
// 			debug($fixture2);
			if (!$this->Fixtures->save($fixture2)) {
				debug($fixture2->errors());
				$ret = $this->ERROR;
			}
		}
		
    	return $ret; 
    }
    function getTournamentId($date = null, $teamAId = null, $teamBId=null ){
		$conn = ConnectionManager:: get('default');
		$sql = 	"select id ".
				"from tournaments t ".
				"where t.start_date <= '".$date."' ".
				"and t.finish_date >= '".$date."' ".
				"and ".$teamAId." in (select team_id from teams_tournaments where tournament_id = t.id) ".
				"and ".$teamBId." in (select team_id from teams_tournaments where tournament_id = t.id)";
// 		debug($sql);
		if($conn != null){
			$stmt = $conn->query($sql);
			$row = $stmt->fetch('assoc');
// 			debug($row);
			if($stmt->rowCount()>0){
				return $row['id'];
			}
		}else{
			debug("conn is null");
		}
		return -1;
    }
    
    /**
     * Admin-only function to delete all fixtures for a given tournament
     * @param unknown $tournamentId
     */
    public function deleteAll($tournamentId = null)
    {
    	// Only visible to administrators
    	if($this->Auth->User('role')!= 'admin'){
    		$this->Flash->error(__('Sorry. You do not have permission!'));
    		return $this->redirect($this->referer());
    	}
		$conn = ConnectionManager:: get('default');
		$sql = 	"delete from fixtures where tournament_id =".$tournamentId;
// 		debug($sql);
		if($conn != null){
			$stmt = $conn->query($sql);
			$ret = $stmt->execute();
// 			debug($ret);
            if($ret){
				$this->Flash->success(__('All fixtures have been deleted. ['.$tournamentId."]"));
            }
            else{
            	$this->Flash->error(__('Someink went wrong.'));
			}
		}else{
// 			debug("conn is null");
		}
    	return $this->redirect($this->referer());
    }
}

