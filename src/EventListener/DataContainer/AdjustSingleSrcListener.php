<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Lottie Player extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

namespace InspiredMinds\ContaoLottiePlayer\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use InspiredMinds\ContaoLottiePlayer\Controller\ContentElement\LottiePlayerController;

/**
 * @Callback(table="tl_content", target="fields.singleSRC.load")
 */
class AdjustSingleSrcListener
{
    public function __invoke($value, DataContainer $dc)
    {
        if (!$dc->activeRecord || LottiePlayerController::TYPE !== $dc->activeRecord->type) {
            return $value;
        }

        $GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['extensions'] = 'json,tgs';

        return $value;
    }
}
