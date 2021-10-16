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
            //$this->data = json_decode(file_get_contents("php://input"));
            //var_dump($this->data);
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

        public function create() 
        {
            echo 'entrou no create';
            /*
            $this->item->name = $this->data->name;
            $this->item->email = $this->data->email;
            $this->item->age = $this->data->age;
            $this->item->designation = $this->data->designation;
            $this->item->created = date('Y-m-d H:i:s');
            
            if($this->item->createCourse()){
                echo 'Course created successfully.';
            } else{
                echo 'Course could not be created.';
            }
            */
        }

        public function update() 
        {   
            echo 'entrou no update';
            /*
            $this->item->id = $this->data->id;
            $this->item->name = $this->data->name;
            $this->item->email = $this->data->email;
            $this->item->age = $this->data->age;
            $this->item->designation = $this->data->designation;
            $this->item->created = date('Y-m-d H:i:s');
            
            if($this->item->updateCourse()){
                echo json_encode("Course data updated.");
            } else{
                echo json_encode("Data could not be updated");
            }
            */
        }

        public function destroy() 
        { 
            echo 'entrou no destroy';
            /*
            $this->item->id = $this->data->id;
            
            if($this->item->destroyCourse()){
                echo json_encode("Course deleted.");
            } else{
                echo json_encode("Data could not be deleted");
            }
            */
        }
    }



?>