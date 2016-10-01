<?php 

/*
 * Convert inky templates into inlined css html for your emails.
 *
 * (c) Dreamvention, Dmitriy Zhuk <dmitriyzhuk@gmail.com>
 * 
 */

namespace Dreamvention\Premailer;

use Hampe\Inky\Inky;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use PHPHtmlParser\Dom;

class Premailer
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

		$dom = new Dom;
		$dom->load($html);
		$links = $dom->find('link');

		// if you have styles separatly, add them to the list. 
		// Remeber that they go after the styles you specified 
		// in the html and may override them.
		foreach($styles as  $style){
			$links[] = file_get_contents($style);
		}

		// collect all the styles into a string.
		foreach($links as $link){
			$href = $link->getAttribute('href'); 
			if($href){
				if(strpos($href, '//') === false){
					$css .= file_get_contents('./'.$href);
				}else{
					$css .= file_get_contents($href);
				}
			}
		}

		// return converted html
		return $this->inliner->convert(
		    $html,
		    $css
		);

	}
}