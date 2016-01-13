<?php

function sendMsg($number, $subject, $message,$account) {
	include 'connection.php';
	$msgid=uniqid('SS');
	
	$msgEncode=urlencode($message);
	$url = "http://192.168.1.101:9300/cgi-bin/sendsms?username=pushme&password=pwd&to=$number&from=$subject&smsc=nalo&text=$msgEncode&dlr-mask=31";
	file_get_contents($url);
	
	
	$query = "Insert INTO msglogs (id,account,msisdn,subject,message)VALUES('$msgid','$account','$number','$subject','$message')";
	$result = mysqli_query($link, $query);
}

function schdMsg($numbers, $subject, $message,$account,$schdtime,$numberCount) {
	include 'connection.php';
	$msgid=uniqid('SSchd');
	
	$query = "Insert INTO schdMsg (id,account,msisdn,subject,message,status,schdtime,numberCount)VALUES('$msgid','$account','$numbers','$subject','$message','pending','$schdtime',$numberCount')";
	$result = mysqli_query($link, $query);
}
?>