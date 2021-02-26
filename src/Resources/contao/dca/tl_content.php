<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Lottie Player extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use InspiredMinds\ContaoLottiePlayer\Controller\ContentElement\LottiePlayerController;

$GLOBALS['TL_DCA']['tl_content']['palettes'][LottiePlayerController::TYPE] = $GLOBALS['TL_DCA']['tl_content']['palettes']['headline'];

$GLOBALS['TL_DCA']['tl_content']['fields']['lottie_options'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'options' => [
        'autoplay',
        'controls',
        'hover',
        'loop',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['lottie_options_reference'],
    'eval' => ['multiple' => true],
    'sql' => ['type' => 'blob', 'notnull' => false],
];

PaletteManipulator::create()
    ->addLegend('lottie_legend', 'type_legend', PaletteManipulator::POSITION_AFTER)
    ->addField('singleSRC', 'lottie_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('lottie_options', 'lottie_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette(LottiePlayerController::TYPE, 'tl_content')
;
