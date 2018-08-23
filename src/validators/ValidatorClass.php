<?php

namespace linnoxlewis\validators;

use linnoxlewis\exception\ImageValidateException;

/**
 * Class Validator
 * @package linnoxlewis\validators
 */
Class Validator{
	
   /**
    * Расширения картинки
    *
    * @var string
    */
    public $extension;
    /**
     * Возможные ошибки
     *
     * @var array
     */
    private $errors = [];
    /**
     * Размер картинки
     *
     * @var integer
     */
    private $imageSize = 0;
	
    /**
     * Установка расширения картинки.
     *
     * @param string $value расширение картинки
     */
    public function setExtension(string $value) : void
    {
        $this->extension = $value;
    }
	
    /**
     * Установка размера картинки.
     *
     * @param integer $value размер картинки
     */
    public function setImageSize(int $value) : void
    {
        $this->imageSize= $value;
    }
	
	/**
	* Валидация параметров картинки.
	*
	* @throws ImageValidateException
	* @return bool
	*/
       public function validate():bool
      {
	if(!in_array($this->extension,EXTENSION)){
		$this->addError($this->extension,ERROR_EXTENSION_MESSAGE);
	}
		
	if($this->imageSize > IMAGE_SIZE){
		$this->addError($this->imageSize,ERROR_SIZE_MESSAGE);
	}
		
	$errors = $this->getError();
	if(!empty($errors)){
		$error = "";
		foreach($errors as $key => $value)
		{
			$error.= $key ."-".$value;
		}
		throw new ImageValidateException($error);
	}

	return true;	
      }
	
	/**
	* Формирует отчет об ошибках.
	*
	* @param string $key проверяемый параметр.
	* @param string $message текст ошибки.
	*
	*/
	private function addError(string $key, string $message): void
	{
		$this->errors[$key] = $message;
	}
	
	/**
	* Возвращает массив ошибок.
	*
	* @return array
	*/
	public function getError():array
	{
		return $this->errors;
	}
}
