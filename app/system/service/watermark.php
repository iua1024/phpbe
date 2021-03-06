<?php
namespace App\System\Service;

use Phpbe\System\Be;

class Watermark extends \Phpbe\System\Service
{

    public function save($image)
    {
        $libImage = Be::getLib('Image');
        $libImage->open($image);

        if (!$libImage->isImage()) {
            $this->setError('不是合法的图片！');
            return false;
        }

        $width = $libImage->getWidth();
        $height = $libImage->getHeight();

        $configWatermark = Be::getConfig('System.Watermark');

        $x = 0;
        $y = 0;
        switch ($configWatermark->position) {
            case 'north':
                $x = $width / 2 + $configWatermark->offsetX;
                $y = $configWatermark->offsetY;
                break;
            case 'northEast':
                $x = $width + $configWatermark->offsetX;
                $y = $configWatermark->offsetY;
                break;
            case 'east':
                $x = $width + $configWatermark->offsetX;
                $y = $height / 2 + $configWatermark->offsetY;
                break;
            case 'southEast':
                $x = $width + $configWatermark->offsetX;
                $y = $height + $configWatermark->offsetY;
                break;
            case 'south':
                $x = $width / 2 + $configWatermark->offsetX;
                $y = $height + $configWatermark->offsetY;
                break;
            case 'southWest':
                $x = $configWatermark->offsetX;
                $y = $height + $configWatermark->offsetY;
                break;
            case 'west':
                $x = $configWatermark->offsetX;
                $y = $height / 2 + $configWatermark->offsetY;
                break;
            case 'northWest':
                $x = $configWatermark->offsetX;
                $y = $configWatermark->offsetY;
                break;
            case 'center':
                $x = $width / 2 + $configWatermark->offsetX;
                $y = $height / 2 + $configWatermark->offsetY;
                break;
        }

        $x = intval($x);
        $y = intval($y);

        if ($configWatermark->type == 'text') {
            $style = array();
            $style['fontSize'] = $configWatermark->textSize;
            $style['color'] = $configWatermark->textColor;

            // 添加文字水印
            $libImage->text($configWatermark->text, $x, $y, 0, $style);
        } else {
            // 添加图像水印
            $libImage->watermark(Be::getRuntime()->getPathData() . '/System/Watermark/' .  $configWatermark->image, $x, $y);
        }

        $libImage->save($image);

        return true;
    }


}
