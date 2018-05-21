<?php
namespace Controller;

use App\Network\Http\HttpSocket;
class ClientsController extends AppController {
    public $components = array('Security', 'RequestHandler');
     
    public function index(){
         
    }
 
    public function request_index(){
     
        // remotely post the information to the server
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_txns.json';
         
        $data = null;
        $httpSocket = new Client();
        $response = $httpSocket->get($link, $data );
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);
         
        $this -> render('/Clients/request_response');
    }
     
    public function request_view($id){
     
        // remotely post the information to the server
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_txns/'.$id.'.json';
 
        $data = null;
        $httpSocket = new Client();
        $response = $httpSocket->get($link, $data );
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);
         
        $this -> render('/Clients/request_response');
    }
     
    public function request_edit($id){
     
        // remotely post the information to the server
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_txns/'.$id.'.json';
 
        $data = null;
        $httpSocket = new Client();
        $data['Txn']['name'] = 'Updated Txn Name';
        $data['Txn']['manufacturer'] = 'Updated Txn  Manufacturer';
        $data['Txn']['name'] = 'Updated Txn  Description';
        $response = $httpSocket->put($link, $data );
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);
         
        $this -> render('/Clients/request_response');
    }
     
    public function request_add(){
     
        // remotely post the information to the server
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_txns.json';
 
        $data = null;
        $httpSocket = new Client();
        $data['Txn']['name'] = 'New Txn';
        $data['Txn']['manufacturer'] = 'New Txn Manufacturer';
        $data['Txn']['name'] = 'New Txn Description';
        $response = $httpSocket->post($link, $data );
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);
         
        $this -> render('/Clients/request_response');
    }
     
    public function request_delete($id){
     
        // remotely post the information to the server
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_txns/'.$id.'.json';
 
        $data = null;
        $httpSocket = new Client();
        $response = $httpSocket->delete($link, $data );
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);
         
        $this -> render('/Clients/request_response');
    }
}
