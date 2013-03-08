=== GitHub-Flavored Markdown Comments ===
Contributors: evansolomon
Tags: github, markdown, comments
Requires at least: 3.4
Tested up to: 3.5.1
Stable tag: 1.0

WordPress plugin to let commenters use (GitHub-flavored) Markdown, and turn it into HTML.

== Description ==

Comment forms allow some HTML, this plugin extends that to let users type in [Markdown](http://daringfireball.net/projects/markdown/) and have it automatically converted to HTML.  It also extends Markdown with a couple features made popular [by GitHub](https://github.com/github/github-flavored-markdown).  Conversion from Markdown to HTML is completely automated and doesn't require anything on the commenter's part.

The feature additions from GitHub are:

* Single linebreaks are treated as new paragraphs
* Code "fencing" with three backticks (```)

Two notable features from GitHub's Markdown implementation are missing:

* To do lists: Doing these well would require some front end interaction, which I decided is outside the scope of this plugin at least for now
* Repository autolinking (e.g. comments, issues, etc): These seemed a little *too* GitHub-specific.

GitHub-Flavored Markdown Comments is developed, unsurprisingly, [on GitHub](https://github.com/evansolomon/wp-github-flavored-markdown-comments).


== Installation ==

This plugin doesn't have any options.  Install it, activate it, and it's on.

**Note:** GitHub-flavored Markdown Comments required PHP **5.3** or later.  If your server has PHP 5.2, this plugin will quickly break your site.

== Screenshots ==

1. Example of pre- and post- converted text (live previews are not (yet) includeded in the plugin).

== Changelog ==

= 1.0 =
* Genesis.
