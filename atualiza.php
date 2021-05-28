<h1>Atualizar produto<h1>
<?php
if(isset($_POST['editar']))
{include "conecta_mysqli.inc";
$id = $_POST['id'];
$resultado = mysqli_query($conexao, "SELECT * FROM produto WHERE id=$id");
$linhas = mysqli_num_rows ($resultado);
for ($i=0; $i<$linhas; $i++){
mysqli_data_seek ($resultado , $i);
$row = mysqli_fetch_row($resultado);

echo '<form action="atualiza.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="'. $row[0] .'">
<input type="text" required name="nome" placeholder="Título do produto" value="'. $row[1] . '">
<span>R$</span><input type="number" required name="preco" placeholder="0.00" step="0.01" value="'. $row[2]. '">
<p>Descrição do Produto</p>
<textarea placeholder="Digite aqui a descrição do seu produto..." name="descricao" rows="5" cols="33">' . $row[3] . '
</textarea></br>
<p>Quantidade em estoque</p>
<input type="number" name="quantidade" min=0 value="'. $row[5] .'"></br>
<input type="file" name="imagem">
<input type="submit" nome="atualizar" value="Salvar">
</form>';
}
mysqli_close($conexao);
} 
if(isset($_POST['atualizar'])){
$msg = false;
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];

    $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
    $novo_nome = md5(time()) . $extensao;
    $diretorio = "upload/";

    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);
    $sql_code = "UPDATE INTO produto (nome, preco, descricao, imagem, quantidade, data) VALUES ('$nome', '$preco', '$descricao','$novo_nome', '$quantidade', NOW()) WHERE id=$id";
    if($conexao->query($sql_code)){
        $msg = "Arquivo atualizado com sucesso!";
    }else{
        $msg = "Falha ao atualizar o arquivo de imagem." . mysqli_connect_error();
    }
}
?>