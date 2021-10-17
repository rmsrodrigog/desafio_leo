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
            //$this->data->image = $this->uploadImages();
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

        public function uploadImages()
        {
            $fileName  =  $_FILES['sendimage']['name'];
            $tempPath  =  $_FILES['sendimage']['tmp_name'];
            $fileSize  =  $_FILES['sendimage']['size'];
                    
            if(empty($fileName))
            {
                $errorMSG = 'noimage';
            }
            else
            {
                $upload_path = '../storage/usuario;'; // set upload folder path 
                
                $fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension
                    
                // valid image extensions
                $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
                                
                // allow valid image file formats
                if(in_array($fileExt, $valid_extensions))
                {				
                    //check file not exist our upload folder path
                    if(!file_exists($upload_path . $fileName))
                    {
                        // check file size '5MB'
                        if($fileSize < 5000000){
                            move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
                        }
                        else{		
                            $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));	
                            echo $errorMSG;
                        }
                    }
                    else
                    {		
                        $errorMSG = json_encode(array("message" => "Sorry, file already exists check upload folder", "status" => false));	
                        echo $errorMSG;
                    }
                }
                else
                {		
                    $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));	
                    echo $errorMSG;		
                }
            }
                    
            // if no error caused, continue ....
            if(!isset($errorMSG))
            {                      
                return $fileName;
            }
            return $errorMSG;
        }
    }

?>