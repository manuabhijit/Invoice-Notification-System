<?php

// take the data form GET method
$invoice_p_id=$_GET['invoiceid'];
$address_receiver=NULL;

// Database connectivity.
require('../generic_php/db_connect.php');
$conn= new db_connector;
$conn->coonect_now();

$query="select * from documents where id ='".$invoice_p_id."'";
$run=mysql_query($query);


while ($row=mysql_fetch_array($run)) {
    $address="dd";
    $dispatch_date=$row[1];
    $my_email=$row[2];

    $query_sender="select * from users where email ='".$row[2]."'";
    $run_sender=mysql_query($query_sender);
    while ($row_sender=mysql_fetch_array($run_sender)) {
        $address_sender=str_replace(", ","\n",$row_sender[3]);
    }

    $query_receiver="select * from users where email ='".$row[3]."'";
    $run_receiver=mysql_query($query_receiver);
    while ($row_receiver=mysql_fetch_array($run_receiver)) {
        $address_receiver=str_replace(", ","\n",$row_receiver[3]);
        $name_receiver=$row_receiver[2];
    }
}

$address_sender=$address_sender."\n".$my_email;

$current_date=date("Y/m/d");
$invoice_d=$invoice_p_id;

require('invoice.php');

// Creating object of a class
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );

$pdf->AddPage();
// Left Top Part
$pdf->addSociete( $name_receiver, $address_receiver);

//Right Part
$pdf->fact_dev( "Abhijit's ", "PORTAL" );
$pdf->temporaire( "My Company" );
$pdf->addDate( $current_date);

// Add the Invoice information
$pdf->addPageNumber("1");
$pdf->addClientAdresse($address_sender);
$pdf->addReglement("The payment can only be done online");
$pdf->addEcheance($dispatch_date);
$pdf->addNumTVA($invoice_d);

$query="select * from documents where id ='".$invoice_p_id."'";
$run=mysql_query($query);

// Add the table headers
$cols=array( "S.No"    => 23,
             "Item Name"  => 78,
             "Quantity"     => 22,
             "Cost"      => 26,
             "Total" => 25,
             "Discount"          => 16 );
$pdf->addCols( $cols);
$cols=array( "S.No"    => "L",
             "Item Name"  => "L",
             "Quantity"     => "C",
             "Cost"      => "R",
             "Total" => "R",
             "Discount"          => "C" );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);

// Add Items
while ($row=mysql_fetch_array($run)) {
    $y    = 109;
    $counter=1;


    $total_cost_of_bil= $row[14];
    for($loop=0; $loop<=4; $loop++)
        if($row[4+$loop*2]!="null")
        {
            $line = array( "S.No"    => $counter++,
                         "Item Name"  => $row[4+$loop*2],
                         "Quantity"     => $row[25+$loop],
                         "Cost"      => $row[5+$loop*2],
                         "Total" => "Rs. ".$row[25+$loop]*$row[5+$loop*2]*(1- $row[20+$loop]/100),
                         "Discount"          => $row[20+$loop]." %" );
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 8;
        }

}

$y   += $size + 8*3;

// Add Total amount
$line = array( "S.No"    => ' ',
             "Item Name"  => "               Total :",
             "Quantity"     => ' ',
             "Cost"      => ' ',
             "Total" => "Rs. ".(string)$total_cost_of_bil,
             "Discount"          =>  ' ');
$size = $pdf->addLine( $y, $line );



$pdf->Output();
?>
