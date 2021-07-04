<?php

/*
 * This file is part of the Kimai CustomJSBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\CustomJSBundle\EventSubscriber;

use App\Event\ThemeEvent;
use KimaiPlugin\CustomJSBundle\Repository\CustomJSRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ThemeEventSubscriber implements EventSubscriberInterface
{

    /**
     * @var CustomJSRepository
     */
    protected $repository;

    /**
     * @param CustomJSRepository $repository
     */
    public function __construct(CustomJSRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ThemeEvent::JAVASCRIPT => ['renderScript', 100],
        ];
    }

    /**
     * @param ThemeEvent $event
     */
    public function renderScript(ThemeEvent $event)
    {
        $js = $this->repository->getCustomJS()->getCustomJS();
        if (empty($js)) {
            return;
        }

        $js = '<script type="text/javascript">' . $js . '</script>';
        $js = str_replace(PHP_EOL, ' ', $js);
        
        $event->addContent($js);
    }
}
