<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Session;
use Framework\Validation;
class UserController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }


    /**
     * load  sign-up/register page
     * 
     * @return void
     */
    public function create()
    {
         // 🚫 Block if user is logged in (regular account session)
        if (Session::get('user')) {
            redirect('/user/account-settings'); // or show "Forbidden"
        }

        // 🚫 Block if admin is already logged in
        if (Session::get('admin')) {
            redirect('/admin/account-settings');
        }
        
        loadView('users/create');
    }


    /**
     * Store user in database
     * 
     * @return void
     */
    public function store()
    {
        inspectAndDie($_POST);
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $privacy = $_POST['privacy'] ?? '';



        $errors = [];

        // Validate email
        if (!Validation::email($email)) {
            $errors['email'] = 'Please Enter A Valid Email';
        }
        // validate password
        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password Must be at least 6 characters';
        }

        if (!Validation::privacy($privacy)) {
            $errors['privacy'] = 'Accept privacy inorder to continue';
        }

        if (!empty($errors)) {
            loadView('users/create', [
                'errors' => $errors,
                'user' => [
                    'email' => $email
                ]
            ]);
            exit;
        }

        // check if email exits
        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email=:email', $params)->fetch();

        if ($user) {
            $errors['email'] = 'That Email Already Exits';
            loadView('users/create', [
                'errors' => $errors,
                'user' => [
                    'email' => $email
                ]
            ]);
            exit;
        }

        // Create user account
        $params = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->query('INSERT INTO users (email, password) VALUES (:email,:password)', $params);

        // Get new userId
        $userId = $this->db->conn->lastInsertId();

        // Set session keys
        Session::set('user', [
            'id' => $userId,
            'email' => $email
        ]);


        redirect('/');
    }


    /**
     * Show the login page
     * 
     * @return void
     */

    public function login()
    {

         // 🚫 Block if user is logged in (regular account session)
        if (Session::get('user')) {
            redirect('/user/account-settings'); // or show "Forbidden"
        }

        // 🚫 Block if admin is already logged in
        if (Session::get('admin')) {
            redirect('/admin/account-settings');
        }


        loadView(
            'users/login'
        );
    }

    /**
     * Authenticate a user with email and password
     * 
     * @return  
     */
    public function authenticate()
    {
       

        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [];

        //Validate email
        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a vaid email';
        }

        //Validate password
        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 5 characters';
        }

        // check for errors
        if (!empty($errors)) {
            loadView(
                'users/login',
                [
                    'errors' => $errors
                ]
            );
            exit;
        }

        //check for email
        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email=:email', $params)->fetch();


        if (!$user) {
            $errors['email'] = 'Incorrect Credentials !!!';
            loadView(
                'users/login',
                [
                    'errors' => $errors,
                    'user' => [
                        'email' => $email
                    ]
                ]

            );
            exit;
        }

        // Check if password match
        if (!password_verify($password, $user->password)) {
            $errors['email'] = 'Incorrect Credentials !!!';
            loadView(
                'users/login',
                [
                    'errors' => $errors,
                    'user' => [
                        'email' => $email
                    ]
                ]
            );
            exit;
        }

        // if it matches , set user Session
        Session::set('user', [
            'id' => $user->id,
            'email' => $user->email,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'phonenumber' => $user->phonenumber,
            'languages' => $user->languages,
            'dob' => $user->dob,
            'address' => $user->address,
            'information' => $user->information,
            'profile_picture' => $user->profile_picture
        ]);
        redirect('/user/account-settings');

    }


    /**
     * load user's account page
     * 
     * @return void
     */
    public function account_settings()
    {
        if (Session::has('user')) {

            loadView(
                'users/accounts/account-settings'

            );

        } else {
            redirect('/auth/register');
            exit;

        }
    }


    /**
     * Store user account info/details
     * 
     * @return void
     */
    public function account_info()
    {


        $firstName = $_POST['firstname'] ?? '';
        $lastName = $_POST["lastname"] ?? '';
        $phoneNumber = $_POST["phonenumber"] ?? '';
        $languages = isset($_POST["languages"]) ? implode(',', $_POST["languages"]) : '';
        $dob = $_POST['dob'] ?? null;
        $address = $_POST["address"] ?? '';
        $information = $_POST["Information"] ?? '';
        $profilePath = null;


        $errors = [];
        //  Validate firstname
        if (!Validation::string($firstName, 7, 30)) {
            $errors['firstname'] = "Firstname must have minimium 7 characters";
        }

        // Validate lastname
        if (!Validation::string($firstName, 7, 30)) {
            $errors['lastname'] = "Lastname must have minimium 7 characters";
        }

        // Validate phonenumber
        if (!Validation::string($phoneNumber, 15, 16)) {
            $errors['phonenumber'] = 'Phone number must be minimium 15 characters';
        }

        // Validate dob
        if (!Validation::dob($dob)) {
            $errors['dob'] = "Date of birth is required.";
        }

        // Validate address
        if (!Validation::string($address, 10, 50)) {
            $errors['address'] = '20 minimium  characters is needed in the address input';
        }

        // Validate information
        if (!Validation::string($information, 50, 750)) {
            $errors['information'] = "information input too small increase to minimium 50 characters and maximium 750 characters";
        }

        // Validate profilepicture
        if (!Validation::profilePicture()) {
            $errors['profilepicture'] = 'Please insert profile picture';
        }


        // if errors was caught
        if (!empty($errors)) {
            loadView(
                'users/accounts/account-settings',
                [
                    'errors' => $errors
                ]
            );
            exit;
        }

        // when no errors is caught
        // load to the database 


        $fileTmpName = $_FILES['profilepicture']['tmp_name'];
        $fileName = make_unique_filename($_FILES['profilepicture']['name']); //Unique filename
        $fileType = $_FILES['profilepicture']['type'];
        $destPath = null;
        $uploadDir = null;

        $allowedTypes = ['image/jpeg', 'image/png'];
        if (in_array($fileType, $allowedTypes)) {
            // setup the upload directory
            $uploadDir = basePath("public/uploads/picture/");

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $destPath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpName, $destPath)) {

                // Store relative path 
                $profilePath = "/uploads/picture/" . $fileName;
            }

            // get userId from Session
            $userId = Session::get('user')['id'];
            if ($userId) {
                $params = [
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'phonenumber' => $phoneNumber,
                    'languages' => $languages,
                    'dob' => $dob,
                    'address' => $address,
                    'information' => $information,
                    'profile_picture' => $profilePath,
                    'id' => $userId
                ];

                $user = $this->db->query("
                        UPDATE users 
                        SET firstname = :firstname,
                            lastname = :lastname,
                            phonenumber = :phonenumber,
                            languages = :languages,
                            dob = :dob,
                            address = :address,
                            information = :information,
                            profile_picture = :profile_picture
                        WHERE id = :id
                        ", $params);

                //Set flash message

                Session::setFlashMessage('success_message', "✅ Profile updated for user ID $userId!");

                // get the current session user
                $currentUser = Session::get('user');

                // Reset (overwrite) with updated info, keeping id & email
                Session::set('user', [
                    'id' => $currentUser['id'],     // keep old id
                    'email' => $currentUser['email'],  // keep old email
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'phonenumber' => $phoneNumber,
                    'languages' => $languages,
                    'dob' => $dob,
                    'address' => $address,
                    'information' => $information,
                    'profile_picture' => $profilePath
                ]);

                redirect('/user/account-settings');
            }


        } else {
            $errors['profilepicture'] = 'Image must be of jpeg or png format';
            loadView(
                'users/accounts/account-settings',
                [
                    'errors' => $errors
                ]
            );
            exit;

        }
    }


    /**
     * Signout a user and clear session
     * 
     * @return void
     */
    public function signout()
    {
        Session::clearAll();

        $params = session_get_cookie_params();

        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        redirect('/');
    }


    /**
     * Add property type
     */
    public function addPropertyType()
    {
        loadView('users/property/addPropertyType');
    }


    /**
     * Save property type to session
     */
    public function savePropertyType()
    {
        // Check if request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = Session::get('user'); // get the current session (with id , email , e.t.c)

            // Step 1 values
            $category = $_POST['category'] ?? null;
            $propertyType = $_POST['propertyType'] ?? null;
            $condition = $_POST['Condition'] ?? null;

            // Merge into property sub-array
            $user['property'] = [
                'category' => $category,
                'propertyType' => $propertyType,
                'condition' => $condition
            ];

            // Save back to session
            Session::set('user', $user);

            redirect('/user/add-property-location');

        }
    }


    /**
     * Load the addPropertyLocation View
     * 
     * @return void
     */
    public function addPropertyLocation()
    {


        // ✅ Make sure Step 1 data exists
        requireStep(1, '/user/add-property-type');

        loadView('users/property/addPropertyLocation');
    }

    /**
     * Save the Location of the property to session
     * 
     * @return void
     */
    public function savePropertyLocation()
    {



        // Check if Request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // get the current session user
            $user = Session::get('user');

            // Step 2 values
            $country = $_POST["country"] ?? null;
            $city = $_POST["city"] ?? null;
            $district = $_POST["district"] ?? null;
            $zip_code = $_POST["zip_code"] ?? null;
            $street_address = $_POST["street_address"] ?? null;

            // merge the 2 values to user property
            $user['property'] = array_merge($user['property'], [
                'country' => $country,
                'city' => $city,
                'district' => $district,
                'zip_code' => $zip_code,
                'street_address' => $street_address
            ]);

            // Reset and save back the user to session
            Session::set('user', $user);
            redirect('/user/add-property-photos');

        }
    }

    /**
     * Load the addPropertyPhotos view
     * 
     * @return void
     */
    public function addPropertyPhotos()
    {

        // ✅ Make sure Step 2 data exists
        requireStep(2, '/user/add-property-location');
        loadView('users/property/addPropertyPhotos');
    }


    /**
     * Save the  Property Photos  to sessions 
     * 
     * @return void
     */
    public function savePropertyPhotos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = Session::get('user');

            $photos = [];

            foreach ($_FILES['property_photos']['name'] as $key => $name) {
                if ($_FILES['property_photos']['error'][$key] === 0) {
                    $photos[] = [
                        'name' => make_unique_filename($name),
                        'tmp_name' => $_FILES['property_photos']['tmp_name'][$key],
                        'type' => $_FILES['property_photos']['type'][$key],
                        'size' => $_FILES['property_photos']['size'][$key]
                    ];
                }
            }

            $uploadDir = basePath("public/uploads/image/properties/");
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $photoPaths = [];

            foreach ($photos as $photo) {
                $destPath = $uploadDir . $photo['name'];
                if (move_uploaded_file($photo['tmp_name'], $destPath)) {
                    $photoPaths[] = "/uploads/image/properties/" . $photo['name'];
                }
            }

            // Save into session

            $user['property'] = array_merge(
                $user['property'],
                [
                    'photos' => $photoPaths
                ]
            );

            Session::set('user', $user);
            redirect('/user/add-property-details');
        }
    }

    /**
     * Load add-property-details view
     * 
     * @return void
     */
    public function addPropertyDetails()
    {
        // ✅ Make sure Step 2 data exists
        requireStep(3, '/user/add-property-photos');
        loadView('users/property/addPropertyDetails');
    }


    /**
     * savePropertyDetails
     * 
     * @return void
     */
    public function savePropertyDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = Session::get('user');

            $ownership = $_POST['ownership'] ?? null;
            $floors_total = $_POST['floors_total'] ?? null;
            $floor = $_POST['floor'] ?? null;
            $total_area = $_POST['total_area'] ?? null;
            $living_area = $_POST['living_area'] ?? null;
            $kitchen_area = $_POST['kitchen_area'] ?? null;
            $bedrooms = $_POST['bedrooms'] ?? null;
            $bathrooms = $_POST['bathrooms'] ?? null;
            $parking = $_POST['parking'] ?? null;
            $amenities = $_POST['amenities'] ?? [];

            // merge into exiting session array
            $user['property'] = array_merge($user['property'], [
                'ownership' => $ownership,
                'floors_total' => $floors_total,
                'floor' => $floor,
                'total_area' => $total_area,
                'living_area' => $living_area,
                'kitchen_area' => $kitchen_area,
                'bedrooms' => $bedrooms,
                'bathrooms' => $bathrooms,
                'parking' => $parking,
                'amenities' => $amenities
            ]);

            // save back into session
            Session::set('user', $user);

            // Next step (Price page)
            redirect('/user/add-property-price');

        }

    }


    /**
     * addPropertyPrice
     * 
     * @return void
     */
    public function addPropertyPrice()
    {


        // ✅ Make sure Step 4 data exists
        requireStep(4, '/user/add-property-details');

        loadView('users/property/addPropertyPrice');
    }


    /**
     * savePropertyPrice
     * 
     * @return void
     */
    public function savePropertyPrice()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = Session::get('user');

            $price = $_POST['price'] ?? null;
            $negotiated = isset($_POST['negotiated']) ? '1' : '0';
            $type_Of_Offer = $_POST['type-Of-Offer'] ?? null;
            $extra_options = $_POST['extra_options'] ?? null;

            // merge into existing session array
            $user['property'] = array_merge($user['property'], [
                'price' => $price,
                'negotiated' => $negotiated,
                'type_Of_Offer' => $type_Of_Offer,
                'extra_options' => $extra_options
            ]);


            // Save back into session
            Session::set('user', $user);

            // Next step (Contact info page)
            redirect('/user/add-property-contact');
        }
    }

    /**
     * load addPropertyContact view
     * 
     * @return void
     */
    public function addPropertyContact()
    {
        // ✅ Make sure Step 5 data exists

        requireStep(5, '/user/add-property-price');
        $user = Session::get('user');
        loadView('users/property/addPropertyContact', [
            'user' => $user
        ]);
    }


    /**
     * savePropertyContact
     * 
     * @return void
     */
    public function savePropertyContact()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tour = isset($_POST['tour']) ? '1' : '0';

            $user = Session::get('user');

            // merge into existing session array
            $user['property'] = array_merge($user['property'], [
                'tour' => $tour
            ]);


            // Save back into session
            Session::set('user', $user);

            // Next step (Accept Terms and Condition page)
            redirect('/user/add-property-accept-terms');
        }
    }

    /**
     * addPropertyTerms
     * 
     * @return void
     */
    public function addPropertyTerms()
    {

        // ✅ Make sure Step 6 data exists
        requireStep(6, '/user/add-property-contact');
        loadView('users/property/addPropertyTerms');
    }

    /**
     * savePropertyTerms
     * 
     * @return void
     */
    public function savePropertyTerms()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $terms = isset($_POST['termsandcondition']) ? '1' : '0';

            $user = Session::get('user');

            // merge into existing session array
            $user['property'] = array_merge($user['property'], [
                'termsandcondition' => $terms
            ]);


            // Save back into session
            Session::set('user', $user);

            // ✅ Make sure Step 7 data exists
            requireStep(7, '/user/add-property-accept-terms');

            $property = $user['property'] ?? [];

            $params = [
                'user_id' => (int) $user['id'],
                'category' => $property['category'] ?? null,
                'property_type' => $property['propertyType'] ?? null,
                'condition' => $property['condition'] ?? null,
                'country' => $property['country'] ?? null,
                'city' => $property['city'] ?? null,
                'district' => $property['district'] ?? null,
                'zip_code' => $property['zip_code'] ?? null,
                'street_address' => $property['street_address'] ?? null,
                'ownership' => $property['ownership'] ?? null,
                'floors_total' => $property['floors_total'] ?? null,
                'floor' => $property['floor'] ?? null,
                'total_area' => $property['total_area'] ?? null,
                'living_area' => $property['living_area'] ?? null,
                'kitchen_area' => $property['kitchen_area'] ?? null,
                'bedrooms' => $property['bedrooms'] ?? null,
                'bathrooms' => $property['bathrooms'] ?? null,
                'parking' => $property['parking'] ?? null,
                'price' => $property['price'] ?? null,
                'negotiated' => $property['negotiated'] ?? 0,
                'type_of_offer' => $property['type_Of_Offer'] ?? null,
                'tour' => $property['tour'] ?? 0,
                'terms_and_condition' => $property['termsandcondition'] ?? 0,
                'extra_options' => !empty($property['extra_options']) ? json_encode($property['extra_options']) : null,
            ];

            try {
                //  Start transaction
                $this->db->conn->beginTransaction();

                //  Insert into properties
                $sql = "INSERT INTO properties (
            user_id, category, property_type, `condition`,
            country, city, district, zip_code, street_address,
            ownership, floors_total, `floor`, total_area, living_area, kitchen_area,
            bedrooms, bathrooms, parking, price, negotiated, type_of_offer,
            tour, terms_and_condition, extra_options
        ) VALUES (
            :user_id, :category, :property_type, :condition,
            :country, :city, :district, :zip_code, :street_address,
            :ownership, :floors_total, :floor, :total_area, :living_area, :kitchen_area,
            :bedrooms, :bathrooms, :parking, :price, :negotiated, :type_of_offer,
            :tour, :terms_and_condition, :extra_options
        )";

                $this->db->query($sql, $params);

                // Get the new property id
                $propertyId = $this->db->conn->lastInsertId();

                //  Insert amenities
                if (!empty($property['amenities']) && is_array($property['amenities'])) {
                    foreach ($property['amenities'] as $amenity) {
                        $this->db->query(
                            "INSERT INTO property_amenities (property_id, amenity) VALUES (:property_id, :amenity)",
                            ['property_id' => $propertyId, 'amenity' => $amenity]
                        );
                    }

                }

                //  Insert photos
                $photos = $property['photos'] ?? [];
                $pos = 0;

                foreach ($photos as $path) {
                    if (!is_string($path) || $path === '')
                        continue;

                    $this->db->query(
                        "INSERT INTO property_photos (property_id, path, is_cover, sort_order) 
                 VALUES (:property_id, :path, :is_cover, :sort_order)",
                        [
                            'property_id' => $propertyId,
                            'path' => $path,
                            'is_cover' => ($pos === 0 ? 1 : 0),
                            'sort_order' => $pos
                        ]
                    );
                    $pos++;
                }

                // Commit transaction
                $this->db->conn->commit();

                //  Clear property from session
                unset($user['property']);
                Session::set('user', $user);

                Session::setFlashMessage('success_message', 'Property published successfully.');
                redirect('/user/account-settings');
            } catch (\Exception $e) {
                $this->db->conn->rollBack();
                error_log("Property save failed: " . $e->getMessage());
                Session::setFlashMessage('error_message', 'An error occurred while saving your property. Please try again.');
                redirect('/user/add-property-accept-terms');
            }
        }
    }

    /**
     * account_payment view
     * 
     * @return void
     */
    public function account_payment()
    {

        $user = Session::get('user');
        if (!$user) {
            redirect('/login');
        }

        $userId = $user['id'];

        // Fetch all payment methods for this user
        $payments = $this->db->query("
        SELECT * FROM payment_methods
        WHERE user_id = :uid
        ORDER BY is_primary DESC, created_at DESC
    ", ['uid' => $userId])->fetchAll();

        // Boolean flag for empty state
        $hasPayments = !empty($payments);

        // Pass data to the view
        loadView('users/accounts/account-payment', [
            'payments' => $payments,
            'hasPayments' => $hasPayments
        ]);
    }



    /**
     * saveCard details
     * 
     * @return void
     */
    public function saveCard()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = Session::get('user')['id'];

            $cardNumber = $_POST['card_number'] ?? '';
            $cardName = $_POST['card_name'] ?? '';
            $expiry = $_POST['card_expiration'] ?? '';
            $cvc = $_POST['card_cvc'] ?? '';
            $isPrimary = isset($_POST['is_primary']) ? 1 : 0;

            // Extract MM/YY
            [$expiryMonth, $expiryYear] = explode('/', $expiry);
            $expiryMonth = (int) $expiryMonth;
            $expiryYear = 2000 + (int) $expiryYear;

            // Last 4 digits only
            $last4 = substr(preg_replace('/\D/', '', $cardNumber), -4);

            // Detect brand
            $brand = 'Other';
            if (preg_match('/^4/', $cardNumber))
                $brand = 'Visa';
            elseif (preg_match('/^5[1-5]/', $cardNumber))
                $brand = 'MasterCard';
            elseif (preg_match('/^3[47]/', $cardNumber))
                $brand = 'Amex';

            // If primary → reset others
            if ($isPrimary) {
                $this->db->query("UPDATE payment_methods SET is_primary = 0 WHERE user_id = :uid", [
                    'uid' => $userId
                ]);
            }


            // Save to DB
            $this->db->query("
        INSERT INTO payment_methods 
        (user_id, method, card_holder_name, card_number_last4, expiry_month, expiry_year, brand, is_primary)
        VALUES (:uid, 'card', :holder, :last4, :month, :year, :brand, :primary)
    ", [
                'uid' => $userId,
                'holder' => $cardName,
                'last4' => $last4,
                'month' => $expiryMonth,
                'year' => $expiryYear,
                'brand' => $brand,
                'primary' => $isPrimary
            ]);

            Session::setFlashMessage('success_message', '✅ Card saved successfully!');
            redirect('/user/account-payment');

        }
    }


    /**
     * Save paypal
     * 
     * @return void
     */
    public function savePaypal()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $userId = Session::get('user')['id'];
            $paypalEmail = $_POST['paypal_email'] ?? '';
            $isPrimary = isset($_POST['is_primary']) ? 1 : 0;

            if (!filter_var($paypalEmail, FILTER_VALIDATE_EMAIL)) {
                Session::setFlashMessage('error_message', '❌ Invalid PayPal email!');
                redirect('/user/account-payment');
            }

            // If marked as primary, reset others
            if ($isPrimary) {
                $this->db->query("UPDATE payment_methods SET is_primary = 0 WHERE user_id = :uid", [
                    'uid' => $userId
                ]);
            }

            // Insert PayPal
            $this->db->query("
        INSERT INTO payment_methods 
        (user_id, method, paypal_email, is_primary)
        VALUES (:uid, 'paypal', :email, :primary)
    ", [
                'uid' => $userId,
                'email' => $paypalEmail,
                'primary' => $isPrimary
            ]);

            Session::setFlashMessage('success_message', '✅ PayPal saved successfully!');
            redirect('/user/account-payment');
        }

    }


    /**
     * deleteCard
     * 
     * @return void
     */
    public function deleteCard(){
      $user = Session::get('user');
      if(!$user){
        redirect('/auth/login');
      }

      if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $cardId = (int) $_POST['id'];

         // Only delete if the card belongs to the logged-in user
         $this->db->query("DELETE FROM payment_methods WHERE id = :id AND user_id = :uid",[
            'id' => $cardId,
            'uid' => $user['id']
         ]);

          Session::setFlashMessage('success_message', '✅ Card deleted successfully!');
      }
       redirect('/user/account-payment');
    }

    /**
     * account-profile
     * 
     * @return void
     */
    public function account_profile(){

        $user = Session::get('user');

        if(!$user){
            redirect('/');
        }

         // Check required profile fields
         $required = ['firstname', 'lastname', 'phonenumber', 'languages', 'dob', 'address', 'information', 'profile_picture'];

         foreach($required as $field){
            if(empty($user[$field])){
                // Redirect to "complete your profile" page
                  Session::setFlashMessage('error_message', '⚠️ Please complete your profile before accessing it.');
                redirect('/user/account-settings');
            }
         }

          // Load profile view with user data
       
        loadView('users/accounts/account-profile',
    [
        'user'=>$user
    ]);
    }

    /**
     * account_listings 
     * 
     * @return void
     */
    public  function account_listings(){
        $user = Session::get('user');
        if(!$user){
            redirect('/auth/login');
        }

        $userId = $user['id'];

         // Fetch all properties that belong to this user
    $properties = $this->db->query("
        SELECT p.*, ph.path AS cover_photo
        FROM properties p
        LEFT JOIN property_photos ph 
            ON ph.property_id = p.id AND ph.is_cover = 1
        WHERE p.user_id = :uid
        ORDER BY p.created_at DESC
    ", ['uid' => $userId])->fetchAll();

    // Send those properties to the view
    loadView('users/accounts/account-listings', [
        'properties' => $properties
    ]);

    }

    /**
     * Delete listing
     * @return void
     */
    public   function delete_listing(){
        $user = Session::get('user');

        if(!$user){
            redirect('/auth/login');
        }

        
    // Only allow POST/DELETE requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_POST['_method'] ?? '') !== 'DELETE') {
        http_response_code(405); // Method Not Allowed
        die("Invalid request");
    }

    $listingId = $_POST['id'] ?? null;
    if (!$listingId) {
        Session::setFlashMessage('error_message', '❌ Invalid listing selected.');
        redirect('/user/account-listings');
    }

    // Make sure listing belongs to the logged-in user
    $userId = $user['id'];
    $this->db->query("
        DELETE FROM properties 
        WHERE id = :id AND user_id = :uid
    ", [
        'id' => $listingId,
        'uid' => $userId
    ]);

    // Also delete photos for that property
    $this->db->query("DELETE FROM property_photos WHERE property_id = :id", ['id' => $listingId]);

    Session::setFlashMessage('success_message', '✅ Listing deleted successfully!');
    redirect('/user/account-listings');
    }

    /**
     * account_helpCenter
     * 
     * @return void
     */
    public function account_helpCenter(){
          $user = Session::get('user');

        if(!$user){
            redirect('/auth/login');
        }

        loadView('/users/accounts/account-helpCenter');
    }
}