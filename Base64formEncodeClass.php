<?php

namespace linnoxlewis\base64Image;

use linnoxlewis\exception\ImageValidateException;
use linnoxlewis\validators\Validator;
use linnoxlewis\base64Image\BaseEncode;

//include "BaseEncodeClass.php";

Class Base64formEncode extends BaseEncode {

    /**
     * Метод кодирование картинки
     *
     * @throws ImageValidateException
     * @return string
     */
	public function base64Encode(): ?string
	{
		if(isset($_FILES['image']))
		{ 
			$imageParam = $this->parseImage($_FILES['image']);

			$validator = new Validator();
			$validator->setExtension($imageParam['extension']);
			$validator->setImageSize($imageParam['size']);
			
			try {
				if($validator->validate()){
					$base64 = $this->getEncoding($imageParam['type'],$imageParam['fileTmp']);
				    return $base64;
				}
			} catch (ImageValidateException $e){
				 return $e->getMessage();
			}
		} else {
		    throw new ImageValidateException("Ошибка файла");
        }
	}

    /**
     * Парсинг параметров картинки
     *
     * @param array $image исходные данные о картинки
     *
     * @return array
     */
    protected function parseImage($image): array
    {
        return [
            'fileTmp' => $image['tmp_name'],
            'type' => pathinfo($image['tmp_name'], PATHINFO_EXTENSION),
            'extension' => strtolower(end(explode('/',$_FILES['image']['type']))),
            'size' => $image['size'],
        ];
    }
}
