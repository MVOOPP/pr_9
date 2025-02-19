<!DOCTYPE HTML>
<html>
	<head> 
		<script src="https://code.jquery.com/jquery-1.8.3.js"></script>
		<meta charset="utf-8">
		<title> Восстановление пароля </title>
		
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="top-menu">
			<a href=# class = "singin"><img src = "img/ic-login.png"/></a>
			<a href=#><img src = "img/logo1.png"/></a>
			<div class="name">
				<a href="index.php">
					<div class="subname">Электронная приемная комиссия</div>
					Пермского авиационного техникума им. А. Д. Швецова
				</a>
			</div>
		</div>
		<div class="space"> </div>
		<div class="main">
			<div class="content">
				<div class="input-error">
					<img src="img/ic-close.png" class="close" onclick="DisableError()"/>
					<img src = "img/ic-error.png"/>
					Непредвиденная ошибка.
					<div class="message">Указанный вами адрес электронной почты не существует в системе, проверьте правильность ввода данных.</div>
				</div>
			
				<div class="success" style="display: none;">
					<img src = "img/ic_success.png">
					<div class = "name">Успешно!</div>
					<div class = "description">
						На указанный вами адрес будет отправлено письмо с новым паролем.
					</div>
				</div>
			
				<div class = "login">
					<div class="name">Восстановление пароля</div>
				
					<div class = "sub-name">Почта (логин):</div>
					<div style="font-size: 12px; margin-bottom: 10px;">На указанную вами почту будет выслан новый пароль, для входа в систему.</div>
					<form id="recovery-form" action="ajax/recovery.php" method="post">
						<input name="login" type="text" placeholder="E-mail@mail.ru" required/>
						<div class="g-recaptcha" data-sitekey="ВАШ_SITE_KEY"></div>
						<input type="submit" class="button" value="Отправить" style="margin-top: 0px;"/>
						<img src = "img/loading.gif" class="loading" style="margin-top: 0px; display: none;"/>
					</form>
				</div>
				
				<div class="footer">
					© КГАПОУ "Авиатехникум", 2020
					<a href=#>Конфиденциальность</a>
					<a href=#>Условия</a>
				</div>
			</div>
		</div>
		
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<script>
			var errorWindow = document.getElementsByClassName("input-error")[0];
			var loading = document.getElementsByClassName("loading")[0];
			
			function DisableError() {
				errorWindow.style.display = "none";
			}
			
			document.getElementById("recovery-form").addEventListener("submit", function(event) {
				event.preventDefault();
				loading.style.display = "block";
				var formData = new FormData(this);
				
				$.ajax({
					url: this.action,
					type: this.method,
					data: formData,
					cache: false,
					processData: false,
					contentType: false,
					success: function (response) {
						loading.style.display = "none";
						if(response == -1) {
							errorWindow.style.display = "block";
						} else {
							document.getElementsByClassName('success')[0].style.display = "block";
							document.getElementsByClassName('description')[0].innerHTML = "На указанный вами адрес <b>" + document.getElementsByName('login')[0].value + "</b> будет отправлено письмо с новым паролем.";
							document.getElementsByClassName('login')[0].style.display = "none";
						}
					},
					error: function() {
						console.log('Системная ошибка!');
						loading.style.display = "none";
					}
				});
			});
		</script>
	</body>
</html>
