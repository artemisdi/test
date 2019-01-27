<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<div class="main-window">
	<div class="main-window__change" id='mainWindowChange'>

	</div>
	<div class="main-window__footer">
			<span id='test'></span>
		<div class="main-window__footer-counter">
			<table class='table table-bordered'>
				<thead class='thead-dark table table-bordered'>
				<tr>
					<th>Таблица достижений</th>
					<th>Экстрасенс JONI</th>
					<th>Экстрасенс ГРИГОРИЙ</th>
				</tr>
				</thead>
				<tr>
					<td>догадки</td>
					<td><span id='qwerty'></span></td>
					<td></td>
				</tr>
					<td>введеные пользователем числа</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Достоверность</td>
					<td></td>
					<td></td>
				</tr>
			</table>
			<div class="developer">
				<span>Разработал приложение</span><br>
				<span>Давлетшин Кирилл</span>
			</div>
		</div>
	</div>

</div>
<style>
	.main-window {

	min-width:400px;
	width:1000px;
	min-height:500px;
	height:700px;
	margin:20px auto;
	}

	.main-window__change {
	width:80%;
	height:50%;
	margin:auto;
	}

	.main-window__change > div {
	width: 50%;
    margin: auto;
	}

	.main-window__footer {
	margin-top:100px;
	}

	.main-window__footer .table {
	width:60%;
	margin:20px auto;
	}

	.main-window__footer .table th {
	text-align:center;
	}

	.main-window__footer .table {
		vertical-align: inherit;
	}

	.main-window__footer .table  tr td:not(:first-child) {
	text-align:center;
	}


		.developer {
			margin:15px;
			color:gray;
			width:100%;
		} 
	</style>
<script>
let login = 'login';
	let	pass = 'pass';
	let xhr = new XMLHttpRequest(); //создал новый экзэмпляр объекта
	let body = "login=" + login + "&pass=" + pass;
	xhr.open("POST", 'server.php', true); // куда отпраляем и каким методом, запросс асинхронный
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.send(body); //аргумент???r
	xhr.onload = function () { //какой код запроса приходит
		console.log(this.status);
	}
	xhr.onreadystatechange = function() {
		console.log(xhr.responseText);
	}
	 var numberOne;
	 var numberTwo;
	 var psychicOne;
	 var psychicTwo;
	 var psychicOnePrestige;
	 var psychicTwoPrestige;
	 var change = document.getElementById('mainWindowChange'),
	 greeting = '<div id="formNe"><p>Доброе время суток, нажмите кнопку,когда будете готовы играть</p><button id="buttonGreeting" >Нажмите</button></div>',
	 one = '<div id="formOne"><p>нажмите кнопку,когда будете готовы играть</p><p>У вас великолепная память :)</p><button id="buttonOne">Нажмите</button></div>',
	 two = '<div id="formTwo"><p>Загадайте число</p><input type="text" id="dataOne"><button id="buttonTwo">Нажмите</button ></div>',
	 three = '<div id="formThree"><table class="table table-bordered"><thead class="thead-dark table table-bordered"><tr><td>Экстрасенс JONI</td><td>Экстрасенс ГРИГОРИЙ</td></tr></thead><tr><td>Звезды говорят, это число '+ psychicOne +'</td><td>Духи подсказывают оно равно  '+ psychicTwo +'</td></tr></table><p>Подтвердите число</p><input type="text" id="dataTwo"><button id="buttonThree">Нажмите</button ></div>';
	 	 change.innerHTML = greeting; //добавил кнопку первоначального экрана
	 	 var arr = [];
	 function addWindowTwo() {
	 	console.log(psychicOne);
	 	console.log(psychicTwo);
	 	if (document.getElementById('formNe')) {	//условие, если есть экран приветствия
	 		document.getElementById('buttonGreeting').onclick = function () {	//при клике на кнопку вызывается функция которая меняет экран 
	 			change.innerHTML = two;
	 			if (document.getElementById('formTwo')) {
	 				document.getElementById('buttonTwo').onclick = function () {
	 					if (document.getElementById('dataOne').value <=9 || document.getElementById('dataOne').value >= 100) {	// если число вводимое больше 100 или меньше 10 тогда все начинаем по новой
							alert('Я думал мы с тобой договорилимь, что числа будут в диапазоне от 10 и до 99');
	 						change.innerHTML = greeting ;
	 						 addWindowTwo();
	 					} else { //иначе продолжаем игру
	 					psychicOne = randomPsy(10, 99);//присваиваем первому экстрасенсу число
	 					psychicTwo = randomPsy(10, 99);//присваиваем второму экстрасенсу число
	 					console.log(psychicOne);
	 					console.log(psychicTwo);
	 					numberOne = document.getElementById('dataOne').value; //запомнили значение первое
	 					change.innerHTML = three;
	 					
	 					if (document.getElementById('formThree')) {
	 						document.getElementById('buttonThree').onclick = function () {
	 							numberTwo = document.getElementById('dataTwo').value;//запомнили значение второе
	 							if (numberOne !== numberTwo) {
	 								alert('введеные значения не совпадают, вы хотите нас обмануть?');
	 								change.innerHTML = greeting ;
	 								addWindowTwo();
	 							}
	 							else {//иначе(если числа совпадают) сравниваем результаты и отправляем на сервер
	 								if (numberOne == psychicOne) {	//если 1 экстрасенс угадал
	 									psychicOnePrestige = true;		// тогда присваиваем 1
	 								}
	 								if (numberOne != psychicOne) {	//если 1 не угадал
	 									psychicOnePrestige = false;	// присваиваем -1
	 								}
	 								if (numberOne == psychicTwo) { //если 2 экстрасенс угадал
	 									psychicTwoPrestige = true;		// тогда присваиваем 1
	 								}
	 								if (numberOne != psychicTwo) {	//если 2 не угадал
	 									psychicTwoPrestige = false;	// присваиваем -1
	 								}	
	 							change.innerHTML = one;
	 							document.getElementById('test').innerHTML = psychicOne;
	 							addWindowTwo();	 
	 							// console.log(numberOne);
	 							// console.log(numberTwo);
	 							// console.log(psychicOne);
	 							// console.log(psychicTwo);
	 							// console.log(psychicOnePrestige);
	 							// console.log(psychicTwoPrestige);								
	 							}
	 						}
	 					}
	 					}

	 				}
	 			}
	 		}
	 	}
	 	else if (document.getElementById('formOne')) {
	 		console.log('зашли во второе условие');
	 		document.getElementById('buttonOne').onclick = function () {
				change.innerHTML = two;
				if (document.getElementById('formTwo')) {
					document.getElementById('buttonTwo').onclick = function () {
						if (document.getElementById('dataOne').value <=9 || document.getElementById('dataOne').value >= 100) {	// если число вводимое больше 100 или меньше 10 тогда все начинаем по новой
							alert('Я думал мы с тобой договорилимь, что числа будут в диапазоне от 10 и до 99');
	 						change.innerHTML = greeting ;
	 						 addWindowTwo();
	 					} else { //иначе продолжаем игру
						numberOne = document.getElementById('dataOne').value; //запомнили значение первое
						change.innerHTML = three;
						if (numberOne >= 21 && numberOne <= 50) { //делаем наших экстрасенсов более сильными
							// console.log('значение от 21 до 50');
							psychicOne = randomPsy(21, 50);//присваиваем первому экстрасенсу число приближенное
							psychicTwo = randomPsy(21, 50);//присваиваем первому экстрасенсу число приближенное
						} else if(numberOne >= 51 && numberOne<= 99) {
							// console.log('значение от 51 до 90');
							psychicOne = randomPsy(51,90);//присваиваем первому экстрасенсу число приближенное
							psychicTwo = randomPsy(51,90);//присваиваем первому экстрасенсу число приближенное
						} else {
							// console.log('иначе будут гадать как бабки :)')
						  	psychicOne = randomPsy(10, 99);//присваиваем первому экстрасенсу число
	 						psychicTwo = randomPsy(10, 99);//присваиваем второму экстрасенсу число
						}

						if (document.getElementById('formThree')) {
								document.getElementById('buttonThree').onclick = function () {
								numberTwo = document.getElementById('dataTwo').value;//запомнили значение второе
								if(numberOne !== numberTwo) {
	 								alert('введеные значения не совпадают, вы хотите нас обмануть?');
	 								change.innerHTML = greeting ;
	 								addWindowTwo();
	 							}
	 							else {
									if (numberOne == psychicOne) {	//если 1 экстрасенс угадал
	 									psychicOnePrestige = true;		// тогда присваиваем 1
	 								}
	 								if (numberOne != psychicOne) {	//если 1 не угадал
	 									psychicOnePrestige = false;	// присваиваем -1
	 								}
	 								if (numberOne == psychicTwo) { //если 2 экстрасенс угадал
	 									psychicTwoPrestige = true;		// тогда присваиваем 1
	 								}
	 								if (numberOne != psychicTwo) {	//если 2 не угадал
	 									psychicTwoPrestige = false;	// присваиваем -1
	 								}		 								
	 								change.innerHTML = one;
	 								document.getElementById('qwerty').innerHTML = numberOne;
	 								document.getElementById('test').innerHTML = psychicOne;
	 								addWindowTwo();
	 							}
	 						}
						}
	 					}

					}
				}
	 		}
	 	}
	 }
	 		  addWindowTwo();
	  function randomPsy(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}


</script>
</body>
</html>

