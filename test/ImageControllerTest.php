<?php 
namespace Anax\Image;

class ImageControllerTest extends \PHPUnit_Framework_TestCase
{
	public function OutputImageTest()
	{
		require('../Image/ImageController.php');
		$path = CACHE_PATH;
		define('IMG_PATH' ,__DIR__ .'imgtest/');
		define('CACHE_PATH' , __DIR__ . 'cache/');
		$link = 'test.jpg';
		$height = 240;
		$width = 300;
		$object = new Anax\Image\ImageController();
		$object->showAction($link,$width,$height);
		$files = scandir($path);
		if(is_array($files))
		{
			if(isset($files[0]))
			{
				$imgInfo = getimagesize($files[0]);
				$this->pass();
			}
			else
			{
				$this->fail();
			}
		}
		
	}
	
	
	
	
	
}