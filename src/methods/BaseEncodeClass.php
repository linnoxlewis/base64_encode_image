<?php

namespace linnoxlewis\base64Image\methods;

/**
 * Базовый класс
 *
 * Class BaseEncode
 * @package linnoxlewis\base64Image\methods
 */
Abstract Class BaseEncode
{
    /**
     * Метод кодирование картинки
     *
     * @throws \Exception
     * @return string
     */
	public abstract function base64Encode($imagePath): ?string;

    /**
     * Парсинг параметров картинки
     *
     * @param array|string $image исходные данные о картинки
     *
     * @return array
     */
	protected abstract function parseImage($image): array;

	/**
     * Получение строки base64
     *
     * @param string|null $type    временный путь картинки
     * @param string      $fileTmp путь к картинки
     *
     * @return string
     */
	protected function getEncoding($type,$fileTmp) : string
	{
		$data = file_get_contents($fileTmp);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
      		return $base64;
	}
}
