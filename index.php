<?php
	include "./createConnection.php";

	createConnectionDB();

?>

<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>

	<body>
		<div>
			<h1>Bem-Vindo!</h1>
		</div>

		<div class="container">
			<h3>Cadastro de usuario</h3>
		

			<form method="POST" action="./usuario/create.php" class="form">
				

				<label>NUM SUS</label> <input type="number" name="num_sus" />
				<br><br>


				<label>Genero</label> 
				<select name="col_genero">
					<option value="M">M</option>
					<option value="F">F</option>
				</select>

				<br>

				<label>Deficiencia</label>
				<select name="cod_deficiencia">
					<option value="1">Nao possui</option>
					<option value="2">Auditiva</option>
					<option value="4">Física</option>
					<option value="5">Intelectual</option>
					<option value="3">Visual</option>
					<option value="6">Outras</option>
				</select>

				<br>

				<label>Obito</label>
				<select name='col_obito'>
					<option value=1>SIM</option>
					<option value=0>NÃO</option>
				</select>
				<br>

				<label>Plano de saude</label>
				<select name='col_plano_saude'>
					<option value=1>SIM</option>
					<option value=0>NÃO</option>
				</select>

				<br>
				<label>Parentesco</label>
				<select name='col_parentesco'>
					<option value=1>Primo/a</option>
					<option value=0>Irma/o</option>
				</select>

				<br>

				<label>Mudanca</label>
				<select name='col_mudanca'>
					<option value=1>SIM</option>
					<option value=0>NÃO</option>
				</select>

				<br>
				<label>Escolaridade</label>
				<select name='cod_escolaridade'>
					<option value=1>Fundamental</option>
					<option value=2>Medio</option>
					<option value=3>Tecnico</option>
				</select>

				<br>
				<label>Crianca fica com</label>
				<select name='col_crianca_fica_com'>
					<option value="Genitores">Genitores</option>
					<option value="Avos">Avos</option>
				</select>

				<br>
				<br>
				<br> <input type="submit" value="Cadastrar" />
			</form>
		</div>

		<br> <br> 
        <div>
            <form method="POST" action="./usuario/login.php">
                <input type="text" name="col_email" >
                <input type="text" name="col_senha" >
                <input type="submit" value="Login">
            </form>
        </div>
        
        <br>


		<div class="container">
			
			<h3>cadastro de moradia</h3>

			<form method="POST" action = "./moradia/create.php">

				<label>CEP</label> <input type="number" name="col_cep" /> <br>
				<label>Numero</label> <input type="number" name="col_numero" /> <br>

				<label>Agua</label> 
				<select name="tem_abastecimento_agua">
					<option value=1>SIM</option>
					<option value=0>NAO</option>
				</select>
				<br>

				<label>Esgoto</label>
				<select name="tem_sistema_esgoto">
					<option value=1>SIM</option>
					<option value=0>NAO</option>
				</select>
				<br>

				<label>Lixo</label>
				<select name="tem_coleta_lixo">
					<option value=1>SIM</option>
					<option value=0>NAO</option>
				</select>
				<br>

				<label>Animais</label>
				<select name="tem_animais">
					<option value=1>SIM</option>
					<option value=0>NAO</option>
				</select>
				<br>

				<label>Rua</label> <input type="text" name="col_rua_moradia" /> <br>
				<label>Num sus</label> <input type="number" name="num_sus" /> <br>

				<input type="submit" value="Cadastrar" />

			</form>

		</div>

		<div class="container">
			<h3>Cadastro saude</h3>

			<div>
				<form action="./saude/create.php" method="POST">
				
					<label>SUS</label> <input type="number" name="num_sus" /> <br>
					<label>Cardiaco</label> 
					<select name="col_doenca_cardiaca" >
						<option value=1>SIM</option>
						<option value=0>NAO</option>
					</select> <br>

					<label>Peso</label> <input type="number" name="col_peso"> <br>

					<label>Respiratoria</label>
					<select name="col_doenca_respiratoria">
						<option value=1>SIM</option>
						<option value=0>NAO</option>
					</select> <br>

					<label>Rins</label>
					<select name="col_problema_rins">
						<option value=1>SIM</option>
						<option value=0>NAO</option>
					</select> <br>

					<input type="number" name="col_e_fumante" > Fumante<br>
					<input type="number" name="col_usa_alcool" id='2'> Alcool<br>
					<input type="number" name="col_usa_drogas"> Drogas<br>
					<input type="number" name="col_hipertensao"> Hipertenso<br>
					<input type="number" name="col_mudanca"> Mudanca<br>
					<input type="number" name="col_diabetes"> Diabetes<br>
					<input type="number" name="col_avc"> AVC<br>
					<input type="number" name="col_cancer"> cancer<br>
                    <input type="submit" value='Enviar' />
				</form>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	</body>
</html>


<!--

	col_cep int not null,
	col_numero int not null,
	tem_abastecimento_agua boolean default False,
	tem_sistema_esgoto boolean default False,
	tem_coleta_lixo boolean default False, 
	tem_animais boolean default False,
	col_rua_moradia varchar(100) not null,

	cod_moradia bigint not null auto_increment,

-->