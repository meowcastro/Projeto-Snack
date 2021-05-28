<?php
include "conecta_mysqli.inc";

$msg = false;

if(isset($_FILES['imagem'])){
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];

    $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
    $novo_nome = md5(time()) . $extensao;
    $diretorio = "upload/";

    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);
    $sql_code = "INSERT INTO produto (id, nome, preco, descricao, imagem, quantidade, data) VALUES (null, '$nome', '$preco', '$descricao','$novo_nome', '$quantidade', NOW())";
    if($conexao->query($sql_code)){
        $msg = "Arquivo enviado com sucesso!";
    }else{
        $msg = "Falha ao enviar o arquivo de imagem." . mysqli_connect_error();
    }
}
?>
<h1>Upload de produtos<h1>

<form action="upload.php" method="POST" enctype="multipart/form-data">
<input type="text" required name="nome" placeholder="Título do produto">
<span>R$</span><input type="number" required name="preco" placeholder="0.00" step="0.01">
<p>Descrição do Produto</p>
<textarea placeholder="Digite aqui a descrição do seu produto..." name="descricao" rows="5" cols="33">
</textarea></br>
<p>Quantidade em estoque</p>
<input type="number" name="quantidade" min=0></br>
<input type="file" required name="imagem">
<input type="submit" value="Salvar">
</form>
<?php if($msg !=false) echo "<p>$msg</p>";?>
