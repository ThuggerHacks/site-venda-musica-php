<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/home.css"/>
    <title>Musica-Home</title>
</head>
<body>
    <?php
        session_start();
        ob_start();
        include_once("config.php");
        include_once("conexao.php");
    ?>
    <nav>
        <a href="home.php"><i>Musica</i></a>
        <ul>
            <li>
                <a href="#musicas">Musicas</a>
            </li>
            <li>
                <a href="#albuns">Albuns</a>
            </li>
            <li>
                <a href="#videos">Videos</a>
            </li>
            <li>
                <a href="#contacto">Contacto</a>
            </li>
            <?php
                if($_SESSION['nome'] == ADM):
            ?>
            <li>
                <a href="plus.php">&plus;</a>
            </li>
            <?php
                endif;
            ?>
        </ul>
    </nav>

    <!----------------musicas----------------->
    <section id="musicas">
       
        <h3>Sess&atilde;o de musicas</h3>
        <?php
            $sql = "SELECT * FROM projecto WHERE tipo = ?";
            $motor = $con->prepare($sql);
            $motor->execute([
                "Musica"
            ]);

            foreach($motor as $linha):
        ?>
        <div class="card"><!----------card-1 start-->
            <div class="card-header">
                <img src="files/<?=$linha['capa']?>"/>
            </div>
            <div class="card-body">
                <strong>Dura&ccedil;&atilde;o: </strong> <span><?=$linha['duracao']?>min</span><br>
                <strong>Artista: </strong> <span><?=$linha['artista']?></span><br>
                <strong>lan&ccedil;amento: </strong> <span><?=$linha['ano_lancamento']?></span><br>
                <strong>Titulo: </strong> <span><?=$linha['titulo']?></span><br>
                <strong>Pre&ccedil;o: </strong> <span><?=$linha['preco']?>Mt</span>
            </div>
            <div class="card-footer">
                <button onclick="tocar('files/<?=$linha['ficheiro']?>')">Tocar</button>

                <?php
                    if(ADM == $_SESSION['nome']):
                ?>
                <a class='btn-del' href='<?='home.php?id='.$linha['id'] ?>'>apagar</a>
                <?php
                    endif;
                ?>
            </div>
        </div><!-------card-1 end-->
        <?php
            endforeach;
        ?>
        
    </section>


    <!-------------------------albuns-->
    <section id="albuns">
        <h3>Sess&atilde;o de albuns</h3>

        <?php
            $sql = "SELECT * FROM projecto WHERE tipo = ?";
            $motor = $con->prepare($sql);
            $motor->execute([
                "Album"
            ]);

            foreach($motor as $linha):
        ?>
        <div class="card"><!----------card-1 start-->
            <div class="card-header">
                <img src="files/<?=$linha['capa']?>"/>
            </div>
            <div class="card-body">
                <strong>Dura&ccedil;&atilde;o: </strong> <span><?=$linha['duracao']?>min</span><br>
                <strong>Artista: </strong> <span><?=$linha['artista']?></span><br>
                <strong>lan&ccedil;amento: </strong> <span><?=$linha['ano_lancamento']?></span><br>
                <strong>Titulo: </strong> <span><?=$linha['titulo']?></span><br>
                <strong>Pre&ccedil;o: </strong> <span><?=$linha['preco']?>Mt</span><br>
                <strong>Numero de faixas: </strong> <span><?=$linha['num_faixa']?></span>
            </div>
            <div class="card-footer">
                <button >baixar</button>

                <?php
                    if(ADM == $_SESSION['nome']):
                ?>
                <a class='btn-del' href='<?='home.php?id='.$linha['id'] ?>'>apagar</a>
                <?php
                    endif;
                ?>
            </div>
        </div><!-------card-1 end-->
        <?php
            endforeach;
        ?>
    </section>

    <!---------------videos-->

     <section id="videos">
        <h3>Sess&atilde;o de videos</h3>
        <?php
            $sql = "SELECT * FROM projecto WHERE tipo = ?";
            $motor = $con->prepare($sql);
            $motor->execute([
                "Video"
            ]);

            foreach($motor as $linha):
        ?>
        <div class="card"><!----------card-1 start-->
            <div class="card-header">
                <video src="files/<?=$linha['ficheiro']?>" ></video>
            </div>
            <div class="card-body">
                <strong>Dura&ccedil;&atilde;o: </strong> <span><?=$linha['duracao']?>min</span><br>
                <strong>Artista: </strong> <span><?=$linha['artista']?></span><br>
                <strong>lan&ccedil;amento: </strong> <span><?=$linha['ano_lancamento']?></span><br>
                <strong>Titulo: </strong> <span><?=$linha['titulo']?></span><br>
                <strong>Pre&ccedil;o: </strong> <span><?=$linha['preco']?>Mt</span>
            </div>
            <div class="card-footer">
                <button onclick="assistir('files/<?=$linha['ficheiro']?>')">Assistir</button>

                <?php
                    if(ADM == $_SESSION['nome']):
                ?>
                <a class='btn-del' href='<?='home.php?id='.$linha['id'] ?>'>apagar</a>
                <?php
                    endif;
                ?>
            </div>
        </div><!-------card-1 end-->
        <?php
            endforeach;
        ?>

    </section>

    <section id="contacto">
         <h3>Sess&atilde;o de contacto</h3>
         <div class='info'>
             <strong>email: </strong><span>musica@gmail.com</span><br>
             <strong>Contacto: </strong><span>848499142</span><br>
             <strong>localiza&ccedil;&atilde;o: </strong><span>Beira, Matacuane</span><br>
             <strong>Horarios: </strong><span>Segunda a sexta, das 8 as 18 horas</span><br>
            
         </div>

         <div>
             <h2>Localiza&ccedil;&atilde;o</h2><BR>
             <img src="files/1.jpg"/>
         </div>
    </section>

    <footer>
        <div class="footer-container">
            <em>Musica</em> - &copy; 2021, todos os direitos reservados
        </div>
    </footer>
    <script src="js/home.js"></script>
</body>
</html>


<!-------------------MODAL TO PLAY VIDEO------>

<div class='modal'>
   <div class='modal-container'>
        <div class='modal-body'>
            <video class='video'></video>
        </div>
   </div>
</div>


<?php
    if(isset($_REQUEST['id'])){

        $sql1 = "SELECT*FROM projecto WHERE id =?";
        $motor1 = $con->prepare($sql1);
        $motor1->execute([
            $_REQUEST['id']
        ]);

        foreach($motor1 as $linha){
            if(file_exists("files/".$linha['ficheiro'])){
                unlink("files/".$linha['ficheiro']);
            }

            if(file_exists("files/".$linha['capa'])){
                unlink("files/".$linha['capa']);
            }
        }
        $sql ="DELETE FROM projecto WHERE id =  ?";
        $motor = $con->prepare($sql);
        $motor->execute(array($_REQUEST['id']));
        header("location:home.php");
    }
?>