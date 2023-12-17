<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Tipocita;
use App\Models\Veterinario;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function imprimir(string $id)
    {
        //$file_name =  f'app/public/citas-' + $id + '.pdf';

        $cita = Cita::find($id);
        $cliente = Cliente::find($cita->cliente_id);
        $tipo_cita = Tipocita::find($cita->tipo_id);
        $veterinario = Veterinario::find($cita->vet_id);

        $this->fpdf = new FPDF($orientation = 'P', $unit = 'mm');
        $this->fpdf->AddPage();
        $this->fpdf->SetFont('Arial', 'B', 20);
        $textypos = 5;
        $this->fpdf->setY(12);
        $this->fpdf->setX(10);
        // Agregamos los datos de la empresa
        $this->fpdf->Cell(5, $textypos, "VETERINARIA RUIZ CARO");
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->setY(30);
        $this->fpdf->setX(10);
        $this->fpdf->Cell(5, $textypos, "DE:");
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->setY(35);
        $this->fpdf->setX(10);
        $this->fpdf->Cell(5, $textypos, "Veterianaria Ruiz Caro");
        $this->fpdf->setY(40);
        $this->fpdf->setX(10);
        $this->fpdf->Cell(5, $textypos, "Jr. San Agustín 498, Lima 15047");
        $this->fpdf->setY(45);
        $this->fpdf->setX(10);
        $this->fpdf->Cell(5, $textypos, "(01) 5497834");
        $this->fpdf->setY(50);
        $this->fpdf->setX(10);
        $this->fpdf->Cell(5, $textypos, "vet.ruiz.caro@gmail.com");
        // Agregamos los datos del cliente
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->setY(30);
        $this->fpdf->setX(75);
        $this->fpdf->Cell(5, $textypos, "PARA:");
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->setY(35);
        $this->fpdf->setX(75);
        $this->fpdf->Cell(5, $textypos,$cliente->nombre." ".$cliente->apellido);
        $this->fpdf->setY(40);
        $this->fpdf->setX(75);
        $this->fpdf->Cell(5, $textypos, $cliente->direccion);
        $this->fpdf->setY(45);
        $this->fpdf->setX(75);
        $this->fpdf->Cell(5, $textypos, $cliente->telefono);
        $this->fpdf->setY(50);
        $this->fpdf->setX(75);
        $this->fpdf->Cell(5, $textypos, $cliente->email);

        // Agregamos los datos del cliente
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->setY(30);
        $this->fpdf->setX(135);
        $this->fpdf->Cell(5, $textypos, "RECIBO #0004");
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->setY(35);
        $this->fpdf->setX(135);
        $this->fpdf->Cell(5, $textypos, "Fecha: 16/12/2023");
        $this->fpdf->setY(40);
        $this->fpdf->setX(135);
        $this->fpdf->Cell(5, $textypos, "Vencimiento: 16/12/2023");
        $this->fpdf->setY(45);
        $this->fpdf->setX(135);
        $this->fpdf->Cell(5, $textypos, "");
        $this->fpdf->setY(50);
        $this->fpdf->setX(135);
        $this->fpdf->Cell(5, $textypos, "");

        /// Apartir de aqui empezamos con la tabla de productos
        $this->fpdf->setY(60);
        $this->fpdf->setX(135);
        $this->fpdf->Ln();
        /////////////////////////////
        //// Array de Cabecera
        $header = array("Tipo de cita", "Veterinario", "Monto Adicional", "Subtotal", "Total");
        //// Arrar de Productos
        $products = array(
            //array($tipo_cita->nombre, $veterinario->nombre." ".$veterinario->apellido, $cita->monto_adicional, $cita->subtotal, $cita->total),
            array($tipo_cita->nombre, $veterinario->nombre." ".$veterinario->apellido , $cita->monto_adicional, $cita->subtotal, $cita->total),

        );
        // Column widths
        $w = array(35, 73, 27, 25, 25);
        // Header
        for ($i = 0; $i < count($header); $i++)
            $this->fpdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->fpdf->Ln();
        // Data
        $total = 0;
        foreach ($products as $row) {
            $this->fpdf->Cell($w[0], 6, $row[0], 1);
            $this->fpdf->Cell($w[1], 6, $row[1], 1);
            $this->fpdf->Cell($w[2], 6, number_format($row[2]), '1', 0, 'R');
            $this->fpdf->Cell($w[3], 6, "S/. " . number_format($row[3], 2, ".", ","), '1', 0, 'R');
            $this->fpdf->Cell($w[4], 6, "S/. " . number_format($row[3] * $row[2], 2, ".", ","), '1', 0, 'R');

            $this->fpdf->Ln();
            $total += $row[3] * $row[2];
        }
        /////////////////////////////
        //// Apartir de aqui esta la tabla con los subtotales y totales
        $yposdinamic = 60 + (count($products) * 10);

        $this->fpdf->setY($yposdinamic);
        $this->fpdf->setX(235);
        $this->fpdf->Ln();
        /////////////////////////////
        $header = array("", "");
        $data2 = array(
            array("Subtotal", $cita->subtotal),
            array("C. Adicionales", $cita->monto_adicional ),
            array("IGV (18%) incluido", 0),
            array("Total", $cita->total),
        );
        // Column widths
        $w2 = array(40, 40);
        // Header

        $this->fpdf->Ln();
        // Data
        foreach ($data2 as $row) {
            $this->fpdf->setX(115);
            $this->fpdf->Cell($w2[0], 6, $row[0], 1);
            $this->fpdf->Cell($w2[1], 6, "S/. " . number_format($row[1], 2, ".", ","), '1', 0, 'R');

            $this->fpdf->Ln();
        }
        /////////////////////////////

        $yposdinamic += (count($data2) * 10);
        $this->fpdf->SetFont('Arial', 'B', 10);

        $this->fpdf->setY($yposdinamic);
        $this->fpdf->setX(10);
        $this->fpdf->Cell(5, $textypos, "TERMINOS Y CONDICIONES");
        $this->fpdf->SetFont('Arial', '', 10);

        $this->fpdf->setY($yposdinamic + 10);
        $this->fpdf->setX(10);
        $this->fpdf->Cell(5, $textypos, "El cliente se compromete a pagar la boleta.");
        $this->fpdf->setY($yposdinamic + 20);
        $this->fpdf->setX(10);
        $this->fpdf->output('D' , 'cita-B00'.$id.'.pdf');
        exit;

        /*$this->fpdf->output('app/public/citas/cita.pdf','F');
        $this->fpdf->output('F' , 'F:/citas/cita-B00'.$id.'.pdf'  );
        exit;
        /*$message ="si se guardo";
        return response()->json($message);*/
    }
}
