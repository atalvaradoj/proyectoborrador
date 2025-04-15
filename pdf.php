<?php
require __DIR__ . "../fpdf186/fpdf.php"; // Replace 'path/to' with the actual relative path to fpdf.php
require_once "includes/db_config.php"; // Cargar configuración de la base de datos

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Notas', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

$conn = getConnection();
$sql = "SELECT CONCAT(e.Nombres, ' ', e.Apellidos) AS Estudiante, 
               CONCAT(d.Nombres, ' ', d.Apellidos) AS Docente, 
               n.Asignatura, n.Nota, n.Comentarios, n.Fecha
        FROM notas n
        JOIN estudiantes e ON n.ID_estudiante = e.ID_estudiante
        JOIN docentes d ON n.ID_docente = d.ID_docente";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(0, 10, "Estudiante: " . $row['Estudiante'], 0, 1);
    $pdf->Cell(0, 10, "Docente: " . $row['Docente'], 0, 1);
    $pdf->Cell(0, 10, "Asignatura: " . $row['Asignatura'], 0, 1);
    $pdf->Cell(0, 10, "Nota: " . $row['Nota'], 0, 1);
    $pdf->Cell(0, 10, "Comentarios: " . $row['Comentarios'], 0, 1);
    $pdf->Ln(5);
}

$pdf->Output();
?>