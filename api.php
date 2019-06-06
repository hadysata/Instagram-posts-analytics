
<?php

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
     echo json_encode($data) ;
?>
