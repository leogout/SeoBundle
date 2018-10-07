<?php

namespace Leogout\Bundle\SeoBundle\Seo\Og;

use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Seo\AbstractSeoGenerator;
use Leogout\Bundle\SeoBundle\Seo\Stdlib\AudioAggregateInterface;
use Leogout\Bundle\SeoBundle\Seo\Stdlib\AudioInterface;
use Leogout\Bundle\SeoBundle\Seo\Stdlib\ImageAggregateInterface;
use Leogout\Bundle\SeoBundle\Seo\Stdlib\ImageInterface;
use Leogout\Bundle\SeoBundle\Seo\Stdlib\LocalizationAwareInterface;
use Leogout\Bundle\SeoBundle\Seo\Stdlib\ResourceInterface;
use Leogout\Bundle\SeoBundle\Seo\Stdlib\VideoAggregateInterface;
use Leogout\Bundle\SeoBundle\Seo\Stdlib\WebsiteInterface;
use Leogout\Bundle\SeoBundle\Seo\TitleSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\DescriptionSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\ImageSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\Stdlib\VideoInterface;

/**
 * Description of OgSeoGenerator.
 *
 * @author: leogout
 */
class OgSeoGenerator extends AbstractSeoGenerator
{
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setType($content)
    {
        return $this->set('og:type', $content);
    }

    /**
     * @return MetaTag
     */
    public function getType()
    {
        return $this->get('og:type');
    }
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setSiteName($content)
    {
        return $this->set('og:site_name', $content);
    }

    /**
     * @return MetaTag
     */
    public function getSiteName()
    {
        return $this->get('og:site_name');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setTitle($content)
    {
        return $this->set('og:title', $content);
    }

    /**
     * @return MetaTag
     */
    public function getTitle()
    {
        return $this->get('og:title');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setImage($content)
    {
        return $this->set('og:image', $content);
    }

    /**
     * @return MetaTag
     */
    public function getImage()
    {
        return $this->get('og:image');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setImageType($content)
    {
        return $this->set('og:image:type', $content);
    }

    /**
     * @return MetaTag
     */
    public function getImageType()
    {
        return $this->get('og:image:type');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setImageAlt($content)
    {
        return $this->set('og:image:alt', $content);
    }

    /**
     * @return MetaTag
     */
    public function getImageAlt()
    {
        return $this->get('og:image:alt');
    }

    /**
     * @param int $content
     *
     * @return $this
     */
    public function setImageWidth($content)
    {
        return $this->set('og:image:width', $content);
    }

    /**
     * @return MetaTag
     */
    public function getImageWidth()
    {
        return $this->get('og:image:width');
    }

    /**
     * @param int $content
     *
     * @return $this
     */
    public function setImageHeight($content)
    {
        return $this->set('og:image:height', $content);
    }

    /**
     * @return MetaTag
     */
    public function getImageHeight()
    {
        return $this->get('og:image:height');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setImageSecureUrl($content)
    {
        return $this->set('og:image:secure_url', $content);
    }

    /**
     * @return MetaTag
     */
    public function getImageSecureUrl()
    {
        return $this->get('og:image:secure_url');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setVideo($content)
    {
        return $this->set('og:video', $content);
    }

    /**
     * @return MetaTag
     */
    public function getVideo()
    {
        return $this->get('og:video');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setVideoType($content)
    {
        return $this->set('og:video:type', $content);
    }

    /**
     * @return MetaTag
     */
    public function getVideoType()
    {
        return $this->get('og:video:type');
    }

    /**
     * @param int $content
     *
     * @return $this
     */
    public function setVideoWidth($content)
    {
        return $this->set('og:video:width', $content);
    }

    /**
     * @return MetaTag
     */
    public function getVideoWidth()
    {
        return $this->get('og:video:width');
    }

    /**
     * @param int $content
     *
     * @return $this
     */
    public function setVideoHeight($content)
    {
        return $this->set('og:video:height', $content);
    }

    /**
     * @return MetaTag
     */
    public function getVideoHeight()
    {
        return $this->get('og:video:height');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setVideoSecureUrl($content)
    {
        return $this->set('og:video:secure_url', $content);
    }

    /**
     * @return MetaTag
     */
    public function getVideoSecureUrl()
    {
        return $this->get('og:video:secure_url');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setAudio($content)
    {
        return $this->set('og:audio', $content);
    }

    /**
     * @return MetaTag
     */
    public function getAudio()
    {
        return $this->get('og:audio');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setAudioType($content)
    {
        return $this->set('og:audio:type', $content);
    }

    /**
     * @return MetaTag
     */
    public function getAudioType()
    {
        return $this->get('og:audio:type');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setAudioSecureUrl($content)
    {
        return $this->set('og:audio:secure_url', $content);
    }

    /**
     * @return MetaTag
     */
    public function getAudioSecureUrl()
    {
        return $this->get('og:audio:secure_url');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDescription($content)
    {
        return $this->set('og:description', $content);
    }

    /**
     * @return MetaTag
     */
    public function getDescription()
    {
        return $this->get('og:description');
    }
    
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setLocale($content)
    {
        return $this->set('og:locale', $content);
    }

    /**
     * @return MetaTag
     */
    public function getLocale()
    {
        return $this->get('og:locale');
    }

    /**
     * @param string[] $locales
     *
     * @return $this
     */
    public function setAlternateLocales($locales)
    {
        return $this->set('og:locale:alternate', $locales);
    }

    /**
     * @return MetaTag
     */
    public function getAlternateLocales()
    {
        return $this->get('og:locale:alternate');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDeterminer($content)
    {
        return $this->set('og:determiner', $content);
    }

    /**
     * @return MetaTag
     */
    public function getDeterminer()
    {
        return $this->get('og:determiner');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setUrl($content)
    {
        return $this->set('og:url', $content);
    }

    /**
     * @return MetaTag
     */
    public function getUrl()
    {
        return $this->get('og:url');
    }

    /**
     * Generate seo tags from given resource.
     *
     * @param TitleSeoInterface|DescriptionSeoInterface|ImageSeoInterface $resource
     *
     * @return $this
     */
    public function fromResource($resource)
    {
        if ($resource instanceof TitleSeoInterface) {
            $this->setTitle($resource->getSeoTitle());
        }
        if ($resource instanceof DescriptionSeoInterface) {
            $this->setDescription($resource->getSeoDescription());
        }
        if ($resource instanceof ImageSeoInterface) {
            $this->setImage($resource->getSeoImage());
        }

        // Website
        if ($resource instanceof WebsiteInterface) {
            $this->setSiteName($resource->getSiteName());
        }

        // Resource
        if ($resource instanceof ResourceInterface) {
            $this->setTitle($resource->getTitle());
            $this->setDescription($resource->getDescription());
        }

        // Video
        $video = $resource;
        if ($video instanceof VideoAggregateInterface) {
            $video = $video->getVideo();
        }
        if ($video instanceof VideoInterface) {
            $this->setVideo($video->getUrl());
            $this->setVideoSecureUrl($video->getSecureUrl());
            $this->setVideoType($video->getMimeType());
            $this->setVideoWidth($video->getWidth());
            $this->setVideoHeight($video->getHeight());
        }

        // Image
        $image = $resource;
        if ($image instanceof ImageAggregateInterface) {
            $image = $image->getImage();
        }
        if ($image instanceof ImageInterface) {
            // new image interface
            $this->setImage($image->getUrl());
            $this->setImageAlt($image->getImageAlt());
            $this->setImageType($image->getMimeType());
            $this->setImageWidth($image->getWidth());
            $this->setImageHeight($image->getHeight());
            $this->setImageSecureUrl($image->getSecureUrl());
        }

        // Audio
        $audio = $resource;
        if ($audio instanceof AudioAggregateInterface) {
            $audio = $audio->getAudio();
        }
        if ($audio instanceof AudioInterface) {
            $this->setAudio($audio->getUrl());
            $this->setAudioType($audio->getMimeType());
            $this->setAudioSecureUrl($audio->getSecureUrl());
        }

        // Locales
        if ($resource instanceof LocalizationAwareInterface) {
            $this->setLocale($resource->getLocale());
            if ($locales = $resource->getAlternateLocales()) {
                $this->setAlternateLocales((is_array($locales)) ? $locales : [$locales]);
            }
        }

        return $this;
    }

    /**
     * @param string $type
     *
     * @return MetaTag
     */
    public function get($type)
    {
        return $this->tagBuilder->getMeta($type);
    }

    /**
     * @param string $type
     * @param string $value
     *
     * @return $this
     */
    public function set($type, $value)
    {
        $this->tagBuilder->addMeta($type)
            ->setType(MetaTag::NAME_TYPE)
            ->setTagName($type)
            ->setContent($value);

        return $this;
    }
}
