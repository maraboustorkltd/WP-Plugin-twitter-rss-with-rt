=== Plugin Name ===
Contributors: maraboustorkltd
Donate link: 
Tags: Twitter, ReTweets, retweet, RT, Blogger.js, json, include_rts, rss, blogs
Requires at least: 2.0.2
Tested up to: 3.0.1
Stable tag: trunk

Currently the method being adopted by many web masters to display tweets on their web sites does not support retweets (RT).
Recently there was an update to allow the parameter include_rts=true to be inluded within the url used to retrieve the tweets
but unfortunately this is not compatible with Blogger.js as it only effects the .rss and .atom feeds (and not the .json feed).
This plugin resolves this issue and enables you to easily replace the code you might currently be using with a 1 line change 
that will add retweets to your pages.

== Description ==

Allows you to add twitter feeds to your site including all retweets (which are not returned by twitters .json feed). Also enables you to 
add tweets to your blogs and word press pages.

[Demo](http://maraboustork.co.uk "Demo") 

= Credits =
* Some js used from http://twitter.com/javascripts/blogger.js
* Google API's http://ajax.googleapis.com/ajax/services/feed
* Anyone who has blogged about the problems with displaying RT's 

If you have followed the advice in one of the many blogs on the internet that instruct you how to add twitter feeds to your
site then you have probably already added an `<ul id="twitter_update_list"></ul>` element to your pages, along with two
javascript includes:

`<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>`
`<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/[yourUsername].json?callback=twitterCallback2&amp;count=10"></script>`

This approach retrieves your tweets using the twitter .json feed which calls a method called twitterCallback2 in 
blogger.js that then inserts your tweets into the `<UL>` element with the id "twitter_update_list".

The problem here is that the .json feed does not currently return retweets. When you start looking around for a solution
to this you will notice that twitter responded to this problem by introducing an `include_rts=true` parameter which is supposed
to add retweets to their feed. 

Unfortunatly, after some research it seems that the `include_rts` parameter is only supported by the .rss and .atom feeds 
`(http://twitter.com/statuses/user_timeline/[yourUsername].atom/.rss)` and to make matters worse you cannot simply replace 
the url used in the second of the script includes above to use the .atom or .rss urls because the output from these urls 
is not recognised by the code in blogger.js.

This solution uses a service provided by google to convert the .atom feed into a JSON object which is then used with code
borrowed from blogger.js to insert the tweets, including the retweets to your `<ul id="twitter_feed_list"/></ul>` element.

In fact, we have also given you the ability to put multiple feeds on a single page by allowing you to provide the name the element that
will recieve them when calling our code (see FAQ's). Also, by implementing the code in the footer.php file as instructed
anywhere you add the `<ul>` tag your feed will appear. This means that if you have your feeds being inserted into a
`<ul id="myFeeds"></ul>` element on your home page and you then create a blog that also contains this same `<ul>` element then 
the feed will also appear in your blog page.

== Installation ==

You can either install it automatically from the WordPress admin, or do it manually:

1. Upload the whole `TwitterRSSWithRT` directory into your plugins folder(`/wp-content/plugins/`)
1. Activate the plugin through the 'Plugins' menu in WordPress

Once installed take the following steps to set it up:

1. Open /wp-content/themes/[yourTheme]/footer.php in a text editor
1. Locate the bottom of footer.php just before `</body>`
1. Insert the following line:
	`<?php get_tweets_with_rt('[your_twitter_username]', [number_of_tweets], '[control_id]'); ?>` 
1. If you have the following included the following scripts in your code then remove them:

`<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>`
`<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/[yourUsername].json?callback=twitterCallback2"></script>`

1. Ensure you have placed `<ul id="[elementId]"></ul>` where you want your feeds to appear eg `<ul id="twitter_update_list"></ul>`.
   If you have already followed other blogs and included the two script files mentioned above you may already have this `<ul>`
   element in your code.

i.e.

`<html>
	<head></head>
	<body>
		...
		<ul id="maraboustork_tweets"></ul>
		...
		<?php get_tweets_with_rt('maraboustorkltd', 10, 'maraboustork_tweets'); ?>
   </body>
</html>`	

== Frequently Asked Questions ==

= How do I change the appearance of these tweets? =

You can control their appearance in the normal way using css. Below is an example that will give you the
appearance used at http://maraboustork.co.uk.

`#twitter_update_list {
   float: left;
   margin-right: 20px;
   width: 280px;
   font-size: 10px;
}

#twitter_update_list li {
   border-bottom: 1px dotted #E6E6E6;
   list-style-type: none;
   padding: 10px 0px;
}`

If you have renamed your `<ul>` element then ensure that that name is also changed in the above css.

= How can i add more than 1 feed to my page? =

Simply add an additional `<?php get_tweets_with_rt('[your_twitter_username]', [number_of_tweets], '[control_id]'); ?>` 
under the existing one replacing the parameters as necessary.

i.e.

`<html>
	<head></head>
	<body>
		...
		<ul id="maraboustork_tweets"></ul>
		<ul id="some_other_feed"></ul>
		...
		<?php get_tweets_with_rt('maraboustorkltd', 10, 'maraboustork_tweets'); ?>
		<?php get_tweets_with_rt('someothertwitteraccount', 5, 'some_other_feed'); ?>
   </body>
</html>`	

= Why are my tweets are not appearing? =

We have noticed that there is a slight delay between the initial call our code makes to the google api
and recieving he tweets. We are in contact with them about this as it appears that it is a security
function to prevent you from carrying out a denial of service attack against a feed provider using the google
api as a proxy to that attack (although we are waiting for this to be confirmed).

We recommend you check that you have specified your twitter user details correctly by accessing the following
url in your web browser:

`http://twitter.com/statuses/user_timeline/[Your Twitter Username].atom?count=10&include_rts=true`

If your tweets are returned in an xml format then there is no reason why the plugin will not work, and we therefore
recommend that you wait for 10-15 minutes and try refreshing your pages after this period.

== Screenshots ==

1. Twitter feed as seen at http://maraboustork.co.uk	

== Changelog ==

**1.0.0** : Updated readme instructions
**1.0.1** : Minor fixes to native ul id
