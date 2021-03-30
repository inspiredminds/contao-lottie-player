<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Lottie Player extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

namespace InspiredMinds\ContaoLottiePlayer;

use Contao\Template;

class LottiePlayerHelper
{
    public function addScript(string $playerType = 'lottie'): void
    {
        if (!empty($GLOBALS['TL_HEAD'][$playerType.'-player-script'])) {
            return;
        }

        $script = Template::generateScriptTag('bundles/contaolottieplayer/'.$playerType.'-player.js', true, null);
        $script = str_replace('<script', '<script id="'.$playerType.'-player-script"', $script);
        $GLOBALS['TL_HEAD'][$playerType.'-player-script'] = $script;
    }
}
