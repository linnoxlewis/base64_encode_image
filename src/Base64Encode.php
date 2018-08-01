<?php

namespace linnoxlewis\base64Image;

use linnoxlewis\base64Image\methods\BaseEncode;
use linnoxlewis\exception\ImageValidateException;

include("validators/ValidatorClass.php");
include ("config/params.php");
include ("exception/ImageValidateException.php");
/**
 * Class Base64Encode
 * @package linnoxlewis\base64Image
 */
class Base64Encode
{
    /**
     * @var BaseEncode
     */
    public $baseEncode;

    public function __construct(BaseEncode $baseEncode)
    {
        $this->baseEncode = $baseEncode;
    }
    /**
     *
     * @param $image
     *
     * @throws ImageValidateException
     * @return null|string
     */
    public function encode($image): string
    {
        try {
            $encodingImage = $this->baseEncode->base64Encode($image);
        } catch (ImageValidateException $e) {
            return $e->getMessage();
        }
        return $encodingImage;
    }
}
