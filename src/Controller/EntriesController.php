<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Mailer\MailerAwareTrait;
use Cake\Datasource\ConnectionManager;


/**
 * Entries Controller
 *
 * @property \App\Model\Table\EntriesTable $Entries
 */
class EntriesController extends AppController
{
	use MailerAwareTrait;

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$this->paginate = [
			'contain' => ['Competitions', 'Users', 'Team1s', 'Team2s', 'Team3s', 'Team4s', 'Team5s', 'Statuses']
		];
		$entries = $this->paginate($this->Entries);

		$this->set(compact('entries'));
		$this->set('_serialize', ['entries']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Entry id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$entry = $this->Entries->get($id, [
			'contain' => ['Competitions', 'Users', 'Team1s', 'Team2s', 'Team3s', 'Team4s', 'Team5s', 'Statuses']
		]);

		$this->set('entry', $entry);
		$this->set('_serialize', ['entry']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add($competitionId = null, $tournamentId = null, $url = null)
	{
		$entry = $this->Entries->newEntity();
		if ($this->request->is('post')) {
			$entry = $this->Entries->patchEntity($entry, $this->request->data);
			// Set Competition and user
			$entry->user_id = $this->Auth->user('id');
			$entry->competition_id = $competitionId;
			$entry->tournament_id = $tournamentId;
			// Check for duplicate teams
			if($this->teamDuplicated($entry)){
				$this->Flash->error(__('Duplicate team!!.'));
			}else{
				$newEntry = $this->Entries->save($entry);
				if($newEntry) {
					$this->Flash->success(__('The entry has been saved.'));
					//
					$id=$newEntry['id'];
					// Send email to organiser
					$this->sendMailToOrganiser($id, $entry);
					// and one to punter
					$this->sendMailToPunter($entry, 'to_punter_new_entry');
					if($url == "VIEW"){
						return $this->redirect(['controller' => 'competitions', 'action' => 'view', $competitionId]);
					}
					else{
						return $this->redirect(['controller' => 'competitions', 'action' => 'index']);
					}
				} else {
					debug($entry->errors());
		   			$error_msg = [];
		   			foreach( $entry->errors() as $errors){
		   				if(is_array($errors)){
		   					foreach($errors as $error){
		   						$error_msg[]=$error;
		   					}
						}else{
		  					$error_msg[]=$errors;
		   				}
					}
					
					if(!empty($error_msg)){
						$this->Flash->error(
							__(implode("\n \r", $error_msg)));
		   			}
				}
			}
		}
		// We only want to add an entry for the particular competition we are looking at.
		$competition = TableRegistry::get('Competitions')->find()->where(['id'=>$competitionId])->first();
		// Check whether the competition is still open for entries
		$now = Time::now();
		$closingDate = new Time($competition->closing_entry_date);
		if($now>$closingDate){
			// redirect back to where we came from
				$this->Flash->error(__($competition->name . ' competition is now closed!!'));
				return $this->redirect($this->referer());
		}
		
		// Use current user logged in
		$user_id = $this->Auth->user('id');
		$user = TableRegistry::get('Users')->find()->where(['id'=>$user_id])->first();
		$this->set('user', $user);
		
		$tournamentId=$competition->tournament_id;
		$team1s = $this->Entries->Team1s->find('list');
		$team2s = $this->Entries->Team2s->find('list');
		$team3s = $this->Entries->Team3s->find('list');
		$team4s = $this->Entries->Team4s->find('list');
		$team5s = $this->Entries->Team5s->find('list');
		$this->set(compact('competition','user', 'teams','team1s', 'team2s', 'team3s', 'team4s', 'team5s'));
	}

	public function sendMailToOrganiser($id =null, $entry = null){
		// Send email to organiser
		// Get organiser email
		$competition = TableRegistry::get('Competitions')->find()->where(['id'=>$entry->competition_id])->first();
		//
		$organiser = TableRegistry::get('Users')->find()->where(['id'=>$competition->organiser_id])->first();
		$to=$organiser->email;
		// Get competition name
		$subject="New Entry Added";
		$url="http://bondevans.com/puntoon/entries/view/"."$id";
		$message="A new entry has been added to your competition.\n\n". 
						"Competition: ". $competition->name. "\n\n".
						"User details:\n\n".
						"Name:\t\t". $this->Auth->user('firstname') . " " . $this->Auth->user('surname')."\n".
						"Username:\t". $this->Auth->user('username') ."\n".
						"Email:\t\t". $this->Auth->user('email') ."\n\n".
						"View the entry here: ". $url ."\n\n"
		;
		$email = new Email();
		$email->from('puntoon@bondevans.com')
			->template('to_organiser_new_entry','puntoon')
			->emailFormat('text')
			->viewVars(['organiser'=>$organiser->firstname])
			->to($to)
			->subject($subject);
		$email->send($message);
		
		return; 
	}

	public function sendMailToPunter($entry = null, $template){
		// Get competition name
		$competition = TableRegistry::get('Competitions')->find()->where(['id'=>$entry->competition_id])->first();
		$message="Thank you for taking a punt at puntoon.com .\n\n". 
						"Competition: ". $competition->name. "\n\n".
						"Punt details:\n\n".
						"Name:\t\t". $entry->name ."\n"
		;

		$myDate = Time::parse($competition->closing_entry_date);
		$close_date = $myDate->format("Y-m-d");

		$email = new Email();
		$email->from('puntoon@bondevans.com')
			->template($template,'puntoon')
			->emailFormat('text')
			->viewVars(['punter'=>$this->Auth->user('firstname'), 'close_date'=>$close_date])
			->to($this->Auth->user('email'))
			->subject(sprintf('New Punt: %s in %s', $entry->name, $competition->name));
		$email->send($message);
	}

	public function teamDuplicated($entry) {
		// $data array is passed using the form field name as the key
		// have to extract the value to make the function generic
		$team1 = $entry->team_1_id;
		$team2 = $entry->team_2_id;
		$team3 = $entry->team_3_id;
		$team4 = $entry->team_4_id;
		$team5 = $entry->team_5_id;
		if($team1 == $team2 || $team1 == $team3 ||$team1 == $team4 || $team1 == $team5 || $team2 == $team3 ||$team2 == $team4 ||$team2 == $team5 || $team3 == $team4 ||$team3 == $team5 || $team4 == $team5 ){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	/**
	 * Edit method
	 *
	 * @param string|null $id Entry id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$entry = $this->Entries->get($id, [
			'contain' => ['Users'=>['fields'=>['id','username']]]
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$entry = $this->Entries->patchEntity($entry, $this->request->data);
			if ($this->Entries->save($entry)) {
				$this->Flash->success(__('The entry has been saved.'));

				return $this->redirect(['controller'=>'competitions','action' => 'view',$entry->competition_id]);
			} else {
				$this->Flash->error(__('The entry could not be saved. Please, try again.'));
			}
		}
		$competitions = $this->Entries->Competitions->find('list', ['limit' => 200]);
		$users = $this->Entries->Users->find('list', ['limit' => 200]);
		$team1s = $this->Entries->Team1s->find('list', ['limit' => 200]);
		$team2s = $this->Entries->Team2s->find('list', ['limit' => 200]);
		$team3s = $this->Entries->Team3s->find('list', ['limit' => 200]);
		$team4s = $this->Entries->Team4s->find('list', ['limit' => 200]);
		$team5s = $this->Entries->Team5s->find('list', ['limit' => 200]);
		$statuses = $this->Entries->Statuses->find('list', ['limit' => 200]);
		$this->set(compact('entry', 'competitions', 'users', 'team1s', 'team2s', 'team3s', 'team4s', 'team5s', 'statuses'));
		$this->set('_serialize', ['entry']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Entry id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
// 		debug($this->request);
// 		$this->request->allowMethod(['post', 'delete']);
		$entry = $this->Entries->get($id);
		if ($this->Entries->delete($entry)) {
			$this->Flash->success(__('The entry has been deleted.'));
		} else {
			$this->Flash->error(__('The entry could not be deleted. Please, try again.'));
		}

		return $this->redirect($this->referer());
	}
	/**
	 * Competition leaders method
	 *
	 * @return void
	 */
	public function leaderBoard($competition_id = NULL) {
		$this->paginate = [
			'conditions' => ['Entries.competition_id' => $competition_id],
			'limit' => 40,
			'order' => ['Total_Goals desc'],
			'contain' => [
				'Users'=>['fields'=>['id', 'username']],
				'Team1s'=>['fields'=>['id', 'name']],
				'Team2s'=>['fields'=>['id', 'name']],
				'Team3s'=>['fields'=>['id', 'name']],
				'Team4s'=>['fields'=>['id', 'name']],
				'Team5s'=>['fields'=>['id', 'name']]
		]];
		$this->set('entries', $this->paginate($this->Entries));
	
		// Set Competition details
		$competition = TableRegistry::get('Competitions')->find()->where(['id'=>$competition_id])->first();
		$this->set('competition', $competition);
	}
	
	/**
	 * User leaders method
	 *
	 * @return void
	 */
	public function mine() {
		$user_id = $this->Auth->user('id');
		// Filtering...
		if($this->request->query('showAll')){
			$conditions=['Entries.user_id' => $user_id];
			$this->set('showAll', 1);
		}
		else{
			$conditions=['Competitions.finish_date>=CURDATE()','Entries.user_id' => $user_id];
		}
		//
		$this->paginate = [
			'conditions' => $conditions,
			'limit' => 10,
			'order' => ['Competitions.finish_date asc'],
   		 	'contain' => [
	   		 	'Competitions'=>['fields'=>['id','name']],
				'Team1s'=>['fields'=>['name']],
				'Team2s'=>['fields'=>['name']],
				'Team3s'=>['fields'=>['name']],
				'Team4s'=>['fields'=>['name']],
				'Team5s'=>['fields'=>['name']]
		]];
		$this->set('entries', $this->paginate($this->Entries));
	
		// Set User details
		$user = TableRegistry::get('Users')->find()->where(['id'=>$user_id])->first();
		$this->set('user', $user);
	}

	/**
	 * addEntry method - used by organiser of competition
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function addEntry($competitionId = null, $tournamentId = null, $url = null)
	{
		$entry = $this->Entries->newEntity();
		if ($this->request->is('post')) {
			$entry = $this->Entries->patchEntity($entry, $this->request->data);
			// Set Competition and user
			$entry->competition_id = $competitionId;
			$entry->tournament_id = $tournamentId;
			$entry->total_goals = $entry->team_1_goals+$entry->team_2_goals+$entry->team_3_goals+
							$entry->team_4_goals+$entry->team_5_goals;
			// Check for duplicate teams
			if($this->teamDuplicated($entry)){
				$this->Flash->error(__('Duplicate team!!.'));
			}elseif ($this->Entries->save($entry)) {
				$this->Flash->success(__('The entry has been saved.'));
				if($url == "VIEW"){
					return $this->redirect(['controller' => 'competitions', 'action' => 'view', $competitionId]);
				}
				else{
					return $this->redirect(['controller' => 'competitions', 'action' => 'index']);
				}
			} else {
				debug($entry->errors());
				$error_msg = [];
				foreach( $entry->errors() as $errors){
					if(is_array($errors)){
						foreach($errors as $error){
							$error_msg[]=$error;
						}
					}else{
						$error_msg[]=$errors;
					}
				}
				 
				if(!empty($error_msg)){
					$this->Flash->error(
							__(implode("\n \r", $error_msg)));
				}
			}
		}
		// We only want to add an entry for the particular competition we are looking at.
		$competition = TableRegistry::get('Competitions')->find()->where(['id'=>$competitionId])->first();
		// Check that the logged in user IS the owner of the competition
		$user_id = $this->Auth->user('id');
		if($user_id != $competition->organiser_id){
			$this->Flash->error(__('You are not the organiser for: ', $competition->name .'!!'));
			return $this->redirect($this->referer());
		}
	
		$tournamentId=$competition->tournament_id;
		$users = $this->Entries->Users->find('list');
		$team1s = $this->Entries->Team1s->find('list');
		$team2s = $this->Entries->Team2s->find('list');
		$team3s = $this->Entries->Team3s->find('list');
		$team4s = $this->Entries->Team4s->find('list');
		$team5s = $this->Entries->Team5s->find('list');
		$this->set(compact('entry','competition','users', 'teams','team1s', 'team2s', 'team3s', 'team4s', 'team5s'));
	}
	/**
	 * Admin-only function to reset all entry totals for a given tournament
	 * @param unknown $tournamentId
	 */
	public function resetAll($tournamentId = null)
	{
		// Only visible to administrators
		if($this->Auth->User('role')!= 'admin'){
			$this->Flash->error(__('Sorry. You do not have permission!'));
			return $this->redirect($this->referer());
		}
		$conn = ConnectionManager:: get('default');
		$sql = 	"update entries set team_1_goals=0, team_2_goals=0, team_3_goals=0, team_4_goals=0, team_5_goals=0, total_goals=0 where tournament_id =".$tournamentId;
//	 	debug($sql);
		if($conn != null){
			$stmt = $conn->query($sql);
			$ret = $stmt->execute();
//	 		debug($ret);
			if($ret){
				$this->Flash->success(__('All entries have been reset. ['.$tournamentId."]"));
			}
			else{
				$this->Flash->error(__('Someink went wrong.'));
			}
		}else{
//	 		debug("conn is null");
		}
		return $this->redirect($this->referer());
	}

	/**
	 * Admin-only function to update Paid flag on given entry
	 * @param unknown $id
	 */
	public function updatePaid($id = null)
	{
		
		$entry = $this->Entries->get($id, [
			'contain' => ['Competitions'=>['fields'=>['organiser_id']]]
		]);
		// Only available to competition organisers
		if($this->Auth->user('id')!= $entry->competition->organiser_id){
			// Only competition organisers allowed to view
			$this->Flash->error(__('You do not have permission.'));
			return $this->redirect($this->referer());
		}
	
		$entry->paid=$this->request->data['paid'];
		if ($this->Entries->save($entry)) {
			$this->Flash->success(__('The entry has been updated.'));

			return $this->redirect($this->referer());
		} else {
			$this->Flash->error(__('The entry could not be updated.'));
		}
	}
	public function chasePayment($id = null){
		$entry = TableRegistry::get('Entries')->find()->where(['id'=>$id])->first();
		$this->sendMailToPunter($entry, 'to_punter_chase_payment');
		$this->Flash->success(__('Email chases will be sent.'));
		return $this->redirect($this->referer());
   	}
}
