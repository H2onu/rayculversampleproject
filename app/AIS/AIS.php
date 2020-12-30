<?php
	/**
	 * Created by PhpStorm.
	 * User: Ray
	 * Date: 4/24/2017
	 * Time: 10:19 AM
	 */

	namespace AIS;


	class AIS {


		public
		function get_ais( $data ) {

			$sid = explode( ":", $data['ProblemSid'] );

			$data['ProblemSid']               = $sid[0];
			$data['ProblemName']              = $this->( $sid[1] );
			$data['MapPage']                  = $sid[2];
			$data['TileNo']                   = $sid[3];
			$data[ $data['prefferredPhone'] ] = $data['phone'];
			unset( $data['prefferredPhone'], $data['phone'] );

			if ( ! empty( $data ) ) {

				$address = rawurlencode( $data['Address'] );

				$url = '' . $address;
				$url .= '';

				$curl = curl_init();
				curl_setopt( $curl, CURLOPT_URL, $url );
				curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );

				$result = curl_exec( $curl );
				curl_close( $curl );

				$obj        = json_decode( $result );
				$properties = $obj->features[0]->properties;
				$geo        = $obj->features[0]->geometry->coordinates;
				$long       = $geo[0];
				$latt       = $geo[1];


				$data['CouncilDistrict'] = $properties->council_district_2016;


				if ( $geo ) {

					$data['X'] = $long;
					$data['Y'] = $latt;

				}

				if ( $obj->status == '404' ) {

					echo "	<div class='alert alert-danger'>
  							<strong>Oops!</strong>
  							<p>It doesn't seem like this is a valid address. Please correct the address and try again.</p>
							</div>";
					die;
				}


				if ( $properties != null ) {

					$this->thank_you( $geo );

				}

			}

		}


	public
		function thank_you( $data ) {

			$data = json_decode( rawurldecode( $data ) );
			$date = new DateTime();
			$date = $date->format( 'Y-m-d H:i:s' );

			echo "	<div class='alert alert-success'>
  					<strong>Success!</strong>
  					</div>
					<h4>Thank you for submitting your request and helping to keep our  running smooth and beautiful.</h4><br><br>";

			echo "

 <table class='table'>
    <tbody>
    <tr>
        <td><h4>Address:</h4></td>
        <td><h4>$data->Address</h4></td>
    </tr>
    <tr>
        <td><h4>Council District:</h4></td>
        <td><h4>$data->CouncilDistrict</h4></td>

    </tr>
    <tr>
        <td><h4>Problem Type:</h4></td>
        <td><h4>$data->ProblemName</h4></td>

    </tr>
    <tr>
        <td><h4>Date:</h4></td>
        <td><h4>$date</h4></td>

    </tr>
    <tr>
        <td><h4>Comments</h4></td>
        <td><h4>$data->comment</h4></td>

    </tr>
    </tbody>
</table>";

			die;


		}


		public
		function ( $string ) {
			$string = str_replace( ' ', '-', $string ); // Replaces all spaces with hyphens.

			return preg_replace( '/[^A-Za-z0-9\-]/', '', $string ); // Removes special chars.
		}

	}



