<?php 
session_start();
// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(session_name(), '', time() - 42000,
//         $params["path"], $params["domain"],
//         $params["secure"], $params["httponly"]
//     );
// }
$_SESSION['userNumber' ] .= $_POST['userNumber']; //добавил в сессию число загаданное пользователем
$_SESSION['userNumber' ] .= ",";//разрыв между числами
$_SESSION['psychicOne' ] .= $_POST['psychicOne']; //Добавил значение экстрасенса первого 
$_SESSION['psychicOne' ] .= ",";//разрыв между числами
$_SESSION['psychicTwo' ] .= $_POST['psychicTwo']; //Добавил значение экстрасенса второго 
$_SESSION['psychicTwo' ] .= ",";//разрыв между числами
$_SESSION['userNumberArr' ] = explode(',', $_SESSION['userNumber']); // взрываем строку числе введенных пользователем для получения массива
$_SESSION['psychicOneArr' ] = explode(',', $_SESSION['psychicOne']); // взрываем строку чисел угаданных экстрасенсом первым для получения массива
$_SESSION['psychicTwoArr' ] = explode(',', $_SESSION['psychicTwo']); // взрываем строку чисел угаданных экстрасенсом первым для получения массива
if($_POST['userNumber'] !== $_POST['psychicOne']) {
	$_SESSION['prestigeOne'] -=1; // убрал еденицу престижа у первого экстрасенса
};
if($_POST['userNumber'] === $_POST['psychicOne']) {
	$_SESSION['prestigeOne'] +=1; //добавил еденицу престижа у первого экстрасенса
};
if($_POST['userNumber'] !== $_POST['psychicTwo']) {
	$_SESSION['prestigeTwo'] -=1; // убрал еденицу престижа у второго экстрасенса
};
if($_POST['userNumber'] === $_POST['psychicTwo']) {
	$_SESSION['prestigeTwo'] +=1;//добавил еденицу престижа у второго экстрасенса
};
$_SESSION['prestigeOneArr'] = explode(',', $_SESSION['prestigeOne']); // взорвал строку престижа для полученния массива престижа первого экстрасенса
$_SESSION['prestigeTwoArr'] = explode(',', $_SESSION['prestigeTwo']); // взорвал строку престижа для полученния массива престижа второго экстрасенса 
print_r($_SESSION);
echo json_encode(($_SESSION));
//Перезалил, не залил утром
 ?>
