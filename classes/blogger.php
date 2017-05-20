<?php
    /*
     *Elizabeth Benner
     *5/21/17
     *blogger.php
     *The Blogger class represents a user of the blogs website
     */
    
    /**
     * The Blogger class represents a user of the blogs website
     *
     * The Blogger class represents a user of the blogs website,
     * it stores user's name, username, password, bio, and the path to their profile picture
     * @author Elizabeth Benner
     * @copyright 2017
     *
     */
    class BlogPost
    {
        protected $fname;
        protected $lname;
        protected $imagePath;
        protected $bio;
        protected $username;
        protected $password;
        
        /**
         *Contructor to create the blogger profile and save the details
         *
         *@param String $fname the user's first name
         *@param String $lname the user's last name
         *@param String image_path the file path to the user's profile image
         *@param String bio the user's bio
         *@param String username the user's login username
         *@param String password tee user's password
         */
        function __construct($fname, $lname, $imagePath, $bio, $username, $password)
        {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->imagePath = $imagePath;
            $this->bio = $bio;
            $this->username = $username;
            $this->password = sha1($password);
        }
        
        //Setters
        
        /**
         *Setter for the fname value
         *@param String $fname the user's first name
         */
        function setFName($fname)
        {
            $this->fname = $fname;
        }
        
        /**
         *Setter for the lname value
         *@param String $lname the user's last name
         */
        function setLName($lname)
        {
            $this->lname = $lname;
        }
        
        /**
         *Setter for the imagePath value
         *@param String $imagePath the file path to the user's profile picture
         */
        function setImagePath($imagePath)
        {
            $this->imagePath = $imagePath;
        }
        
        /**
         *Setter for the bio value
         *@param String $bio the user's bio
         */
        function setBio($bio)
        {
            $this->bio = $bio;
        }
        
        /**
         *Setter for the username value
         *@param String $username the user's login username
         */
        function setUsername($username)
        {
            $this->username = $username;
        }
        
        /**
         *Setter for the password value
         *@param String $password the user's password
         */
        function setPassword($password)
        {
            $this->password = sha1($password);
        }
        
        
        
        
        //end of setters
        
        //Getters
        /**
         *Getter for the fname value
         *@return String the user's first name
         */
        function getFName()
        {
            return $this->fname;
        }
        
        //Getters
        /**
         *Getter for the lname value
         *@return String the user's last name
         */
        function getlName()
        {
            return $this->lname;
        }
        
       /**
         *Getter for the imagePath value
         *@return String the file path to the user's profile picture
         */
        function getImagePath()
        {
            return $this->imagePath;
        }
        
        /**
         *Getter for the imagePath value
         *@return String the file path to the user's profile picture
         */
        function getImagePath()
        {
            return $this->imagePath;
        }
        
        /**
         *Getter for the bio value
         *@return String the user's bio
         */
        function getBio()
        {
            return $this->bio;
        }
        
        /**
         *Getter for the username value
         *@return String the user's login username
         */
        function getUsername()
        {
            return $this->username;
        }
        //End of getters
    }