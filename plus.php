<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
    <title>Document</title>
</head>
<body>

    <?php
        require_once("config.php");
        require_once("conexao.php");
        session_start();
        if(ADM!=$_SESSION['nome']){
            header("location:home.php");
            
        }

       
    ?>
    <div class="login-container">
        <h3>PUBLICAR PROJECTO</h3>
        <form class="login-form" method="post" enctype="multipart/form-data">
            <center>
                <small style="color:red">
                    <?php
                         if(isset($_REQUEST['load'])){
                            $tipo = isset($_REQUEST['tipo'])?$_REQUEST['tipo']:"";
                            $duracao = isset($_REQUEST['duracao'])?$_REQUEST['duracao']:"";
                            $artista = isset($_REQUEST['artista'])?$_REQUEST['artista']:"";
                            $ano = isset($_REQUEST['ano'])?$_REQUEST['ano']:"";
                            $titulo = isset($_REQUEST['titulo'])?$_REQUEST['titulo']:"";
                            $preco = isset($_REQUEST['preco'])?$_REQUEST['preco']:"";
                            $faixas = isset($_REQUEST['faixas'])?$_REQUEST['faixas']:"";
                            $file = $_FILES['file'];
                            $capa = $_FILES['capa'];

                            if(trim($tipo)=="" || trim($duracao)=="" || trim($artista)=="" || trim($ano) =="" || trim($titulo)=="" || trim($preco) == "" || trim($faixas) ==""){
                                echo "por favor preencha todos os dados corectamente";
                            }else{
                                $sql = "INSERT INTO projecto (  tipo,duracao,   artista,ano_lancamento,titulo , preco,num_faixa ,ficheiro, capa ) values(?,?,?,?,?,?,?,?,?)";
                                $motor = $con->prepare($sql);
                                $motor->execute(array(
                                    $tipo,
                                    $duracao,
                                    $artista,
                                    $ano,
                                    $titulo,
                                    $preco,
                                    $faixas,
                                    $file['name'],
                                    $capa['name']
                                ));

                                move_uploaded_file($file['tmp_name'],"files/".$file['name']);
                                move_uploaded_file($capa['tmp_name'],"files/".$capa['name']);
                                header("location:plus.php");

                            }
                        }
                    ?>
                </small>
            </center>
            <select name="tipo">
                <option value="Musica">Musica</option>
                <option value="Album">Album</option>
                <option value="Video">Video</option>
            </select><br>
            <input type="text" name="duracao" id="duracao" placeholder="duracao"><br>
            <input type="text" name="artista" id="" placeholder="artista"><br>
            <input type="text" name="ano" id="" placeholder="ano de lan&ccedil;amento"><br>
            <input type="text" name="titulo" id="" placeholder="titulo"><br>
            <input type="number" name="preco" id="" placeholder="pre&ccedil;o"><br> <input type="number" name="faixas" id="" placeholder="numero de faixas" min=5  class="faixas"><br>
            <input type="file" name="file" id="file"><br>
            capa: <input type="file" name="capa" id="">
            <input type="submit" value="carregar" name="load">
            <small>
                <a href="home.php">Home</a>
            </small>
           
        </form>
    </div>

    <script src="js/plus.js"></script>
</body>
</html>