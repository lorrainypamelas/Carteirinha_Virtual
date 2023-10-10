<html>
    <head>
        <?php
            session_start();
            if(empty($_POST['usuario']) || empty($_POST['matricula'])){
                echo "<script>
                    alert ('Login ou Senha Incorretos!');
                    window.location.href='logina.html';
                    </script>";
                exit();
            }
        ?>
        <link rel="icon" type="image/png" href="images/icons/logo.png">
        <meta charset="UTF=8"/>
        <title>Listagem</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
    <body>
        <nav class="navbar navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">Início</a>
            </div>
        </nav><br>
        <div class="container">
            <table class="table table-bordered">
                <tr class="bg-primary">
                    <th scope="col" colspan="2"><center>Olá aluno, aqui estão suas informações:</center></th>
                </tr>

                <?php

                include('conectar.php');

                $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
                $senha = mysqli_real_escape_string($conn, $_POST['matricula']);
				

                $pasta ="arquivos/"; //buscar imagem na pasta 
                $local= dir($pasta); // diretorio de busca
                        
                $query = "select * from cadastraralunos where usuario ='{$usuario}' and matricula = '{$senha}'";

                $result = mysqli_query($conn, $query);

                $row = mysqli_num_rows($result);

                if($row == 1){
                    $_SESSION['usuario'] = $usuario;
                    echo "<script>
                            alert ('Login realizado com sucesso!');
                        </script>";
                        $comando = "SELECT * FROM cadastraralunos WHERE usuario LIKE '%$usuario%'";   
						
                        //execultar consulta
                        $consulta= mysqli_query($conn, $comando);
						
                        
						$aux=0;
                        
                        while(mysqli_num_rows($consulta)>$aux){
						
                        //pegar linha da consulta
                        $rs = mysqli_fetch_array($consulta);
						//mudei do if acima pois la traz tudo e aqui vem direto da row "lina do db" conforme a consulta do where
						echo "<th>Foto</th><td><img src='".$pasta.$rs['foto']."'width='300''></img></td>";
						
                        echo("
                        <tr>
						
                        <th>Nome</th>
                        <td>$rs[usuario]
                        </tr>
                        <tr>
                        <th>Número da Matrícula</th>
                        <td>$rs[matricula]
                        </tr>  
                        <tr>
                        <th>Idade</th>
                        <td>$rs[idade]
                        </tr> 
                        <tr>
                        <th>Sexo</th>
                        <td>$rs[sexo]
                        </tr>
                        <tr>
                        <th>Endereço</th>
                        <td>$rs[endereco]
                        </tr>
                        <tr>
                        <th>Telefone</th>
                        <td>$rs[telefone]
                        </tr>
                        <tr>
                        <th>Sala</th>
                        <td>$rs[sala]
                        </tr>
                        <tr>
                        <th>Curso</th>
                        <td>$rs[curso]
                        </tr>
                        <tr>
                        <th>Ano Letivo</th>
                        <td>$rs[dataano]
                        </tr>
                    </tr>");
                $aux++;
                }
                    exit();
                }else{
                    echo "<script>
                            alert ('Login ou Senha Incorretos!');
                            window.location.href='logina.html';
                        </script>";
                    exit();
                } 
                ?>
				
            </table>
        </div>
    </body>
</html>