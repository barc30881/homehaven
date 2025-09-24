<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Framework\Database;
use Framework\Session;

class ListingController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function create()
    {
        loadView('listings/create');
    }


    // Show single listing

    public function show($params)
    {
        $id = $params[0] ?? null;

        if (!$id) {
            redirect('/'); // no ID, go home
        }

        // Fetch property
        $property = $this->db->query("
            SELECT p.*, u.firstname, u.lastname, u.email, u.phonenumber , u.address, u.profile_picture
            FROM properties p
            LEFT JOIN users u ON u.id = p.user_id
            WHERE p.id = :id
        ", ['id' => $id])->fetch();

        if (!$property) {
            inspectAndDie('Listing not found');
        }

        // Fetch all photos
        $photos = $this->db->query("
            SELECT * FROM property_photos
            WHERE property_id = :id
            ORDER BY is_cover DESC, id ASC
        ", ['id' => $id])->fetchAll();

        //Fetch all amenities
        $amenities = $this->db->query("
    SELECT amenity AS name
    FROM property_amenities
    WHERE property_id = :id
", ['id' => $id])->fetchAll();

        loadView('listings/listing-single-entry', [
            'property' => $property,
            'photos' => $photos,
            'amenities' => $amenities
        ]);
    }

    /**
     * scheduleTour
     */

public function scheduleTour()
{
    $realtorEmail = $_POST['realtor_email'] ?? null;  
    $adminEmail   = "admin@connectbuilderse-mobilemarket.com"; // fixed admin email


    
    $date  = $_POST['date'] ?? '';
    $time  = $_POST['time'] ?? '';
    $name  = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $location = $_POST['location'] ?? '';

    $subject = "New Tour Request for {$location}";
$message = "
<table width='100%' cellpadding='0' cellspacing='0' border='0' style='background:#f4f4f4; padding:20px; font-family:Arial, sans-serif;'>
  <tr>
    <td align='center'>
      <table width='600' cellpadding='0' cellspacing='0' border='0' style='background:#ffffff; border-radius:8px; overflow:hidden;'>
        <tr>
          <td style='background:#2c3e50; color:#ffffff; padding:20px; text-align:center; font-size:24px; font-weight:bold;'>
            🏡 New Tour Request
          </td>
        </tr>
        <tr>
          <td style='padding:20px; color:#333333; font-size:16px;'>
            <p style='margin:0 0 10px 0;'>Hello, you have received a new <strong>tour request</strong> from connect builders e-mobile market.</p>
            
            <table width='100%' cellpadding='8' cellspacing='0' border='0' style='margin-top:15px; border-collapse:collapse;'>
              <tr style='background:#f9f9f9;'>
                <td width='150' style='font-weight:bold;'>Name:</td>
                <td>{$name}</td>
              </tr>
              <tr>
                <td style='font-weight:bold;'>Email:</td>
                <td>{$email}</td>
              </tr>
              <tr style='background:#f9f9f9;'>
                <td style='font-weight:bold;'>Phone:</td>
                <td>{$phone}</td>
              </tr>
              <tr>
                <td style='font-weight:bold;'>Date:</td>
                <td>{$date}</td>
              </tr>
              <tr style='background:#f9f9f9;'>
                <td style='font-weight:bold;'>Time:</td>
                <td>{$time}</td>
              </tr>
              <tr>
                <td style='font-weight:bold;'>Location:</td>
                <td>{$location}</td>
              </tr>
            </table>
            
            <p style='margin-top:20px; font-size:14px; color:#666;'>Please contact the requester to confirm this tour.</p>
          </td>
        </tr>
        <tr>
          <td style='background:#2c3e50; color:#ffffff; text-align:center; padding:15px; font-size:14px;'>
            © " . date('Y') . " Connect Builders. All rights reserved.
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
";


    $mail = new PHPMailer(true);

    try {
        //  SMTP (raw values)
        $mail->isSMTP();
        $mail->Host       = "connectbuilderse-mobilemarket.com";
        $mail->SMTPAuth   = true;
        $mail->Username   = "admin@connectbuilderse-mobilemarket.com"; // server token
        $mail->Password   = "q?k7Ym+O3KD&"; // same as username
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // SSL/TLS
        $mail->Port       = 587;

        // From + Recipients
        $mail->setFrom("admin@connectbuilderse-mobilemarket.com", "Connect Builders");
        if ($realtorEmail) {
            $mail->addAddress($realtorEmail);
        }
        $mail->addAddress($adminEmail);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();

        Session::setFlashMessage('success_message', '✅ Your tour request has been sent!');
    } catch (\Exception $e) {
        Session::setFlashMessage('error_message', "❌ Mail failed: {$mail->ErrorInfo}");
    }

    redirect($_SERVER['HTTP_REFERER'] ?? '/');
}

/**
 * contactRealtor
 */

public function contactRealtor()
{
    
    $realtorEmail = $_POST['realtor_email'] ?? null;    
    $adminEmail   = "admin@connectbuilderse-mobilemarket.com";

    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $phone   = $_POST['phone'] ?? '';
    $messageText = $_POST['message'] ?? '';
    $location = $_POST['location'] ?? '';

    $subject = "Property Inquiry: {$location}";
    $message = "
    <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background:#f4f4f4; padding:20px; font-family:Arial, sans-serif;'>
      <tr>
        <td align='center'>
          <table width='600' cellpadding='0' cellspacing='0' border='0' style='background:#ffffff; border-radius:8px; overflow:hidden;'>
            <tr>
              <td style='background:#0069d9; color:#ffffff; padding:20px; text-align:center; font-size:24px; font-weight:bold;'>
                📩 New Property Inquiry
              </td>
            </tr>
            <tr>
              <td style='padding:20px; color:#333333; font-size:16px;'>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Phone:</strong> {$phone}</p>
                <p><strong>Property:</strong> {$location}</p>
                <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($messageText)) . "</p>
              </td>
            </tr>
            <tr>
              <td style='background:#0069d9; color:#ffffff; text-align:center; padding:15px; font-size:14px;'>
                © " . date('Y') . " Connect Builders. All rights reserved.
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>";

    $mail = new PHPMailer(true);

    try {
        // SMTP Config (raw values)
         $mail->isSMTP();
        $mail->Host       = "connectbuilderse-mobilemarket.com";
        $mail->SMTPAuth   = true;
        $mail->Username   = "admin@connectbuilderse-mobilemarket.com"; // server token
        $mail->Password   = "q?k7Ym+O3KD&"; // same as username
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // SSL/TLS
        $mail->Port       = 587;

        $mail->setFrom("admin@connectbuilderse-mobilemarket.com", "Connect Builders");
        if ($realtorEmail) {
            $mail->addAddress($realtorEmail);
        }
        $mail->addAddress($adminEmail);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();

        Session::setFlashMessage('success_message', '✅ Your message has been sent!');
    } catch (\Exception $e) {
        Session::setFlashMessage('error_message', "❌ Mail failed: {$mail->ErrorInfo}");
    }

    redirect($_SERVER['HTTP_REFERER'] ?? '/');
}





public function vendor($id)
{
    
    // $vendorId = $_GET['id'] ?? null;

    // if (!$vendorId) {
    //     redirect('/'); // no vendor id, go home
    // }

    // fetch vendor details from users table
    $vendor = $this->db->query(
        "SELECT id, firstname, lastname, phonenumber, email, address, information, profile_picture 
         FROM users WHERE id = :id",
        ['id' => $id]
    )->fetch();

    if (!$vendor) {
        inspectAndDie('404'); // vendor not found
    }

    
    loadView('listings/vendor-entry-page', [
        'vendor' => $vendor
    ]);
}


public function showAll()
{
    $sql = "SELECT p.*, 
               u.firstname, u.lastname, u.email, u.phonenumber, u.address, u.profile_picture,
               (SELECT path FROM property_photos WHERE property_id = p.id AND is_cover = 1 LIMIT 1) as cover_photo
        FROM properties p
        LEFT JOIN users u ON u.id = p.user_id
        WHERE 1=1";


    $params = [];

    if (!empty($_GET['offer_type'])) {
        $sql .= " AND p.type_of_offer = :offer_type";
        $params['offer_type'] = $_GET['offer_type'];
    }

    if (!empty($_GET['location'])) {
        $sql .= " AND p.city = :location";
        $params['location'] = $_GET['location'];
    }

    if (!empty($_GET['property_type'])) {
        $sql .= " AND p.property_type = :property_type";
        $params['property_type'] = $_GET['property_type'];
    }

    if (!empty($_GET['price_min'])) {
        $sql .= " AND p.price >= :price_min";
        $params['price_min'] = (int) $_GET['price_min'];
    }

    if (!empty($_GET['price_max'])) {
        $sql .= " AND p.price <= :price_max";
        $params['price_max'] = (int) $_GET['price_max'];
    }

    $properties = $this->db->query($sql, $params)->fetchAll();

    loadView('listings/listing', [
        'properties' => $properties
    ]);
}








}


