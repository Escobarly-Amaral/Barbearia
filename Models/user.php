<?php
    require_once('../Database/db.php');

    class userModel{
        use connectdb;

        public function listUsers(){
            try{
                $conn = $this->loadDB();
                $conn = $this->conn;
                $sql = $conn->prepare("SELECT * FROM customers ORDER BY id");
                $sql->execute();
                $result = $sql->fetchAll();
                // echo "<pre>";
                // print_r($result);
                // foreach ($result as $row) {
                //     echo '<b>NOME: </b>' . $row['name'] . '<br>' . '<b>TELEFONE: </b>' . $row['phone'] . '<br>' . '<b>EMAIL: </b>' . $row['email'] . '<br>' . '<b>ENDEREÇO: </b>' . $row['adress'] . '<br><br>';
                // }
                return $resulte;

            }catch(Exception $e){
                echo "<pre>Erro: " . $e->getMessage() . "</pre>";
            }
        }

        public function addUser($data){
            try{
                $conn = $this->loadDB();
                $conn = $this->conn;
                    /*
                        EXEMPLIFICANDO: os dados dos usuarios do formulario de registro estarão em uma matriz
                        $data = [
                            "name" => "Pedro",
                            "password" => "1292",
                            "email" => "pedro@gmail.com",
                            "fone" => "85986562539",
                            "adress" => "Rua Tomás n° 164",
                        ];
                    */
                $password = $data['password'];
                $name = $data['name'];
                $email = $data['email'];
                $fone = $data['fone'];
                $adress = $data['adress'];

                $maxid = $conn->prepare("SELECT id FROM customers ORDER BY id DESC LIMIT 1");
                $maxid->execute();
                $lastid = $maxid->fetchColumn();
                $id = ($lastid !== false) ? $lastid + 1 : 1;

                $sql = $conn->prepare("INSERT INTO customers (id, password, name, email, phone, adress)
                                        VALUES (:id, :pass, :name, :mail, :phone, :adress)");
                $sql->bindParam(':id', $id);
                $sql->bindParam(':pass', $password);
                $sql->bindParam(':name', $name);
                $sql->bindParam(':mail', $email);
                $sql->bindParam(':phone', $fone);
                $sql->bindParam(':adress', $adress);
                $sql->execute();
                
            }catch(Exception $e){
                echo "<pre>Erro: " . $e->getMessage() . "</pre>";
            }
        }

        public function setUser($data){
            try{
                $conn = $this->loadDB();
                $conn = $this->conn;

                $sql = $conn->prepare("UPDATE customers SET password=:password, name=:name, email=:mail, phone=:phone, adress=:adress WHERE id = :id");
                    /*
                        $data = [
                            "id" => "2",
                            "name" => "Pedro Alves",
                            "password" => "1292",
                            "email" => "pedro@gmail.com",
                            "fone" => "85986562539",
                            "adress" => "Rua Tomás n° 164",
                        ];
                    */
                $id = $data['id'];
                $password = $data['password'];
                $name = $data['name'];
                $email = $data['email'];
                $fone = $data['fone'];
                $endereco = $data['adress'];

                $sql->bindParam(':id', $id);
                $sql->bindParam(':password', $password);
                $sql->bindParam(':name', $name);
                $sql->bindParam(':mail', $email);
                $sql->bindParam(':phone', $fone);
                $sql->bindParam(':adress', $endereco);
                $sql->execute();
            }catch(Exception $e){
                echo "<pre>Erro: " . $e->getMessage() . "</pre>";
            }
        }

        public function removeUser($id){
            $conn = $this->loadDB();
            $conn = $this->conn;

            $sql = $conn->prepare("DELETE FROM customers WHERE id = :id");
            $sql->bindParam(':id', $id);
            $sql->execute();
        }

        public function login($username, $password){
            try{
                $conn = $this->loadDB();
                $conn = $this->conn;

                $sql = $conn->prepare("SELECT password FROM customers WHERE name = :username");
                $sql->bindParam(':username', $username);
                $sql->execute();
                $user = $sql->fetch_assoc();

                if ($user && password_verify($password, $user['password'])) {
                    return true;
                }else{
                    return false;
                }
            }catch(Exception $e){
                echo "<pre>Erro: " . $e->getMessage() . "</pre>";
            }
        }
    }
?>