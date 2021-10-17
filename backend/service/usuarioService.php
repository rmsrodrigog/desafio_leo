<?php
    //namespace service;

    class usuarioService{

        // Connection 
        private $conn;

        // Table
        private $db_table = "usuario";

        // Columns
        public $id;
        public $name;
        public $email;
        public $usuario;
        public $senha;
        public $imagem;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sqlQuery = "SELECT id, nome, email, usuario, senha, imagem FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            $itemCount = $stmt->rowCount();
            if($itemCount > 0){
                
                $courseArr = array();
                $courseArr["body"] = array();
                $courseArr["itemCount"] = $itemCount;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $e = array(
                        "id" => $id,
                        "nome" => $nome,
                        "email" => $email,
                        "usuario" => $usuario,
                        "senha" => $senha,
                        "imagem" => $imagem
                    );

                    array_push($courseArr["body"], $e);
                }
                return $courseArr;
            }else{
                return "Nenhum dado encontrado";
            }
        }

        // SHOW
        public function retrive($id){
            $sqlQuery = "SELECT id, nome, email, usuario, senha, imagem
                        FROM ". $this->db_table ."
                        WHERE id = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $itemCount = $stmt->rowCount();
            if($itemCount > 0) {
                $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
                $courseArr = array();
                $courseArr["body"] = array();
                $e = array(
                    "nome" => $dataRow['nome'], 
                    "email" => $dataRow['email'],
                    "usuario" => $dataRow['usuario'],
                    "senha" => $dataRow['senha'],
                    "imagem" => $dataRow['imagem']
                ); 
                array_push($courseArr["body"], $e);
                return $courseArr;
            }else{
                return "Nenhum dado encontrado";
            }
        }        

        // CREATE
        public function create($data){
            $sqlQuery = "INSERT INTO
                            ". $this->db_table ."
                        SET
                            nome = :nome, 
                            email = :email, 
                            usuario = :usuario, 
                            senha = :senha,
                            imagem = :imagem";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nome=htmlspecialchars(strip_tags($data->nome));
            $this->email=htmlspecialchars(strip_tags($data->email));
            $this->usuario=htmlspecialchars(strip_tags($data->usuario));
            $this->senha=htmlspecialchars(strip_tags($data->senha));
            $this->imagem=htmlspecialchars(strip_tags($data->imagem));
            
            // bind data
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":usuario", $this->usuario);
            $stmt->bindParam(":senha", $this->senha);
            $stmt->bindParam(":imagem", $this->imagem);
        
            if($stmt->execute()){
               return array("mensagem" => "Criado com sucesso;");
            }
            return array("erro" => "Erro durante a gravação do curso no banco de dados");
        }

        // UPDATE
        public function update($id, $data){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nome = :nome, 
                        email = :email, 
                        usuario = :usuario, 
                        senha = :senha,
                        imagem = :imagem
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nome=htmlspecialchars(strip_tags($data->nome));
            $this->email=htmlspecialchars(strip_tags($data->email));
            $this->usuario=htmlspecialchars(strip_tags($data->usuario));
            $this->senha=htmlspecialchars(strip_tags($data->senha));
            $this->imagem=htmlspecialchars(strip_tags($data->imagem));
            $this->id=htmlspecialchars(strip_tags($id));
        
            // bind data
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":usuario", $this->usuario);
            $stmt->bindParam(":senha", $this->senha);
            $stmt->bindParam(":imagem", $this->imagem);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
                return array("mensagem" => "Update realizado com sucesso;");
            }
            return array("erro" => "Erro durante a update do curso no banco de dados");
        }

        // DELETE
        function delete($id){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return array("mensagem" => "Deleção realizada com sucesso;");
            }
            return array("erro" => "Erro durante a deleção do curso no banco de dados");
        }

    }
?>

