<?php
require_once '../AutoId.php';
header("Access-Control-Allow-Origin:*");
$id = create_guid();
class Videos{
    private $host="localhost";
    private $username="root";
    private $password="";
    private $database="cheaf khalil";
    private $con=null;

    function __construct() {
       $con = mysqli_connect($this->host,$this->username,$this->password,$this->database);
       $this->con = $con;
    }
    public function insert($id,$url_name){
        $target_dir='test_upload/';
        $target_file= $target_dir.basename($url_name);
        $imgFileType= pathinfo($target_file,PATHINFO_EXTENSION);
        if ($imgFileType != 'mp4'){
            return 0;
        }else{
            $video_path= $url_name;
            $insert_video_sql ="INSERT INTO `videos`( `id`,`url`) VALUES ('$id','$video_path')";
            $query = mysqli_query($this->con,$insert_video_sql);
            if($query){
                //Eslam
                //move_uploaded_file($_FILES['VideoUrl']['tmp_name'],$target_file);
                return 1;
            }else{
                return 2;
            }
        }

    }
    public function selectAll(){
        $selectAll = "select * from videos ";
        $query =mysqli_query($this->con,$selectAll);
        if($query){
            $records = mysqli_fetch_all($query,MYSQLI_ASSOC);
            return $records;
        }else{
            echo "Statement Error";
            $records = null;
            return $records;
        }

    }
    public function selectWithId($id){
        $selectWithId = "select * from videos where id ='$id' ";
        $query =mysqli_query($this->con,$selectWithId);
        if($query){

            $records = mysqli_fetch_all($query,MYSQLI_ASSOC);
            return $records;
        }else{
            echo "Statement Error";
            $records = null;
            return $records;
        }
    }
    public function deleteAll(){
        $deleteSql = "delete from videos";
        $query =mysqli_query($this->con,$deleteSql);
        if($query){
            echo "Done";
        }else{
            echo "Statement Error";
        }
    }
    public function deleteWithId($id){
        $deleteSql = "delete from videos where id =$id";
        $query =mysqli_query($this->con,$deleteSql);
        if($query){
            echo "Done";
        }else{
            echo "Statement Error";
        }
    }
    public function updateWithId($id,$url,$section_id){
        $updateQuery = "update videos set url='$url', section_id='$section_id' where id ='$id' ";
        $query =mysqli_query($this->con,$updateQuery);
        if($query){
            echo "Done";
        }else{
            echo "Statement Error";
        }

    }

    public function VideoExist($url){
        $selectWithName = "select * from videos where url ='$url' ";
        $query =mysqli_query($this->con,$selectWithName);
        if($query){
            $records = mysqli_fetch_all($query,MYSQLI_ASSOC);
        }else{
            $records = 0;
        }

        if(count($records)>0){
            return 1;
        }else{
            return 0;
        }

    }
}
