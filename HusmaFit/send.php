<?php
if ($_POST) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $plan = $_POST['plan'];
    
    // Email
    $to = "info@husmafit.uz";
    $subject = "Yangi ro'yxat: $name";
    $body = "Ism: $name\nTelefon: $phone\nAbonement: $plan";
    mail($to, $subject, $body);
    
    // SMS (SMS.uz API – kalit o'zgartiring)
    $sms_url = "https://sms.uz/api/send";
    $sms_data = [
        'api_key' => 'YOUR_API_KEY',
        'to' => $phone,
        'text' => "HusmaFitdan salom, $name! Ro'yxatingiz qabul qilindi. Tez orada bog'lanamiz. Kod: 123456"
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $sms_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($sms_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
    
    echo "<script>alert('Muvaffaqiyatli! SMS yuborildi.'); window.location='index.html';</script>";
}
?>