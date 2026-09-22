<?php

$notas = [8.5, 6.0, 7.2, 9.1, 5.4, 10.0, 7.8, 4.9, 8.0, 6.7];

echo "Notas dos alunos: ";
foreach ($notas as $indice => $nota) {
    echo ($indice > 0 ? ", " : "") . $nota;
}
echo "<br><br>";

$maior = max($notas);
$menor = min($notas);

$aprovados = 0;
$reprovados = 0;

foreach ($notas as $nota) {
    if ($nota >= 7.0) {
        $aprovados++;
    } else {
        $reprovados++;
    }
}

$notasOrdenadas = $notas;
sort($notasOrdenadas, SORT_NUMERIC);

echo "Maior nota: $maior<br>";
echo "Menor nota: $menor<br>";
echo "Alunos aprovados: $aprovados<br>";
echo "Alunos reprovados: $reprovados<br>";
echo "Notas em ordem crescente: ";
foreach ($notasOrdenadas as $indice => $nota) {
    echo ($indice > 0 ? ", " : "") . $nota;
}
echo "<br>";
?>