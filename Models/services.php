<?php
    require_once('../Database/db.php');

    class servicesModel{
        use connectdb;

        public function listServices(){
            try{
                $conn = $this->loadDB();
                $conn = $this->conn;
                $sql = $conn->prepare("SELECT * FROM services ORDER BY id");
                $sql->execute();
                $result = $sql->fetchAll();

                return $result;
            }catch(Exception $e){
                echo "<pre>Erro: " . $e->getMessage() . "</pre>";
            }
        }

        public function addService(){
            try{
                $conn = $this->loadDB();
                $conn = $this->conn;

                $maxid = $conn->prepare("SELECT id FROM services ORDER BY id DESC LIMIT 1");
                $maxid->execute();
                $lastid = $maxid->fetchColumn();
                $id = ($lastid !== false) ? $lastid + 1 : 1;

                $desc = NULL;
                $name = NULL;
                $price = NULL;

                $sql = $conn->prepare("INSERT INTO services (id, name, description, price)
                                        VALUES (:id, :name, :desc, :price)");
                $sql->bindParam(':id', $id);
                $sql->bindParam(':desc', $desc);
                $sql->bindParam(':name', $name);
                $sql->bindParam(':price', $price);
                $sql->execute();
                
            }catch(Exception $e){
                echo "<pre>Erro: " . $e->getMessage() . "</pre>";
            }
        }

        public function setService(){    
            try{
                $conn = $this->loadDB();
                $conn = $this->conn;

                $sql = $conn->prepare("UPDATE services SET name=:name, description=:description, price=:price WHERE id = :id");

                $id = $data['id'];
                $description = $data['description'];
                $name = $data['name'];
                $price = $data['price'];

                $sql->bindParam(':id', $id);
                $sql->bindParam(':password', $password);
                $sql->bindParam(':name', $name);
                $sql->bindParam(':mail', $price);
                $sql->execute();
            }catch(Exception $e){
                echo "<pre>Erro: " . $e->getMessage() . "</pre>";
            }
        }

        public function removeUser($id){
            try{
                $conn = $this->loadDB();
                $conn = $this->conn;

                $sql = $conn->prepare("DELETE FROM services WHERE id = :id");
                $sql->bindParam(':id', $id);
                $sql->execute();
            }catch(Exception $e){
                echo "<pre>Erro: " . $e->getMessage() . "</pre>";
            }
        }
    }
?>