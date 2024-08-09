<?php
require ("fpdf/fpdf.php");
require ("word.php");
include('connect.php');


// Customer and invoice details
$info = [
    "customer" => "",
    "address" => ",",
    "city" => "",
    "invoice_no" => "",
    "invoice_date" => "",
    "total_amt" => "",
    "words" => "",
];

// Select Invoice Details From Database
$sql = "SELECT * FROM invoice WHERE SID='{$_GET["id"]}'";
$res = $con->query($sql);
if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();

    $obj = new IndianCurrency($row["GRAND_TOTAL"]);

    $info = [
        "customer" => $row["CNAME"],
        "address" => $row["CADDRESS"],
        "city" => $row["CCITY"],
        "invoice_no" => $row["INVOICE_NO"],
        "invoice_date" => date("d-m-Y", strtotime($row["INVOICE_DATE"])),
        "total_amt" => $row["GRAND_TOTAL"],
        "words" => $obj->get_words(),
    ];
}

// Invoice Products
$products_info = [];

// Select Invoice Product Details From Database
$sql = "SELECT * FROM invoice_products WHERE SID='{$_GET["id"]}'";
$res = $con->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $products_info[] = [
            "name" => $row["PNAME"],
            "price" => $row["PRICE"],
            "gst" => $row["GST"],
            "qty" => $row["QTY"],
            "total" => $row["TOTAL"],
        ];
    }
}

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('logo.jpeg', 10, 10, 35);

        // Display Company Info
        $this->SetY(10);
        $this->SetX(60);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(50, 10, "Vrishanksoft", 0, 1);

        $this->SetFont('Arial', '', 14);
        $this->Cell(50, 7, ",", 0, 1);
        $this->Cell(50, 7, "", 0, 1);
        $this->Cell(50, 7, "", 0, 1);

        // Display INVOICE text
        $this->SetY(15);
        $this->SetX(-40);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(50, 10, "INVOICE", 0, 1);

        // Display Horizontal line
        $this->Line(0, 48, 210, 48);
    }

    function body($info, $products_info)
    {
        // Billing Details
        $this->SetY(55);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 10, "Bill To: ", 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->Cell(50, 7, $info["customer"], 0, 1);
        $this->Cell(50, 7, $info["address"], 0, 1);
        $this->Cell(50, 7, $info["city"], 0, 1);

        // Display Invoice no
        $this->SetY(55);
        $this->SetX(-60);
        $this->Cell(50, 7, "Invoice No : " . $info["invoice_no"]);

        // Display Invoice date
        $this->SetY(63);
        $this->SetX(-60);
        $this->Cell(50, 7, "Invoice Date : " . $info["invoice_date"]);

        // Display Table headings
        $this->SetY(95);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(60, 9, "DESCRIPTION", 1, 0);
        $this->Cell(30, 9, "PRICE", 1, 0, "C");
        $this->Cell(20, 9, "GST", 1, 0, "C");
        $this->Cell(30, 9, "QTY", 1, 0, "C");
        $this->Cell(40, 9, "TOTAL", 1, 1, "C");
        $this->SetFont('Arial', '', 12);

        // Display table product rows
        foreach ($products_info as $row) {
            $this->Cell(60, 9, $row["name"], "LR", 0);
            $this->Cell(30, 9, $row["price"], "R", 0, "R");
            $this->Cell(20, 9, $row["gst"], "R", 0, "R");
            $this->Cell(30, 9, $row["qty"], "R", 0, "C");
            $this->Cell(40, 9, $row["total"], "R", 1, "R");
        }

        // Display table empty rows
        for ($i = 0; $i < 12 - count($products_info); $i++) {
            $this->Cell(60, 9, "", "LR", 0);
            $this->Cell(30, 9, "", "R", 0, "R");
            $this->Cell(20, 9, "", "R", 0, "R");
            $this->Cell(30, 9, "", "R", 0, "C");
            $this->Cell(40, 9, "", "R", 1, "R");
        }

        // Display table total row
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(150, 9, "TOTAL", 1, 0, "R");
        $this->Cell(30, 9, $info["total_amt"], 1, 1, "R");

        // Display amount in words
        $this->SetY(225);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 9, "Amount in Words ", 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 9, $info["words"], 0, 1);
    }

    function Footer()
    {
        // set footer position
        $this->SetY(-50);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, "for Vrishank soft", 0, 1, "R");
        $this->Ln(15);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, "Authorized Signature", 0, 1, "R");
        $this->SetFont('Arial', '', 10);

        // Display Footer Text
        $this->Cell(0, 10, "This is a computer-generated invoice", 0, 1, "C");
    }
}

// Create A4 Page with Portrait
$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
$pdf->body($info, $products_info);
$pdf->Output();
?>
