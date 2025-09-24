<?php

namespace Framework;

use DateTime;

class Validation{

    /**
     * Validate a string
     * 
     * @param string @value
     * @param int @min
     * @param int @max
     * @return  bool
     */
     public static function string($value,$min=1,$max= INF){
        if(is_string($value)){
            $value = trim($value);
            $lenght = strlen($value);
           
            return $lenght >= $min && $lenght <= $max;
        }
        return false;
     }

     /**
      * Validate email address
      *@param string $value
      *@return Stringable
      */
      public static function email($value){
        $value = trim($value);

        return filter_var($value, FILTER_VALIDATE_EMAIL);
      }


      /**
       * Match a value against another
       * @param string $value1
       * @param string $value2
       * @return bool
       */
      public static function match($value1, $value2){
        $value1 = trim($value1);
        $value2 = trim($value2);

        return $value1 === $value2;
      }
     

      /**
       * Check privacy status
       * 
       * @param string $privacy
       * @return bool
       */
      public static function privacy($privacy){
        $status = false;
        if(!empty($privacy) && $privacy=== 'on'){
          $status = true;    
        }
        return $status;
      }

      /**
       * Validate date
       * 
       * @param string $dob
       * @return bool
       */
      public static function dob($dob){
        
        $isValid = false;
        if($dob){
          $d = DateTime::createFromFormat('Y-m-d',$dob);
          $isValid = $d && $d->format('Y-m-d')===$dob;

          return $isValid;
         
        }
        return $isValid;
    }

    /**
     * Validate the profile picture
     * 
     * 
     * 
     * @return bool
     */
    public static function profilePicture(){
      if($_SERVER['REQUEST_METHOD']==='POST' ){
        if(isset($_FILES['profilepicture']) && $_FILES['profilepicture']['error']===UPLOAD_ERR_OK){
          return true;
        }else{
          return false;
        }
      }
      return false;
    }


}