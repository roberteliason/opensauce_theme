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
		echo( $barcodeobj->getBarcodeSVGcode( 10, 10, '#EEEEEE' ) );
	}


	public function getQRCode( $url = false ) {

		if ( false === $url ) {
			$url = $this->getCurrentPath();
		}

		$barcodeobj = new TCPDF2DBarcode( $url, 'QRCODE, H');
		$barcodeobj->getBarcodeSVG( 10, 10, '#EEEEEE' );
	}


	public function getQRCodePNG( $url = false ) {
		if ( false === $url ) {
			$url = $this->getCurrentPath();
		}

		$barcodeobj = new TCPDF2DBarcode( $url, 'QRCODE, H');
		$barcodeobj->getBarcodePNG( 10, 10, array( 33, 33, 33 ) );
	}


	public function getCurrentPath() {
		$Path = $_SERVER['REQUEST_URI'];
		$URI  = get_site_url().$Path;

		return $URI;
	}
}