
	<div class="">
	<div class="container-fluid row justify-content-center">
		<div>
			<h1>Список абитуриентов</h1>
			<h4><small class="text-muted"><?=$this->header?></small></h4>
		</div>	
	</div>
	<div class="container-fluid row justify-content-center bg-info text-white" style="padding-top: 13px; border-top: 3px solid lightblue; border-bottom: 3px solid lightblue;">
	<form method="post" class="col-md-6">
		<div class="form-group row">
  			<label for="name-input" class="col-4 col-form-label">Имя</label>
  			<div class="col-8">
    			<input class="form-control form-control-sm <?=$this->classes['name']?>"   type="text" name="name"  placeholder = "<?=$this->placeholders['name']?>" value = "<?=htmlspecialchars($this->values['name'])?>" id="name-input">
    			<div class="invalid-feedback">
        			<?=$this->errors['name']?>
      			</div>
  			</div>
		</div>

		<div class="form-group row">
  			<label for="surname-input" class="col-4 col-form-label">Фамилия</label>
  			<div class="col-8">
    			<input class="form-control form-control-sm <?=$this->classes['surname']?>" type="text" name="surname" placeholder="<?=$this->placeholders['surname']?>" value = "<?=htmlspecialchars($this->values['surname'])?>" id="surname-input">
    			<div class="invalid-feedback">
        			<?=$this->errors['surname']?>
      			</div>
  			</div>
		</div>

		<div class="form-group row">
  			<label for="gender" class="col-4 col-form-label">Пол</label>
  			<div class="col-8"> 
  				<select class="form-control form-control-sm <?=$this->classes['gender']?>" name="gender" value = "<?=htmlspecialchars($this->values['gender'])?>" >
  					<option disabled <?=($this->values['gender']<>'')?'':"selected"?> value style="display:none">Пол</option>
  					<option value="male" <?=($this->values['gender']=='male')?'selected':""?>>Муж.</option>
  					<option value="female" <?=($this->values['gender']=='female')?'selected':""?>>Жен.</option>
				</select>
				<div class="invalid-feedback">
        			<?=$this->errors['gender']?>
      			</div>
  			</div> 
		</div>


		<div class="form-group row">
  			<label for="groupnumber-input" class="col-4 col-form-label">Номер группы</label>
  			<div class="col-8">
    			<input class="form-control form-control-sm <?=$this->classes['groupnumber']?>"  type="text" name="groupnumber" placeholder="<?=$this->placeholders['groupnumber']?>" value = "<?=htmlspecialchars($this->values['groupnumber'])?>" id="groupnumber-input">
    			<div class="invalid-feedback">
        			<?=$this->errors['groupnumber']?>
      			</div>
  			</div>
		</div>

		<div class="form-group row">
  			<label for="email-input" class="col-4 col-form-label">Адрес электронной почты</label>
  			<div class="col-8">
    			<input class="form-controlform-control-sm <?=$this->classes['e_mail']?>" type="email" name="e_mail" placeholder="<?=$this->placeholders['e_mail']?>" value = "<?=htmlspecialchars($this->values['e_mail'])?>" id="email-input">
    			<div class="invalid-feedback">
        			<?=$this->errors['e_mail']?>
      			</div>
  			</div>
		</div>
		
		<div class="form-group row">
  			<label for="score-input" class="col-4 col-form-label">Суммарное число баллов ЕГЭ</label>
  			<div class="col-8">
    			<input class="form-control form-control-sm <?=$this->classes['score']?>" type="number" name = "score" placeholder="<?=$this->placeholders['score']?>" min="30" max="300" value = "<?=htmlspecialchars($this->values['score'])?>" id="score-input">
    			<div class="invalid-feedback">
        			<?=$this->errors['score']?>
      			</div>
  			</div>
		</div>		

		<div class="form-group row">
  			<label for="dob-input" class="col-4 col-form-label">Дата рождения</label>
  			<div class="col-8">
    			<input class="form-control form-control-sm <?=$this->classes['dob']?>" type="text" name="dob" placeholder="<?=$this->placeholders['dob']?>" onfocus="(this.type='date')" value = "<?=htmlspecialchars($this->values['dob'])?>" id="dob-input">
    			<div class="invalid-feedback">
        			<?=$this->errors['dob']?>
      			</div>
  			</div>
		</div>
		
		<div class="form-group row">
  			<label for="locality" class="col-4 col-form-label">Прописка</label>
  			<div class="col-8"> 
  				<select class="form-control form-control-sm <?=$this->classes['locality']?>" name="locality" value = "<?=htmlspecialchars($this->values['locality'])?>">
  					<option disabled <?=($this->values['locality']<>'')?'':"selected"?> value style="display:none"> Прописка </option>
  					<option value="resident" <?=($this->values['locality']=='resident')?'selected':""?>>Местный</option>
  					<option value="nonresident" <?=($this->values['locality']=='nonresident')?'selected':""?>>Иногородний</option>
				</select>
				<div class="invalid-feedback">
        			<?=$this->errors['locality']?>
      			</div>
  			</div> 
		</div>

		<div class="form-group row">	
		<button type="submit" class="btn btn-default"><?=htmlspecialchars($this->button)?></button>
		</div>
	</form>
	</div>
	</div>
	</body>
</html>

