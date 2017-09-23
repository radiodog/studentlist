
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<title></title>
	<style type="text/css">
		.is-valid {border:2px groove green;}
		.is-invalid {border:2px groove red;}
	</style>
</head>
<body>
	<div class="">
	<div class="container-fluid row justify-content-center">
		<div>
			<h1>Список абитуриентов</h1>
			<h4><small class="text-muted"><?=$header?></small></h4>
		</div>	
	</div>
	<div class="container-fluid row justify-content-center bg-info text-white" style="padding-top: 13px; border-top: 3px solid lightblue; border-bottom: 3px solid lightblue;">
	<form method="post" class="col-md-6">
		<div class="form-group row">
  			<label for="name-input" class="col-4 col-form-label">Имя</label>
  			<div class="col-8">
    			<input class="form-control form-control-sm <?=$class['name']?>"   type="text" name="name"  placeholder = "<?=$placeholder['name']?>" value = "<?=$values['name']?>" id="name-input">
    			<div class="invalid-feedback">
        			<?=$errors['name']?>
      			</div>
  			</div>
		</div>

		<div class="form-group row">
  			<label for="surname-input" class="col-4 col-form-label">Фамилия</label>
  			<div class="col-8">
    			<input class="form-control form-control-sm <?=$class['surname']?>" type="text" name="surname" placeholder="<?=$placeholder['surname']?>" value = "<?=$values['surname']?>" id="surname-input">
    			<div class="invalid-feedback">
        			<?=$errors['surname']?>
      			</div>
  			</div>
		</div>

		<div class="form-group row">
  			<label for="gender" class="col-4 col-form-label">Пол</label>
  			<div class="col-8"> 
  				<select class="form-control form-control-sm <?=$class['gender']?>" name="gender" value = "<?=$values['gender']?>" >
  					<option disabled <?=($values['gender']<>'')?'':"selected"?> value style="display:none">Пол</option>
  					<option value="male" <?=($values['gender']=='male')?'selected':""?>>Муж.</option>
  					<option value="female" <?=($values['gender']=='female')?'selected':""?>>Жен.</option>
				</select>
				<div class="invalid-feedback">
        			<?=$errors['gender']?>
      			</div>
  			</div> 
		</div>


		<div class="form-group row">
  			<label for="groupnumber-input" class="col-4 col-form-label">Номер группы</label>
  			<div class="col-8">
    			<input class="form-control form-control-sm <?=$class['groupnumber']?>"  type="text" name="groupnumber" placeholder="<?=$placeholder['groupnumber']?>" value = "<?=$values['groupnumber']?>" id="groupnumber-input">
    			<div class="invalid-feedback">
        			<?=$errors['groupnumber']?>
      			</div>
  			</div>
		</div>

		<div class="form-group row">
  			<label for="email-input" class="col-4 col-form-label">Адрес электронной почты</label>
  			<div class="col-8">
    			<input class="form-controlform-control-sm <?=$class['e_mail']?>" type="email" name="e_mail" placeholder="<?=$placeholder['e_mail']?>" value = "<?=$values['e_mail']?>" id="email-input">
    			<div class="invalid-feedback">
        			<?=$errors['e_mail']?>
      			</div>
  			</div>
		</div>
		
		<div class="form-group row">
  			<label for="score-input" class="col-4 col-form-label">Суммарное число баллов ЕГЭ</label>
  			<div class="col-8">
    			<input class="form-control form-control-sm <?=$class['score']?>" type="number" name = "score" placeholder="<?=$placeholder['score']?>" min="30" max="300" value = "<?=$values['score']?>" id="score-input">
    			<div class="invalid-feedback">
        			<?=$errors['score']?>
      			</div>
  			</div>
		</div>		

		<div class="form-group row">
  			<label for="dob-input" class="col-4 col-form-label">Дата рождения</label>
  			<div class="col-8">
    			<input class="form-control form-control-sm <?=$class['dob']?>" type="text" name="dob" placeholder="<?=$placeholder['dob']?>" onfocus="(this.type='date')" value = "<?=$values['dob']?>" id="dob-input">
    			<div class="invalid-feedback">
        			<?=$errors['dob']?>
      			</div>
  			</div>
		</div>
		
		<div class="form-group row">
  			<label for="locality" class="col-4 col-form-label">Прописка</label>
  			<div class="col-8"> 
  				<select class="form-control form-control-sm <?=$class['locality']?>" name="locality" value = "<?=$values['locality']?>">
  					<option disabled <?=($values['locality']<>'')?'':"selected"?> value style="display:none"> Прописка </option>
  					<option value="resident" <?=($values['locality']=='resident')?'selected':""?>>Местный</option>
  					<option value="nonresident" <?=($values['locality']=='nonresident')?'selected':""?>>Иногородний</option>
				</select>
				<div class="invalid-feedback">
        			<?=$errors['locality']?>
      			</div>
  			</div> 
		</div>

		<div class="form-group row">	
		<button type="submit" class="btn btn-default"><?=htmlspecialchars($button)?></button>
		</div>
	</form>
	</div>
	</div>
	</body>
</html>

<footer class="navbar-bottom row-fluid text-left">
    <div class="col-md-4">
        <a href='http://localhost/index.php/list'>Список студентов</a>
    </div>

    <div class="col-md-4">
        <a href='https://github.com/codedokode/pasta/blob/master/student-list.md'>Техническое задание</a>
    </div>
    
    <div class="col-md-4 ">
        <a href='https://github.com/radiodog/studentlist'>Git</a> проекта
    </div>
</footer>