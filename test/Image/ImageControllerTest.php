<?php 
namespace Anax\Image;

class ImageControllerTest extends \PHPUnit_Framework_TestCase
{
	public function testOutputImage()
	{
		
		define('IMG_PATH' ,__DIR__ .'imgtest/');
		define('CACHE_PATH' , __DIR__ );
		$link = 'test.jpg';
		$height = 240;
		$width = 300;
		$flag = false;
		$object = new Anax\Image\ImageController();
		$object->showAction($link,$width,$height);
		$imgInfo = getimagesize(CACHE_PATH.'-.-test_240_300_q60.jpg');
		if(($imgInfo[0] == 300)&&($imgInfo[0] == 240))
		{
			$flag = true;
		}
		
		$this->assertTrue($flag);
	}
	
}