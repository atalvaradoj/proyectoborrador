<?php
require('fpdf186/fpdf.php');
include 'includes/db_config.php';
$conn = getConnection();

if (isset($_POST['ID_estudiante'])) {
    $ID_estudiante = $_POST['ID_estudiante'];

    $query = $conn->prepare("SELECT e.Nombres AS Estudiante, n.Materia, n.Nota, n.Asistencia
                             FROM notas n
                             JOIN estudiantes e ON n.ID_estudiante = e.ID_estudiante
                             WHERE n.ID_estudiante = ?");
    $query->bind_param("s", $ID_estudiante);
    $query->execute();
    $result = $query->get_result();

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,'Reporte de Notas y Asistencia',0,1,'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(50,10,'Materia',1);
    $pdf->Cell(30,10,'Nota',1);
    $pdf->Cell(40,10,'Asistencia (%)',1);
    $pdf->Ln();

    $pdf->SetFont('Arial','',12);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(50,10,utf8_decode($row['Materia']),1);
        $pdf->Cell(30,10,$row['Nota'],1);
        $pdf->Cell(40,10,$row['Asistencia'] . '%',1);
        $pdf->Ln();
    }

    $pdf->Output('I', 'reporte_notas.pdf');
}
?>
