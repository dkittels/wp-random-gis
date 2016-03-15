# wp-random-gis
A Wordpress Plugin that will display widget with a random image from Google Image Search based on selected search terms

## Purpose

I mostly started this to refresh my memory on Wordpress plugin development and as such it's not really meant for wider use
at this time.  With a little more work it could turn into something practical, however.

## Installation and Use

In order to use this plugin you'll need a [Google Custom Search Engine](https://cse.google.com/cse/create/new) and a 
[Custom Search API Key](https://console.developers.google.com/apis/library).  For the Google Custom Search you'll want
to add ImageObject as a Schema.org type in advanced options at creation, and after creation edit the search engine to turn
Image Search on.  This is where you'll also get the id for the engine by clicking Search Engine ID.

To get your API key simply go to the Google Developer Console, create a new project, access the Custom Search API, and create
a key.  The API key is free to use for up to 100 requests per day.

Once you have that taken care of, you can install the plugin itself by putting it your wp-content/plugins folder.  Turn it on
in your Wordpress admin panel and then drop it wherever you like in the widgets panel.  You'll then be asked to configure it.

**Title:** The title displayed for the widget.
**Search Terms:** The search query you want to retrieve a random image for.
**Max Offset:** The size of the pool of images the random image will be selected from.  Bigger means more variety,
smaller means a more precise pool.  Max is 100.
**Google API Key:** The API Key you registered on the Google Developer Console
**Custom Search ID:** The ID for the Google Custom Search you created.

That's about it.  The widget should now be firing off on your wordpress.

## TODO

With the API limitation, no styling, and no caching to speak of this is pretty much just proof of concept at this point.
A few things needed to make it more practical:

+ Caching to get around that pesky 100 requests limit.
+ Track API usage to report when the limit is hit.
+ A local save method, as I'm sure hotlinking to 100 random sources isn't going to make you new friends
+ Styling to enforce max/min dimensions.  Right now the plugin searches only for "medium" sized images which can
still be disproportionately wide or tall.

## Special Thanks

to this [article on packtpub](https://www.packtpub.com/books/content/how-write-widget-wordpress-3) for the quick refresher 
on plugin make-up and 
[vijay shekogar's answer on this stackoverflow question](http://stackoverflow.com/questions/34035422/google-image-search-says-api-no-longer-available)
for pointing me in the right direction on how to make access Google Image Search through API calls now that the
original Google Imarge Search API has been deprecated.
