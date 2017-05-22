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

@todo: Make all configurations optionnal




### From the config
_**NOTE**: See the configuration as a default set of tags. Your SEO tags are likely to change over your app depending on your datas._

Configure the bundle in your `config.yml`:
```yml
leogout_seo:
    general: # This will be shared between the basic, open graph and twitter config
        title: Default title
        description: Default description.
        image: http://images.com/poneys/12/large # This one is shared by open graph and twitter only
    basic:
        title: Awesome title # Will override the default title
        keywords: default, keywords
    og:
        type: website
        url: http://test.com/articles
    twitter:
        card: summary
        site: '@leogoutt'
```
Then use it in twig (usually in some `<head></head>` tags):
```twig
<head>
    {{ leogout_seo('basic') }}
    {{ leogout_seo('og') }}
    {{ leogout_seo('twitter') }}
</head>
```

Which will result in:
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



### From a resource:
You can configure your own model classes to let the built-in seo generators do all the work.
Multiple _interfaces_ have been defined to help the generators guess which methods they can call to fill their tags.
This is an exemple for the `leogout_seo.generator.basic` generator:
#####In your resource:
```php
class MyResource implements BasicSeoInterface
{
    protected $name;
    protected $description;
    protected $tags = [];

    // ...Your logic
    
    // These methods from BasicSeoInterface have to return strings or objects with a __toString() method.
    public function getSeoTitle() { return $this->name; }
    public function getSeoDescription(){ return substr($this->description, 0, 150); }
    public function getSeoKeywords() { return implode(',', $this->tags); }
}
```
#####In your controller (or somewhere else):
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
            ->addKeyword('ho');
        
        $this->get('leogout_seo.generator.basic')->fromResource($myResource);
        
        return $this->render('MyController:Default:index.html.twig');
    }
}
```
#####In your views:
```twig
<head>
    {{ leogout_seo('basic') }}
</head>
```

#####The result:
```html
<head>
    <title>Cool resource</title>
    <meta name="description" content="Some description" />
    <meta name="keywords" content="hey,ho" />
</head>
```

There are **three** different interfaces, one for each generator:
* `BasicSeoInterface` for `leogout_seo.generator.basic`
* `OgSeoInterface` for `leogout_seo.generator.og`
* `TwitterSeoInterface` for `leogout_seo.generator.twitter`

These three interfaces extends _simpler interfaces_ which you can also inplement.
As an example, if you only have a meta description on your resource, you can implement `DescriptionSeoInterface` only, to provide a description alone:
#####In your resource:
```php
class MyResource implements DescriptionSeoInterface
{
    protected $description;
    //...
    public function getSeoDescription(){ return substr($this->description, 0, 150); }
}
```

The list of the different interfaces and what they extends:
|                     | TitleSeoInterface | DescriptionSeoInterface | KeywordsSeoInterface | ImageSeoInterface |
|                     | `->getSeoTitle()` | `->getSeoDescription()` | `->getSeoKeywords()` | `->getSeoImage()` |
|---------------------|-------------------|-------------------------|----------------------|-------------------|
| BasicSeoInterface   |         X         |            X            |           X          |                   |
| OgSeoInterface      |         X         |            X            |                      |         X         |
| TwitterSeoInterface |         X         |            X            |                      |         X         |




### From the generator itself
You can get the `leogout_seo.generator.[basic|twitter|og]` as a service to set or override any values:
```php
class DefaultController extends Controller
{
    public function indexAction()
    {
        $this->get('leogout_seo.generator.basic')
            ->setTitle('Title set in controller')
            ->setRobots(true, false);
        
        return $this->render('AppBundle:Default:index.html.twig');
    }
}
```



### Advanced usage
LeogoutSeoBundle provides classes to create your own SEO tags and providers.
First, you have to create a seo generator which extends the AbstractSeoGenerator:
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

Then, register it as a service and add it a `leogout_seo.generator` tag ans a custom tag:
```yaml
services:
    app.seo_generator.my_tags:
        class:     AppBundle\Generator\MyTagsGenerator
        arguments: [ '@leogout_seo.builder' ] # This is required
        tags: { name: leogout_seo.generator, alias: my_tags }
```

That's it, now you can use it like the others:
#####In your controller (or somewhere else):
```php
class MyController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->get('app.seo_generator.my_tags')->setMyTag('cool');
        
        return $this->render('MyController:Default:index.html.twig');
    }
}
```
#####In your view:
```twig
<head>
    {{ leogout_seo('my_tags') }}
</head>
```
#####Result:
```html
<head>
    <meta name="myAwesomeTag" content="cool" />
</head>
```

### Configuration reference
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
