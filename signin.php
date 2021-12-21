<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
    <title>Musica-signin</title>
</head>
<body>
    <div class="login-container">
        <h3>SIGNIN</h3>
        <center><small style="color:red">

        <?php
            require_once("conexao.php");
            
            if(isset($_REQUEST['env'])){
                $nome = isset($_REQUEST['nome'])?$_REQUEST['nome']:"";
                $senha = isset($_REQUEST['senha'])?$_REQUEST['senha']:"";
                $senha2 = isset($_REQUEST['senha2'])?$_REQUEST['senha2']:"";
                $celular = isset($_REQUEST['celular'])?$_REQUEST['celular']:"";
                $bi = isset($_REQUEST['bi'])?$_REQUEST['bi']:"";
                $workplace = isset($_REQUEST['workplace'])?$_REQUEST['workplace']:"";
                $data = isset($_REQUEST['data'])?$_REQUEST['data']:"";
                $genero = isset($_REQUEST['genero'])?$_REQUEST['genero']:"";
                $endereco = isset($_REQUEST['endereco'])?$_REQUEST['endereco']:"";

                if(trim($nome)=="" || trim($senha)=="" || trim($senha2)=="" || trim($celular)=="" || trim($bi)=="" || trim($workplace)=="" || trim($data)=="" || trim($endereco)==""){
                    echo "por favor preencha todos os campos";
                }elseif($senha!=$senha2){
                    echo "senhas devem ser iguais";
                }elseif($data>"2008-02-02"){
                    echo "idade minima: 2008-02-02";
                }else{

                    $sql = "SELECT*FROM user WHERE bi = ? OR celular = ?";
                    $motor = $con->prepare($sql);
                    $motor->execute([
                        $bi,
                        $celular
                    ]);

                    if($motor->rowCount()>0){
                        echo "ja existe alguem com este numero de BI ou celular";
                    }else{
                        $motor1 = $con->prepare("INSERT INTO user (nome,celular,senha,data_nascimento,genero,endereco,workspace,bi) VALUES(?,?,?,?,?,?,?,?)");
                        $motor1->execute([
                            $nome,
                            $celular,
                            md5($senha),
                            $data,
                            $genero,
                            $endereco,
                            $workplace,
                            $bi
                        ]);

                        echo "<span style='color:green'>registado com sucesso, fa&ccedil;a login</span>";
                    }
                  
                }
            }
        ?>
        </small></center>
        <form class="login-form" method="post">
            <input type="text" placeholder="nome" name="nome" required/><br>
            <input type="password" name="senha" placeholder="senha" required/><br>
            <input type="password" name="senha2" placeholder="confirmar senha"/><br>
            <formgroup>
                <input type="number" name="celular" placeholder="celular"/><br>
                <input type="text" name="bi" placeholder="numero de BI" pattern="[0-9]{12}[A-Z]{1}" required title="siga o padrao: 123456789001B"/>
            </formgroup>
            <formgroup>
                <input type="text" name="workplace" placeholder="local de trabalho/estudo"/>
                <input type="text" name="endereco" placeholder="endereco" />
            </formgroup>
            <div>
                <label for="data" >Data de nascimento: </label>
                <input type="date" name="data" id="" ><br>
                <fieldset>
                    <legend>Genero</legend>
                    <label for="masc">Masculino</label>
                    <input type="radio" name="genero" id="masc" checked>
                    <label for="fem">Femenino</label>
                    <input type="radio" name="genero" id="fem" >
                </fieldset><br>
                <input type="submit" name="env" value="terminar">
            </div>
            <small>J&aacute; t&ecirc;m conta? <a href="index.php">entrar</a></a></small>
        </form>
    </div>
</body>
</html>

