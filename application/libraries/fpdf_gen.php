<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/fpdf/fpdf.php';

class Fpdf_gen {
	
		
	public function __construct() {
		
		// require_once APPPATH.'/libraries/fpdf/fpdf.php';
		
		$pdf = new FPDF();
		$pdf->AddPage();
		
		$CI =& get_instance();
		$CI->fpdf = $pdf;
		
		
	}

	
	
}