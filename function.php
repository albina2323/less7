<?php 
function clear(){
    global $conn;
    foreach ($_POST as $key => $value) {
		$_POST[$key] = mysqli_real_escape_string($conn, $value);
	}
}
function save_mess(){
  if(!empty($_FILES)){
 
    /*print_r($_FILES);
    echo "</pre>";
    move_uploaded_file($_FILES['file']['tmp_name'],"uploads/".$_FILES['file']['name']);*/
      $uploaddir = 'uploads/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
  
       
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
           
            $text = " Файл корректен и был успешно загружен.";
        } else {
            $uploadfile = "uploads/error.jpg";
            $text = "Возможная атака с помощью файловой загрузки!";
        }
  
  }
    global $conn;
    clear();
    extract($_POST);
    #$text = mysqli_real_escape_string($conn, $_POST['text']);
    $query = "INSERT INTO mess (text,img) VALUES('$text','$uploadfile')";
    mysqli_query($conn, $query);
    
   
}
function get_mess(){
  
    if(!empty($_FILES)){
 
  /*print_r($_FILES);
  echo "</pre>";
  move_uploaded_file($_FILES['file']['tmp_name'],"uploads/".$_FILES['file']['name']);*/
    $uploaddir = 'uploads/';
      $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

     
      if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
         
          $text = " Файл корректен и был успешно загружен.";
      } else {
          $uploadfile = "uploads/error.jpg";
          $text = "Возможная атака с помощью файловой загрузки!";
      }

}
    global $conn;
  

    $query = "SELECT * FROM mess ORDER BY date DESC";
    $res = mysqli_query($conn, $query);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);

}

function tel_mess(){
    $text = $_POST['text'];
    $apiToken = "6853985014:AAEbFZ9H72mgs8sXggGCbLo6YV4S5bbFZz0";
    $data = [
      'chat_id' => '5283915179',
      'text' => $text
    ];
  $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" .
                                 http_build_query($data) );
}

function show_arr($arr){
    echo '<pre>'.print_r($arr, true).'</pre>';
}


?>
