<?php

namespace App\Controllers;
use Framework\Database;
use Framework\Session;

class HomeController{

    protected $db;

    // public function __construct(){
    
    // }

        public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }


     public function index(){
       $properties = $this->db->query("
            SELECT p.id, p.property_type, p.price, p.type_of_offer, p.total_area, p.bedrooms, p.bathrooms, p.parking,
                   p.street_address, p.city, p.district, p.zip_code, p.created_at,
                   pp.path AS cover_photo
            FROM properties p
            LEFT JOIN property_photos pp 
                   ON pp.property_id = p.id AND pp.is_cover = 1
            ORDER BY p.created_at DESC
            LIMIT 10
        ")->fetchAll();

        loadView('home', [
            'properties' => $properties
        ]);   
     }
}