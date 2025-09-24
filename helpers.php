
<?php

use Framework\Session;
/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */

function basePath($path = "")
{
    return __DIR__ . "/" . $path;
}



/**
 * INSPECT A VALUE
 * 
 * @param mixed $value
 * 
 * @return void
 */
function inspect($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}


/**
 * INSPECT A VALUE AND DIE
 * 
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value)
{

    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}



/**
 * Load a view
 * 
 * @param string $name
 * @param array  $data
 * 
 * @return  void
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "view'{$name} does not exit'";
    }
}



/**
 * Load a partial
 * 
 * @param string $name
 * @return void
 */

function loadPartial($name, $data = [])
{
    $partialPath = basePath("App/views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        extract($data);
        require $partialPath;
    } else {
        echo "Partial '${name} does not exits'";
    }
}

/**
 * Redirect to a  view
 * 
 * @param string $url
 * @return void
 */

function redirect($uri)
{
    header("Location: " . url($uri));
    exit;
}


/**
 * Redirect a user back to a previous view if its not certified by Session
 * 
 * @param string $step
 * @param string $redirect
 * 
 * @return void
 */
function requireStep($step,$redirect){
    $user = Session::get('user');
    $property = $user['property'] ?? [];

    switch($step){
        case 1 :
            if(empty($property['category']) || empty($property['propertyType']) || empty($property['condition'])){
                 Session::setFlashMessage('error_message', 'Please select the property category, type, and condition before continuing.');
                redirect($redirect);
                exit;
            }
            break;
        case 2 :
            if(empty($property['country']) || empty($property['city']) || empty($property['district']) || empty($property['zip_code']) || empty($property['street_address'])  ){
                        Session::setFlashMessage('error_message', 'Please complete all location details (country, city, district, ZIP code, and street address).');
                redirect($redirect);
                exit;
            }
            break ;
        case 3 :
            if(!isset($property['photos']) || 
               count($property['photos']) === 0
            )
            {
                  //Set flash message
                Session::setFlashMessage('error_message', "You must upload at least one photo before continuing.");
                redirect($redirect);
                exit;
            }
            break;
        case 4 :
            if(empty($property['ownership']) || 
            empty($property['floors_total']) ||
            empty($property['floor']) || 
            empty($property['total_area']) || 
            empty($property['living_area']) || 
            empty($property['kitchen_area']) || 
            empty($property['bedrooms']) || 
            empty($property['bathrooms']) || 
            empty($property['parking']) || 
            empty($property['amenities'])
             ){
                //Set flash message
                Session::setFlashMessage('error_message', "Please complete all property details Fields.");
                redirect($redirect);
                exit;
            }
            break;
        case 5 :
            if(
               empty($property['price']) ||
               empty($property['negotiated']) ||  
               empty($property['type_Of_Offer'])
               
            ){
                 //Set flash message
                Session::setFlashMessage('error_message', "Please complete all property Price Fields.");
                redirect($redirect);
                exit;
            }
            break ;
        case 6 :
            if(!isset($property['tour']) )
            {
                 //Set flash message
                Session::setFlashMessage('error_message', "Please set the tour Field.");
                redirect($redirect);
                exit;

            }
            break  ;
        case 7:
            if(empty($property['termsandcondition']))
            {
                //Set flash message
                Session::setFlashMessage('error_message', "Please Accept The Terms And Condition.");
                redirect($redirect);
                exit;
            }
            break;
            
    }

}


/**
 * Create a safe, unique, lowercase file name for uploads.
 */
function make_unique_filename($originalFilename) {
    $ext  = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));
    $base = strtolower(pathinfo($originalFilename, PATHINFO_FILENAME));
    $safe = preg_replace('/[^a-z0-9_-]/', '_', $base); // keep only safe chars
    return uniqid($safe . '_') . ($ext ? '.' . $ext : '');
}



/**
 * Generate an app URL relative to BASE_URL
 *
 * @param string $path
 * @return string
 */
function url($path = '') {
    // Change this if your app is in a different subfolder
    $base = '/realEstate';

    // Make sure slashes are handled cleanly
    return rtrim($base, '/') . '/' . ltrim($path, '/');
}
