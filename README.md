# LeogoutSeoBundle
This bundle provides a simple and flexible API to manage _search engine optimization_ (SEO) tags in your application.
Its main goal is to make it simple for you to manage the most common **meta**, **open graph** and **twitter card** tags
and to let you configure less common ones with ease.

[![Build Status](https://travis-ci.org/leogout/SeoBundle.svg?branch=master)](https://travis-ci.org/leogout/SeoBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/leogout/SeoBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/leogout/SeoBundle/?branch=master)

## Installation
Install the bundle with the command:

`composer require leogout/seo-bundle`

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

## Configuration

These configuration values are the defaults used to render your tags.
See the next section to learn how to override them dynamically.

There are four sections in the config:
* `general`: The _global_ configuration. Its values are shared among the other as defaults.
* `basic`: A set of the most common SEO tags.
* `og`: A set of _open graph_ tags based on http://ogp.me/.
* `twitter`: A set of _twitter card_ tags based on https://dev.twitter.com/cards/types

See "Configuration reference" to get the whole configuration.

**In your `config.yml`:**
```yml
leogout_seo:
    general:
        title: Default title
        description: Default description.
        image: http://images.com/poneys/12/large # This one is shared by open graph and twitter only
    basic:
        title: Awesome title
        keywords: default, keywords
    og:
        type: website
        url: http://test.com/articles
    twitter:
        card: summary
        site: '@leogoutt'
```

**In your view:**
```twig
<head>
    {{ leogout_seo() }}
</head>
```
**NOTE:** _You can provide a generator name to the `leogout_seo()` twig method to render it specifically.
For example, to render the `basic` seo generator, you can use `leogout_seo('basic')`._


**The result:**
```html
<head>
    <title>Awesome title</title>
    <meta name="description" content="Default description." />
    <meta name="keywords" content="default, keywords" />
    <meta name="og:title" content="Default title" />
    <meta name="og:description" content="Default description." />
    <meta name="og:image" content="http://test.com/articles" />
    <meta name="og:type" content="website" />
    <meta name="twitter:title" content="Default title" />
    <meta name="twitter:description" content="Default description." />
    <meta name="twitter:image" content="http://images.com/poneys/12/large" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@leogoutt" />
</head>
```

**NOTE:** _By default, the SEO generators aren't loaded if you don't require them in the config.
However, if you want to use the associated generators without configuring any default values 
(or configuring only the general ones), you can use this notation:_

```yml
leogout_seo:
   general:
       title: Default title
       description: Default description.
       image: http://images.com/poneys/12/large # This one is shared by open graph and twitter only
   basic: ~
   og: ~
   twitter: ~
```


## Setting values dynamically

You can get the `'[basic|twitter|og]` as a service to set or override any values.
Each value of the configuration can be overrided using a setter of the following form:
`$this->get('leogout_seo.provider.generator')->get('` **[basic|twitter|og]** `')->set` **[config field name]** `(` **[value]** `)`

For example, if you want to change `title` and `robots` from `basic`, you can do this:
```php
class DefaultController extends Controller
{
    public function indexAction()
    {
        $this->get('leogout_seo.provider.generator')->get('basic')
            ->setTitle('Title set in controller')
            ->setRobots(true, false); // they can be chained
        
        return $this->render('AppBundle:Default:index.html.twig');
    }
}
```


## Setting values from a resource

You can configure your own model classes to let the seo generators do all the work thanks to the **fromResource()** method.
Multiple interfaces are available to help the method guess which setters to call to fill the tags.

This is an exemple for the `basic` generator:
**In your resource:**
```php
use Leogout\Bundle\SeoBundle\Seo\Basic\BasicSeoInterface;

class MyResource implements BasicSeoInterface
{
    protected $name;
    protected $description;
    protected $tags = [];

    // ...Your logic
    
    // These methods are from BasicSeoInterface and have to
    // return a string (or an object with a __toString() method).
    public function getSeoTitle()
    {
        return $this->name; 
    }
    public function getSeoDescription()
    {
        return $this->description; 
    }
    public function getSeoKeywords()
    {
        return implode(',', $this->tags); 
    }
}
```

**In your controller:**
```php
class MyController extends Controller
{
    public function indexAction(Request $request)
    {
        $myResource = new MyResource();
        $myResource
            ->setName('Cool resource')
            ->setDescription('Some description')
            ->addKeyword('hey')
            ->addKeyword('ho')
            ->addKeyword('let's go!');
        
        $this->get('leogout_seo.provider.generator')->get('basic')->fromResource($myResource);
        
        return $this->render('MyController:Default:index.html.twig');
    }
}
```

**In your view:**
```twig
<head>
    {{ leogout_seo('basic') }}
</head>
```

**The result:**
```html
<head>
    <title>Cool resource</title>
    <meta name="description" content="Some description" />
    <meta name="keywords" content="hey,ho,let's go!" />
</head>
```

There are **three** main interfaces, one for each generator:
* `BasicSeoInterface` for `basic`
* `OgSeoInterface` for `og`
* `TwitterSeoInterface` for `twitter`

These interfaces extends _simpler interfaces_ which you can inplement instead or additionnally.
For example, if you only have a meta description on your resource, you can implement `DescriptionSeoInterface` only to provide a description alone.
This is the list of the different interfaces and what they extends:

|                     | TitleSeoInterface | DescriptionSeoInterface | KeywordsSeoInterface | ImageSeoInterface |
| ------------------- |:-----------------:|:-----------------------:|:--------------------:|:-----------------:|
| BasicSeoInterface   |         X         |            X            |           X          |                   |
| OgSeoInterface      |         X         |            X            |                      |         X         |
| TwitterSeoInterface |         X         |            X            |                      |         X         |


## Advanced usage

If the built-in generators don't suit your needs, LeogoutSeoBundle provides a way to create your own SEO generators.
First, you have to create a class that extends the AbstractSeoGenerator class:
```php
use Leogout\Bundle\SeoBundle\Seo\AbstractSeoGenerator;

class MyTagsGenerator extends AbstractSeoGenerator
{
    public function setMyTag($content)
    {
        $this->tagBuilder->addMeta('myTag')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('myAwesomeTag')
            ->setContent((string) $content);

        return $this;
    }

    public function getMyTag()
    {
        return $this->tagBuilder->getMeta('myTag');
    }
}
```

Then, register it as a service and add it a `leogout_seo.generator` tag and a custom alias.
Don't forget the `@leogout_seo.builder` dependency:
```yaml
services:
    app.seo_generator.my_tags:
        class:     AppBundle\Generator\MyTagsGenerator
        arguments: [ '@leogout_seo.builder' ] # This is required
        tags: { name: leogout_seo.generator, alias: my_tags }
```

That's it, now you can use it alongside the others:

**In your controller:**
```php
class MyController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->get('leogout_seo.provider.generator')->get('my_tags')->setMyTag('cool');
        
        return $this->render('MyController:Default:index.html.twig');
    }
}
```

**In your view:**
```twig
<head>
    {{ leogout_seo('my_tags') }}
</head>
```

**Result:**
```html
<head>
    <meta name="myAwesomeTag" content="cool" />
</head>
```

## Configuration reference
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

## Contributing
If you want to contribute \(thank you!\) to this bundle, here are some guidelines:

* Please respect the [Symfony guidelines](http://symfony.com/doc/current/contributing/code/standards.html)
* Test everything! Please add tests cases to the tests/ directory when:
    * You fix a bug that wasn't covered before
    * You add a new feature
    * You see code that works but isn't covered by any tests \(there is a special place in heaven for you\)

## Todo
* Packagist

## Thanks
Many thanks to the [ARCANEDEV/SEO-Helper](https://github.com/ARCANEDEV/SEO-Helper) who authorized me to take some ideas from their library and to [KnpMenuBundle](https://github.com/KnpLabs/KnpMenuBundle) which inspired me for the Providers APIs.
