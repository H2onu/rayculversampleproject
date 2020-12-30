<?php

	require( '../../../../../app/fpdf181/FPDF.php' );


	use App\submitProject;
	use App\DB;

	error_reporting( - 1 );
	ini_set( 'display_errors', 'On' );


	class PDF extends FPDF {
		function Header () {
			//global $title;

			//logo
			$this->Image( '../images/PSC-FormAsset-2060x342-V2-01.jpg' );

//			// Arial bold 15
//		//	$this->SetFont( 'Arial', 'B', 15 );
//			// Calculate width of title and position
//			$w = $this->GetStringWidth( $title ) + 6;
//			$this->SetX( ( 210 - $w ) / 2 );
//			// Colors of frame, background and text
//			$this->SetDrawColor( 0, 80, 180 );
//			$this->SetFillColor( 230, 230, 0 );
//			$this->SetTextColor( 220, 50, 50 );
//			// Thickness of frame (1 mm)
//			$this->SetLineWidth( 1 );
			// Title
//			$this->Cell( $w, 9, $title, 1, 1, 'C', true );
//			// Line break
			$this->Ln( 10 );
		}

		function Footer () {
			// Position at 1.5 cm from bottom
			$this->SetY( - 15 );
			// Arial italic 8
			$this->SetFont( 'Arial', 'I', 8 );
			// Text color in gray
			$this->SetTextColor( 128 );
			// Page number
			$this->Cell( 0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C' );
		}

		function ChapterTitle ( $num, $label ) {
			// Arial 12
			$this->SetFont( 'Arial', 'B', 16 );
			// Background color
			$this->SetFillColor( 200, 220, 255 );
			// Title
			$this->Ln( 4 );
			$this->Cell( 0, 6, "PSC VOUCHER: $label", 0, 1, 'L', true );
			// Line break
			$this->Ln( 4 );
			$this->Ln( 4 );
		}

		function SubTitle ( $file ) {
			// Arial 12
			$this->SetFont( 'Arial', 'B', 16 );
			// Background color
			$this->SetFillColor( 255, 255, 255 );
			// Title
			$this->Cell( 0, 6, "$file", 0, 1, 'C', true );
			// Line break
			$this->Ln( 4 );
		}

		function ChapterBody ( $file ) {
			// Read text file
			//$txt = file_get_contents( $file );
			// Times 12
			$this->SetFont( 'Arial', '', 12 );
			// Output justified text
			$this->MultiCell( 0, 5, $file );
			// Line break
			$this->Ln();
			// Mention in italics
			$this->SetFont( '', 'I' );
			//$this->Cell( 0, 5, '(end of excerpt)' );
		}

		function ProjectDetails ( $file ) {
			// Read text file
			//$txt = file_get_contents( $file );
			// Times 12
			$this->SetFont( 'Arial', 'B', 12 );
			// Output justified text
			$this->MultiCell( 0, 5, $file );
			// Line break
			$this->Ln();
			// Mention in italics
			$this->SetFont( '', 'I' );
			//$this->Cell( 0, 5, '(end of excerpt)' );
		}

		function RedemptionDetails ( $file ) {
			// Read text file
			//$txt = file_get_contents( $file );
			// Times 12
			$this->SetFont( 'Arial', 'B', 12 );
			// Output justified text
			$this->MultiCell( 0, 5, $file );
			// Line break
			$this->Ln();
			// Mention in italics
			$this->SetFont( '', 'I' );
			//$this->Cell( 0, 5, '(end of excerpt)' );
		}

		function ProjectLocations ( $file ) {
			// Read text file
			//$txt = file_get_contents( $file );
			// Times 12
			$this->SetFont( 'Arial', '', 12 );
			// Output justified text
			$this->MultiCell( 0, 5, $file );
			// Line break
			$this->Ln();
			// Mention in italics
			$this->SetFont( '', 'I' );
			//$this->Cell( 0, 5, '(end of excerpt)' );
		}

		function SupplyLocations ( $file ) {
			// Read text file
			//$txt = file_get_contents( $file );
			// Times 12
			$this->SetFont( 'Arial', 'B', 12 );
			// Output justified text
			$this->MultiCell( 0, 5, $file );
			// Line break
//			$this->Ln();
			// Mention in italics
			$this->SetFont( '', 'I' );
			//$this->Cell( 0, 5, '(end of excerpt)' );
		}

		function SupplyDetails ( $file ) {
			// Read text file
			//$txt = file_get_contents( $file );
			// Times 12
			$this->SetFont( 'Arial', '', 12 );
			// Output justified text
			$this->MultiCell( 0, 5, $file );
			// Line break
			$this->Ln();
			// Mention in italics
			$this->SetFont( '', 'I' );
			//$this->Cell( 0, 5, '(end of excerpt)' );
		}

		function Dates ( $file ) {
			// Read text file
			//$txt = file_get_contents( $file );
			// Times 12
			$this->SetFont( 'Arial', 'B', 12 );
			// Output justified text
			$this->MultiCell( 0, 5, $file );
			// Line break
//			$this->Ln();
			// Mention in italics
			$this->SetFont( '', 'I' );
			//$this->Cell( 0, 5, '(end of excerpt)' );
		}

		function DateDetails ( $file ) {
		$this->SetFont( 'Arial', '', 12 );
			$this->MultiCell( 0, 5, $file );
			// Line break
			$this->Ln();
			// Mention in italics
			$this->SetFont( '', 'I' );
			//$this->Cell( 0, 5, '(end of excerpt)' );
		}

		function PrintChapter ( $num, $title, $text1, $text2, $text3, $text4, $text5, $text6, $text7, $text8 ) {

			$this->AddPage();
			$this->SubTitle( $text1 );
			$this->ChapterTitle( $num, $title );
			$this->RedemptionDetails( $text2 );
			$this->ChapterBody( $text3 );
			$this->ProjectDetails( $text4 );
			$this->SupplyLocations( $text5 );
			$this->SupplyDetails( $text6 );
			$this->Dates( $text7 );
			$this->DateDetails( $text8 );


		}

		function get_data ($id) {

			$dog = submitProject::FindOrFail( $id );

			echo "<pre>";
			var_dump( $dog );
			echo "</pre>";
			die;


			$eventID = $_POST['rc_voucher_form'];

			$sql = "SELECT * 
				FROM
				tblProjectEvent WHERE projEventID = '$eventID'";

			$result = mysqli_query( $con, $sql );

			while ( $row = mysqli_fetch_array( $result ) ) {

				$data['projEventID']      = $row["projEventID"];
				$data['projEventOwnerID'] = $row["projEventOwnerID"];
				$data['projEventTitle']   = $row["projEventTitle"];

				$data['pin'] = 'pn' . $row['projEventID'] . 'x' . $row['projEventOwnerID'];

				return $data;

			}


		}


	}

	$pdf     = new PDF( 'L' );
	$title   = ' Spring  up 2017';
	$voucher = $pdf->get_data();


	$text1 = 'THIS IS YOUR GENERAL SUPPLY VOUCHER';

	$text2 = 'REDEMPTION DETAILS';

	$text3 = 'PLEASE PRINT THIS PAGE AND PRESENT IT TO THE STREETS DEPARTMENT STAFF WHEN YOU PICKUP YOUR PROJECT SUPPLIES. YOU MUST PRESENT THIS VOUCHER TO RECEIVE YOUR SUPPLIES - NO EXCEPTIONS.';

	$text4 = '
PROJECT #: ' . $voucher['pin'] . ' 
PROJECT   : ' . $voucher['projEventTitle'];

	$text5 = 'SUPPLY PICKUP LOCATION';

	$text6 = '3033 S. 63rd Street, , PA';

	$text7 = 'DATES & TIMES';

	$text8 = 'Monday, 4/3 - Friday, 4/7: 7am to 6pm
Saturday, 4/8: 7am to 10am';


	$pdf->SetTitle( $title );
	$pdf->PrintChapter( 1, $voucher['projEventTitle'], $text1, $text2, $text3, $text4, $text5, $text6, $text7, $text8 );
	//$pdf->PrintChapter( 2, 'THE PROS AND CONS', '20k_c2.txt' );

	$pdf->Output();
?>



























