<?php session_start();?>
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
		<div id="formOne" ><p>Доброе время суток, нажмите кнопку,когда будете готовы играть</p>
			<div><button id="buttonOne" class='btn btn-dark'>Нажмите</button></div>
		</div>
		<div id="formTwo" class='hidden'><p>нажмите кнопку,когда будете готовы играть</p><p>У вас великолепная память :)</p>
			<div>
				<button id="buttonTwo" class='btn btn-dark'>Нажмите</button>
			</div>
		</div>
		<div id="formThree" class='hidden'><p>Загадайте двухзначное число</p>
			<div>
				<input type="text" id="dataOne" class="form-control" maxlength="2" placeholder="~10-99~"><button id="buttonThree" class='btn btn-dark'>Нажмите</button >
			</div>
		</div>
		<div id="formFour" class='hidden'><table class="table table-bordered"><thead class="thead-dark table table-bordered"><tr><td>Экстрасенс JONI</td><td>Экстрасенс ГРИГОРИЙ</td></tr></thead><tr><td>Звезды говорят, это число <span id='numberExtraOne'></span></td><td>Духи подсказывают оно равно <span id='numberExtraTwo'></span></td></tr></table><p>Подтвердите загаданное число</p>
			<div>
				<input type="text" id="dataTwo" class="form-control" maxlength="2" placeholder="~10-99~"><button id="buttonFour" class='btn btn-dark'>Нажмите</button>
			</div>
		</div>
	</div>
	<div class="main-window__footer">
		<p id='test-one'></p>
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
					<td>
						<ul id='numbExtraOne'></ul>
					</td>
					<td>
						<ul id='numbExtraTwo'></ul>
					</td>
				</tr>
					<td>введеные пользователем числа</td>
						<td>
							<ul id='numberPlayerExtrOne'></ul>
						</td>
						<td>
							<ul id='numberPlayerExtrTwo'></ul>
						</td>
				</tr>
				<tr>
					<td>Престиж</td>
					<td>
						<span id='prestigeExOne'></span>
					</td>
					<td>
						<span id='prestigeExTwo'></span>
					</td>
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
	.hidden {
		display:none;
	}

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
		width: 75%;
    	margin: auto;
	}

	.main-window__change > div input {
		margin-right:20px;

	}

	.main-window__change > div > div {
		display: flex;
		justify-content: center;
	}

	li {
		list-style-type: none;
		margin-left:-40px;
	}

	.main-window__change > div p {
		text-align: center;
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
	
	table td {
		vertical-align: inherit;
	}

	.developer {
		margin:15px;
		color:gray;
		width:100%;
	
	} 
	</style>
<script>
let xhr = new XMLHttpRequest(); //создал новый экзэмпляр объекта	
	let x;
	let dataServer;     // полученные данные с сервера
	let prestigeOneArr; // престиж первого экстрасенса
	let prestigeTwoArr; // престиж второго экстрасенса
	let psychicOneArr;  // значения которые предположил экстрасенс первый
	let psychicTwoArr;  // значения которые предположил экстрасенс второй
	let userNumberArr;  // значение которое загадал пользователь

	 function addWindowTwo() {
	 	// console.log('вызвали функцию');
	 	let formOne = document.getElementById('formOne'), // блок отоброжения первой страницы
	 		formTwo = document.getElementById('formTwo'), //  блок отоброжения второй страницы
	 		formThree = document.getElementById('formThree'),//  блок отоброжения третьей страницы
	 		formFour = document.getElementById('formFour'), //  блок отоброжения четвертой страницы
	 		inputOne = document.getElementById('dataOne'),	// поле вводимое пользователем в первый раз
	 		inputTwo = document.getElementById('dataTwo'), //  поле вводимое пользователем во второй раз
	 		buttonOne = document.getElementById('buttonOne'), // кнопка на первой странице
	 		buttontwo = document.getElementById('buttonTwo'), // кнопка на второй странице
	 		buttonthree = document.getElementById('buttonThree'), // кнопка на третьей странице
	 		buttonFour = document.getElementById('buttonFour'), // кнопка на четвертой странице
	 		extraOne = document.getElementById('numberExtraOne'), // значение экстрасенса первого 
	 		extratwo = document.getElementById('numberExtratwo'), // значение экстрасенса второго 
	 		prestigeExtraOne, // значение экстрасенса второго 
	 		prestigeExtratwo, // значение экстрасенса второго 
			arr = []; //для запоминания и отправки на сервер
			inputOne.value = ''; //очистили поля для ввода первое
			inputTwo.value = ''; //очистили поля для ввода второе
			if(!(formOne.classList.contains('hidden'))) {	//проверяем наличие класса у первой страниц
				// console.log('Зашли в первое условие');
				buttonOne.onclick = function () {	//тогда вызывается обработчик событий onclick
					// console.log('нажал кнопку')
					formOne.classList.add('hidden');	//скрываем первую страницу
					formThree.classList.remove('hidden'); // выводим третью
					buttonthree.onclick = function () {
						if (inputOne.value >= 10 && inputOne.value <=50 ) {
							extraOne = randomPsy(10, 50); //присвоил значение первому экстрасенсу
							extratwo = randomPsy(10, 50); //присвоил значение второму экстрасенсу
						}
						else {
							extraOne = randomPsy(50, 99); //присвоил значение первому экстрасенсу
							extratwo = randomPsy(50, 90); //присвоил значение второму экстрасенсу
						}
						
						if(inputOne.value <= 9 || inputOne.value >= 100) {
							// console.log('зашли в условие, если больше 99 или меньше 10');
							alert('я думал тебе понятны условия игры');
							formThree.classList.add('hidden');	//скрываем первую страницу
							formOne.classList.remove('hidden'); // выводим первую
							addWindowTwo();
						}
						else {
						numberExtraOne.innerHTML = extraOne; //вывели значение первого экстрасенса на экран
						numberExtraTwo.innerHTML = extratwo; //вывели значение второго экстрасенса на экран
							if (inputOne.value == extraOne) { // проверяем, совпадают ли наши значения с экстрасенсом 1
								prestigeExtraOne = 1;	 //если да то true
							}
							if (inputOne.value != extraOne) { // проверяем, совпадают ли наши значения с экстрасенсом 1
								prestigeExtraOne = -1; //если нет то false
							}
							if (inputOne.value == extratwo) { // проверяем, совпадают ли наши значения с экстрасенсом 2
								prestigeExtratwo = 1; //если да то true
							}
							if (inputOne.value != extratwo) { // проверяем, совпадают ли наши значения с экстрасенсом 2
								prestigeExtratwo = 0; //если нет то false
							}
							// console.log(prestigeExtraOne);
							// console.log(prestigeExtratwo);
						// console.log('зашли в условие, если ввели все хорошо');
						formThree.classList.add('hidden');	//скрываем третью страницу
						formFour.classList.remove('hidden'); // выводим четвертую
						buttonFour.onclick = function () { // нажали четвертую кнопку для перехода на новую игру (продолжение)
							if(inputOne.value != inputTwo.value) { //проверка на совпадения чисел которые ввел пользователь за 1 раунд
								alert('обманывать не хорошо, нужно вводить тоже самое значение как и в первый раз :)');
								formFour.classList.add('hidden');	//скрываем четвертую страницу
								formTwo.classList.remove('hidden'); // выводим первую
								addWindowTwo();
							}
							else { //иначе запускаем стандартную систему 
							formFour.classList.add('hidden');	//скрываем четвертую страницу
							formTwo.classList.remove('hidden'); // выводим вторую
								var userNumber = String(inputOne.value),
									psychicOne = extraOne,
									psychicTwo = extratwo,
									body = "userNumber=" + userNumber + "&psychicOne=" + psychicOne + "&psychicTwo=" + psychicTwo;
								xhr.open("POST", 'server.php', true); // куда отпраляем и каким методом, запросс асинхронный
								xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
								xhr.send(body); //аргумент???r
								xhr.onload = function () { //какой код запроса приходит
								// console.log(this.status); // отоброжение кода запроса с сервера
								if(this.status === 200) {
									// console.log('все окей');
									if(this.status === 200) {
									// console.log('все окей');
									x = this.response;
									dataServer = JSON.parse(x); // переменная после парсинга числа угаданные первым экстрасенсом
									// console.log(dataServer);
									userNumberArr = dataServer.userNumberArr; // записали данные которые пользователь ввел
									psychicOneArr = dataServer.psychicOneArr; // записали данные которые экстрасенс 1й угадал 
									psychicTwoArr = dataServer.psychicTwoArr; // записали данные которые экстрасенс 2й угадал 
									prestigeOneArr = dataServer.prestigeOne; // записали данные престижа в виде числа 1й экстрасенс
									prestigeTwoArr = dataServer.prestigeTwo; // записали данные престижа в виде числа 2й экстрасенс
									// console.log(userNumberArr);
									// console.log(psychicOneArr);
									// console.log(psychicTwoArr);
									// console.log(prestigeOneArr);
									// console.log(prestigeTwoArr);
										let numberPlayOne = document.createElement('li'), // li под первого экстрасенса введеным пользователем
											numberPlayTwo = document.createElement('li'), // li под второго экстрасенса введеным пользователем
											numbExtraSaveOne = document.createElement('li'),
											numbExtraSaveTwo = document.createElement('li');
										//подставляем значение под первого экстрасенса значения введеные пользователем
  										numberPlayOne.innerHTML = userNumberArr[0];       // под первого экстрасенса (записали 0 элемент)
  										numberPlayerExtrOne.appendChild(numberPlayOne);   // отобразили значение 

  										//подставляем значение под второго экстрасенса значения введеные пользователем
  										numberPlayTwo.innerHTML = userNumberArr[0];
  										numberPlayerExtrTwo.appendChild(numberPlayTwo);

  										//подставляем данные от экстрасенса первого
  										numbExtraSaveOne.innerHTML = psychicOneArr[0];
  										numbExtraOne.appendChild(numbExtraSaveOne);

  										//подставляем данные от экстрасенса второго
  										numbExtraSaveTwo.innerHTML = psychicTwoArr[0];
  										numbExtraTwo.appendChild(numbExtraSaveTwo);
  										console.log(userNumberArr[0]);
  										console.log(psychicOneArr[0]);
  										console.log(psychicTwoArr[0]);
  										
  										//подставляем престиж первого экстрасенса
  										document.getElementById('prestigeExOne').innerHTML = prestigeOneArr;
  										// //подставляем престиж второго экстрасенса
  										document.getElementById('prestigeExTwo').innerHTML = prestigeTwoArr;
  										// if (prestigeOneArr < 0 ) {
  										// 	document.getElementById('prestigeExOne').innerHTML = 'Не внушает доверие';
  										// }
  										// if (prestigeTwoArr < 0 ) {
  										// 	document.getElementById('prestigeExTwo').innerHTML = 'Не внушает доверие';
  										// }
  										// if (prestigeOneArr >= 0 && prestigeOneArr <=5 ) {
  										// 	document.getElementById('prestigeExOne').innerHTML = 'я тебя не обману';
  										// }
  										// if (prestigeTwoArr >= 0 && prestigeTwoArr <=5 ) {
  										// 	document.getElementById('prestigeExTwo').innerHTML = 'Не внушает доверие';
  										// }
  										// if (prestigeOneArr >= 6  ) {
  										// 	document.getElementById('prestigeExOne').innerHTML = 'просто БОГ фортуны';
  										// }
  										// if (prestigeTwoArr >= 6 ) {
  										// 	document.getElementById('prestigeExTwo').innerHTML = 'просто БОГ фортуны';
  										// }


								}
								}
								}
								xhr.onreadystatechange = function() {
								// console.log(xhr.responseText);
							
								}	

									addWindowTwo();
							}

						}
						}

					}
				}
			}
			else if (!(formTwo.classList.contains('hidden'))) { //проверяем наличие класса у второй страниц
				// console.log('Зашли во второе условие');
				buttontwo.onclick = function () {
					formTwo.classList.add('hidden');	//скрываем вторую страницу
					formThree.classList.remove('hidden'); // выводим третью	
					buttonThree.onclick = function () {
						if (inputOne.value >= 10 && inputOne.value <=50 ) {
							extraOne = randomPsy(10, 50); //присвоил значение первому экстрасенсу
							extratwo = randomPsy(10, 50); //присвоил значение второму экстрасенсу
						}
						else {
							extraOne = randomPsy(50, 90); //присвоил значение первому экстрасенсу
							extratwo = randomPsy(50, 90); //присвоил значение второму экстрасенсу
						}
						// else if ( inputOne.value >= 51 && inputOne.value <= 99 ) { //если больше 51 и меньше 99
						// 	// let extraRand = randomPsy(1, 20); //вызов функции рандома для опредления более сильного экстрасэнса
						// 	// // console.log(extraRand)
						// 	// console.log('зашли а у словие больше 51 и меньше 99');
						// 		if(inputOne.value > 60 && inputOne.value < 90) { //если введенное больше 60 и меньше 90
						// 			if(inputOne.value >= 70 && inputOne.value <= 80) { // если больше 70 и меньше 80
						// 				console.log('зашли в условие ксли больше 70 и менььше 80');
						// 				extraOne = randomPsy(70, 75); //присвоил значение первому экстрасенсу шанс 10%
						// 				extratwo = randomPsy(75, 80); //присвоил значение второму экстрасенсу шанс 10%
						// 			} else  { //иначе 
						// 				console.log('зашли в условие иначе');
						// 				extraOne = randomPsy(60, 70); //присвоил значение первому экстрасенсу 3% шанс
						// 				extratwo = randomPsy(80, 90); //присвоил значение второму экстрасенсу 3% шанс
						// 			}
						// 		} else {
						// 			console.log('зашли в условие иначе');
						// 			extraOne = randomPsy(60, 90); //присвоил значение первому экстрасенсу 3% шанс
						// 			extratwo = randomPsy(60, 90); //присвоил значение второму экстрасенсу 3% шанс
						// 		}
						// 		else if (extraRand < 10) {
						// 		console.log('зашли в условие vtymit 10 random');
						// 		// console.log('функция рандома определила меньше 10, будем гадать от 51 до 99');
						// 		extraOne = randomPsy(51, 99); //присвоил значение первому экстрасенсу
						// 		extratwo = randomPsy(51, 99); //присвоил значение второму экстрасенсу
						// 	}		
						// }
						if(inputOne.value <= 9 || inputOne.value >= 100) {
						// console.log('зашли в условие, если больше 99 или меньше 10');
						alert('я думал тебе понятны условия игры');
						formThree.classList.add('hidden');	//скрываем первую страницу
						formOne.classList.remove('hidden'); // выводим третью
						addWindowTwo();
					} else {
						numberExtraOne.innerHTML = extraOne; //вывели значение первого экстрасенса на экран
						numberExtraTwo.innerHTML = extratwo; //вывели значение второго экстрасенса на экран
						if (inputOne.value == extraOne) { // проверяем, совпадают ли наши значения с экстрасенсом 1
								prestigeExtraOne =true;	 //если да то true
							}
						if (inputOne.value != extraOne) { // проверяем, совпадают ли наши значения с экстрасенсом 1
								prestigeExtraOne = false; //если нет то false
							}
						if (inputOne.value == extratwo) { // проверяем, совпадают ли наши значения с экстрасенсом 2
								prestigeExtratwo =true; //если да то true
							}
						if (inputOne.value != extratwo) { // проверяем, совпадают ли наши значения с экстрасенсом 2
								prestigeExtratwo = false; //если нет то false
							}
							// console.log(prestigeExtraOne);
							// console.log(prestigeExtratwo);
						// console.log(extraOne)
						formThree.classList.add('hidden');	//скрываем третью страницу
						formFour.classList.remove('hidden'); // выводим четвертую
						buttonFour.onclick = function () {
							
							if(inputOne.value != inputTwo.value) {	//проверка на совпадения чисел которые ввел пользователь за 1 раунд
							alert('обманывать не хорошо, нежно вводить тоже самое значение как и в первый раз :)');
							formFour.classList.add('hidden');	//скрываем четвертую страницу
							formOne.classList.remove('hidden'); // выводим первую
							addWindowTwo();
							} else { //иначе запускаем стандартную систему 
								formFour.classList.add('hidden');	//скрываем четвертую страницу
								formTwo.classList.remove('hidden'); // выводим вторую
								var userNumber = inputOne.value,
								psychicOne = extraOne,
								psychicTwo = extratwo,
								body = "userNumber=" + userNumber + "&psychicOne=" + psychicOne + "&psychicTwo=" + psychicTwo;
								xhr.open("POST", 'server.php', true); // куда отпраляем и каким методом, запросс асинхронный
								xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
								xhr.send(body); //тело передачи
								xhr.onload = function () { //какой код запроса приходит
								// console.log(this.status);
								if(this.status === 200) {
									// console.log('все окей');
									x = this.response;
									dataServer = JSON.parse(x);
									userNumberArr = dataServer.userNumberArr; // записали данные которые пользователь ввел
									psychicOneArr = dataServer.psychicOneArr; // записали данные которые экстрасенс 1й угадал 
									psychicTwoArr = dataServer.psychicTwoArr; // записали данные которые экстрасенс 2й угадал 
									prestigeOneArr = dataServer.prestigeOne; // записали данные престижа в виде числа 1й экстрасенс
									prestigeTwoArr = dataServer.prestigeTwo; // записали данные престижа в виде числа 2й экстрасенс
									// console.log(userNumberArr);
									// console.log(psychicOneArr);
									// console.log(psychicOneArr.length-1);
									// console.log(psychicTwoArr);
									// console.log(prestigeOneArr);
									// console.log(prestigeTwoArr);
									let numberPlayOne = document.createElement('li'), // li под первого экстрасенса введеным пользователем
										numberPlayTwo = document.createElement('li'), // li под второго экстрасенса введеным пользователем
										numbExtraSaveOne = document.createElement('li'),
										numbExtraSaveTwo = document.createElement('li');
										//подставляем значение под первого экстрасенса значения введеные пользователем
  									numberPlayOne.innerHTML = userNumberArr[userNumberArr.length-2];       // под первого экстрасенса (записали 0 элемент)
  									numberPlayerExtrOne.appendChild(numberPlayOne);   // отобразили значение 
  										//подставляем значение под второго экстрасенса значения введеные пользователем
  									numberPlayTwo.innerHTML = userNumberArr[userNumberArr.length-2];
  									numberPlayerExtrTwo.appendChild(numberPlayTwo);

  										//подставляем данные от экстрасенса первого
  									numbExtraSaveOne.innerHTML = psychicOneArr[psychicOneArr.length-2];
  									numbExtraOne.appendChild(numbExtraSaveOne);

  										//подставляем данные от экстрасенса второго
  									numbExtraSaveTwo.innerHTML = psychicTwoArr[psychicTwoArr.length-2];
  									numbExtraTwo.appendChild(numbExtraSaveTwo);

  									// 	//подставляем престиж первого экстрасенса
  									document.getElementById('prestigeExOne').innerHTML = prestigeOneArr;
  									// 	//подставляем престиж второго экстрасенса
  									document.getElementById('prestigeExTwo').innerHTML = prestigeTwoArr;
  									// if(prestigeOneArr < 0 ) {
  									// 		document.getElementById('prestigeExOne').innerHTML = 'Не внушает доверие';
  									// 	}
  									// if(prestigeTwoArr < 0 ) {
  									// 		document.getElementById('prestigeExTwo').innerHTML = 'Не внушает доверие';
  									// 	}
  									// if(prestigeOneArr >= 0 && prestigeOneArr <=5 ) {
  									// 		document.getElementById('prestigeExOne').innerHTML = 'я тебя не обману';
  									// 	}
  									// if(prestigeTwoArr >= 0 && prestigeTwoArr <=5 ) {
  									// 		document.getElementById('prestigeExTwo').innerHTML = 'Не внушает доверие';
  									// 	}
  									// if(prestigeOneArr >= 6  ) {
  									// 		document.getElementById('prestigeExOne').innerHTML = 'просто БОГ фортуны';
  									// 	}
  									// if(prestigeTwoArr >= 6 ) {
  									// 		document.getElementById('prestigeExTwo').innerHTML = 'просто БОГ фортуны';
  									// 	}
								}
								}
								xhr.onreadystatechange = function() {
								// console.log(xhr.responseText);
								let x = xhr.responseText;
								// console.log('выводим значение с сервера dв блоке onreadystatechange');
								// console.log(x[0]);
								}		
								addWindowTwo();
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
