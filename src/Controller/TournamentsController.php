<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;

/**
 * Tournaments Controller
 *
 * @property \App\Model\Table\TournamentsTable $Tournaments
 */
class TournamentsController extends AppController
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
    		$this->set('showAll', 1);
    		$conditions=[];
    	}
    	else{
    		$conditions=['finish_date>=CURDATE()'];
    	}
//
    	$this->paginate = [
    		'conditions'=>$conditions];
    	 
        $this->set('tournaments', $this->paginate($this->Tournaments));
    	//
        $this->set('_serialize', ['tournaments']);
    }

    /**
     * View method
     *
     * @param string|null $id Tournament id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tournament = $this->Tournaments->get($id, []);

        $this->set('tournament', $tournament);
        $this->set('_serialize', ['tournament']);
        // Paginate the Competitions
        $this->paginate = [
        		'Competitions' => [
            			'contain' => ['Organisers'=>['fields'=>['id','username']]],
        				'limit'=>10,
        				'conditions' => ['Competitions.tournament_id' => $id]
        		]
        ];
        $competitions = $this->paginate('Competitions');
        // Make Competitions available to the view
        $this->set(compact('competitions'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tournament = $this->Tournaments->newEntity();
        if ($this->request->is('post')) {
            $tournament = $this->Tournaments->patchEntity($tournament, $this->request->data);
            if ($this->Tournaments->save($tournament)) {
                $this->Flash->success(__('The tournament has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tournament could not be saved. Please, try again.'));
            }
        }
        $teams = $this->Tournaments->Teams->find('list', ['limit' => 200]);
        $this->set(compact('tournament', 'teams'));
        $this->set('_serialize', ['tournament']);
    }
	public $ref;
    /**
     * Edit method
     *
     * @param string|null $id Tournament id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tournament = $this->Tournaments->get($id, [
            'contain' => ['Teams']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$tournament = $this->Tournaments->patchEntity($tournament, $this->request->data);
            if ($this->Tournaments->save($tournament)) {
                $this->Flash->success(__('The tournament has been saved.'));
                return $this->redirect($this->request->session()->read('BACKTO'));
			} else {
                $this->Flash->error(__('The tournament could not be saved. Please, try again.'));
            }
        }else{
    		$this->request->session()->write('BACKTO', $this->referer());
        }
        $teams = $this->Tournaments->Teams->find('list', ['limit' => 200]);
        $this->set(compact('tournament', 'teams'));
        $this->set('_serialize', ['tournament']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tournament id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tournament = $this->Tournaments->get($id);
        if ($this->Tournaments->delete($tournament)) {
            $this->Flash->success(__('The tournament has been deleted.'));
        } else {
            $this->Flash->error(__('The tournament could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
