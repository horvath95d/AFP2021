<?php
include("../connection.php");
$db = new dbObj();
$connection =  $db->getConnstring();
$request_method=$_SERVER["REQUEST_METHOD"];

switch ($request_method) {
	case 'GET':
		if(!empty($_GET["userid"]))
		{
			get_messages();
		}
		else{
			get_login(username, password);
		}
		break;

	case 'POST':
		if(!empty($_GET["userid"])){
			post_register(username, email, password);
		}
		else{
			if(!empty("text")){
				post_sendmessages(userid, text)
			}
			elseif (!empty("files")) {
				post_sendfiles(userid, files);
			}
			else{
				post_statuschange(userid, statusid);
			}
		}
	default:
		header("HTTP/1.0 405 Method Not Allowed");
		break;
}

function get_login($username, $password){
	$query="SELECT userid, username, , password, email, registerdate, statusid FROM user WHERE username = :username AND password = :password";
    $params = [
        ':username' => $username,
        ':password' => sha1($password)
    ];

    require_once DATABASE_CONTROLLER;

    $record = getRecord($query,$params);
    if (!empty($record)) {
        $_SESSION['userid'] = $record['userid'];
        $_SESSION['username'] = $record['username'];
        $_SESSION['password'] = $record['password'];
        $_SESSION['email'] = $record['email'];
        $_SESSION['registerdate'] = $record['registerdate'];
        $_SESSION['statusid'] = $record['statusid'];
        header('Location: index.php');
    }
    return false;
}

function get_messages(){
	global $connection;
    $query="SELECT * FROM message";
    $response=array();
    $result=mysqli_query($connection, $query);
    while($row=mysqli_fetch_array($result))
    {
        $response[]=$row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function post_register($username, $email, $password){
	$query = "SELECT userid FROM user WHERE email = ':email'";
    $params = [':email' => $email];

    require_once DATABASE_CONTROLLER;
    $record = getRecord($query,$params);
    if (empty($record)) {
        $query ="INSERT INTO user (first_name, last_name ,email, password) VALUES (:first_name, :last_name, :email, :password)";
        $params =[
            ':first_name' => $fname,
            ':last_name' => $lname,
            ':email' => $email,
            ':password' => sha1($password)
        ];
        if(executeDML($query,$params))
            header('location: index.php?P=login');
    }

    return false;
}

function post_statuschange($userid, $statusid){
    $query = "SELECT statusid FROM user WHERE userid = ':userid'";
    $params = [':statusid' => $statusid];
    if (empty($record)) {
        $query ="INSERT INTO user (statusid) VALUES (:statusid)";
        $params =[
            ':statusid' => $statusid
        ];
        if(executeDML($query,$params))
            header('location: index.php');
    }
}

function post_sendmessages($userid, $text){
    require_once DATABASE_CONTROLLER;
    $record = getRecord($query,$params);
    if (empty($record)) {
        $query ="INSERT INTO message (userid, text, timedate) VALUES (:userid, :text, :timedate)";
        $params =[
            ':userid' => $userid,
            ':text' => $text,
            ':timedate' => $timedate
        ];
        if(executeDML($query,$params))
            header('location: index.php');
    }

    return false;
}

function post_sendfiles(userid, files){
    require_once DATABASE_CONTROLLER;
    $record = getRecord($query,$params);
    if (empty($record)) {
        $query ="INSERT INTO message (userid, files, timedate) VALUES (:userid, :files, :timedate)";
        $params =[
            ':userid' => $userid,
            ':files' => $files,
            ':timedate' => $timedate
        ];
        if(executeDML($query,$params))
            header('location: index.php');
    }

    return false;
}

?>