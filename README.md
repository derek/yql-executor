About
---------------

YQL is awesome, but sometimes you don't need to use all the SQL-like features of it and you just want make an API service with JavaScript. **Executor to the rescue**.  Think of it like the NoSQL version of YQL.

Executor is a web application that simply generates an [open datatable](http://www.datatables.org/) for you in effort to simplify and expedite the development process.  While Executor does nothing magic, I believe it lowers the learning curve and removes the intricacies of understanding YQL from the equation.  As long as you know JavaScript, you can now use YQL to create dynamic API services via open datatables.

The neat things with datatables is that once you have one complete, you now have an API service that you can pass dynamic data to via the querystring.  Think the [REST URL](http://s89997654.onlinehome.us/screencaps/skitched-20110924-235709.jpg) YQL uses is too long and ugly? Use YQL's [Console](https://developer.yahoo.com/yql/console/) to create a query alias.  So for example, here is an API service that searches YouTube, Justin.TV, Flickr, and Netflix for the specified term in the querystring, [http://query.yahooapis.com/v1/public/yql/derek/mediasearch?query=kittens](http://query.yahooapis.com/v1/public/yql/derek/mediasearch?query=kittens).  The best part is, you don't thave to worry about hosting it.  Let Yahoo worry about that.

Specifics
--------
Within YQL, there's a little-known feature, the `<execute>` sub-element.  Inside of `<execute>`, you can put whatever JavaScript you want to execute inside of YQL's [Rhino] engine.  Yes, you heard me right, any JavaScript you want to pass in.  It's pretty rad.

Inside of `<execute>`, you start with 2 global objects

  - [y] - A library of utility methods
  - [response] - contains the results of the YQL response

Note, there's also a 3rd global ([request]), but that won't be very useful for Executor. So ignore it for now.

Let's start with the important one first, `response`.  There's really not much to it aside from `response.object` which is the property you assign your output to.  This will be the data received by the client making the YQL request. This is just about the most basic example of an `<execute>` sub-element:

> `response.object = 
<items>
    <item>foo</item>
    <item>bar</item>
</items>;`

Now, if you really want to take advantage of `<execute>` and earn some gold stars, you'll want to investigate the `y` object a little more closely.  This object contains really useful things like:
  
  - `y.log(string)` - Log messages to `<diagnostics>`
  - `y.rest(url)` - Execute HTTP requests
  - `y.query(query)` - Execute YQL queries
  - `y.crypto.encodeMd5(string)` - Generate an MD5
  - `y.include(url)` - Includes and evals a JavaScript file
  - `y.parseJson(json_string)` - Returns a JavaScript object when given a well-formed JSON string.  I sometimes have issues with this method, and instead just use `eval()`. \**shrugs**
  - `y.jsonToXml(object)` - Converts a JavaScript/JSON object into E4X/XML
  - `y.xmlToJson(object)` - Converts an E4X/XML object into a JSON object

There are quite a few more methods, but those are the most commonly used ones.

E4X
------

Just a special note: YQL makes use of E4X.  So if the non-quotes XML elements looks a little funky to you, that is why.  The awesome part about [E4X](http://en.wikipedia.org/wiki/ECMAScript_for_XML) is that you get XML natives in JavaScript.  The awful part of E4X is that it means you are using XML inside of JavaScript.  Read more into it if you are curious because a detailed explanation is well beyond the scope of this README.

In short, E4X actually makes XML inside of JavaScript bearable, so don't freak out too much.

Who/What/When/Where?
-------

This was hacked together in about 10 hours by [@derek](http://twitter.com/derek) at a Y! HackU event in Berkeley on Sept 23rd/24th 2011.



   [y]: 
http://developer.yahoo.com/yql/guide/yql-javascript-objects.html#yql-execute-yglobalobject
   [request]: http://developer.yahoo.com/yql/guide/yql-javascript-objects.html#yql-execute-yrestobject
   [response]: http://developer.yahoo.com/yql/guide/yql-javascript-objects.html#yql-execute-responseglobalobject
   [rhino]: http://en.wikipedia.org/wiki/Rhino_%28JavaScript_engine%29

