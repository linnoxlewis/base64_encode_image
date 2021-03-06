<?php

namespace linnoxlewis\base64Image\methods;

use linnoxlewis\exception\ImageValidateException;
use linnoxlewis\validators\Validator;

/**
 * Класс кодирования
 *
 * Class Base64formEncode
 *
 * @package linnoxlewis\base64Image\methods
 */
Class Base64pathEncode extends BaseEncode
{
    /**
     * Метод кодирование картинки.
     *
     * @param string|array $imagePath Путь до картинки.
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
            if ($validator->validate()) {
                $base64 = $this->getEncoding($imageParam['type'], $imageParam['fileTmp']);
                return $base64;
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
            'extension' => $pathParts['extension'],
            'size' => filesize($image),
        ];
    }
}
