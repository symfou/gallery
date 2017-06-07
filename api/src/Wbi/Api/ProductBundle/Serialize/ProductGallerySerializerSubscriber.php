<?php

namespace Wbi\Api\ProductBundle\Serialize;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
/**
 * Class ProductGallerySerializerSubscriber
 *
 * @category
 * @author Boumaiza Majdi <boumaiza.majdi@mail.com>
 */
class ProductGallerySerializerSubscriber implements EventSubscriberInterface
{
    private $admin_url;
    private $rootDir, $imagine;

    
    public function __construct($admin_url, $rootDir, $imagine)
    {
        $this->admin_url = $admin_url;
        $this->rootDir = $rootDir;
        $this->imagine = $imagine;
    }

    public static function getSubscribedEvents()
    {
        return [
//            ['event' => 'serializer.pre_serialize', 'method' => 'onPreSerialize', 'class' => 'Wbi\Api\ProductBundle\Entity\ProductGallery' ],
            ['event' => 'serializer.post_serialize', 'method' => 'onPostSerialize', 'class' => 'Wbi\Api\ProductBundle\Entity\ProductGallery' ]
        ];
    }


    public function onPreSerialize(ObjectEvent $event)
    {
//        $webDir = $this->rootDir.'/../web';
        $path = $event->getObject()->getUrl();
//        $url = str_replace($webDir, '', $path);
        $event->getObject()->setUrl($this->admin_url.DIRECTORY_SEPARATOR.$path);
        $resolvedPath = $this->imagine->getBrowserPath('/'.$path, 'small');
        $event->getObject()->setFolder($resolvedPath);
//        $event->getVisitor()->addData('relative_url',$path);
    }


    public function onPostSerialize(ObjectEvent $event)
    {
        $path = $event->getObject()->getUrl();
        $event->getVisitor()->addData('absolute_url',$this->admin_url.DIRECTORY_SEPARATOR.$path);
        $resolvedPath = $this->imagine->getBrowserPath('/'.$path, 'small');
        $event->getVisitor()->addData('thumb_small',$resolvedPath);
    }


}