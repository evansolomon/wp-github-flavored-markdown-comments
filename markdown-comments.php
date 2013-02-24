<?php

/*
Plugin Name: Github-Flavored Markdown Comments
Plugin URI: https://github.com/evansolomon/wp-github-flavored-markdown-comments
Description: Markdown-powered WordPress comments, with a Github Twist
Version: 1.0
Author: Evan Solomon
Author URI: http://evansolomon.me/
*/

// Markdown library
// From `extra` branch of https://github.com/michelf/php-markdown/
if ( ! class_exists( 'MarkdownExtra_Parser' ) )
    include( __DIR__ . '/lib/markdown.php' );

/**
 * Add a few extras from Github's Markdown implementation
 * https://github.com/github/github-flavored-markdown
 */
class ES_GH_Markdown_Parser extends MarkdownExtra_Parser {
    /**
     * Overload to enable single-newline paragraphs
     * https://github.com/github/github-flavored-markdown/blob/gh-pages/index.md#newlines
     */
    function formParagraphs( $text ) {
        // Treat single linebreaks as double linebreaks
        $text = preg_replace('#([^\n])\n([^\n])#', "$1\n\n$2", $text );
        return parent::formParagraphs( $text );
    }

    /**
     * Overload to support ```-fenced code blocks
     * https://github.com/github/github-flavored-markdown/blob/gh-pages/index.md#fenced-code-blocks
     */
    function doCodeBlocks( $text ) {
        $text = preg_replace_callback(
            '#'       .
            '^```'    . // Fenced code block
            '[^\n]*$' . // No language-specific support yet
            '\n'      . // Newline
            '(.+?)'   . // Actual code here
            '\n'      . // Last newline
            '^```$'   . // End of block
            '#ms',      // Multiline mode + dot matches newlines
            array( $this, '_doCodeBlocks_callback' ),
            $text
        );

        return parent::doCodeBlocks( $text );
    }

}

class ES_Markdown_Comments {
    protected $parser;
    private static $instance;

    public static function get_instance() {
        if ( ! self::$instance )
            self::$instance = new self;

        return self::$instance;
    }

    private function __construct() {
        add_action( 'init', array( $this, 'init' ) );

        // Just in case another plugin loads the Markdown lib with the WP stuff turned on
        @define( 'MARKDOWN_WP_POSTS', false );
        @define( 'MARKDOWN_WP_COMMENTS', false );
    }

    public function init() {
        if ( ! $this->parser )
            $this->parser = new ES_GH_Markdown_Parser;

        // Markdown-ify comments
        add_filter( 'pre_comment_content', array( $this, 'markdown' ) , 6  );
        return $this;
    }

    public function markdown( $text ) {
        return $this->parser->transform($text);
    }
}

ES_Markdown_Comments::get_instance();
