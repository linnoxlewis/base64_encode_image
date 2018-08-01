<?php

namespace linnoxlewis\base64Image\methods;

use linnoxlewis\exception\ImageValidateException;
use linnoxlewis\validators\Validator;

/**
 * Class Base64formEncode
 * @package linnoxlewis\base64Image\methods
 */
Class Base64formEncode extends BaseEncode
{

    /**
     * Метод кодирование картинки.
     *
     * @param string $image объект картинки.
     *
     * @throws ImageValidateException
     * @return string
     */
    public function base64Encode($image): ?string
    {
        if (isset($_FILES['image'])) {
            $imageParam = $this->parseImage($_FILES['image']);

            $validator = new Validator();
            $validator->setExtension($imageParam['extension']);
            $validator->setImageSize($imageParam['size']);
            if ($validator->validate()) {
                $base64 = $this->getEncoding($imageParam['type'], $imageParam['fileTmp']);
                return $base64;
            } else {
                throw new ImageValidateException("Ошибка файла");
            }
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
            'extension' => strtolower(end(explode('/', $_FILES['image']['type']))),
            'size' => $image['size'],
        ];
    }
}
