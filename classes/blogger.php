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
    class Blogger
    {
        protected $imagePath;
        protected $bio;
        protected $username;
        protected $password;
        protected $latestPost;
        protected $email;
        
        /**
         *Contructor to create the blogger profile and save the details
         *
         *@param String image_path the file path to the user's profile image
         *@param String bio the user's bio
         *@param String username the user's login username
         *@param String password tee user's password
         */
        function __construct($imagePath, $bio, $username, $password, $email)
        {
            $this->imagePath = $imagePath;
            $this->bio = $bio;
            $this->username = $username;
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            $this->latestPost = "This user has not created a post yet...";
            $this->email = $email;
        }
        
        //Setters
        
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
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }
        
        /**
         *Setter for the latest post
         *@param String $latestPost the user's latest post
         */
        function setPass($latestPost)
        {
            $this->password = $latestPost;
        }
        
         /**
         *Setter for the email address
         *@param String $email the user's email address
         */
        function setEmail($email)
        {
            $this->email = $email;
        }
        
        
        //end of setters
        
        //Getters
        
       /**
         *Getter for the imagePath value
         *@return String the file path to the user's profile picture
         */
        function getPath()
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
        
        /**
         *Getter for the password value
         *@return String the user's password
         */
        function getPass()
        {
            return $this->password;
        }
        
        /**
         *Getter for the latestPost value
         *@return String the user's latest post
         */
        function getLatestPost()
        {
            return $this->latestPost;
        }
        
        /**
         *Getter for the email address
         *@return String the user's email address
         */
        function getEmail()
        {
            return $this->email;
        }
        //End of getters
    }