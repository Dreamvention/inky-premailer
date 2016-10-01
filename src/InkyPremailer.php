<?php 

/*
 * Convert inky templates into inlined css html for your emails.
 *
 * (c) Dreamvention, Dmitriy Zhuk <dmitriyzhuk@gmail.com>
 * 
 */

namespace Dreamvention\InkyPremailer;

use Hampe\Inky\Inky;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class InkyPremailer
{
	private $gridColumns = 12;
	private $additionalComponentFactories = [];
	private $inky = '';
	private $inliner = '';

	public function __construct() {
		$this->inky = new Inky($this->gridColumns, $this->additionalComponentFactories);
		$this->inliner = new CssToInlineStyles();

	}

	public function render($html, $styles = array()) {

		// build the html from inky template
		$html = $this->inky->releaseTheKraken($html);
		$css = '';

		// add style links provided on render.
		foreach($styles as $style){
			if(strpos($style, '//') === false){
				$css .= file_get_contents('./'.$style);
			}else{
				$css .= file_get_contents($style);
			}
		}
		
		// return converted html
		return $this->inliner->convert(
		    $html,
		    $css
		);

	}
}