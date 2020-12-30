<?php

	namespace App\PDF;

	use App\submitProject;
	use App\Contacts;
	use App\adminEvent;
	use Codedge\Fpdf\Fpdf\Fpdf;


	error_reporting( - 1 );
	ini_set( 'display_errors', 'On' );


	class PDF extends Fpdf {
		function Header() {
			//global $title;

			//logo
//			$this->Image( '../public/assets/images/subpage-headers-psc-2017.jpg' );
			$this->Image( '../public/assets/images/21493-6pro-PSC-FormAsset-1030x171_1030x171.jpg' );

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

		function Footer() {
			// Position at 1.5 cm from bottom
			$this->SetY( - 15 );
			// Arial italic 8
			$this->SetFont( 'Arial', 'I', 8 );
			// Text color in gray
			$this->SetTextColor( 128 );
			// Page number
			$this->Cell( 0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C' );
		}

		function ChapterTitle( $num, $label ) {
			// Arial 12
			$this->SetFont( 'Arial', 'B', 16 );
			// Background color
			$this->SetFillColor( 200, 220, 255 );
			// Title
			$this->Ln( 4 );
			$this->Cell( 0, 6, "Project Name: $label", 0, 1, 'L', true );
			// Line break
			$this->Ln( 4 );
			$this->Ln( 4 );
		}

		function SubTitle( $file, $text0 ) {
			// Arial 12
			$this->SetFont( 'Arial', 'B', 20 );
			// Background color
			$this->SetFillColor( 255, 255, 255 );
			// Title
			$this->Cell( 0, 6, "$file", 0, 1, 'C', true );
			//Line Break
			$this->LN( 4 );
			//
			$this->SetFont( 'Arial', 'B', 16 );
			//
			$this->Cell( 0, 16, "$text0", 0, 1, 'C', true );
			//Line break
			$this->Ln( 4 );
		}

		function ChapterBody( $file ) {
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

		function ProjectDetails( $file ) {
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

		function RedemptionDetails( $file ) {

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

		function ProjectLocations( $file ) {
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

		function SupplyLocations( $file ) {
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

		function SupplyDetails( $file ) {
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

		function Dates( $file ) {
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

		function DateDetails( $file ) {
			$this->SetFont( 'Arial', '', 12 );
			$this->MultiCell( 0, 5, $file );
			// Line break
			$this->Ln();
			// Mention in italics
			$this->SetFont( '', 'I' );
			//$this->Cell( 0, 5, '(end of excerpt)' );
		}

		function PrintChapter( $num, $title, $text0, $text1, $text2, $text3, $text4, $text5, $text6, $text7, $text8 ) {

			$this->AddPage();
			$this->SubTitle( $text0, $text1 );
			$this->ChapterTitle( $num, $title );
			$this->RedemptionDetails( $text2 );
			$this->ChapterBody( $text3 );
			$this->ProjectDetails( $text4 );
			$this->SupplyLocations( $text5 );
			$this->SupplyDetails( $text6 );
			$this->Dates( $text7 );
			$this->DateDetails( $text8 );


		}

		function get_data( $project_id ) {

			$project = submitProject::FindOrFail( $project_id );
			$contact = Contacts::where( 'project_id', $project_id )->firstOrFail();
			$event   = adminEvent::where( 'active', '1' )
			                     ->where( 'id', $project->event_id )
			                     ->firstOrFail();


			$data['projEventID']               = $project_id;
			$data['projEventOwnerID']          = $contact->id;
			$data['primary_first_name']        = $contact->primary_contact_fname;
			$data['primary_last_name']         = $contact->primary_contact_lname;
			$data['projEventTitle']            = $project->project_title;
			$data['pin']                       = 'pn' . $project_id . 'x' . $contact->id;
			$data['supplyPickupLocation']      = $event->supplyPickupLocation;
			$data['supplyPickupLocationDates'] = $event->supplyPickupLocationDates;
			$data['redemptionDetails']         = $event->redemptionDetails;

			return $data;


		}


	}

?>
