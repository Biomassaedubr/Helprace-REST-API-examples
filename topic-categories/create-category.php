<?php 

$email = "admin@example.com";
$api_key = "c475648a0ac47f3887ffbd97be390439";
$yourdomain = "testing-helprace-signup";
$server = "helprace.com";

// Create a new topic with a minimum set of required fields
$topic_data = json_encode(array(
  "name" => "Sample category",
  "insert_after" => 0
));

$space_id = 1;
$channel = "knowledgebase";
$url = "https://$yourdomain.$server/api/v1/spaces/$space_id/$channel/categories";

$ch = curl_init($url);

$header[] = "Content-type: application/json";
$header[] = "Accept: application/json";
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $topic_data);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_USERPWD, "$email/api_key:$api_key");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CAINFO, "/cacert.pem");

$server_output = curl_exec($ch);
$info = curl_getinfo($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($server_output, 0, $header_size);
$response = substr($server_output, $header_size);

echo "___Response Headers___ <br>\n";
echo nl2br($headers)."<br>\n";
echo "___Response Body___ <br>\n";
echo "$response <br>\n";

curl_close($ch);