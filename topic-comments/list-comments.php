<?php 

$email = ""; // your email, same as your Helprace login
$api_key = ""; // an API key from the Settings > Integrations > API page in your Helprace admin panel
$yourdomain = ""; // the first part of your help desk URL (without alias): yourdomain.helprace.com
$server = "helprace.com";

$topic_id = 13;
$reply_id = 10224;
$url = "https://$yourdomain.$server/api/v1/topics/$topic_id/replies/$reply_id/comments";

$ch = curl_init($url);

$header[] = "Accept: application/json";
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_USERPWD, "$email/api_key:$api_key");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);
$info = curl_getinfo($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($server_output, 0, $header_size);
$response = substr($server_output, $header_size);

$response = json_encode(json_decode($response), JSON_PRETTY_PRINT);

echo "___Response Headers___ <br>\n";
echo nl2br($headers)."<br>\n";
echo "___Response Body___ <br>\n";
echo "$response <br>\n";

curl_close($ch);