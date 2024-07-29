<?php

require_once '../vendor/autoload.php';
require_once '../Database/db.php';
require_once '../Models/User.php';

class UserController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = addslashes($_POST['username']);
            $password = addslashes($_POST['password']);
            $email = addslashes($_POST['email']);
            $fone = addslashes($_POST['fone']);
            $adress = addslashes($_POST['adress']);

            if (empty($username) || empty($password) || empty($email) || empty($fone) || empty($adress)){
                $_SESSION['message'] = 'Todos os campos são obrigatórios!';
                require_once '/../views/register.php';
                return;
            }

            $userModel = new User();
            if ($userModel->register($username, $password, $email, $fone, $adress)) {
                $_SESSION['message'] = 'Cadastro realizado com sucesso!';
                header('Location: /login');
                exit();
            } else {
                $_SESSION['message'] = 'Erro ao cadastrar usuário!';
            }

            require_once '/../views/register.php';
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = addslashes($_POST['username']);
            $password = addslashes($_POST['password']);

            if (empty($username) || empty($password)) {
                $_SESSION['message'] = 'Todos os campos são obrigatórios!';
                require_once '/../views/login.php';
                return;
            }

            $userModel = new User();
            if ($userModel->login($username, $password)) {
                session_start();
                $_SESSION['user'] = $username;
                header('Location: /home');
                exit();
            } else {
                $_SESSION['message'] = 'Dados inválidos!';
            }

            require_once '/../views/login.php';
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
        exit();
    }

    public function home() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }else{
            $user = new User();
            $stmt = $user->listUsers();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            require_once 'views/users/index.php';
        }
    }

    public function edit($id) {
        $user = new User();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user->id = $id;
            $user->name = addslashes($_POST['name']);
            $user->email = addslashes($_POST['email']);

            if ($user->setUser()) {
                header('Location: /public/index.php');
            } else {
                $_SESSION['message'] = 'Erro ao atualizar usuário.';
            }
        } else {
            $stmt = $user->listUsers();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $user = null;
            foreach ($users as $u) {
                if ($u['id'] == $id) {
                    $user = $u;
                    break;
                }
            }
            require_once 'views/users/edit.php';
        }
    }

    public function delete($id) {
        $user = new User();
        $user->id = $id;

        if ($user->removeUser()) {
            header('Location: /public/index.php');
        } else {
            $_SESSION['message'] = 'Erro ao deletar usuário.';
        }
    }
};

?>