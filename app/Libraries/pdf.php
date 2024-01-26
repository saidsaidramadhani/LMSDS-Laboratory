<?php
/*
# override the default TCPDF config file
if(!defined('K_TCPDF_EXTERNAL_CONFIG')) {	
	define('K_TCPDF_EXTERNAL_CONFIG', TRUE);
}
	*/
# include TCPDF
//require(APPPATH.'config/tcpdf'.EXT);
require(APPPATH.'config/tcpdf.php');
require_once($tcpdf['base_directory'].'/tcpdf.php');



/************************************************************
 * TCPDF - CodeIgniter Integration
 * Library file
 * ----------------------------------------------------------
 * @author Jonathon Hill http://jonathonhill.net
 * @version 1.0 
 * @package tcpdf_ci
 ***********************************************************/
class Pdf extends TCPDF {
	
	
	/**
	 * TCPDF system constants that map to settings in our config file
	 *
	 * @var array
	 * @access private
	 */
	private $cfg_constant_map = array(
		'K_PATH_MAIN'	=>'base_directory',
		'K_PATH_URL'	=>'base_url',
		'K_PATH_FONTS'	=>'fonts_directory',
		'K_PATH_CACHE'	=>'cache_directory',
		'K_PATH_IMAGES'	=>'image_directory',
		'K_BLANK_IMAGE' =>'blank_image',
		'K_SMALL_RATIO'	=>'small_font_ratio',
	);
	
	
	/**
	 * Settings from our APPPATH/config/tcpdf.php file
	 *
	 * @var array
	 * @access private
	 */
	private $_config = array();
	
	
	/**
	 * Initialize and configure TCPDF with the settings in our config file
	 *
	 */
	function __construct() {
		
		# load the config file
		require(APPPATH.'config/tcpdf.php');
		$this->_config = $tcpdf;
		unset($tcpdf);
		
		
		
		# set the TCPDF system constants
		foreach($this->cfg_constant_map as $const => $cfgkey) {
			if(!defined($const)) {
				define($const, $this->_config[$cfgkey]);
				#echo sprintf("Defining: %s = %s\n<br />", $const, $this->_config[$cfgkey]);
			}
		}
		
		# initialize TCPDF		
		parent::__construct(
			$this->_config['page_orientation'], 
			$this->_config['page_unit'], 
			$this->_config['page_format'], 
			$this->_config['unicode'], 
			$this->_config['encoding'], 
			$this->_config['enable_disk_cache']
		);
		
		
		# language settings
		if(is_file($this->_config['language_file'])) {
			include($this->_config['language_file']);
			$this->setLanguageArray($l);
			unset($l);
		}
		
		# margin settings
		$this->SetMargins($this->_config['margin_left'], $this->_config['margin_top'], $this->_config['margin_right']);
		
		# header settings
		$this->print_header = $this->_config['header_on'];
		$this->print_header = FALSE; 
		$this->setHeaderFont(array($this->_config['header_font'],'', $this->_config['header_font_size']));
		$this->setHeaderMargin($this->_config['header_margin']);
		$this->SetHeaderData(
			$this->_config['header_logo'], 
			$this->_config['header_logo_width'], 
			$this->_config['header_title'], 
			$this->_config['header_string']
		);
		
		# footer settings
		$this->print_footer = $this->_config['footer_on'];
		$this->setFooterFont(array($this->_config['footer_font'],'', $this->_config['footer_font_size']));
		$this->setFooterMargin($this->_config['footer_margin']);
		
		# page break
		$this->SetAutoPageBreak($this->_config['page_break_auto'], $this->_config['footer_margin']);
		
		# cell settings
		$this->cMargin = $this->_config['cell_padding'];
		$this->setCellHeightRatio($this->_config['cell_height_ratio']);
		
		# document properties
		$this->author = $this->_config['author'];
		$this->creator = $this->_config['creator'];
		
		# font settings
		$this->SetFont($this->_config['page_font'],'', $this->_config['page_font_size']);
		
		# image settings
		$this->imgscale = $this->_config['image_scale'];
		
	}
	
	//Page header
    public function Header() {
        // Logo
			$ormargins = $this->getOriginalMargins();
			$headerfont = $this->getHeaderFont();
			$headerdata = $this->getHeaderData();

		$image_file = K_PATH_IMAGES.'logo.jpg';
        $this->Image($image_file, 19, 5.5, $headerdata['logo_width']+15,'','JPG','','T', true, 100,'', false, false, 0, false, false, false);
		$this->SetTextColor(0, 0, 0);
		// header title
		$cell_height = round(($this->getCellHeightRatio() * $headerfont[2]) / $this->getScaleFactor(), 2);
			if ($this->getRTL()) {
				$header_x = $ormargins['right'] + ($headerdata['logo_width'] * 2.1);
			} else {
				$header_x = $ormargins['left'] + ($headerdata['logo_width'] * 2.1);
			}
		$imgy = $this->GetY()+12;
		$this->SetFont('helvetica','B', $headerfont[2]+2);
		$this->SetX($header_x+25);				
		$stretching = 80;
		$spacing = 0.154;
		$this->setCellPaddings(-3, -3, -3, -3);
		$this->setFontStretching($stretching);
		$this->setFontSpacing($spacing);
		$this->Cell(0, $cell_height-6,'National College of Tourism', 0, 1,'C', 0,'', 0);
		$stretching = 90;
		$spacing = -0.254;		
		$this->setFontStretching($stretching);
		$this->setFontSpacing($spacing);
		$this->SetFont('Freeserif','B', $headerfont[2] - 2);
		$this->SetX($header_x+25);		
		$this->Cell(0, $cell_height-6,'OFFICE OF THE DEPUTY VICE CHANCELLOR (ACADEMIC)', 0, 1,'C', 0,'', 1);
		$this->SetFont('Freeserif','B', $headerfont[2] - 4);
		$this->SetX($header_x+25);		
		$this->Cell(0, $cell_height-6,'P.O. Box 3000, CHUO KIKUU, MOROGORO', 0, 1,'C', 0,'', 1);
		$this->SetFont('Freeserif','B', $headerfont[2] - 4);
		$this->SetX($header_x+25);		
		$this->Cell(0, $cell_height-6,'Tanzania', 0, 1,'C', 0,'', 1);
		$this->SetFont('Freeserif','', $headerfont[2] - 4);
		$this->SetX($header_x+25);		
		$this->Cell(0, $cell_height-6,'Tel. +255-23-2603511/4, Dir. +255-23-2603236; Fax. +255-23-2604652', 0, 1,'C', 0,'', 1);
		$this->SetFont('Freeserif','', $headerfont[2] - 4);
		$this->SetX($header_x+25);		
		$this->Cell(0, $cell_height-6,'E-mail: dvc@suanet.ac.tz or admission@suanet.ac.tz', 0, 1,'C', 0,'', 1);		
		$this->SetFont('dejavusanscondensed','', $headerfont[2] - 2);
		$this->SetX($header_x+25);
		$this->Cell(0, $cell_height-6, $headerdata['title'], 0, 2,'C', 0,'', 0);
		
		$this->SetLineStyle(array('width' => 0.85 / $this->getScaleFactor(),'cap' =>'butt','join' =>'miter','dash' => 0,'color' => array(0, 0, 0)));
		$this->SetY((6.835 / $this->getScaleFactor()) + max($imgy, $this->GetY()));
		if ($this->getRTL()) {
			$this->SetX($ormargins['right']);
		} else {
			$this->SetX($ormargins['left']);
		}
		$this->Cell(0, 0,'','T', 10,'C');
			
    }

    // Page footer
    public function Footer() {
        //Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica','I', 8);
        // Page number
        $this->Cell(0, 10,'Page'.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false,'C', 0,'', 0, false,'T','M');
    }
	
	
	
}