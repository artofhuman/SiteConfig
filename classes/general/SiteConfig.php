<?php
/**
 * SiteConfig Class
 * @author Pupkov Semen
 * @copyright Clever Site Studio
 */

class SiteConfig
{
  
  function __construct()
  {
    $this->xmlFile = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/SiteConfig/config.xml';
  }
  
  function readXmlFile()
  {
    $xml = simplexml_load_file($this->xmlFile, 'SimpleXMLElement', LIBXML_NOCDATA);
    
    return $xml;
  }
  
	function getInput($item) {
		$id = 'siteConfig_'.$item['name'];
		global $APPLICATION;
		switch ($item['type']) {

		case 'textarea':
			$result = '<textarea name="'.$item['name'].'" cols="'.$item['cols'].'" rows="'.$item['rows'].'" id="'.$id.'">'.$item['value'].'</textarea>';
			break;
		
		case 'html':
			/*
			$result = CFileman::ShowHTMLEditControl($item['name'], $item['value'], array(
				'site' => 'ru',
				//'light_mode' => 'Y',
				//'bFromTextarea' => true,
				'bWithoutPHP' => true,
			));
			//*/
			$CLightHTMLEditor = new CLightHTMLEditor();
			$result = $CLightHTMLEditor->Show(array(
				'id' => $item['name'],
				'content' => $item['value'],
				'inputName' => $item['name'],
				'inputId' => $item['name'],
			));
			break;
		
		case 'file':
			$result = '<input type="file" name="'.$item['name'].'" value="" id="'.$id.'" />';
			if (!empty($item['value'])) {
				$result .= '<input type="hidden" name="'.$item['name'].'__old" value="'.$item['value'].'" />';
				$file = CFile::GetByID($item['value'])->GetNext();
				$result .= '<br /><a href="/upload/'.$file['SUBDIR'].'/'.$file['FILE_NAME'].'" target="_blank">'.$file['ORIGINAL_NAME'].' ('.$file['FILE_SIZE'].' b)</a>&nbsp;&nbsp;&nbsp;<label><input style="position:relative;top:0.25em;" type="checkbox" name="'.$item['name'].'__del" value="1" />Удалить</label>';
			}
			break;
			
		case 'checkbox':
			$checked = ($item['value'] == 1) ? ' checked="checked"' : '';
			
		default:
			if (!$item['size']) {
				$item['size'] = 50;
			}
			$result = '<input'.$checked.' type="'.$item['type'].'" size="'.$item['size'].'" name="'.$item['name'].'" value="'.$item['value'].'" id="'.$id.'" />';
			break;
			
		}

		return $result;
	}
  
	function getLabel($item) {
		return '<label for="siteConfig_'.$item['name'].'">'.(string)$item.'</label>';
	}
  
	function save() {
		$xmlData = $this->readXmlFile();
		
		foreach ($xmlData as $section) {
			foreach ($section as $item) {
				$name = (string)$item['name'];
				switch ($item['type']) {
				
				case "file":
					if (intval($_FILES[$name]['error']) == 0 || $_POST[$name.'__del']) {
						$fields = $_FILES[$name];
						$fields['MODULE_ID'] = 'SiteConfig';
						if ($_POST[$name.'__old']) {
							$fields['old_file'] = $_POST[$name.'__old'];
							$fields['del'] = 'Y';
						}
						$id = CFile::SaveFile($fields, 'SiteConfig');
						if (intval($id) > 0) {
							$item['value'] = $id;
						} else {
							$item['value'] = '';
						}
					} else {
						$item['value'] = $_POST[$name.'__old'];
					}
					unset($_POST[$name.'__old'],$_POST[$name.'__del']);
					break;
					
				case "checkbox":
					$item['value'] = $_POST[$name] ?  1 : 0;
					break;
					
				default :
					$item['value'] = $_POST[$name];
					break;
					
				}
			}
		}
		
		$xmlData->asXML($this->xmlFile);
	}
  
  public function getOption($optionName)
  {
    $xmlData = $this->readXmlFile();
    foreach ($xmlData as $section) {
      foreach ($section as $item) {
	if ($item['name'] == $optionName) {
	  return (string)$item['value'];
	  break;
	}
      }
    }
    
  }
}

?>
