<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    // Ma'lumotlarni tozalash
    $name  = htmlspecialchars($name);
    $phone = htmlspecialchars($phone);

    // Telefon formati tekshiruvi
    if (!preg_match('/^\+998[0-9]{9}$/', $phone)) {
        die("<script>alert('Telefon raqami noto‘g‘ri!'); history.back();</script>");
    }

    // Email yuborish
    $to      = "husmahotel@gmail.com";
    $subject = "Yangi ro'yxat: $name";
    $message = "Ism: $name\nTelefon: $phone\nVaqt: " . date('d.m.Y H:i:s');
    $headers = "From: no-reply@husmafit.uz\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $sent = mail($to, $subject, $message, $headers);

    if ($sent) {
        // Muvaffaqiyatli yuborildi → sahifaga qaytish + modal
        header("Location: kontakt.html?success=1");
        exit;
    } else {
        echo "<script>alert('Xatolik: Email yuborilmadi!'); history.back();</script>";
    }
}
?>
