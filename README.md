# GitHub-Flavored Markdown Comments

WordPress plugin to let commenters use (Github-flavored) Markdown, and turn it into HTML.

Based on [Michel Fortin's PHP markdown library](https://github.com/michelf/php-markdown/) with added features from [GitHub-flavored Markdown](https://github.com/github/github-flavored-markdown).

* Single linebreaks are treated as new paragraphs
* Code "fencing" with three backticks (```)


### Missing features

Two notable features from GitHub's Markdown implementation are missing:

* To do lists: Doing these well would require some front end interaction, which I decided is outside the scope of this plugin at least for now
* Repository autolinking (e.g. comments, issues, etc): These seemed a little *too* GitHub-specific.
