<?php
error_reporting(-1);




//var_dump($uploadfile);
require_once "config.php";
require_once "function.php";


$db = clear();
//show_arr($db);
if(!empty($_POST)){
    save_mess();
    tel_mess();
    header("Location: {$_SERVER['PHP_SELF']}");
	exit;
}
$mess = get_mess();
#show_arr($mess);

//show_arr($_FILES);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}


/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
</style>

<body>
<h2>Chat Messages</h2>
<?php if(!empty($mess)) : ?>
    <?php foreach($mess as $messenger) : ?>
        <div class="container">
        <img src="<?=$messenger['img']; ?>" alt="Avatar" style="width:100%;">
        <a href='delete.php?id=<?= $messenger['id']; ?>'>
        <p><?=$messenger['text']; ?></p>
    </a>
        <span class="time-right"><?=$messenger['date']; ?></span>
        </div>
    <?php endforeach; ?>
<?php endif;?>

<button class="open-button" onclick="openForm()">Chat</button>

<div class="chat-popup" id="myForm">
<form action="" class="form-container" enctype="multipart/form-data" method="post">
    <h1>Chat</h1>

    <label for="msg"><b>Message</b></label>
    <textarea placeholder="Type message.." name="text" required></textarea>
     <input type="file" name="userfile" id="">
    
    <button type="submit" class="btn">Send</button>
    
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script>

function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  
}
</script>
</body>
</html>
