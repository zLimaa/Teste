<?php 

require_once "conexao.php";

?>
<html>
	<meta http-equiv="Content-Type" content="text/html", charset="utf-8"> <! Tirar erros de Caracteres Especial. />
	<link rel="stylesheet" type="text/css" href="style.css">
	<head>
		<title> Cadastro  Random </title> 
	</head>

	<body>

		

				<input type="submit" value="Cadastrar" id = "btn_cadastrar"/>
			</form>
		</div>
	</body>
</html> 

<?php
	
	if (@$_GET['go'] == 'Cadastrar') 
	{
		$nome = $_POST['nome'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		$nascimento = $_POST['nascimento'];
		$telefone = $_POST['telefone'];
		$celular = $_POST['celular'];
		$email = $_POST['email'];
		$cep = $_POST['cep'];
		$endereco =$_POST['endereco'];
		$casa = $_POST['casa'];
		$pergunta = $_POST['pergunta'];
		$resposta = $_POST['resposta'];
	}
	
	if (empty($nome)) 
	{
		echo "<script>alert('Preencha o Campo: Nome!'); history.back();</script>";
	}
	elseif (empty($cpf)) 
	{
		echo "<script>alert('Preencha o Campo: CPF!'); history.back();</script>";
	}
	elseif (empty($rg)) 
	{
		echo "<script>alert('Preencha o Campo: RG!'); history.back();</script>";
	}
 	elseif (empty($nascimento)) 
	{
		echo "<script>alert('Preencha o Campo: Data de Nascimento!'); history.back();</script>";
	}
	elseif (empty($telefone)) 
	{
		echo "<script>alert('Preencha o Campo: Telefone!'); history.back();</script>";
	}
	elseif (empty($celular)) 
	{
		echo "<script>alert('Preencha o Campo: Celular!'); history.back();</script>";
	}
	elseif (empty($email)) 
	{
		echo "<script>alert('Preencha o Campo: E-mail!'); history.back();</script>";
	}
	elseif (empty($cep)) 
	{
		echo "<script>alert('Preencha o Campo: CEP!'); history.back();</script>";
	}
	elseif (empty($endereco)) 
	{
		echo "<script>alert('Preencha o Campo: Endereço!'); history.back();</script>";
	}
	elseif (empty($bairro)) 
	{
		echo "<script>alert('Preencha o Campo: Bairro!'); history.back();</script>";
	}
	elseif (empty($cidade)) 
	{
		echo "<script>alert('Preencha o Campo: Cidade!'); history.back();</script>";
	}
	elseif (empty($cargo)) 
	{
		echo "<script>alert('Preencha o Campo: Cargo!'); history.back();</script>";
	}
	elseif (empty($entrada)) 
	{
		echo "<script>alert('Preencha o Campo: Entrada!'); history.back();</script>";
	}
	elseif (empty($login)) 
	{
		echo "<script>alert('Preencha o Campo: Login!'); history.back();</script>";
	}
	elseif (empty($senha)) 
	{
		echo "<script>alert('Preencha o Campo: Senha!'); history.back();</script>";
	}
	elseif (empty($pergunta)) 
	{
		echo "<script>alert('Preencha o Campo: Pergunta!'); history.back();</script>";
	}
	elseif (empty($resposta)) 
	{
		echo "<script>alert('Preencha o Campo: Resposta!'); history.back();</script>";
	}
	else
	{
		$query1 = @mysql_num_rows(mysql_query("SELECT * FROM integrante WHERE CPF = '$cpf'"));
		$query2 = @mysql_num_rows(mysql_query("SELECT * FROM integrante WHERE RG = '$rg'"));
		$query3 = @mysql_num_rows(mysql_query("SELECT * FROM integrante WHERE EMAIL = '$email'"));
		$query4 = @mysql_num_rows(mysql_query("SELECT * FROM login WHERE LOGIN = '$login'"));

		if($query1 == 1)
		{
			echo "<script>alert('CPF Informado Já Está Cadastrado!'); history.back();</script>";
		}
		elseif($query2 == 1)
		{
			echo "<script>alert('RG Informado Já Está Cadastrado!'); history.back();</script>";
		}
		elseif($query3 == 1)
		{
			echo "<script>alert('E-mail Informado Já Está Cadastrado!'); history.back();</script>";
		}
		elseif($query4 == 1)
		{
			echo "<script>alert('Login Informado Já Está Em Uso!'); history.back();</script>";
		}
		else
		{
			@mysql_query("INSERT INTO cidade (Nome_Cidade, Estado) VALUES ('$cidade','PE');");
			$aux1 = @mysql_query("SELECT Id_Cidade FROM cidade WHERE Nome_Cidade = '$cidade';");
			$result1 = @mysqli_query($conexao,$aux1);
			$id_cidade = @mysqli_fetch_assoc($result1);


			@mysql_query("INSERT INTO bairro (Nome_Bairro, BCidade_Id_Cidade) VALUES ('$bairro', '$id_cidade');");
			$aux2 = @mysql_query("SELECT Id_Bairro FROM bairro WHERE Nome_Bairro = '$bairro';");
			$result2 = @mysqli_query($conexao,$aux2);
			$id_bairro = @mysqli_fetch_assoc($result2);


			@mysql_query("INSERT INTO endereco (CEP, Nome_Rua, Bairro_Id_Bairro, ECidade_Id_Cidade) VALUES ('$cep', '$endereco', '$id_bairro', 'id_cidade');");
			$aux3 = @mysql_query("SELECT Id_Endereco FROM endereco WHERE Nome_Rua = '$endereco';");
			$result3 = @mysqli_query($conexao,$aux3);
			$id_endereco = @mysqli_fetch_assoc($result3);


			@mysql_query("INSERT INTO integrante (Nome, CPF, RG, Nascimento, Telefone, Celular, Email, E_Id_Endereco, Casa, B_Id_Bairro, C_Id_Cidade, Cargo, Entrada) VALUES ('$nome', '$cpf', '$rg', '$nascimento', '$telefone', '$celular', '$email', '$id_endereco', '$casa', '$id_bairro','$id_cidade', '$cargo', '$entrada');");			
			$aux4 = @mysql_query("SELECT Id FROM integrante WHERE Nome = '$nome';");
			$result4 = @mysqli_query($conexao,$aux4);
			$id_integrante = @mysqli_fetch_assoc($result4);


			@mysql_query("INSERT INTO login (Integrante_Id, Login, Senha, Pergunta_Seguranca, Resposta) VALUES ('$id_integrante', '$login', '$senha', '$pergunta', '$resposta');");

			
		}
	}


?>