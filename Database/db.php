<?php
    trait connectdb{

        protected $conn;

        public function loadDB(){
            try{
                if($this->conn == NULL){
                    $ini = parse_ini_file('config.ini');
                    $host = $ini['host'];
                    $name = $ini['name'];
                    $user = $ini['user'];
                    $pass = $ini['pass'];

                    $conn = new PDO("mysql:host={$host};dbname={$name}", $user, $pass);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->conn = $conn;
                }else{
                    echo "<pre>Erro: Já existe uma conexão com o banco de dados feita!!!</pre>";
                }
            }catch(Exception $e){
                echo "<pre>Erro: " . $e->getMessage() . "</pre>";
            }
        }

        public function closeDB(){
            $this->conn = null;
        }
    }
?>