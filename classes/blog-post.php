<?php
    /*
     *Elizabeth Benner
     *5/21/17
     *blog-post.php
     *The BlogPost class represents a post on the blogs website
     */
    
    /**
     * The BlogPost class represents a post on the blogs website
     *
     * The BlogPost class represents a post on the blogs website,
     * it stores title, text, and word count
     * @author Elizabeth Benner
     * @copyright 2017
     *
     */
    class BlogPost
    {
        protected $title;
        protected $text;
        protected $wordCount;
        
        /**
         *Contructor to create the blog post and save the details
         *
         *@param String $title the post title
         *@param String $text the post text
         */
        function __construct($title, $text)
        {
            $this->title = $title;
            $this->text = $text;
            $this->wordCount = str_word_count($text);
        }
        
        //Setters
        
        /**
         *Setter for the title value
         *@param String $title the title of the post
         */
        function setTitle($title)
        {
            $this->title = $title;
        }
        
        /**
         *Setter for the text value, simultaneously changes wordCount
         *@param String $text the post text
         */
        function setText($text)
        {
            $this->text = $text;
            $this->wordCount = str_word_count($text);
        }
        
        //end of setters
        
        //Getters
        /**
         *Getter for the title value
         *@return String the title of the post
         */
        function getTitle()
        {
            return $this->title;
        }
        
        /**
         *Getter for the text value
         *@return String the post text
         */
        function getText()
        {
            return $this->text;
        }
        
       /**
         *Getter for the word count value
         *@return int the total word count for the post
         */
        function getWordCount()
        {
            return $this->wordCount;
        }
        //End of getters
    }