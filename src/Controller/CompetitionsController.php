<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Error\Debugger;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Competitions Controller
 *
 * @property \App\Model\Table\CompetitionsTable $Competitions
 */
class CompetitionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		// Filtering...
    	if($this->request->query('showAll')){
    		$conditions='';
    		$this->set('showAll', 1);
    	}
    	else{
    		$conditions='Competitions.finish_date>=CURDATE()';
    	}

    	$this->paginate = [
        	'conditions'=>$conditions,
        	'contain' => ['Tournaments', 
        		'Organisers'=>['fields'=>['id','username']]]];
        $this->set('competitions', $this->paginate($this->Competitions));
        $this->set('_serialize', ['competitions']);
    }

    /**
     * mine method
     *
     * @return void
     */
    public function mine() {
    	$user_id = $this->Auth->user('id');
    	$user = TableRegistry::get('Users')->find()->where(['id'=>$user_id])->first();
    	$this->set('user', $user);
    	// Filtering...
    	if($this->request->query('showAll')){
    		$conditions=['Competitions.organiser_id' => $user_id];
    		$this->set('showAll', 1);
    	}
    	else{
    		$conditions=['Competitions.finish_date>=CURDATE()','Competitions.organiser_id' => $user_id];
    	}

    	$this->paginate = [
    		'limit' => 10,
    		'conditions'=>$conditions,
//     		'conditions' => ['Competitions.organiser_id' => $user_id],
    		'contain' => ['Tournaments',
    			'Organisers'=>['fields'=>['username']]]];
    	$this->set('competitions', $this->paginate($this->Competitions));
    	$this->set('_serialize', ['competitions']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Competition id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competition = $this->Competitions->get($id, [
        	'contain' => ['Tournaments', 
        		'Organisers'=>['fields'=>['username']]]
        		 ]);
        if($this->Auth->user('id')!= $competition->organiser_id){
        	// Only competition organisers allowed to view
        	$this->Flash->error(__('You do not have permission.'));
        	return $this->redirect($this->referer());
        }
        // Work out prize fund and total pot
        $num_entries = TableRegistry::get('Entries')->find()->where(['competition_id'=>$id])->count();
        $paid_entries = TableRegistry::get('Entries')->find()->where(['competition_id'=>$id, 'paid'=>1])->count();
		$prize_fund = $competition->entry_fee*$paid_entries*$competition->prize_percent/100;
		
		$competition['num_entries'] = $num_entries;
		$competition['paid_entries']= $paid_entries;
		$competition['prize_fund'] = $prize_fund;
		
        $this->set('competition', $competition);
        $this->set('_serialize', ['competition']);

        // Paginate the Entries
        $this->paginate = [
        	'Entries' => [
        		'contain' => ['Users'=>['fields'=>['id','username']],
        			'Team1s'=>['fields'=>['id','name']],
					'Team2s'=>['fields'=>['id','name']],
					'Team3s'=>['fields'=>['id','name']],
					'Team4s'=>['fields'=>['id','name']],
					'Team5s'=>['fields'=>['id','name']],
					'Statuses'=>['fields'=>['id','name']]],
        		'limit'=>40,
        		'conditions' => ['Entries.competition_id' => $id]
        	]
        ];
        $entries = $this->paginate('Entries');
        // Make Competitions available to the view
        $this->set(compact('entries'));
    }

    /**
     * Get number of paid entries for a competition
     * @param unknown $id
     */
    private function paidEntries($id = null)
    {
/*    	$conn = ConnectionManager:: get('default');
    	$sql = 	"select count(*) from entries where competition_id = ".$id. " and paid = 1";
    	// 		debug($sql);
    	if($conn != null){
    		$stmt = $conn->query($sql);
    		$ret = $stmt->execute();
    		debug($ret);
    	}else{
    			$this->Flash->error(__('Someink went wrong.'));
    	}
    	return $ret;
*/
    	$count = TableRegistry::get('Entries')->find()->where(['competition_id'=>$id, 'paid'=>1])->count();
    	debug($count);
		return($count);    	 
        }
    
    /**
     * Details method - for punters
     *
     * @param string|null $id Competition id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function details($id = null)
    {
    	$competition = $this->Competitions->get($id, [
    			'contain' => ['Tournaments',
    			'Organisers'=>['fields'=>['username']]]
    			]);
		// Anyone can view these details
    	$this->set('competition', $competition);
    	$this->set('_serialize', ['competition']);
    }
    
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $competition = $this->Competitions->newEntity();
        if ($this->request->is('post')) {
            $competition = $this->Competitions->patchEntity($competition, $this->request->data);
            $competition->organiser_id = $this->Auth->user('id');
            if ($this->Competitions->save($competition)) {
                $this->Flash->success(__('The competition has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The competition could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('competition'));
        $this->set('_serialize', ['competition']);
        $tournaments = $this->Competitions->Tournaments->find('list');
        $this->set(compact('tournaments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Competition id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $competition = $this->Competitions->get($id, [
            'contain' => ['Tournaments', 'Organisers'=>['fields'=>['username']]]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $competition = $this->Competitions->patchEntity($competition, $this->request->data);
            if ($this->Competitions->save($competition)) {
                $this->Flash->success(__('The competition has been saved.'));

                return $this->redirect(['action' => 'mine']);
            } else {
                $this->Flash->error(__('The competition could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('competition'));
        $this->set('_serialize', ['competition']);
        $tournaments = $this->Competitions->Tournaments->find('list');
        $this->set(compact('tournaments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Competition id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $competition = $this->Competitions->get($id);
        if ($this->Competitions->delete($competition)) {
            $this->Flash->success(__('The competition has been deleted.'));
        } else {
            $this->Flash->error(__('The competition could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
