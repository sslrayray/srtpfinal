<?php
/* @author leiyu
 * @date 2014.12.17
 * @checkbox class, show the JWBimage
 */
 define('WORD_HEIGHT', 12);
 define('WORD_WEIGHT', 8);
 define('WORD_SPACE', 1);
 define('OFFSET_X', 5);
 define('OFFSET_Y', 5);
 
 class checkbox{
 	
 	public function setImg($Image){
 		$this->ImgPath = $Image;
 	}
 	
 	public function getResult() {
 		return $this->Result;
 	}
 	
 	public function getData() {
 		return $this->data;
 	} 	
 	
 	public function getHec(){
		$res = imagecreatefromgif($this->ImgPath);
		$size = getimagesize($this->ImgPath);
		$data = array();
		
		for ($i = 0; $i < $size[1]; ++$i){
			for ($j = 0; $j < $size[0]; ++$j){
				$rgb = imagecolorat($res, $j, $i);
				$rgbarr = imagecolorsforindex($res, $rgb);
				if ($rgbarr['green'] == 0){
					$data[$i][$j] = '1';
				}else{
					$data[$i][$j] = '0';
				}
			}
			
		}
		$this->data = $data;
		$this->ImgSize = $size;
 	}
 	
 	public function Draw() {
 		for ($i = 0; $i < $this->ImgSize[1]; ++$i){
 			for ($j = 0; $j < $this->ImgSize[0]; ++$j){
 				echo $this->data[$i][$j];
 			}
 			echo "<br />";
 		}
 	}
 	
 	public function decode(){
 		$data = array('', '', '', '', '');

 		for ($num = 0; $num < 5; ++$num){
 			for ($y = OFFSET_Y; $y < OFFSET_Y+WORD_HEIGHT; ++$y){
 				for ($x = OFFSET_X+$num*(WORD_SPACE+WORD_WEIGHT); $x < OFFSET_X+$num*(WORD_SPACE+WORD_WEIGHT)+WORD_WEIGHT; ++$x){
 					$data[$num] .= $this->data[$y][$x];
 				}
 			}
 		}	
 		//cmpare
 		$this->Result = '';
 		for ($num = 0; $num < 5; ++$num){
 			$max = 0;
 			$maxkey = 0;
 			foreach ($this->Keys as $key => $code){
 				$percent = 0.0;
 				similar_text($data[$num], $code, $percent);
 				if ($percent > $max){
 					$maxkey = $key;
 					$max = $percent;  
 				}
 			}
 			$this->Result .= $maxkey;
 		}	
 	}
 	
 	public function __construct(){
 		$this->Keys = array(
 			'0' => '001111000111111011100111110000111100001111000011110000111100001111000011111001110111111000111100',
 			'1' => '000011000001110000111100011011000100110000001100000011000000110000001100000011000000110000001100',
 			'2' => '001111000111111011100011110000110000001100000110000011100001110000111000011000001111111111111111',
 			'3' => '001111100111111111000011000000110001111000011110000001110000001111000011111001110111111000111100',
 			'4' => '000001100000111000001110000111100011011000110110011001101100011011111111111111110000011000000110',
 			'5' => '011111100111111001100000111000001111110011111110110001110000001111000011111001110111111000111100',
 			'6' => '001111100111111101100011110000001101110011111110111001111100001111000011011000110111111000111100',
 			'7' => '111111111111111100000110000011000000110000011000000110000001100000111000001100000011000000110000',
 			'8' => '001111000111111011000011110000111100001101111110011111101100001111000011110000110111111000111100',
 			//this website do not have '9'
 			'9' => '000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000'
 		);
 	}
 	protected $ImgPath;
 	protected $ImgSize;
 	protected $data;
 	protected $Keys;
 	protected $Result;
 }
?>