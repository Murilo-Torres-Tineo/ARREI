<?php
$classA = ['Alice', 'Bruno', 'Carla', 'Daniel', 'Eva', 'Fernando'];
$classB = ['Gabriela', 'Bruno', 'Hugo', 'Eva', 'Isabela', 'Joaquim'];

$both = array_intersect($classA, $classB);
$onlyA = array_diff($classA, $classB);
$onlyB = array_diff($classB, $classA);

echo "<h2>Alunos em ambas as turmas</h2>\n<p>" . implode(', ', $both) . "</p>\n";
echo "<h3>Apenas na turma A</h3>\n<p>" . implode(', ', $onlyA) . "</p>\n";
echo "<h3>Apenas na turma B</h3>\n<p>" . implode(', ', $onlyB) . "</p>\n";

?>