<?php

namespace linnoxlewis\base64Image\methods;

use linnoxlewis\exception\ImageValidateException;
use linnoxlewis\validators\Validator;

Class Base64pathEncode extends BaseEncode
{
    /**
     * Метод кодирование картинки.
     *
     * @param string $imagePath Путь до картинки.
     *
     * @throws ImageValidateException
     * @return string
     */
    public function base64Encode($imagePath): string
    {
        if (file_exists($imagePath)) {

            $imageParam = $this->parseImage($imagePath);

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
