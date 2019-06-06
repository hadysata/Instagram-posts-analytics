
<?php

block() ;


$url = $_POST['URL'] ;
$code = "" ;
$pic = "Error : Can't find this post";


if (strpos($url, 'instagram.com/p/') == false) {
    $data['result'] = "This isn't a valid URL";
     $data['pic'] = "";
     echo json_encode($data) ;
    
    die();
}else{
    $url = explode("instagram.com/p/", $url);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.instagram.com/p/$url[1]");

$headers = [
    'Accept: */*',
'X-Requested-With: XMLHttpRequest',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36',
'X-IG-App-ID: 936619743392459',
'Referer: https://www.instagram.com/instagram/',
'Accept-Language: ar,en-US;q=0.9,en;q=0.8,und;q=0.7',
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
$respone = trim(curl_exec($ch));
curl_close($ch);

$result = explode('accessibility_caption":"', $respone);
$result = explode('","', $result[1]);
if (strlen($result[0]) >= 3){
    $data['result']  = $result[0];
    }else{
         $data['result']  = "Error : Can't find this post";
}


$pic = explode('og:image" content="', $respone);
$pic = explode('" />', $pic[1]);
if (strlen($pic[0]) >= 3){
    $data['pic'] =  '<img src="' . $pic[0] . '" >' ;
    }else{
        $data['pic'] = "";
}

add($result[0] , $pic[0]);

     echo json_encode($data) ;



function block(){
  $min_seconds_between_refreshes = 5;

session_start();

if(array_key_exists('last_access', $_SESSION) && time()-$min_seconds_between_refreshes <= $_SESSION['last_access']) {
  // The user has been here at least $min_seconds_between_refreshes seconds ago - block them
   $data['result'] = "You are going too quickly, please wait a few seconds and try again.";
     $data['pic'] = "";
  exit(json_encode($data));
}
// Record now as their last access time
$_SESSION['last_access'] = time();
}


function add($p,$t){
     include('config.php');




if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

$sql = "INSERT INTO IGAI (pic,txt)
VALUES ('$p', '$t')";

if ($db->query($sql) === TRUE) {
     
} else {

    
}

$db->close();

} 



?>