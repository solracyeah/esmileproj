<?php
include 'db.php';

$query = "SELECT * FROM tooth_details ORDER BY tooth_number";
$stmt = $pdo->query($query);

$teeth = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $teeth[] = $row;
}

header('Content-Type: application/json');
echo json_encode($teeth);
?>
