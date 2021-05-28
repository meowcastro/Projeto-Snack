<?php 
echo '<table><tr>
<td></td>
<td>Código</td>
<td>Nome</td>
<td>Preço</td>
<td>Descrição</td>
<td>Imagem</td>
<td>Estoque</td>
<td>Data de cadastro</td>
</tr>';
include "conecta_mysqli.inc";
$resultado = mysqli_query($conexao, "SELECT * FROM produto");
$linhas = mysqli_num_rows ($resultado);
for ($i=0; $i<$linhas; $i++){
mysqli_data_seek ($resultado , $i);
$row = mysqli_fetch_row($resultado);

echo '<tr><td><form action="listagem.php" method="POST">
<input type="hidden" name="id" value="' . $row[0] . '">
<input type="submit" name="excluir" value="Excluir"></form>';
echo '<form action="atualiza.php" method="POST">
<input type="hidden" name="id" value="' . $row[0] . '">
<input type="submit" name="editar" value="Editar"></td></form>';
echo "<td> " . $row[0] . "</td>";
echo "<td>" . $row[1] . "</td>";
echo "<td>R$" . $row[2] . "</td>";
echo "<td>" . $row[3] . "</td>";
echo '<td><img style="height:50px" src="upload/' . $row[4] . '"/></td>';
echo "<td>" . $row[5] . "</td>";
echo "<td>" . $row[6] . "</td></tr>";
}
mysqli_close($conexao);
echo "</table>";

function excluir(){
    include "conecta_mysqli.inc";
    $id = $_POST['id'];
    $sql = "DELETE FROM produto WHERE id=$id";
    $resultado = mysqli_query($conexao, $sql);
    $linhas = mysqli_affected_rows($conexao);
    echo "Produto excluido com sucesso!";

}
if(isset($_POST['excluir']))
{
   excluir();
} 
?>

<style>
form {
    float: left;
}
</style>