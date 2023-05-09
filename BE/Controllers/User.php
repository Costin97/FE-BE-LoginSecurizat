<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function token(){
        $token = bin2hex(random_bytes(16));
        return $this->response->setJSON(['token' => $token]);
    }

    public function login() {  
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => md5($this->request->getVar('password'))
        ];

        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM logintable LT where 
            LT.password = '{$data['password']}'
        and LT.username = '{$data['username']}'"); 
    
        $row = $query->getRowArray();
        if (isset($row)) {
            if ($data['username'] == $row['username'] && 
            $data['password'] == $row['password']){
                return $this->response->setJSON(['val' => true]);
            }
        }else{
            return $this->response->setJSON(['val' => false]);
        }
    }

    public function signup(){
        $password = $this->request->getVar('password');
        $user = $this->request->getVar('username');
        $obj = [
            'id' => NULL,
            'username' => $user,
            'password' => md5($password)
        ];

        $table = 'logintable';
        $db = \Config\Database::connect();

        $db->table($table)->insert($obj);
    }
}