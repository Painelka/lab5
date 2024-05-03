<?php

function redirectToHome(): void
{
    header( header:'Location: /');
    exit();
}

if (false === isset($_POST['email'], $_POST['category'], $_POST['title'], $_POST['description'])){
    redirectToHome();
}

$category =$_POST['category'];
$title =$_POST['title'];
$description =$_POST['description'];


require  'C:\Users\Софья\Desktop\lab4\Lab4\code\vendor\autoload.php';
$client = new \Google_Client();
$client->setApplicationName('Google sheets and php');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('ofline');
try
{
    $client->setAuthConfig('C:\Users\Софья\Desktop\lab4\Lab4\code\credentials.json');
}
catch (\Google\Exception $e)
{
    echo "Ошибка\n";
}
$service = new Google_Service_Sheets($client);
$spreadsheetId = "1SIro9lyvc5gQJIdyUHrJaE0KTCeMxENqUiNNsQgq0QQ";









$filePath ="categories/{$category}/{$title}.txt";
if (false === file_put_contents($filePath, $description)){
    throw new Exception(message: 'Something went wrong.');
}
chmod($filePath, 0777);
redirectToHome();



