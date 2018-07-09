<?php

namespace base64EncodeClasses;

use exception\ImageValidateException;
use validators\Validator;
use base64Image\BaseEncode;

Class Base64pathEncode extends BaseEncode
{
    /**
     * Путь к картинки
     *
     * @var string
     */
    public $imagePath;

    public function __construct($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Метод кодирование картинки
     *
     * @throws ImageValidateException
     * @return string
     */
    public function base64Encode(): string
    {
        if (file_exists($this->imagePath)) {

            $imageParam = $this->parseImage($this->imagePath);

            $validator = new Validator();
            $validator->setExtension($imageParam['extension']);
            $validator->setImageSize($imageParam['size']);

            try {
                if ($validator->validate()) {
                   $base64 = $this->getEncoding($imageParam['type'], $imageParam['fileTmp']);
                   return $base64;
                }
            } catch (ImageValidateException $e) {
                return $e->getMessage();
            }
        } else {
            throw new ImageValidateException("Нет такого файла");
        }
    }

    /**
     * Парсинг параметров картинки
     *
     * @param string $image исходные данные о картинки
     *
     * @return array
     */
    protected function parseImage($image): array
    {
        $pathParts = pathinfo($image);
        return [
            'fileTmp' => $image,
            'type' => null,
            'extension' =>  $pathParts['extension'],
            'size' => filesize($image),
        ];
    }
}
