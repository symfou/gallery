<?php
/**
 * Class ProductGalleryListener
 *
 * @category
 * @package Wbi\Api\ProductBundle\Handler
 * @author Boumaiza Majdi <boumaiza.majdi@mail.com>
 */

namespace Wbi\Api\ProductBundle\Handler;

use Symfony\Component\HttpFoundation\Request;
use Wbi\Api\ProductBundle\Entity\ProductGallery;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Gedmo\Uploadable\Event\UploadablePostFileProcessEventArgs;
use Symfony\Component\Filesystem\Filesystem;
use Liip\ImagineBundle\Imagine\Data\DataManager;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesserInterface as SymfonyMimeTypeGuesserInterface;

class ProductGalleryListener
{
    private $imagineFilterManager;
    private $imagineDataManager;
    private $fileSystem;
    private $webDir;

    public function __construct(FilterManager $imagineFilterManager, DataManager $imagineDataManager, Filesystem $fileSystem, $webDir)
    {
        $this->imagineFilterManager = $imagineFilterManager;
        $this->imagineDataManager = $imagineDataManager;
        $this->fileSystem = $fileSystem;
        $this->webDir = $webDir;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof ProductGallery) {
            $entity->setPath("uploads/product/".$entity->getProduct()->getId());
        }
    }



    public function uploadablePostFileProcess(UploadablePostFileProcessEventArgs $args){
        $entity = $args->getEntity();
        if ($entity instanceof ProductGallery) {
            $image = $entity->getUrl();
            $binary = $this->imagineDataManager->find('original', $image);
            $binary = $this->imagineFilterManager->applyFilter($binary, 'original');
            $this->fileSystem->dumpFile($image, $binary->getContent());
        }
    }

}