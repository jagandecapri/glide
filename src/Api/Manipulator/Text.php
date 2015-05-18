<?php

namespace League\Glide\Api\Manipulator;

use Intervention\Image\Image;
use Symfony\Component\HttpFoundation\Request;

class Text implements ManipulatorInterface
{
    /**
     * Perform blur image manipulation.
     * @param  Request $request The request object.
     * @param  Image   $image   The source image.
     * @return Image   The manipulated image.
     */
    public function run(Request $request, Image $image)
    {
        $blur = $this->getBlur($request->get('blur'));

        if ($blur) {
            $image->blur();
        }

        return $image;
    }

    /**
     * Resolve string text.
     * @param  string $string The string text.
     * @return string The resolved string text.
     */
    public function getTextString($string)
    {
        if (is_null($string)) {
            return false;
        }

        return $string;
    }

    /**
     * Resolve text file.
     * @param  string $string The string text.
     * @return string The resolved string text.
     */
    public function getTextFile($string)
    {
        if (is_null($string)) {
            return false;
        }

        if(ctype_digit($string) && !preg_match('/^[1-5]$/', $string)){
            return false;
        }

        if(!ctype_digit($string) && !preg_match('/\.ttf$/', $string)){
            return false;
        }

        return $string;
    }

    /**
     * Resolve string text size.
     * @param  string $string The string text.
     * @return string The resolved string text.
     */
    public function getTextSize($string)
    {
        if (is_null($string)) {
            return false;
        }

        if(!ctype_digit($string)){
            return false;
        }

        return $string;
    }

    /**
     * Resolve string text color.
     * @param  string $string The string text.
     * @return string The resolved string text.
     */
    public function getTextColor($string)
    {
        if (is_null($string)) {
            return false;
        }

        if(!preg_match('/^\#?(?:[a-f0-9]{3}|[a-f0-9]{6})$/i', $string) ){
            return false;
        }

        return $string;
    }
}
