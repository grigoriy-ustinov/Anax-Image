<?php 
namespace Anax\Image;

class ImageControllerTest extends \PHPUnit_Framework_TestCase
{
	public function testOutputImage()
	{
		
		define('IMG_PATH' ,__DIR__ .DIRECTORY_SEPARATOR.'imgtest'. DIRECTORY_SEPARATOR);
		define('CACHE_PATH' , __DIR__ .DIRECTORY_SEPARATOR);
		$height = 240;
		$width = 300;
		$flag = false;
		$filename = "test.jpg";
		
		chmod(IMG_PATH,0777);
		chmod(CACHE_PATH,0777);
		
		$image = new \Anax\Image\Image($filename,$width,$height);		
		$image->validate();
		$image->getImageInfo();
		$image->createFilenameForCache();
		$image->openOriginalImage();
		$image->calculateNewImage();
		$image->resizeImage();
	    $image->applyFilters();
	    $image->SaveAs();
		$this->assertTrue(file_exists('-.-test_240_300_q60.jpg'));
		
		$imgInfo = getimagesize(CACHE_PATH.'-.-test_240_300_q60.jpg');
		if(($imgInfo[0] == 300)&&($imgInfo[0] == 240))
		{
			$flag = true;
		}
		
		$this->assertTrue($flag);
	}
	
}