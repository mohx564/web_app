<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $api_url = "http://localhost:3000/users"; // رابط API

    $data = json_encode([
        "name" => $name,
        "email" => $email
    ]);

    $options = [
        "http" => [
            "header" => "Content-Type: application/json",
            "method" => "POST",
            "content" => $data
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($api_url, false, $context);

    if ($result) {
        header("Location: index.php"); // إعادة تحميل الصفحة بعد الإضافة
        exit();
    } else {
        echo "حدث خطأ أثناء الإضافة.";
    }
}
?>
