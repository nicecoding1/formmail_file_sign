<?php
/**
 * 폼메일 제작
 * 제작일: 2022/08/10
 * 개발자: 조재상
 */

include "mailer.php";

$mode = $_REQUEST['mode'];
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$name = $firstName." ".$lastName;
$phoneNumber = $_REQUEST['phoneNumber'];
$emailAddress = $_REQUEST['emailAddress'];
$address = $_REQUEST['address'];
$signImage = $_REQUEST['signImage'];
$ip = $_SERVER['REMOTE_ADDR'];

$subject = "[한인회 온라인신청] $name ";
$body = "";
$body .= "이름: $name<br>";
$body .= "휴대폰번호: $phoneNumber<br>";
$body .= "이메일주소: $emailAddress<br>";
$body .= "주소: $address<br>";

$admin_email = "oralol@naver.com";

if($mode == "send") {
	for($i=1;$i<=1;$i++) {
		$file[$i] = $_FILES['applyFile'.$i]['name'];
		$target[$i] = "./temp/".$file[$i];

		if (move_uploaded_file($_FILES['applyFile'.$i]['tmp_name'], $target[$i])) {
			chmod("$target[$i]", 0777);
		}
	}

	if($signImage != "") {
		list($type, $data) = explode(';', $signImage);
		list(, $data) = explode(',', $data);
		$data = base64_decode($data);
		$name2 = str_replace(" ", "_", $name);
		$fp = fopen("./temp/{$name2}.png", "wb");
		if($fp) {
			fwrite($fp, $data);
			fclose($fp);
			$file[2] = "{$name2}.png";
			$target[2] = "./temp/".$file[2];
		}
	}

	$from_name = $name;
	$from_email = $admin_email;
	$ret = mailer($from_name, $from_email, "ksam_ca", $admin_email, $subject, $body, $file);

	if($file[1] != "") @unlink($target[1]);
	if($file[2] != "") @unlink($target[2]);
	if($file[3] != "") @unlink($target[3]);
	
	echo "<meta http-equiv='content-type' content='text/html; charset=utf-8'>";
	if($ret) echo "<script>alert('폼메일 발송 성공');location.href='form.php';</script>";
	else echo "<script>alert('폼메일 발송 실패');history.back();</script>";
}

?>
