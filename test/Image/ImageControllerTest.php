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
		//$file = $image->getTestInfo();
		
		
		$imgInfo = getimagesize(IMG_PATH.'test.jpg');
		$this->assertEquals($imgInfo[0],300);
		$this->assertEquals($imgInfo[1],240);
	}
	
}