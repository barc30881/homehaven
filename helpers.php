
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


