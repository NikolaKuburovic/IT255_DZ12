<?php

include("config.php");
 
function checkIfLoggedIn(){
	global $conn;
	if(isset($_SERVER['HTTP_TOKEN'])){
		$token = $_SERVER['HTTP_TOKEN'];
		$result = mysqli_query($conn, "SELECT * FROM korisnik WHERE token='$token'");
		$num_rows = mysqli_num_rows($result);
		if($num_rows > 0)
		{
			return true;
		}
		else{
			return false;
		}
		}
	else{
		return false;
	}
	}
//-------------------------------------------------------------
//POVEZANO SA LOGIN.PHP
//-------------------------------------------------------------
function login($username, $password){
	global $conn;
	$rarray = array();
	if(checkLogin($username,$password)){
		$id = sha1(uniqid());
		$result2 = mysqli_query($conn,"UPDATE korisnik SET token='$id' WHERE username='$username'");
		$rarray['token'] = $id;
	} else{
		$rarray['error'] = "Pogresan username/password";
	}
	return json_encode($rarray);
}

//-------------------------------------------------------------
//POVEZANO SA REGSOBA.PHP
//-------------------------------------------------------------
function addRoom($ime, $sprat, $kreveti, $m2, $tv, $internet, $djakuzi, $rezervacija){
	global $conn;
	$rarray = array();
	$stmt = $conn->prepare("INSERT INTO soba (ime, sprat, kreveti, m2, tv, internet, djakuzi, rezervacija) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssssss",$ime, $sprat, $kreveti, $m2, $tv, $internet, $djakuzi, $rezervacija);
	if($stmt->execute()){
		$rarray['sucess'] = "ok";
	}else{
		$rarray['error'] = "Database connection error";
	}
	return json_encode($rarray);
}
//-------------------------------------------------------------
//POVEZANO SA REGHOTEL.PHP
//-------------------------------------------------------------
function addHotel($naziv, $brojSoba, $kategorija, $adresa, $lokacija){
	global $conn;
	$rarray = array();
	$stmt = $conn->prepare("INSERT INTO hotel (naziv, brojSoba, kategorija, adresa, lokacija) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("sssss",$naziv, $brojSoba, $kategorija, $adresa, $lokacija);
	if($stmt->execute()){
		$rarray['sucess'] = "ok";
	}else{
		$rarray['error'] = "Database connection error";
	}
	return json_encode($rarray);
}
//-------------------------------------------------------------
function checkLogin($username, $password){
	global $conn;
	$username = mysqli_real_escape_string($conn,$username);
	$password = md5(mysqli_real_escape_string($conn,$password));
	$result = mysqli_query($conn, "SELECT * FROM korisnik WHERE username='$username' AND password='$password'");
	$num_rows = mysqli_num_rows($result);
	if($num_rows > 0)
	{
		return true;
	}
	else{
		return false;
	}
}
//-------------------------------------------------------------
//POVEZANO SA REGISTER.PHP
//-------------------------------------------------------------
function register($username, $password, $ime, $prezime){
	global $conn;
	$rarray = array();
	$errors = "";
	if(checkIfUserExists($username)){
		$errors .= "Korisnicko ime vec postoji\r\n";
	}
	if(strlen($username) < 5){
		$errors .= "Korisnicko ime mora da ima najmanje 5 karaktera\r\n";
	}
	if(strlen($password) < 5){
		$errors .= "Lozinka mora da ima najmanje 5 karaktera\r\n";
	}
	if(strlen($ime) < 3){
		$errors .= "Ime mora da ima najmanje 3 karaktera\r\n";
	}
	if(strlen($prezime) < 3){
		$errors .= "Prezime mora da ima najmanje 3 karaktera\r\n";
	}
	if($errors == ""){
		$stmt = $conn->prepare("INSERT INTO korisnik (ime, prezime, username, password) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $ime, $prezime, $username, md5($password));
		if($stmt->execute()){
			$id = sha1(uniqid());
			$result2 = mysqli_query($conn,"UPDATE korisnik SET token='$id' WHERE username='$username'");
			$rarray['token'] = $id;
		}else{
			$rarray['error'] = "Database connection error";
		}
	} else{
		$rarray['error'] = json_encode($errors);
	}
	return json_encode($rarray);
}
//-------------------------------------------------------------
function checkIfUserExists($username){
	global $conn;
	$result = mysqli_query($conn, "SELECT * FROM korisnik WHERE username='$username'");
	$num_rows = mysqli_num_rows($result);
	if($num_rows > 0)
	{
		return true;
	}
	else{
		return false;
	}
}

?>