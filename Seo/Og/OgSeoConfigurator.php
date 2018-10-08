<?php

namespace Leogout\Bundle\SeoBundle\Seo\Og;

use Leogout\Bundle\SeoBundle\Exception\InvalidSeoGeneratorException;
use Leogout\Bundle\SeoBundle\Seo\AbstractSeoConfigurator;
use Leogout\Bundle\SeoBundle\Seo\AbstractSeoGenerator;

/**
 * Description of OgSeoConfigurator.
 *
 * @author: leogout
 */
class OgSeoConfigurator extends AbstractSeoConfigurator
{
    /**
     * @param AbstractSeoGenerator $generator
     */
    public function configure(AbstractSeoGenerator $generator)
    {
        if (!($generator instanceof OgSeoGenerator)) {
            throw new InvalidSeoGeneratorException(__CLASS__, OgSeoGenerator::class, get_class($generator));
        }
        
        if (null !== $siteName = $this->getConfig('site_name')) {
            $generator->setSiteName($siteName);
        }
        if (null !== $title = $this->getConfig('title')) {
            $generator->setTitle($title);
        }
        if (null !== $description = $this->getConfig('description')) {
            $generator->setDescription($description);
        }
        if (null !== $image = $this->getConfig('image')) {
            $generator->setImage($image);
        }
        if (null !== $imageType = $this->getConfig('image_type')) {
            $generator->setImageType($imageType);
        }
        if (null !== $imageWidth = $this->getConfig('image_width')) {
            $generator->setImageWidth($imageWidth);
        }
        if (null !== $imageHeight = $this->getConfig('image_height')) {
            $generator->setImageHeight($imageHeight);
        }
        if (null !== $imageSecureUrl = $this->getConfig('image_secure_url')) {
            $generator->setImageSecureUrl($imageSecureUrl);
        }
        if (null !== $audio = $this->getConfig('audio')) {
            $generator->setAudio($audio);
        }
        if (null !== $audioType = $this->getConfig('audio_type')) {
            $generator->setAudioType($audioType);
        }
        if (null !== $audioSecureUrl = $this->getConfig('audio_secure_url')) {
            $generator->setAudioSecureUrl($audioSecureUrl);
        }
        if (null !== $video = $this->getConfig('video')) {
            $generator->setVideo($video);
        }
        if (null !== $videoType = $this->getConfig('video_type')) {
            $generator->setVideoType($videoType);
        }
        if (null !== $videoWidth = $this->getConfig('video_width')) {
            $generator->setVideoWidth($videoWidth);
        }
        if (null !== $videoHeight = $this->getConfig('video_height')) {
            $generator->setVideoHeight($videoHeight);
        }
        if (null !== $videoSecureUrl = $this->getConfig('video_secure_url')) {
            $generator->setVideoSecureUrl($videoSecureUrl);
        }
        if (null !== $type = $this->getConfig('type')) {
            $generator->setType($type);
        }
        if (null !== $url = $this->getConfig('url')) {
            $generator->setUrl($url);
        }
        if (null !== $type = $this->getConfig('determiner')) {
            $generator->setDeterminer($type);
        }
        if (null !== $locale = $this->getConfig('locale')) {
            $generator->setLocale($locale);
        }
        if (null !== $alternateLocales = $this->getConfig('alternate_locales')) {
            $generator->setAlternateLocales($type);
        }
    }
}
