<?php
    include_once('../config/database.php');
    include_once('../service/usuarioService.php');

    class usuarioController 
    {
        protected $db;
        protected $servico;
        protected $data;

        public function __construct() {
            $database = new database();
            $this->db = $database->getConnection();
            $this->servico = new usuarioService($this->db);
            $this->data = json_decode(file_get_contents("php://input"));
        }

        public function index() {
            try {
                $retornoJson = json_encode($this->servico->getAll());
                return $retornoJson;
            }catch(Exception $e) {
                return json_encode(array("error" => "Erro no index do usuario:". $e->getMessage()));
            }
        }

        public function show($id) 
        {
            try {
                $retornoJson = json_encode($this->servico->retrive($id));
                return $retornoJson;
            }catch(Exception $e) {
                return json_encode(array("error" => "Erro no show do usuario:". $e->getMessage()));
            }
        }

        public function store() 
        {
            try {
                $this->data->senha = password_hash($this->data->senha, PASSWORD_DEFAULT);
                $retornoJson = json_encode($this->servico->create($this->data));
                return $retornoJson;
            }catch(Exception $e) {
                return json_encode(array("error" => "Erro no store do usuario:". $e->getMessage()));
            }
        }

        public function update($id) 
        {   
            try {
                $this->data->senha = password_hash($this->data->senha, PASSWORD_DEFAULT);
                $retornoJson = json_encode($this->servico->update($id, $this->data));
                return $retornoJson;
            }catch(Exception $e) {
                return json_encode(array("error" => "Erro no update do usuario:". $e->getMessage()));
            }
        }

        public function destroy($id) 
        { 
            try {
                $retornoJson = json_encode($this->servico->delete($id));
                return $retornoJson;
            }catch(Exception $e) {
                return json_encode(array("error" => "Erro no deletar do usuario:". $e->getMessage()));
            }
        }
    }



?>