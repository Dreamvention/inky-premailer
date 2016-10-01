<?php 

/*
 * A class Wrapper to convert inky templates into inlined css html for your emails.
 *
 * (c) Dreamvention, Dmitriy Zhuk <dmitriyzhuk@gmail.com>
 *
 * If you have any questions or ideas, please open an issue on github
 * https://github.com/Dreamvention/inky-premailer/issues
 * Thank you!.
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

	public function render($html, $links = false, $styles = false) {

		// build the html from inky template
		$html = $this->inky->releaseTheKraken($html);
		$css = '';

		if($links){
			// styles can be either an array or a string. 
			if(is_array($links)){
				// add style links provided on render.
				foreach($links as $link){
					if(strpos($link, '//') === false){
						$css .= file_get_contents('./'.$link);
					}else{
						$css .= file_get_contents($link);
					}
				}
			}
		}

		if($styles){
			$css .= $styles;
		}
			
		
		// return converted html
		return $this->inliner->convert(
		    $html,
		    $css
		);

	}
}