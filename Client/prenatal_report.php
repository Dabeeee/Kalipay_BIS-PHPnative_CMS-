
<?php


require('../functions/connection.php');
require('../fpdf181/fpdf.php');
class MyPdf extends FPDF{

	function header(){
		$this->Image('../logo.jpg',130,10,31);
		$this->Ln();
		$this->SetFont('ARIAL','B',12);
		

		$this->	Cell(276,70,'BRGY. KALIPAY BIRTHING INFORMATION SYSTEM',0,0,'C');
		$this->Ln(25);
		$this->Cell(276,30,'PATIENTS RECORD',0,0,'C');
		$this->Ln(20);

		$this->Cell(276,10,"",0,0,'C');
		$this->Ln();
		$this->Cell(276,10,"",0,0,'C');
		$this->Ln();



	}

	function Footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');

	}

	function HeaderTable(){
		$this->SetFont('Times','B',12);
		$this->Cell(40,10,'',10,0,'C');
		$this->Cell(60,10,'Test Name',1,0,'C');
		$this->Cell(80,10,'Test Results',1,0,'C');
		$this->Cell(60,10,'Date Taken',1,0,'C');
		$this->Ln();


	}
	function HeaderTable1(){
		$this->SetFont('Times','B',12);
		$this->Cell(40,10,'',10,0,'C');
		$this->Cell(60,10,'Checkup Date',1,0,'C');
		$this->Cell(80,10,'Remarks',1,0,'C');
		$this->Cell(60,10,'Issued Medicine',1,0,'C');
		$this->Ln();


	}



	function Userdetails(){

		require('../functions/connection.php');
		$id=$_POST['id'];

		$result = mysqli_query($db,"SELECT * FROM patient_list WHERE user_id ='$id'");
		while ($row = mysqli_fetch_assoc($result)) {
			$first_name=$row['first_name'];
			$last_name=$row['last_name'];
			$address=$row['address'];
			$contact_number=$row['contact_number'];
			$maiden_name=$row['maiden_name'];
			$birthdate=$row['birthdate'];
			$high_attain1=$row['high_attain1'];
			$employed1=$row['employed1'];
			$employed2=$row['employed2'];
			$expecteddate=$row['expecteddate'];
			$weight=$row['weight'];
			$partner_name=$row['partner_name'];
			$citizenship_1=$row['citizenship_1'];
			$citizenship_2=$row['citizenship_2'];
			$contact_number2=$row['contact_number2'];
			$high_attain2=$row['high_attain2'];
			$delivery_type=$row['delivery_type'];
			


			
			

			
			$this->Cell(40,10,'',10,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"Patient Name:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(60,10,"$first_name $last_name",0,0,'L');
			$this->Cell(20,10,"",0,0,'C');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"Patient No:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(40,10,"$id",0,0,'L');
			$this->Ln();
			

			$this->Cell(40,10,'',10,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"Contact Number:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(60,10,"$contact_number",0,0,'L');
			$this->Cell(20,10,"",0,0,'C');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"Permanent Address:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(40,10,"$address",0,0,'L');
			$this->Ln();





			$this->Cell(40,10,'',10,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"Citizenship:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(60,10,"$citizenship_1",0,0,'L');
			$this->Cell(20,10,"",0,0,'C');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"Employment Status:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(40,10,"$employed1",0,0,'L');
			$this->Ln();
			
			

			$this->Cell(40,10,'',10,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(60,10,"Highest Educational Attainment:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(60,10,"$high_attain1",0,0,'L');
			$this->Cell(20,10,"",0,0,'C');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(40,10,"",0,0,'L');
			$this->Ln();



			$this->Cell(40,10,'',10,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"Birth Date:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(60,10,"$birthdate",0,0,'L');
			$this->Cell(20,10,"",0,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10," Body Mass 	Weight:",0,0,'C');
			$this->SetFont('Times','',12);
			$this->Cell(40,10,"$weight kilograms",0,0,'C');
			$this->Ln();


			$this->Cell(40,10,'',10,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(60,10,"Expected Delivery Date:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(40,10,"$expecteddate",0,0,'L');
			$this->Cell(20,10,"",0,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10," Delivery Type:",0,0,'C');
			$this->SetFont('Times','',12);
			$this->Cell(60,10,"$delivery_type",0,0,'C');
			$this->Ln();
			


			$this->Cell(40,10,'',10,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"Partner Name:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(60,10,"$partner_name",0,0,'L');
			$this->Cell(20,10,"",0,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10," Citizenship:",0,0,'C');
			$this->SetFont('Times','',12);
			$this->Cell(40,10,"$citizenship_2",0,0,'C');
			$this->Ln();

			$this->Cell(40,10,'',10,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(60,10,"Highest Educational Attainment:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(60,10,"$high_attain2",0,0,'L');
			$this->Cell(20,10,"",0,0,'C');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(40,10,"",0,0,'L');
			$this->Ln();


			$this->Cell(40,10,'',10,0,'L');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"Contact Number:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(60,10,"$contact_number2",0,0,'L');
			$this->Cell(20,10,"",0,0,'C');
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,"Employment Status:",0,0,'L');
			$this->SetFont('Times','',12);
			$this->Cell(40,10,"$employed2",0,0,'L');
			$this->Ln();



			$this->Cell(276,10,"",0,0,'C');
			$this->Ln();
			$this->Cell(276,10,"",0,0,'C');
			$this->Ln();
		}
	}

	function Title(){


		$this->SetFont('Times','B',12);
		$this->Cell(276,10,"Tests Completed ",0,0,'C');
		$this->Ln();
		$this->Cell(276,10,"",0,0,'C');
		$this->Ln();




	}
	function Title1(){


		$this->SetFont('Times','B',12);
		$this->Cell(276,10,"Checkup Meetings",0,0,'C');
		$this->Ln();
		$this->Cell(276,10,"",0,0,'C');
		$this->Ln();





	}
	


	function Space(){



		$this->Cell(276,10,"",0,0,'C');
		$this->Ln();
		$this->Cell(276,10,"",0,0,'C');
		$this->Ln();





	}
	

	function Table(){
		require('../functions/connection.php');
		$id=$_POST['id'];
		$result = mysqli_query($db,"SELECT * FROM prenatal_test WHERE user_id ='$id'");
		while ($row = mysqli_fetch_assoc($result)) {
			$test_name = $row['test_name'];
			$results = $row['results'];
			$date_taken = $row['date_taken'];


			$this->SetFont('Times','',10);
			$this->Cell(40,10,'',10,0,'C');
			$this->Cell(60,10,$test_name,1,0,'C');
			$this->Cell(80,10,$results,1,0,'C');
			$this->Cell(60,10,$date_taken,1,0,'C');
			$this->Ln();




		}
	}



	function Table1(){
		require('../functions/connection.php');
		$id=$_POST['id'];
		$result = mysqli_query($db,"SELECT * FROM prenatal_checkup WHERE user_id ='$id'");
		while ($row = mysqli_fetch_assoc($result)) {
			$remarks = $row['remarks'];
			$issued_medicine = $row['issued_medicine'];
			$date_taken = $row['date_taken'];


			$this->SetFont('Times','',10);
			$this->Cell(40,10,'',10,0,'C');
			$this->Cell(60,10,$date_taken,1,0,'C');
			$this->Cell(80,10,$remarks,1,0,'C');
			$this->Cell(60,10,$issued_medicine,1,0,'C');
			$this->Ln();



		}
	}

}

$pdf=new MyPdf();
$pdf->AliasNBpages();
$pdf->AddPAge('L','A4',0);
$pdf->Userdetails();
$pdf->Title();
$pdf->HeaderTable();
$pdf->Table();
$pdf->Space();

$pdf->Title1();
$pdf->HeaderTable1();

$pdf->Table1();


$pdf->Output();







?>