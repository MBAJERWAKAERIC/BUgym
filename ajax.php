<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'update_account'){
	$save = $crud->update_account();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_plan"){
	$save = $crud->save_plan();
	if($save)
		echo $save;
}

if($action == "delete_plan"){
	$delete = $crud->delete_plan();
	if($delete)
		echo $delete;
}
if($action == "save_package"){
	$save = $crud->save_package();
	if($save)
		echo $save;
}

if($action == "delete_package"){
	$delete = $crud->delete_package();
	if($delete)
		echo $delete;
}
if($action == "save_trainer"){
	$save = $crud->save_trainer();
	if($save)
		echo $save;
}

if($action == "delete_trainer"){
	$delete = $crud->delete_trainer();
	if($delete)
		echo $delete;
}
if($action == "save_member"){
	$save = $crud->save_member();
	if($save)
		echo $save;
}
if($action == "delete_member"){
	$save = $crud->delete_member();
	if($save)
		echo $save;
}

if($action == "save_schedule"){
	$save = $crud->save_schedule();
	if($save)
		echo $save;
}
if($action == "delete_schedule"){
	$save = $crud->delete_schedule();
	if($save)
		echo $save;
}
if($action == "get_schecdule"){
	$get = $crud->get_schecdule();
	if($get)
		echo $get;
}
if($action == "delete_forum"){
	$save = $crud->delete_forum();
	if($save)
		echo $save;
}

if($action == "save_payment"){
	$save = $crud->save_payment();
	if($save)
		echo $save;
}

if($action == "renew_membership"){
	$save = $crud->renew_membership();
	if($save)
		echo $save;
}

if($action == "end_membership"){
	$save = $crud->end_membership();
	if($save)
		echo $save;
}
if($action == "save_membership"){
	$save = $crud->save_membership();
	if($save)
		echo $save;
}	
if($action == "participate"){
	$save = $crud->participate();
	if($save)
		echo $save;
}
if($action == "get_venue_report"){
	$get = $crud->get_venue_report();
	if($get)
		echo $get;
}
if($action == "save_art_fs"){
	$save = $crud->save_art_fs();
	if($save)
		echo $save;
}
if($action == "delete_art_fs"){
	$save = $crud->delete_art_fs();
	if($save)
		echo $save;
}
if($action == "get_pdetails"){
	$get = $crud->get_pdetails();
	if($get)
		echo $get;
}
ob_end_flush();
?>
