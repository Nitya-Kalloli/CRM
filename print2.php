<?php 
  require ("fpdf/fpdf.php");
  require ("word.php");
  include('connect.php');

  //customer and invoice details
  $info=[
    "customer"=>"",
    "address"=>",",
    "email"=>"",
    "quotation_no"=>"",
    "quotation_date"=>"",
    "total_amt"=>"",
    "words"=>"",
  ];
  
  //Select Invoice Details From Database
  $sql="select * from quotations where SID='{$_GET["id"]}'";
  $res=$con->query($sql);
  if($res->num_rows>0){
	  $row=$res->fetch_assoc();
	  
	  $obj=new IndianCurrency($row["grand_total"]);
	 

	  $info=[
		"customer"=>$row["customer_name"],
		"address"=>$row["customer_address"],
		"email"=>$row["customer_email"],
		"quotation_no"=>$row["quotation_no"],
		"quotation_date"=>date("d-m-Y",strtotime($row["quotation_date"])),
		"total_amt"=>$row["grand_total"],
		"words"=> $obj->get_words(),
	  ];
  }
  
  //invoice Products
  $products_info=[];
  
  //Select Invoice Product Details From Database
  $sql="select * from quotation_details where SID='{$_GET["id"]}'";
  $res=$con->query($sql);
  if($res->num_rows>0){
	  while($row=$res->fetch_assoc()){
		   $products_info[]=[
			"name"=>$row["project_name"],
			"desc"=>$row["project_description"],
      "cost"=>$row["estimated_cost"],
			"total"=>$row["total"],
		   ];
	  }
  }
  
  class PDF extends FPDF
  {
    function Header(){
      
       $this->Image('logo.jpeg', 10, 10, 35);
      
      //Display Company Info
         $this->SetY(10);
        $this->SetX(60);
      //Display Company Info
      $this->SetFont('Arial','B',14);
      $this->Cell(50,10,"Vrishanksoft",0,1);
      $this->SetFont('Arial','',14);
      $this->Cell(50,7,"West Street,",0,1);
      $this->Cell(50,7,"Salem 636002.",0,1);
      $this->Cell(50,7,"PH : 8778731770",0,1);
      
      //Display INVOICE text
      $this->SetY(15);
      $this->SetX(-40);
      $this->SetFont('Arial','B',18);
      $this->Cell(50,10,"QUOTATION",0,1);
      
      //Display Horizontal line
      $this->Line(0,48,210,48);
    }
    
    function body($info,$products_info){
      
      //Billing Details
      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"Bill To: ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$info["customer"],0,1);
      $this->Cell(50,7,$info["address"],0,1);
      $this->Cell(50,7,$info["email"],0,1);
      
      //Display Invoice no
      $this->SetY(55);
      $this->SetX(-60);
      $this->Cell(50,7,"Quotation No : ".$info["quotation_no"]);
      
      //Display Invoice date
      $this->SetY(63);
      $this->SetX(-60);
      $this->Cell(50,7,"Quotation Date : ".$info["quotation_date"]);
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(60,9,"Project Name",1,0);
      $this->Cell(40,9,"Project Descr",1,0,"C");
      $this->Cell(40,9,"Estimated Cost",1,0,"C");
      $this->Cell(40,9,"TOTAL",1,1,"C");
      $this->SetFont('Arial','',12);
      
      //Display table product rows
      foreach($products_info as $row){
        $this->Cell(60,9,$row["name"],"LR",0);
        $this->Cell(40,9,$row["desc"],"R",0,"R");
        $this->Cell(40,9,$row["cost"],"R",0,"R");
        $this->Cell(40,9,$row["total"],"R",1,"R");
      }
      //Display table empty rows
      for($i=0;$i<12-count($products_info);$i++)
      {
        $this->Cell(60,9,"","LR",0);
        $this->Cell(40,9,"","R",0,"R");
        $this->Cell(40,9,"","R",0,"C");
        $this->Cell(40,9,"","R",1,"R");
      }
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(140,9,"TOTAL",1,0,"R");
      $this->Cell(40,9,$info["total_amt"],1,1,"R");
      
      //Display amount in words
      $this->SetY(225);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,9,"Amount in Words ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(0,9,$info["words"],0,1);
      
    }
    function Footer(){
      
      //set footer position
      $this->SetY(-50);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,10,"for Vrishank soft",0,1,"R");
      $this->Ln(15);
      $this->SetFont('Arial','',12);
      $this->Cell(0,10,"Authorized Signature",0,1,"R");
      $this->SetFont('Arial','',10);
      
      //Display Footer Text
      $this->Cell(0,10,"This is a computer generated invoice",0,1,"C");
      
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  $pdf->Output();
?>