<?php
require_once "verificacao.php";
//    verificando se já foi selecionado uma foto
    if(isset($_POST)){

        if(isset($_GET['txt'])){
            $txtFoto = $_GET['txt'];
//            recuperando o nome do arquivo
            $nomeArquivo = basename($_FILES['fleFoto']['name']);

//            separando somente a extensão do arquivo e guardando numa variavel
            $extensao_arquivo = strchr($nomeArquivo, ".");

//            guardando apenas o nome do arquivo sem sua extensão
            $nome_foto = pathinfo($nomeArquivo, PATHINFO_FILENAME);

//            armazena na variavel o nome do arquivo(CRIPTOGRAFADO)
//            concatenando a extensão(NÃO CRIPTOGRAFADA)
            $nomeArquivo = md5(uniqid(time()).$nome_foto).$extensao_arquivo;

//            pegando o tamanho do arquivo a convertendo para MB
            $tamanho_arquivo = round(($_FILES['fleFoto']['size'] / 1024));

//            nome da pasta criada para guardar as fotos
            $upload_dir = "arquivos/";

//            array que contem todas as extensões de arquivos que são permitidos
            $arquivos_permitidos = array(".jpg", ".png", ".gif", ".svg", ".jpeg");

//            criando o caminho que vai estar a imagem (nomePasta + nomeArquivo = caminho)
            $caminho_imagem = $upload_dir.$nomeArquivo;

//            verificando se o arquivo é permitido
            if(in_array($extensao_arquivo, $arquivos_permitidos)){
//                verificando se o tamanho do arquivo é permitido
                if($tamanho_arquivo <= 5120){
//                    pegando o arquivo que esta na pasta temporaria
                    $arquivo_tmp  = $_FILES['fleFoto']['tmp_name'];
                    if(move_uploaded_file($arquivo_tmp, $caminho_imagem)){
                        echo("<img src='".$caminho_imagem."'>");
                        echo("
                            <script>
                                frmCadastro.$txtFoto.value = '$caminho_imagem';
                            </script>
                        ");
                    } else {
                        echo("Erro ao enviar o arquivo para o servidor");
                    }
                } else {
                    echo("Tamanho da imagem não permitido");
                }
            } else {
                echo("Tipo de arquivo não permitido");
            }
        }
    }
?>
