<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $age = test_input($_POST["age"]);
    $message = test_input($_POST["message"]);
    $reason = test_input($_POST["reason"]);

    // Twój Webhook URL w Discord
    $webhookUrl = "https://discord.com/api/webhooks/1109596865982382110/IsBvMwLyhIot46YyR2__DUwOHaVvPIBHydgjMqC_ZgQ76bCTHzaUNxCfEaZs5cqJL-CN"; // Zastąp własnym URL-em Webhooka

    // Tworzymy tablicę z danymi do wysłania na Webhooka
    $data = array(
        'name' => "$name",
        'content' => "New Contact Form:\nName: $name\nEmail: $email\nAge: $age\nMessage: $message\nReason: $reason"
    );

    // Tworzymy nagłówki HTTP
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );

    // Tworzymy zasób do obsługi żądania HTTP
    $context = stream_context_create($options);
    $result = file_get_contents($webhookUrl, false, $context);

    // Możesz sprawdzić, czy wysłanie było udane
    if ($result === FALSE) {
        // Obsłuż błąd
        echo "Wysłanie danych nie powiodło się.";
    } else {
        // Wysłanie danych było udane
        echo "Dane zostały pomyślnie wysłane.";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
