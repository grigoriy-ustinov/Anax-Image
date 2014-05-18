<?php
namespace Anax\Image;

class ImageController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
	
	public function showAction($filename,$width,$height)
	{
		if (!isset($filename))
		{
			echo "no file to show";
			die();
		}
		$path = $this->request->getBaseUrl();
		//Default img and cache catalog
		//cache have to be writable 777
		if(!defined('IMG_PATH'))
		{
			define('IMG_PATH', ANAX_INSTALL_PATH . 'webroot/img' . DIRECTORY_SEPARATOR);
		}
		if(!defined('CACHE_PATH'))
		{
			define('CACHE_PATH', ANAX_INSTALL_PATH . '/webroot/cache/');
		}
		
		$image = new \Anax\Image\Image($filename,$width,$height);
		$pathToImage = realpath(IMG_PATH . $filename);
		
		$image->validate();
		$image->getImageInfo();
		$image->createFilenameForCache();
		$toShow = $image->checkImageAndUse();
		
		
		$filler = explode("/",$toShow);
		$endFilename = end($filler);
		$pathImage = $path .'/cache/'. $endFilename;
		if($toShow == null)
		{
			$image->openOriginalImage();
			$image->calculateNewImage();
			$image->resizeImage();
		    $image->applyFilters();
		    $image->SaveAs();
		   	$toShow = $image->outputImage($pathToImage);
			
			$filler = explode("/",$toShow);
			$endFilename = end($filler);
			$pathImage = $path .'/img/'. $endFilename;
		}
		
		$imgLink = "<img src='{$pathImage}' alt=''/>";
		return $imgLink;
	}
	
}