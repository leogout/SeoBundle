# LeogoutSeoBundle
**WARNING**: This bundle is currently under development, things will change fast. Do not use in production.

This bundle provides a simple and flexible API to manage SEO tags in your application.

Its main goal is to make it simple for you to manage the most common **meta**, **open graph** and **twitter card** tags and to let you configure les common ones with ease.

### Installation
Register the bundle in your AppKernel:
```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Leogout\Bundle\SeoBundle\LeogoutSeoBundle(),
        );
    }
}
```

### Configuration:
```yml
leogout_seo:
    general:
        title: Default title
        description: Default description.
        image: http://images.com/poneys/12/large
    basic:
        title: Basic title
        description: Basic description.
        keywords: default, keywords
        canonical: http://test.com
        robots:
            index: false
            follow: false
    og:
        title: Open graph title
        description: Open graph description.
        image: http://images.com/poneys/12/large
        type: website # article, book, profile
        url: http://test.com/articles
    twitter:
        title: Twitter title
        description: Twitter description.
        image: http://images.com/poneys/12/thumbnail
        card: summary # summary_large_image
        site: '@leogoutt' # optionnal
```

### Contributing
If you want to contribute \(thank you!\) to this bundle, here are some guidelines for you:

* Please respect the [Symfony guidelines](http://symfony.com/doc/current/contributing/code/standards.html)
* Test everything! Please add tests cases to the tests/ directory when:
* You fix a bug that wasn't covered before
* You add a new feature
* You see code that works but isn't covered by any tests \(there is a special place in heaven for you\)

### Todo
* Install travis ci
* Packagist
* First realease
* OpenGraph: http://ogp.me/
* TwitterCard: https://dev.twitter.com/cards/types

### Thanks
Many thanks to the [ARCANEDEV/SEO-Helper](https://github.com/ARCANEDEV/SEO-Helper) which authorized me to take some ideas from their library and to [KnpMenuBundle](https://github.com/KnpLabs/KnpMenuBundle) which inspired me for the Providers APIs.
