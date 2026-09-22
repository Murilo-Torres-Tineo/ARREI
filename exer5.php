<?php
$students = [
    ['nome' => 'Alice', 'idade' => 20, 'curso' => 'Engenharia', 'nota' => 8.5],
    ['nome' => 'Bruno', 'idade' => 22, 'curso' => 'Direito', 'nota' => 6.0],
    ['nome' => 'Carla', 'idade' => 19, 'curso' => 'Medicina', 'nota' => 9.2],
    ['nome' => 'Daniel', 'idade' => 21, 'curso' => 'Administração', 'nota' => 4.8],
    ['nome' => 'Eva', 'idade' => 20, 'curso' => 'Arquitetura', 'nota' => 7.0],
];

$approved = [];
$failed = [];
$sum = 0;
$highest = null;

foreach ($students as $s) {
    $sum += $s['nota'];
    if ($s['nota'] >= 6.0) {
        $approved[] = $s;
    } else {
        $failed[] = $s;
    }
    if ($highest === null || $s['nota'] > $highest['nota']) {
        $highest = $s;
    }
}

$average = $sum / count($students);

echo "<h2>Alunos aprovados</h2>\n<ul>\n";
foreach ($approved as $a) {
    echo "<li>{$a['nome']} ({$a['curso']}) - Nota: {$a['nota']}</li>\n";
}
echo "</ul>\n";

echo "<p><strong>Aluno com maior nota:</strong> {$highest['nome']} - Nota: {$highest['nota']}</p>\n";
echo "<p><strong>Média das notas:</strong> " . number_format($average, 2, ',', '.') . "</p>\n";
echo "<p><strong>Quantidade aprovados:</strong> " . count($approved) . "</p>\n";
echo "<p><strong>Quantidade reprovados:</strong> " . count($failed) . "</p>\n";

?>