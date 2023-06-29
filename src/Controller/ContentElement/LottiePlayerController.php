<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Lottie Player extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

namespace InspiredMinds\ContaoLottiePlayer\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\ServiceAnnotation\ContentElement;
use Contao\FilesModel;
use Contao\StringUtil;
use Contao\Template;
use InspiredMinds\ContaoLottiePlayer\LottiePlayerHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\PathUtil\Path;

/**
 * @ContentElement(LottiePlayerController::TYPE, category="media", template="ce_lottie_player")
 */
class LottiePlayerController extends AbstractContentElementController
{
    public const TYPE = 'lottie_player';

    private $helper;
    private $projectDir;

    public function __construct(LottiePlayerHelper $helper, string $projectDir)
    {
        $this->helper = $helper;
        $this->projectDir = $projectDir;
    }

    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        if (empty($model->singleSRC)) {
            return new Response();
        }

        $file = FilesModel::findByUuid($model->singleSRC);

        if (null === $file || !\in_array($file->extension, ['json', 'tgs'], true)) {
            return new Response();
        }

        $filepath = Path::join($this->projectDir, $file->path);

        if (!is_file($filepath)) {
            return new Response();
        }

        $playerType = 'json' === $file->extension ? 'lottie' : 'tgs';
        $template->playerType = $playerType;
        $template->singleSRC = '/'.$file->path;
        $template->lottie_options = StringUtil::deserialize($model->lottie_options, true);

        $this->helper->addScript($playerType);

        return $template->getResponse();
    }
}
