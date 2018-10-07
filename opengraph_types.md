[Source](http://ogp.me/ "Permalink to The Open Graph protocol")

# The Open Graph protocol

The [Open Graph protocol][1] enables any web page to become a rich object in a social graph. For instance, this is used on Facebook to allow any web page to have the same functionality as any other object on Facebook.

While many different technologies and schemas exist and could be combined together, there isn't a single technology which provides enough information to richly represent any web page within the social graph. The Open Graph protocol builds on these existing technologies and gives developers one thing to implement. Developer simplicity is a key goal of the Open Graph protocol which has informed many of [the technical design decisions][2].

* * *

To turn your web pages into graph objects, you need to add basic metadata to your page. We've based the initial version of the protocol on [RDFa][3] which means that you'll place additional `<meta>` tags in the `<head>` of your web page. The four required properties for every page are:

* `og:title` \- The title of your object as it should appear within the graph, e.g., "The Rock".
* `og:type` \- The [type][4] of your object, e.g., "video.movie". Depending on the type you specify, other properties may also be required.
* `og:image` \- An image URL which should represent your object within the graph.
* `og:url` \- The canonical URL of your object that will be used as its permanent ID in the graph, e.g., "http://www.imdb.com/title/tt0117500/".

As an example, the following is the Open Graph protocol markup for [The Rock on IMDB][5]:
    
    
    <html prefix="og: http://ogp.me/ns#">
    <head>
    <title>The Rock (1996)</title>
    <meta property="og:title" content="The Rock" />
    <meta property="og:type" content="video.movie" />
    <meta property="og:url" content="http://www.imdb.com/title/tt0117500/" />
    <meta property="og:image" content="http://ia.media-imdb.com/images/rock.jpg" />
    ...
    </head>
    ...
    </html>
    

### [Optional Metadata][6]

The following properties are optional for any object and are generally recommended:

* `og:audio` \- A URL to an audio file to accompany this object.
* `og:description` \- A one to two sentence description of your object.
* `og:determiner` \- The word that appears before this object's title in a sentence. An [enum][7] of (a, an, the, "", auto). If `auto` is chosen, the consumer of your data should chose between "a" or "an". Default is "" (blank).
* `og:locale` \- The locale these tags are marked up in. Of the format `language_TERRITORY`. Default is `en_US`.
* `og:locale:alternate` \- An [array][8] of other locales this page is available in.
* `og:site_name` \- If your object is part of a larger web site, the name which should be displayed for the overall site. e.g., "IMDb".
* `og:video` \- A URL to a video file that complements this object.

For example (line-break solely for display purposes):
    
    
    <meta property="og:audio" content="http://example.com/bond/theme.mp3" />
    <meta property="og:description" 
      content="Sean Connery found fame and fortune as the
               suave, sophisticated British agent, James Bond." />
    <meta property="og:determiner" content="the" />
    <meta property="og:locale" content="en_GB" />
    <meta property="og:locale:alternate" content="fr_FR" />
    <meta property="og:locale:alternate" content="es_ES" />
    <meta property="og:site_name" content="IMDb" />
    <meta property="og:video" content="http://example.com/bond/trailer.swf" />
    

The RDF schema (in [Turtle][9]) can be found at [ogp.me/ns][10].

* * *

Some properties can have extra metadata attached to them. These are specified in the same way as other metadata with `property` and `content`, but the `property` will have extra `:`.

The `og:image` property has some optional structured properties:

* `og:image:url` \- Identical to `og:image`.
* `og:image:secure_url` \- An alternate url to use if the webpage requires HTTPS.
* `og:image:type` \- A [MIME type][11] for this image.
* `og:image:width` \- The number of pixels wide.
* `og:image:height` \- The number of pixels high.
* `og:image:alt` \- A description of what is in the image (not a caption). If the page specifies an og:image it should specify `og:image:alt`.

A full image example:
    
    
    <meta property="og:image" content="http://example.com/ogp.jpg" />
    <meta property="og:image:secure_url" content="https://secure.example.com/ogp.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="A shiny red apple with a bite taken out" />
    

The `og:video` tag has the identical tags as `og:image`. Here is an example:
    
    
    <meta property="og:video" content="http://example.com/movie.swf" />
    <meta property="og:video:secure_url" content="https://secure.example.com/movie.swf" />
    <meta property="og:video:type" content="application/x-shockwave-flash" />
    <meta property="og:video:width" content="400" />
    <meta property="og:video:height" content="300" />
    

The `og:audio` tag only has the first 3 properties available (since size doesn't make sense for sound):
    
    
    <meta property="og:audio" content="http://example.com/sound.mp3" />
    <meta property="og:audio:secure_url" content="https://secure.example.com/sound.mp3" />
    <meta property="og:audio:type" content="audio/mpeg" />
    

* * *

If a tag can have multiple values, just put multiple versions of the same `<meta>` tag on your page. The first tag (from top to bottom) is given preference during conflicts.
    
    
    <meta property="og:image" content="http://example.com/rock.jpg" />
    <meta property="og:image" content="http://example.com/rock2.jpg" />
    

Put structured properties after you declare their root tag. Whenever another root element is parsed, that structured property is considered to be done and another one is started.

For example:
    
    
    <meta property="og:image" content="http://example.com/rock.jpg" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image" content="http://example.com/rock2.jpg" />
    <meta property="og:image" content="http://example.com/rock3.jpg" />
    <meta property="og:image:height" content="1000" />
    

means there are 3 images on this page, the first image is `300x300`, the middle one has unspecified dimensions, and the last one is `1000`px tall.

* * *

In order for your object to be represented within the graph, you need to specify its type. This is done using the `og:type` property:
    
    
    <meta property="og:type" content="website" />
    

When the community agrees on the schema for a type, it is added to the list of global types. All other objects in the type system are [CURIEs][12] of the form
    
    
    <head prefix="my_namespace: http://example.com/ns#">
    <meta property="og:type" content="my_namespace:my_type" />
    

The global types are grouped into verticals. Each vertical has its own namespace. The `og:type` values for a namespace are always prefixed with the namespace and then a period. This is to reduce confusion with user-defined namespaced types which always have colons in them.

### [Music][13]

`og:type` values:

[`music.song`][14]

* `music:duration` \- [integer][15] >=1 - The song's length in seconds.
* `music:album` \- [music.album][16] [array][8] \- The album this song is from.
* `music:album:disc` \- [integer][15] >=1 - Which disc of the album this song is on.
* `music:album:track` \- [integer][15] >=1 - Which track this song is.
* `music:musician` \- [profile][17] [array][8] \- The musician that made this song.

[`music.album`][16]

* `music:song` \- [music.song][14] \- The song on this album.
* `music:song:disc` \- [integer][15] >=1 - The same as `music:album:disc` but in reverse.
* `music:song:track` \- [integer][15] >=1 - The same as `music:album:track` but in reverse.
* `music:musician` \- [profile][17] \- The musician that made this song.
* `music:release_date` \- [datetime][18] \- The date the album was released.

[`music.playlist`][19]

* `music:song` \- Identical to the ones on [music.album][16]
* `music:song:disc`
* `music:song:track`
* `music:creator` \- [profile][17] \- The creator of this playlist.

[`music.radio_station`][20]

* `music:creator` \- [profile][17] \- The creator of this station.

### [Video][21]

`og:type` values:

[`video.movie`][22]

* `video:actor` \- [profile][17] [array][8] \- Actors in the movie.
* `video:actor:role` \- [string][23] \- The role they played.
* `video:director` \- [profile][17] [array][8] \- Directors of the movie.
* `video:writer` \- [profile][17] [array][8] \- Writers of the movie.
* `video:duration` \- [integer][15] >=1 - The movie's length in seconds.
* `video:release_date` \- [datetime][18] \- The date the movie was released.
* `video:tag` \- [string][23] [array][8] \- Tag words associated with this movie.

[`video.episode`][24]

* `video:actor` \- Identical to [video.movie][22]
* `video:actor:role`
* `video:director`
* `video:writer`
* `video:duration`
* `video:release_date`
* `video:tag`
* `video:series` \- [video.tv_show][25] \- Which series this episode belongs to.

[`video.tv_show`][25]

A multi-episode TV show. The metadata is identical to [video.movie][22].

[`video.other`][26]

A video that doesn't belong in any other category. The metadata is identical to [video.movie][22].

### [No Vertical][27]

These are globally defined objects that just don't fit into a vertical but yet are broadly used and agreed upon.

`og:type` values:

[`article`][28] \- Namespace URI: [`http://ogp.me/ns/article#`][29]
* `article:published_time` \- [datetime][18] \- When the article was first published.
* `article:modified_time` \- [datetime][18] \- When the article was last changed.
* `article:expiration_time` \- [datetime][18] \- When the article is out of date after.
* `article:author` \- [profile][17] [array][8] \- Writers of the article.
* `article:section` \- [string][23] \- A high-level section name. E.g. Technology
* `article:tag` \- [string][23] [array][8] \- Tag words associated with this article.

[`book`][30] \- Namespace URI: [`http://ogp.me/ns/book#`][31]
* `book:author` \- [profile][17] [array][8] \- Who wrote this book.
* `book:isbn` \- [string][23] \- The [ISBN][32]
* `book:release_date` \- [datetime][18] \- The date the book was released.
* `book:tag` \- [string][23] [array][8] \- Tag words associated with this book.

[`profile`][17] \- Namespace URI: [`http://ogp.me/ns/profile#`][33]
* `profile:first_name` \- [string][23] \- A name normally given to an individual by a parent or self-chosen.
* `profile:last_name` \- [string][23] \- A name inherited from a family or marriage and by which the individual is commonly known.
* `profile:username` \- [string][23] \- A short unique string to identify them.
* `profile:gender` \- [enum][7](male, female) - Their gender.

[`website`][34] \- Namespace URI: [`http://ogp.me/ns/website#`][35]

No additional properties other than the basic ones. Any non-marked up webpage should be treated as `og:type` website.

* * *

The following types are used when defining attributes in Open Graph protocol.

| ----- |
| **Type** |  **Description** |  **Literals** |  
| [Boolean][36] |  A Boolean represents a true or false value |  true, false, 1, 0 |  
| [DateTime][18] |  A DateTime represents a temporal value composed of a date (year, month, day) and an optional time component (hours, minutes) |  [ISO 8601][37] |  
| [Enum][7] |  A type consisting of bounded set of constant string values (enumeration members).  | A string value that is a member of the enumeration |  
| [Float][38] |  A 64-bit signed floating point number |  All literals that conform to the following formats:

1.234  
-1.234  
1.2e3  
-1.2e3  
7E-10  

 |  
| [Integer][15] |  A 32-bit signed integer. In many languages integers over 32-bits become floats, so we limit Open Graph protocol for easy multi-language use. |  All literals that conform to the following formats:

1234  
-123  

 |  
| [String][23] |  A sequence of Unicode characters |  All literals composed of Unicode characters with no escape characters |  
| [URL][39] |  A sequence of Unicode characters that identify an Internet resource.  | All valid URLs that utilize the http:// or https:// protocols | 


### Object types mentioned in the facebook developer docs


- [`article`][40] | This object represents an article on a website. It is the preferred type for blog posts and news stories. | 

- [`book`][41] | This object type represents a book or publication. This is an appropriate type for ebooks, as well as traditional paperback or hardback books. Do not use this type to represent magazines | 

- [`books.author`][42] | This object type represents a single author of a book. | 

- [`books.book`][43] | This object type represents a book or publication. This is an appropriate type for ebooks, as well as traditional paperback or hardback books | 

- [`books.genre`][44] | This object type represents the genre of a book or publication. | 

- [`business.business`][45] | This object type represents a place of business that has a location, operating hours and contact information. | 

- [`fitness.course`][46] | This object type represents the user's activity contributing to a particular run, walk, or bike course. | 

- [`game.achievement`][47] |  This object type represents a specific achievement in a game. An app must be in the 'Games' category in App Dashboard to be able to use this object type. Every achievement has a `game:points` value associate with it. This is not related to the points the user has scored in the game, but is a way for the app to indicate the relative importance and scarcity of different achievements: * Each game gets a total of 1,000 points to distribute across its achievements * Each game gets a maximum of 1,000 achievements * Achievements which are scarcer and have higher point values will receive more distribution in Facebook's social channels. For example, achievements which have point values of less than 10 will get almost no distribution. Apps should aim for between 50-100 achievements consisting of a mix of 50 (difficult), 25 (medium), and 10 (easy) point value achievements Read more on how to use achievements in [this guide](/docs/howtos/achievements/). | 

- [`music.album`][48] | This object type represents a music album; in other words, an ordered collection of songs from an artist or a collection of artists. An album can comprise multiple discs. | 

- [`music.playlist`][49] | This object type represents a music playlist, an ordered collection of songs from a collection of artists. | 

- [`music.radio_station`][50] | This object type represents a 'radio' station of a stream of audio. The audio properties should be used to identify the location of the stream itself. | 

- [`music.song`][51] | This object type represents a single song. | 

- [`place`][52] | This object type represents a place - such as a venue, a business, a landmark, or any other location which can be identified by longitude and latitude. | 

- [`product`][53] | This object type represents a product. This includes both virtual and physical products, but it typically represents items that are available in an online store. | 

- [`product.group`][54] | This object type represents a group of product items. | 

- [`product.item`][55] | This object type represents a product item. | 

- [`[profile`][56] | This object type represents a person. While appropriate for celebrities, artists, or musicians, this object type can be used for the profile of any individual. The `fb:profile_id` field associates the object with a Facebook user. | 

- [`[restaurant.menu`][57] | This object type represents a restaurant's menu. A restaurant can have multiple menus, and each menu has multiple sections. | 

- [`[restaurant.menu_item`][58] | This object type represents a single item on a restaurant's menu. Every item belongs within a menu section. | 

- [`[restaurant.menu_section`][59] | This object type represents a section in a restaurant's menu. A section contains multiple menu items. | 

- [`[restaurant.restaurant`][60] | This object type represents a restaurant at a specific location. | 

- [`[video.episode`][61] | This object type represents an episode of a TV show and contains references to the actors and other professionals involved in its production. An episode is defined by us as a full-length episode that is part of a series. This type must reference the series this it is part of. | 

- [`[video.movie`][62] | This object type represents a movie, and contains references to the actors and other professionals involved in its production. A movie is defined by us as a full-length feature or short film. Do not use this type to represent movie trailers, movie clips, user-generated video content, etc. | 

- [`[video.other`][63] | This object type represents a generic video, and contains references to the actors and other professionals involved in its production. For specific types of video content, use the `video.movie` or `video.tv_show` object types. This type is for any other type of video content not represented elsewhere (eg. trailers, music videos, clips, news segments etc.) | 

- [`[video.tv_show`][64] | This object type represents a TV show, and contains references to the actors and other professionals involved in its production. For individual episodes of a series, use the `video.episode` object type. A TV show is defined by us as a series or set of episodes that are produced under the same title (eg. a television or online series) | 

[1]: http://ogp.me/
[2]: http://www.scribd.com/doc/30715288/The-Open-Graph-Protocol-Design-Decisions
[3]: http://en.wikipedia.org/wiki/RDFa
[4]: http://ogp.me#types
[5]: http://www.imdb.com/title/tt0117500/
[6]: http://ogp.me#optional
[7]: http://ogp.me#enum
[8]: http://ogp.me#array
[9]: http://en.wikipedia.org/wiki/Turtle_(syntax)
[10]: http://ogp.me/ns/ogp.me.ttl
[11]: http://en.wikipedia.org/wiki/Internet_media_type
[12]: http://en.wikipedia.org/wiki/CURIE
[13]: http://ogp.me#type_music
[14]: http://ogp.me#type_music.song
[15]: http://ogp.me#integer
[16]: http://ogp.me#type_music.album
[17]: http://ogp.me#type_profile
[18]: http://ogp.me#datetime
[19]: http://ogp.me#type_music.playlist
[20]: http://ogp.me#type_music.radio_station
[21]: http://ogp.me#type_video
[22]: http://ogp.me#type_video.movie
[23]: http://ogp.me#string
[24]: http://ogp.me#type_video.episode
[25]: http://ogp.me#type_video.tv_show
[26]: http://ogp.me#type_video.other
[27]: http://ogp.me#no_vertical
[28]: http://ogp.me#type_article
[29]: http://ogp.me/ns/article
[30]: http://ogp.me#type_book
[31]: http://ogp.me/ns/book
[32]: http://en.wikipedia.org/wiki/International_Standard_Book_Number
[33]: http://ogp.me/ns/profile
[34]: http://ogp.me#type_website
[35]: http://ogp.me/ns/website
[36]: http://ogp.me#bool
[37]: http://en.wikipedia.org/wiki/ISO_8601
[38]: http://ogp.me#float
[39]: http://ogp.me#url
[40]: https://developers.facebook.com/docs/reference/opengraph/object-type/article/
[41]: https://developers.facebook.com/docs/reference/opengraph/object-type/book/
[42]: https://developers.facebook.com/docs/reference/opengraph/object-type/books.author/
[43]: https://developers.facebook.com/docs/reference/opengraph/object-type/books.book/
[44]: https://developers.facebook.com/docs/reference/opengraph/object-type/books.genre/
[45]: https://developers.facebook.com/docs/reference/opengraph/object-type/business.business/
[46]: https://developers.facebook.com/docs/reference/opengraph/object-type/fitness.course/
[47]: https://developers.facebook.com/docs/reference/opengraph/object-type/game.achievement/
[48]: https://developers.facebook.com/docs/reference/opengraph/object-type/music.album/
[49]: https://developers.facebook.com/docs/reference/opengraph/object-type/music.playlist/
[50]: https://developers.facebook.com/docs/reference/opengraph/object-type/music.radio_station/
[51]: https://developers.facebook.com/docs/reference/opengraph/object-type/music.song/
[52]: https://developers.facebook.com/docs/reference/opengraph/object-type/place/
[53]: https://developers.facebook.com/docs/reference/opengraph/object-type/product/
[54]: https://developers.facebook.com/docs/reference/opengraph/object-type/product.group/
[55]: https://developers.facebook.com/docs/reference/opengraph/object-type/product.item/
[56]: https://developers.facebook.com/docs/reference/opengraph/object-type/profile/
[57]: https://developers.facebook.com/docs/reference/opengraph/object-type/restaurant.menu/
[58]: https://developers.facebook.com/docs/reference/opengraph/object-type/restaurant.menu_item/
[59]: https://developers.facebook.com/docs/reference/opengraph/object-type/restaurant.menu_section/
[60]: https://developers.facebook.com/docs/reference/opengraph/object-type/restaurant.restaurant/
[61]: https://developers.facebook.com/docs/reference/opengraph/object-type/video.episode/
[62]: https://developers.facebook.com/docs/reference/opengraph/object-type/video.movie/
[63]: https://developers.facebook.com/docs/reference/opengraph/object-type/video.other/
[64]: https://developers.facebook.com/docs/reference/opengraph/object-type/video.tv_show/