<?php
namespace Abollinger\PHPStarter\Config;

use \Symfony\Component\Yaml\Yaml;

/**
 * Some functions that can be used in the app as Helpers
 * Feel free to create your own functions !
 */
class Helpers 
{
	/**
	 * Render PHP array into a HTML ul list
	 * 
	 * @param array $arr		The array to render as a list
	 * @param array $classes 	A array of classes to apply to the ul/li. Expecting ["ul" => "classForTheUlTag", "li" => "classForTheLiTag"]
	 * @return string 			Default return is an empty string, else it's a HTML ul list of the array
	 */
    public static function printArray(
		$arr,
		$classes = []
	) : string {
		if (!is_array($arr)) return "";
		static $closingTag = array();
		$str = "<ul".($classes["ul"] ?? "").">\r\n";
		$closingTag[] = "</ul>\r\n";
		foreach ($arr as $k => $v) {
			if(is_array($v)){
				$str .= "<li".($classes["li"] ?? "").">$k => <em>array</em>\r\n";
				$str .= self::printArray($v);
			} else {
				$display = is_bool($v) ? ($v ? 'true' : 'false') : htmlentities(is_string($v) || is_float($v) || is_int($v) ? $v : '');
				$str .= "<li".($classes["li"] ?? "").">$k => <strong>".$display."</strong>";
			}
			$closingTag[] = "</li>\r\n";
			$str .= array_pop($closingTag);
		}
		$str .= array_pop($closingTag);
		return $str;
	}

	/**
	 * Yaml files reader returning the content as a array. Base on Symfony/Yaml package
	 * 
	 * @param string $filePath	The path to the YAML file
	 * @return array 			Return a PHP array of the YAML file content
	 */
	public static function getYaml(
		$filePath = ""
	) : array {
		try {
			return Yaml::parseFile($filePath);
		} catch (\Exception $e) {
			return ["code" => $e->getCode(), "message" => $e->getMessage()];
		}
	}

	/**
	 * Scan a directory and return an array of all paths. Escape the .class.php files.
	 * 
	 * @param string $dir 		Directory to scan
	 * @param string $rootDir	Root of the directory. Initially $dir = $rootDir, but in the loop $dir will change
	 * @return array $allData	Array of all detailles path/files. Not nested.
	 */
	public static function getScan(
		$dir, 
		$rootDir, 
		$allData = array()
	) : array {
		$invisibleFileNames = array(".", "..");
		$dirContent = scandir($dir);
		foreach ($dirContent as $key => $content) {
			$path = $dir.'/'.$content;
			if (!in_array($content, $invisibleFileNames) && !strpos($content, ".class.")) {
				if(is_file($path) && is_readable($path)) {
					$allData[] = str_replace($rootDir, "", $path);
				}elseif(is_dir($path) && is_readable($path)) {
					$allData = self::getScan($path, $rootDir, $allData);
				}
			}
		}
		return $allData;
	}
}