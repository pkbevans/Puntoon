<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Leaders Controller
 *
 * @property \App\Model\Table\LeadersTable $Leaders
 */
class LeadersController extends AppController
{

/**
 * Competition leaders method
 *
 * @return void
 */
	public function byComp($competition_id = NULL) {
		$this->paginate = [
        	'conditions' => ['Leaders.competition_id' => $competition_id],
			'limit' => 40,
			'order' => ['Total_Goals desc'],
			'contain' => [
				'Team1s'=>['fields'=>['id', 'name']],
				'Team2s'=>['fields'=>['id', 'name']],
				'Team3s'=>['fields'=>['id', 'name']],
				'Team4s'=>['fields'=>['id', 'name']],
				'Team5s'=>['fields'=>['id', 'name']]
		]];
		$this->set('leaders', $this->paginate($this->Leaders));
		
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
//
		$this->paginate = [
			'conditions' => array('Leaders.user_id' => $user_id),
			'limit' => 10,
			'order' => ['Total_Goals desc'],
			'contain' => [
				'Team1s'=>['fields'=>['name']],
				'Team2s'=>['fields'=>['name']],
				'Team3s'=>['fields'=>['name']],
				'Team4s'=>['fields'=>['name']],
				'Team5s'=>['fields'=>['name']]
		]];
		$this->set('leaders', $this->paginate($this->Leaders));
				
		// Set User details
    	$user = TableRegistry::get('Users')->find()->where(['id'=>$user_id])->first();
    	$this->set('user', $user);
	}	
}
