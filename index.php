<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aham Jr.</title>
</head>

<body>
    <h1>Exercícios</h1>
    <a href="exer1.php">Controle de Notas</a>
    <br><br>
    <a href="exer2.php">Produtos e Preços</a>
    <br><br>
    <a href="exer3.php">Manipulação de Nomes</a>
    <br><br>
    <a href="exer4.php">Números Repetidos</a>
    <br><br>
    <a href="exer5.php">Cadastro de Alunos</a>
    <br><br>
    <a href="exer6.php">Controle de Estoque</a>
    <br><br>
    <a href="exer7.php">Alunos de Duas Turmas</a>
    <br><br>
    <a href="./controle-produtos/CTRLP.php">Controle de Produtos</a>

    <hr>

</body>

</html>

<hr>
<br>

<?php
echo "exemplo-01 <br>";
echo "Array original: " . "<br>";
$array = array(1, 2, 3, 4);
$array2 = [1, 2, 3, 4];

for ($i = 0; $i < count($array); $i++) {
    echo $array[$i] . "\n" . "<br>";
}
echo "<br>";

echo "exemplo-02 <br>";
echo "Adicionando elementos ao final do array: 5, 6" . "<br>";
array_push($array, 5, 6);
for ($i = 0; $i < count($array); $i++) {
    echo $array[$i] . "\n" . "<br>";
}
echo "<br>";

echo "exemplo-03 <br>";
$resultado = array_pop($array);
echo "Valor removido: " . $resultado . "<br>";
for ($i = 0; $i < count($array); $i++) {
    echo $array[$i] . "\n" . "<br>";
}
echo "<br>";

echo "exemplo-04 <br>";
$comeco2 = array_unshift($array, 0);
echo "Valor adicionado no início: 0" . "<br>";
for ($i = 0; $i < count($array); $i++) {
    echo $array[$i] . "\n" . "<br>";
}
echo "<br>";

echo "exemplo-05 <br>";
$comeco = array_shift($array);
echo "Valor removido do início: " . $comeco . "<br>";
for ($i = 0; $i < count($array); $i++) {
    echo $array[$i] . "\n" . "<br>";
}
echo "<br>";

echo "exemplo-06 <br>";
$array2 = [6, 7, 8, 9];
$result = array_merge($array, $array2);
echo "Array mesclado: " . "<br>";
for ($i = 0; $i < count($result); $i++) {
    echo $result[$i] . "\n" . "<br>";
}
echo "<br>";

echo "exemplo-07 <br>";
$retira = array_slice($result, 3, 3);
echo "Elementos selecionados: " . "<br>";
for ($i = 0; $i < count($retira); $i++) {
    echo $retira[$i] . "\n" . "<br>";
}
echo "<br>";
?>