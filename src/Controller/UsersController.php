<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Error\Debugger;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
	private $registerDefaults = array(
			'role' => 'punter'
	);

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Cookie', ['expiry' => '1 day']);
	}
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'limit' => '100'
        ];
    	$users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$user = $this->Users->get($id);
    	   
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        // Paginate the Entries
        $this->paginate = [
        	'Entries' => [
        		'contain' => 
        			['Competitions'=>['fields'=>['id','name']],
        			'Team1s'=>['fields'=>['id','name']],
        			'Team2s'=>['fields'=>['id','name']],
					'Team3s'=>['fields'=>['id','name']],
					'Team4s'=>['fields'=>['id','name']],
					'Team5s'=>['fields'=>['id','name']],
					'Statuses'=>['fields'=>['id','name']]],
        		'limit'=>10,
        		'conditions' => ['Entries.user_id' => $id]
        	]
        ];
        $entries = $this->paginate('Entries');
        // Make Competitions available to the view
        $this->set(compact('entries'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->role = $this->registerDefaults['role'];
            
            if ($this->Users->save($user)) {
            	$this->Auth->setUser($user->toArray());
            	$this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
 //               $this->Flash->error(__('The user could not be saved. Please, try again.'));
            	debug($user->errors());
            	$error_msg = [];
            	foreach( $user->errors() as $errors){
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
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login() {
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				if($this->request->data['rememberMe'] == '1'){
					$cookie = [];
					$cookie['username'] = $this->request->data['username'];
					$cookie['password'] = $this->request->data['password'];
					$this->Cookie->write('rememberMe', $cookie, true, "1 week");
				}
				$this->Cookie->delete('logout');
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error('Your username or password is incorrect.');
		}
		else{
			if(empty($this->data)){
				// Dont use the remember -me stuff if they have logged out
				if(!$this->Cookie->check('logout')){
					$cookie = $this->Cookie->read('rememberMe');
					if(!is_null($cookie)){
						$this->request->data = $cookie;
						$user = $this->Auth->identify();
						if($user){
							$this->Auth->setUser($user);
							return $this->redirect($this->Auth->redirectUrl());
						}
					}
				}
			}
		}    
    }
    
    public function logout() {
		$cookie = [];
		$cookie['username'] = $this->request->data['username'];
		$this->Cookie->write('logout', $cookie, true, "1 week");
    	$this->Flash->success('You Successfully Logged Out');
    	return $this->redirect($this->Auth->logout());
    }
    
}
