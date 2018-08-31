<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 */
class UsersController extends AppController
{
    public function index()
    {       
        $users = $this->paginate($this->Users);
        $this->set('users', $users);
        //$this->set('user', $users);
    }
    public function view($nombre)
    {
        echo "weeeeeennnaaaaaaaa xoroooooo $nombre";
        exit();
    }
    public function add()
    {
        $user = $this->Users->newEntity();
        
        if($this->request->is('post'))
        {
            //debug($this->request->data);
            $user = $this->Users->patchEntity($user, $this->request->data);

            if($this->Users->save($user))
            {
                $this->Flash->success('El usuario se registro correctamente.');
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }
            else
            {
                $this->Flash->error('El usuario no se a podido registrar, intenta denuevo.');
            }

        }

        $this->set(compact('user'));
    }

    public function login()
    {
        if($this->request->is('post'))
        {
            $user = $this->Auth->identify();
            if($user)
            {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            else
            {
                $this->Flash->error('Datos incorrectos, intenta denuevo.', ['key' => 'auth']);
            }
        }
    }
}
