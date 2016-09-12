<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller {
    public function indexAction() {
        
    }
    
    private function _registerSession($user)
    {
        $this->session->set(
            'auth',
            [
                'id'   => $user->id,
                'email' => $user->email
            ]
        );
    }
    
    
    public function loginAction() {
        if ($this->request->isPost()) {
            $arr = $this->request->getPost();
            
            $user = User::findFirst(
                array(
                    array(
                        'email' => $arr['email'],
                        'password' => $arr['password']
                    )
                )
            );
            
            if (!$user) {
                echo "Wrong password or email.";
            } else {
                echo "Hello, %username%!";
                $this->_registerSession($user);
    
                    $this->flash->success('Welcome ' . $user->name);
    
                    // Forward to the 'invoices' controller if the user is valid
                    return $this->dispatcher->forward(
                        [
                            'controller' => 'invoices',
                            'action'     => 'index'
                        ]
                    );
            }
        }
    }
    
}
