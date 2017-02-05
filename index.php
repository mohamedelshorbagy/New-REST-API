<?php

require 'confing.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

/* ---------------------------------------------------------------------------------------------------------- */
// ===> Members Insertion
$app->post('/insertMember',function () use ($app){
      $db = getDB();
      $json = $app->request->getBody();
      $data = json_decode($json , true);

      $Name = filter_var($data['Name'],FILTER_SANITIZE_STRING);
      $password = filter_var($data['password'],FILTER_SANITIZE_STRING);
      $Email = filter_var($data['Email'],FILTER_SANITIZE_EMAIL);
      $BloodType = filter_var($data['BloodType'],FILTER_SANITIZE_STRING);
      $Age = filter_var($data['Age'],FILTER_SANITIZE_NUMBER_INT);
      $Phone = filter_var($data['Phone'],FILTER_SANITIZE_NUMBER_INT);
      $City = filter_var($data['City'],FILTER_SANITIZE_STRING);
      $zipcode = filter_var($data['zipcode'],FILTER_SANITIZE_NUMBER_INT);
      $healthCondition = filter_var($data['healthCondition'],FILTER_SANITIZE_STRING);
      $birthDate = $data['birthDate'];

        $stmt = $db->prepare("INSERT INTO person(Name,password,Email,BloodType,Age,Phone,City,zipcode,healthCondition,birthDate) VALUES ('$Name','$password','$Email','$BloodType','$Age','$Phone','$City','$zipcode','$healthCondition','$birthDate')");
        $stmt->execute();




});










/* ---------------------------------------------------------------------------------------------------------- */
 // Get Data For the SignUp
$app->get('/login/:Name/:password',function ($Name , $password) use ($app) {

    $db = getDB();
    $Name = filter_var($Name,FILTER_SANITIZE_STRING);
    $password = filter_var($password,FILTER_SANITIZE_STRING);
    $stmt = $db->prepare("SELECT * FROM person WHERE Name='$Name' AND password='$password'");
    $stmt->execute();
    $rowCount = $stmt->rowCount();

      if ($rowCount > 0) {
          echo '{"row":"true"}';

      } else {
        echo '{"row":"false"}';
      }






});






/* ---------------------------------------------------------------------------------------------------------- */
//Get All Data From DB





$app->run();




/*
 {
	"Name":"Mohamed",
	"password":"123456",
	"Email":"mohamedelshorbagy96@gmail.com",
	"BloodType":"A+",
	"Age":"25",
	"Phone":"01098271750",
	"City":"Cairo",
	"zipcode":"01117",
	"healthCondition":"Good",
	"birthDate":"2017-02-15"


}
 */


?>
