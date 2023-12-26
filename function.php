<?php 
function clear(){
    global $conn;
    foreach ($_POST as $key => $value) {
		$_POST[$key] = mysqli_real_escape_string($conn, $value);
	}
}
function save_mess(){
    global $conn;
    clear();
    extract($_POST);
    #$text = mysqli_real_escape_string($conn, $_POST['text']);
    $query = "INSERT INTO mess (text) VALUES('$text')";
    mysqli_query($conn, $query);
    
   
}
function get_mess(){
    global $conn;
    $query = "SELECT * FROM mess ORDER BY date DESC";
    $res = mysqli_query($conn, $query);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);

}

function tel_mess(){
    $text = $_POST['text'];
    $apiToken = "6786168897:AAGkTJsi-de3zI7Ib1ndP-WRE2b3ksdHvXo";
    $data = [
      'chat_id' => '790926957',
      'text' => $text
    ];
  $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" .
                                 http_build_query($data) );
}

function show_arr($arr){
    echo '<pre>'.print_r($arr, true).'</pre>';
}


?>