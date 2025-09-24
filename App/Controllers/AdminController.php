<?php
namespace App\controllers;

use Framework\Database;
use Framework\Session;
use Framework\Validation;
use Framework\Middleware\AdminAuth;

class AdminController
{


    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }


    /**
     * Show login page
     */
    public function showlogin()
    {
        // 🚫 Block if user is logged in (regular account session)
        if (Session::get('user')) {
            redirect('/'); // or show "Forbidden"
        }

        // 🚫 Block if admin is already logged in
        if (Session::get('admin')) {
            redirect('/admin/account-settings');
        }

        loadView('admin/login');

    }

    /**
     * login to admin dashboard
     */
    public function login()
    {

        // 🚫 Block if user is logged in (regular account session)
        if (Session::get('user')) {
            redirect('/'); // or show "Forbidden"
        }

        // 🚫 Block if admin is already logged in
        if (Session::get('admin')) {
            redirect('/admin/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $errors = [];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email address.";
            }
            if (!$password) {
                $errors[] = "Password is required.";
            }

            if (empty($errors)) {
                $admin = $this->db->query("
                    SELECT * FROM admins WHERE email = :email LIMIT 1
                ", ['email' => $email])->fetch();

                if ($admin && password_verify($password, $admin->password)) {
                    // ✅ Login successful → set admin session

                    Session::set('admin', [
                        'id' => $admin->id,
                        'email' => $admin->email,
                        'firstname' => $admin->firstname,
                        'lastname' => $admin->lastname,
                        'phonenumber' => $admin->phonenumber,
                        'languages' => $admin->languages,
                        'dob' => $admin->dob,
                        'address' => $admin->address,
                        'information' => $admin->information,
                        'profile_picture' => $admin->profile_picture
                    ]);


                    redirect('/admin/account-settings');
                } else {
                    $errors[] = "❌ Incorrect email or password.";
                }
            }

            // Show form again with errors + entered email
            loadView('admin/login', [
                'errors' => $errors,
                'user' => ['email' => $email]
            ]);
        } else {
            // GET request → show login form
            loadView('admin/login');
        }
    }


    /**
     * load account_settings view
     */
    public function account_settings()
    {
        AdminAuth::requireAdmin();


        loadView('admin/accounts/account-settings');

    }

    /**
     * Save admin account_info
     */
    public function account_info()
    {
        AdminAuth::requireAdmin();

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
        if (!Validation::string($firstName, 4, 30)) {
            $errors['firstname'] = "Firstname must have minimium 4 characters";
        }

        // Validate lastname
        if (!Validation::string($firstName, 4, 30)) {
            $errors['lastname'] = "Lastname must have minimium 4 characters";
        }

        // Validate phonenumber
        if (!Validation::string($phoneNumber, 11, 14)) {
            $errors['phonenumber'] = 'Phone number must be minimium 11 characters';
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
                'admin/accounts/account-settings',
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
            $userId = Session::get('admin')['id'];
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
                        UPDATE admins 
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
                $currentUser = Session::get('admin');

                // Reset (overwrite) with updated info, keeping id & email
                Session::set('admin', [
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

                redirect('/admin/account-settings');
            }


        } else {
            $errors['profilepicture'] = 'Image must be of jpeg or png format';
            loadView(
                'admin/accounts/account-settings',
                [
                    'errors' => $errors
                ]
            );
            exit;

        }
    }

    /**
     * load account_profile view
     */
    public function account_profile()
    {
        AdminAuth::requireAdmin();

        $user = Session::get('admin');

        // Check required profile fields
        $required = ['firstname', 'lastname', 'phonenumber', 'languages', 'dob', 'address', 'information', 'profile_picture'];

        foreach ($required as $field) {
            if (empty($user[$field])) {
                // Redirect to "complete your profile" page
                Session::setFlashMessage('error_message', '⚠️ Please complete your profile before accessing it.');
                redirect('/admin/account_settings');
            }
        }

        // Load profile view with user data

        loadView(
            'admin/accounts/account-profile',
            [
                'user' => $user
            ]
        );
    }

    /**
     * load account_listings view
     */
    public function account_listings()
    {
        AdminAuth::requireAdmin();


        // Fetch all users from DB
        $users = $this->db->query("
        SELECT id, firstname, lastname, email, phonenumber, address, profile_picture
        FROM users
        ORDER BY created_at DESC
    ")->fetchAll();

        // Count
        $totalUsers = count($users);

        // Send to view
        loadView('admin/accounts/account-listings', [
            'users' => $users,
            'totalUsers' => $totalUsers
        ]);



    }

    /**
     * Delete a user
     */
    public function delete_user()
    {
        AdminAuth::requireAdmin();

        $id = $_POST['id'] ?? null;

        if ($id) {
            $this->db->query("DELETE FROM users WHERE id = :id", ['id' => $id]);
            Session::setFlashMessage('success_message', "User deleted successfully!");
        }

        redirect('/admin/account-listings');
    }


    /**
     * account_helpCenter
     */
    public function account_helpCenter(){
         AdminAuth::requireAdmin();

           loadView('admin/accounts/account-helpCenter');
    }

    /**
     * signout
     */
    public function signout(){
        AdminAuth::requireAdmin();

        Session::clearAll();

        $params = session_get_cookie_params();

        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        redirect('/');
    }
}



