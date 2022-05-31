<!DOCTYPE html">
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="content-type">
		<link rel="stylesheet" type="text/css" media="screen" href="./v/style.css" />
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
	</head>
	<body>
		<hr/>
		<?echo $content?>
		<hr>
		<small><a href="" id="copy">Копирайт</a> &copy;</small>	
		<script>
			jQuery.validator.addMethod("accept", function(value, element, param) {
				let length=value.length;
				return value.match(new RegExp(param +"{"+length+"}"+"$"));
			});	

			$(document).ready(function(){
				$("#registerform").validate({
					rules:{
						login:{
							required: true,
							minlength: 2,
							maxlength: 16,
							accept: "[а-яА-ЯёЁa-zA-Z]",
						},
						password:{
							required: true,
							minlength: 6,
							maxlength: 16,
						},
						password_rep: {
							equalTo: "#password"
						},
					},
					messages:{
						login:{
							required: "Это поле обязательно для заполнения",
							accept: "Имя пользователя должно содержать латинские или русские буквы",
							minlength: "Имя пользователя должно быть минимум 2 символа",
							maxlength: "Максимальное число символов - 16",
						},
						password:{
							required: "Это поле обязательно для заполнения",
							minlength: "Пароль должен быть минимум 6 символов",
							maxlength: "Пароль должен быть максимум 16 символов",
						},
						password_rep:{
							required: "Это поле обязательно для заполнения",
							equalTo: "Пароли должны совпадать",
						},
					}
				});
			});

			$('body').on('click', '.password-checkbox', function(){
				if ($(this).is(':checked')){
					$('#password').attr('type', 'text');
					$('#password_rep').attr('type', 'text');
				} else {
					$('#password').attr('type', 'password');
					$('#password_rep').attr('type', 'password');
				}
			}); 
		
		</script>
	</body>
</html>
