<?php
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class MYPDF extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    public function Footer() { 
       // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    

}

?>