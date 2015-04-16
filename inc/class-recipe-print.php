<?php

include_once( get_template_directory() .'/libs/tcpdf_min/tcpdf.php' );
include_once( get_template_directory() .'/libs/tcpdf_min/tcpdf_barcodes_2d.php' );

class Recipe_Print {

	protected $TCPDF;

	public function __construct() {
		$this->TCPDF = New TCPDF();
	}


	public function printQRCode( $url = false ) {

		if ( false === $url ) {
			$url = $this->getCurrentPath();
		}

		$barcodeobj = new TCPDF2DBarcode( $url, 'QRCODE, H');
		return( $barcodeobj->getBarcodeSVGcode(6, 6, 'black') );
	}


	public function getCurrentPath() {
		$Path = $_SERVER['REQUEST_URI'];
		$URI  = get_site_url().$Path;

		return $URI;
	}
}