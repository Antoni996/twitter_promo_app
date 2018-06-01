<?php
/**
 * Created by PhpStorm.
 * User: antoni
 * Date: 18/05/18
 * Time: 18.57
 */
require_once('include/OAuth.php');
require_once('include/TwitterAPIExchange.php');
require_once('include/twitteroauth.php');

$settings = array(
    'oauth_access_token' => "981450978133032961-lsjyj5bKqF1NrbfFlRxYQdfLTC6jnX1",
    'oauth_access_token_secret' => "IrmVprrdNzjdTNuJaDsfYtaCJ7E1zXS5bQlBYgcs9iCh1",
    'consumer_key' => "C7VSn0nf9hXfmE2k9IptG0bze",
    'consumer_secret' => "bdjOUsa7hxIgFkecJZnm4VuDIdcgsWmWvi1IBFQ53YF400GBRK"
    );

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

$requestMethod = 'GET';

$getfield = '?screen_name=username_test1&count=10';
            $twitter = new TwitterAPIExchange($settings);
            $response = json_decode($twitter -> setGetfield($getfield)
                        -> buildOauth($url,$requestMethod)
                        -> performRequest(),$assoc=TRUE);


/** ERROR CHECK
if($response["errors"][0]["message"] != "")
{
    echo"<h3>Sorry, there wa a problem.</h3>
    <p>Twitter returned the following error message: </p>
    <p><em>".$string[errors][0]["message"]."</em></p>";
    exit();
}
echo "<pre>";
print_r($response);
echo "</pre>";
*/


$var = 'your value';
echo '<input type="text" name="name1" value="'.$var.'"></br>';

foreach ($response as $key)
{
    $profilepic =$key['user']['profile_image_url'];
    echo '<img src='.$profilepic.'></img>';

    echo "Time And Date: ".$key['created_at']."</br>";
    echo "Tweet: ".$key['text']."</br>";
    echo "Screen Name: ".$key['user']['screen_name']."</br>";
    echo "Retweet count: ".$key['retweet_count']."</br>";
    echo "<hr>";
}




?>