<?php

include "conecction.php";
    if(isset($_POST['action'])){
        $categoryController = new CategoryController();
        switch ($_POST['action']){
            case 'store':
                $name = strip_tags($_POST['name']);
                $description = strip_tags($_POST['description']);
                $status = strip_tags($_POST['status']);
                $categoryController->store($name,$description,$status);

            break;
            case 'update':
				$name = strip_tags($_POST['name']);
				$description = strip_tags($_POST['description']);
				$status = strip_tags($_POST['status']);
				$id = strip_tags($_POST['id']);
				$CategoryController->update($id, $name, $description, $status);
			break;
			case 'delete':
				$id = strip_tags($_POST['id']);
				$CategoryController->destroy($id);
			break;

            }

    }


class CategoryController{



    function get(){


        $conn = connect();
        if($conn->connect_error==false)
        {
            $query = "select * from categories";
            $prepared_query = $conn->prepare($query);
            $prepared_query->execute();
            echo("si jala");
            $result = $prepared_query->get_result();
            $categories = $result->fetch_all(MYSQLI_ASSOC);
            if(count($categories)>0){
                return $categories;
            }else
                return array();



        }else{
            return array();
        }
        


    }
    public function store($name,$description,$status){
        $conn = connect();
        if($conn->connect_error==false){
            $query = "insert into categories(name,description,status) 
            values(?,?,?)";
            
            $prepared_query = $conn->prepare($query);
            $prepared_query->bind_param('sss',$name,$description,$status);
            if($prepared_query->execute()){
                header("Location:". $_SERVER['HTTP_REFERER']);
            
            }else{
                header("Location:". $_SERVER['HTTP_REFERER']);

            }
        }
         
    }

    public function update($id,$name,$description,$status){
        $conn = connect();
        if($conn->connect_error==false){
            if($id!="" && $name!=""&& $description!=""&&$status!=""){
                $query = "update categories ser name=?, description =?,status=?, where id=?";
                $prepared_query = $conn->prepare($query);
                $prepared_query->$conn->bind_param('sss1',$name,$description,$status,$id);
                
            } 
        }

    }

    public function destroy($id){
        $conn = connect();
        if ($conn->connect_error==false){
            if($id!=""){
                $query="delete from categories where id=?";
                $prepared_query = $conn->prepare($query);
                $prepared_query->bind_param('i',$id);
                if($prepared_query->execute()){
                    header("Location:".$_SERVER["HTTP_REFERER"]);
                }
                else
                    header("Location:".$_SERVER["HTTP_REFERER"]);

            }
        }
        else
            header("Location:".$_SERVER["HTTP_REFERER"]);
    }
    
}

?>