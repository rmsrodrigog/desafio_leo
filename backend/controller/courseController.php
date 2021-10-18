<?php
    //namespace controller; 

    //use config\database; 
    //use service\courseService;

    //var_dump('oi'); die();

    include_once('../config/database.php');
    include_once('../service/courseService.php');

    class courseController 
    {
        protected $db;
        protected $servico;
        protected $data;

        public function __construct() {
            $database = new database();
            $this->db = $database->getConnection();
            $this->servico = new courseService($this->db);
            $this->data = json_decode(file_get_contents("php://input"));
        }

        public function index() {
            try {
                $retornoJson = json_encode($this->servico->getAll());
                return $retornoJson;
            }catch(Exception $e) {
                return json_encode(array("error" => "Erro no index do course:". $e->getMessage()));
            }
        }

        public function show($id) 
        {
            try {
                $retornoJson = json_encode($this->servico->retrive($id));
                return $retornoJson;
            }catch(Exception $e) {
                return json_encode(array("error" => "Erro no show do course:". $e->getMessage()));
            }
        }

        public function store() 
        {
            try {
                $retornoJson = json_encode($this->servico->create($this->data));
                return $retornoJson;
            }catch(Exception $e) {
                return json_encode(array("error" => "Erro no store do course:". $e->getMessage()));
            }
        }

        public function update($id) 
        {   
            try {
                $retornoJson = json_encode($this->servico->update($id, $this->data));
                return $retornoJson;
            }catch(Exception $e) {
                return json_encode(array("error" => "Erro no update do course:". $e->getMessage()));
            }
        }

        public function destroy($id) 
        { 
            try {
                $retornoJson = json_encode($this->servico->delete($id));
                return $retornoJson;
            }catch(Exception $e) {
                return json_encode(array("error" => "Erro no deletar do course:". $e->getMessage()));
            }
        }
    }



?>