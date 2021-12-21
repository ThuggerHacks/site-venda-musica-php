<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
    <title>Musica-Login</title>
</head>
<body>
    <div class="login-container">
        <h3>LOGIN</h3>
        <form class="login-form" method="post">
            <center>
                <small style="color:red">
                    <?php
                       if(isset($_REQUEST['enviar'])){
                        session_start();

                        require_once("conexao.php");

                        $nome = isset($_REQUEST['nome'])?$_REQUEST['nome']:"";
                        $senha = isset($_REQUEST['senha'])?$_REQUEST['senha']:"";

                        if(trim($nome) == "" || trim($senha) == ""){
                            echo "por favor preencha todos os campos";
                        }else{
                            $sql = "SELECT * FROM user WHERE nome = ?  AND senha = ?";
                            $motor = $con->prepare($sql);
                            $motor->execute([
                                $nome,
                                md5($senha)
                            ]);

                            if($motor->rowCount()>0){
                                $_SESSION['nome'] = $nome;
                                header("location:home.php");
                            }else{
                                echo "conta n&atilde;o existe";
                            }
                        }

                       }
                    ?>
                </small>
            </center>
            <input type="text" placeholder="nome" name="nome" required/><br>
            <input type="password" placeholder="senha" name="senha" required/><br>
            <input type="submit" value="entrar" name="enviar">
            <small>N&atilde;o t&ecirc;m conta? <a href="signin.php">registar</a></a></small>
        </form>
    </div>
</body>
</html>