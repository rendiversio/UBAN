<?php
//cekklikindo
$header[] = "Content-Type: application/json";
$header[] = "Host: api.klikindomaret.com";
$header[] = "Connection: Keep-Alive";
$header[] = "User-Agent: okhttp/3.12.1";
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
$a12 = generate_string($permitted_chars, 12);
$a4 = generate_string($permitted_chars, 4);
$a41 = generate_string($permitted_chars, 4);
$a42 = generate_string($permitted_chars, 4);
$a8 = generate_string($permitted_chars, 8);
$permitted_charsa = '0123456789';
$angkaq = generate_string($permitted_charsa, 4);
$url = "https://api.klikindomaret.com/api/Customer/LoginViaMobileApps?isMobile=true&device_token=".$a8."-".$a42."-".$a41."-".$a4."-".$a12."&districtID=".$angkaq."&TrafficSource=";
echo "----------------------------------------------\n";
echo "Cek Kupon Akun Klik Indomaret\n";
echo "We Are Brothers Official\n";
echo "----------------------------------------------\n";
$nom = readline("[+]Nomor Kamu => ");
$pw = readline("[+]Password Kamu => ");
$data = '{"Email":"'.$nom.'","Password":"'.$pw.'"}';
$res = curl($url,$header,"post",$data);
$ari = json_decode($res,true);
$meseg = $ari["Message"];
echo "[+]Login => ".$meseg."\n";
$respon = $ari["ResponseID"];
$id = $ari["ResponseObject"]["ID"];
$url = "https://api.klikindomaret.com/api/Customer/Account?access_token=".$respon;
$res = curl($url,$header,"get",$data);
$kupon = json_decode($res,true);
$result = $kupon["0"]["CustNotifications"];
foreach($result as $kode){
echo $kode["Title"]."\n";
echo $kode["Message"]."\n";
}


function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
 

function curl($url, $header, $mode="get", $data=0)
	{
	if ($mode == "get" || $mode == "Get" || $mode == "GET")
		{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		$result = curl_exec($ch);
		}
	elseif ($mode == "post" || $mode == "Post" || $mode == "POST")
		{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		$result = curl_exec($ch);
		}
	else
		{
		$result = "Not define";
		}
	return $result;
	}
function random($length,$a)
	{
		$str = "";
		if ($a == 0) {
			$characters = array_merge(range('0','9'));
		}elseif ($a == 1) {
			$characters = array_merge(range('0','9'),range('a','z'));
		}
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
function nama()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$ex = curl_exec($ch);
		preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
		return $name[2][mt_rand(0, 14) ];
	}


