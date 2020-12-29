<?php
header("Access-Control-Allow-Origin: *");
$id='';
require_once '../Controllers/videos.php';

$json='';

$videos = new Videos();
if (isset($_POST['viewRecord'])) {
        #region view one record
    $id =$_POST['id'];
    $video = $videos->selectWithId($id);
//var_dump($video);
    $src="";
    foreach ($video as $v){
        //"test_upload/".
        $src=$videos->selectWithId($v['id'])[0]['url'];
        $images[] = $src;
    }
    if(@$images) {
        $json = array("status" => 0, "images" => $images);
    }else{
        $json = array("status" => 0, "images" => 'you have no images with this id');
    }


    #endregion
    }else if (isset($_POST['Upload'])) {
        #region Upload Video

        $url_name = $_POST['url_name'];
        //$url_tmp_name=$_FILES['VideoUrl']['tmp_name'];
        $res = $videos->insert($id,$url_name);
        $json = array("status" => 2, "msg" => $url_name);

    #endregion
    }else if(isset($_POST['viewAllRecords'])){
        #region viewAllVideos
        $images = [];
        $video = $videos->selectAll();
        $src="";
        foreach ($video as $v){
            $src="test_upload/".trim($videos->selectWithId($v['id'])[0]['url'],'.');
            $images[] = $src;
        }
        $json = array("status" => 0, "images" =>$images);

    #endregion
    }else{
        $json = array("status" => 3, "msg" =>'Request Error');
    }
//$json = array("status" => 3, "images" =>'1222211');



header('Content-type: application/json');
echo json_encode($json);

/*if($exist === 0) {
    $qur = $videos->insert($id,$_POST['Upload']);
    if ($qur == 1) {
        //new video
        $json = array("status" => 1, "msg" => "Video uploaded and Moved Successfully !");
    } else if ($qur == 0) {
        //exist video
        $json = array("status" => 0, "msg" => "Video is  already exist !");
    } else if ($qur == 2) {
        // we didn't use post
        $json = array("status" => 2, "msg" => "Request error!");
    }else if ($qur == 3) {
        //un supported format
        $json = array("status" => 3, "msg" => "We dont support this format !");
    }
}else if($exist === 1){
    $json = array("status" => 3, "msg" => "Video already exists!");
}else if($exist == 2) {
    $json = array("status" => 3, "msg" => "we don't support this format!");
}else{
    $json = array("status" => 3, "msg" => "moka");

}*/