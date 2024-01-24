<?php 

	namespace App\Libraries;

	use CodeIgniter\I18n\Time;

	/**
	 * 
	 */
	class UseFullSnippets
	{
		public function human($dt, $timezone)
		{
			return Time::parse($dt, $timezone)->humanize();
		}

		public function base64_tlv_encode($company, $vat_no, $inv_date, $total, $total_vat)
	    {
	        $result = chr(1) . chr( strlen($company) ) . $company;
	        $result.= chr(2) . chr( strlen($vat_no) ) . $vat_no;
	        $result.= chr(3) . chr( strlen($inv_date) ) . $inv_date;
	        $result.= chr(4) . chr( strlen($total) ) . $total;
	        $result.= chr(5) . chr( strlen($total_vat) ) . $total_vat;
	        return base64_encode($result);
	    }

	    /* TLV Encoding Functions */
		public function getTLV($dataToEncode) {
		    $TLVS = '';
		    for ($i = 0; $i < count($dataToEncode); $i++) {
		        $tag = $dataToEncode[$i][0];
		        $value = $dataToEncode[$i][1];
		        $length = strlen($value);
		        $TLVS .= pack("H*", sprintf("%02X", $tag)).pack("H*", sprintf("%02X", $length)).(string)$value ;
		    }
		    return $TLVS;
		}

		public function number_pad($number,$n) {
	    	return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
		}
		/* TLV Encoding Functions */

		/*public function downloadContant()
		{	
			// $request   = \Config\Services::request();

			// echo "<pre>";
			// print_r ($request);
			// echo "</pre>";
			// exit();

			if(isset($_GET['file'])){
			    $path = "./" . $_GET['file'];
			    $filename = $_GET['file'];
				
				//exploding the file based on . operator
					$file_ext = explode('.',$filename);
					//count taken (if more than one . exist; files like abc.fff.2013.pdf
					$file_ext_count=count($file_ext);
					//minus 1 to make the offset correct
					$cnt=$file_ext_count-1;
					// the variable will have a value pdf as per the sample file name mentioned above.
					$file_extension= $file_ext[$cnt];
			    if(file_exists($path)) {
					if($file_extension == "jpg" OR $file_extension == "jpeg"){
						header('Content-Description: File Transfer');
						header('Content-Type: image/jpeg');
						header('Content-Disposition: attachment; filename='.basename($filename));
						header('Accept-Ranges: bytes');  // For download resume
						header('Content-Transfer-Encoding: binary');
						header('Expires: 0');
						header('Cache-Control: public');
						header('Pragma: public');
						readfile($path);  //this is necessary in order to get it to actually download the file, otherwise it will be 0Kb
					}elseif($file_extension == "pdf"){
						header('Content-Description: File Transfer');
						header('Content-Type: application/octet-stream');
						header('Content-Disposition: attachment; filename="'.basename($filename).'"');
						header('Expires: 0');
						header('Cache-Control: must-revalidate');
						header('Pragma: public');
						header('Content-Length: ' . filesize($filename));
						flush(); // Flush system output buffer
						readfile($path);
					}
			    } else {
			        echo "File not found on server";
			    }
			}else{
			    echo "No file to download";
			}
		    
		}*/

	}