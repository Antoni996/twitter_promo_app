<?php
/**
 * Created by PhpStorm.
 * User: antoni
 * Date: 20/05/18
 * Time: 22.11
 */
error_reporting(1);

session_start();

include_once("include/config.php");
include_once("include/OAuth.php");
include_once("include/TwitterAPIExchange.php");
include_once("include/twitteroauth.php");

?>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <title>Promo API</title>
    <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] == 'verified') {
    $screenname = $_SESSION['request_vars']['screen_name'];
    $twitterid = $_SESSION['request_vars']['user_id'];
    $oauth_token = $_SESSION['request_vars']['oauth_token'];
    $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];

    $settings = array(
        'oauth_access_token' => "981450978133032961-lsjyj5bKqF1NrbfFlRxYQdfLTC6jnX1",
        'oauth_access_token_secret' => "IrmVprrdNzjdTNuJaDsfYtaCJ7E1zXS5bQlBYgcs9iCh1",
        'consumer_key' => "C7VSn0nf9hXfmE2k9IptG0bze",
        'consumer_secret' => "bdjOUsa7hxIgFkecJZnm4VuDIdcgsWmWvi1IBFQ53YF400GBRK"
    );



    ?>
</head>

<body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<!--HERES THE NAVBAR-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark navbar-fixed-top ">
    <div class="container-fluid">
    <ul class="navbar-nav">
        <li class="navbar-brand">Promo APP</li>
        <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">App</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="#">Help</a>
        </li>

    </ul>
    <ul class="nav navbar-nav navbar-right">
        <form class="form-inline my-2 my-lg-0 navbar-right">
            <?php

            $usershow = "https://api.twitter.com/1.1/users/show.json";
            $requestMethod = "GET";
            $getfield = '?screen_name='.$screenname.'';
            $twitter = new TwitterAPIExchange($settings);
            $usershowresponse = json_decode($twitter -> setGetfield($getfield)
                -> buildOauth($usershow,$requestMethod)
                -> performRequest(),$assoc=TRUE);
            $profilepic = $usershowresponse['profile_image_url'];

            //My Profile
            echo "<hr>";
            echo '<img class="rounded-circle" src=' . $profilepic . ' alt="my profile" style="width: 14%"></img>&nbsp';
            echo '<div style="color: #f9f9f9"> Welcome, <i><b>' . $screenname .'</i></b></div>';

            //log out
            //echo '<a class="btn btn-outline-primary btn-sm" href="lagout.php">Logout</a>';
            //echo '<button type="button" class="btn btn-outline-danger"><a href="logout.php" >Logout</a></button>';
            echo "<br><hr><hr>";
            ?>
            &nbsp
            <button class=" btn btn-nav btn-danger my-2 my-sm-0 btn-sm"><a href="logout.php" style="color: #f9f9f9">Log Out</a></button>

        </form>

    </ul>
    </div>
</nav>
<div class="jumbotron text-center">
    <h2>PROMO AROUND APP</h2>
    <span class="text-muted">find your perfect promo around you</span>
</div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php

                $usershow = "https://api.twitter.com/1.1/users/show.json";
                $requestMethod = "GET";
                $getfield = '?screen_name='.$screenname.'&count=10';
                $twitter = new TwitterAPIExchange($settings);
                $usershowresponse = json_decode($twitter -> setGetfield($getfield)
                    -> buildOauth($usershow,$requestMethod)
                    -> performRequest(),$assoc=TRUE);
                $profilepic = $usershowresponse['profile_image_url'];

                //My Profile
                echo "<hr>";
                echo '<img class="img-thumbnail" src=' . $profilepic . ' alt="my profile"></img>';
                echo ' Welcome, <i><b>' . $screenname .'</i></b> ';

                //log out
                //echo '<a class="btn btn-outline-primary btn-sm" href="lagout.php">Logout</a>';
                //echo '<button type="button" class="btn btn-outline-danger"><a href="logout.php" >Logout</a></button>';
                echo "<br><hr><hr>";
                ?>


                    <div class="dropdown show">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Kategori Promo
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Makanan</a>
                            <a class="dropdown-item" href="#">Wisata</a>
                            <a class="dropdown-item" href="#">Komputer & Hp</a>
                            <hr>
                            <a class="dropdown-item" href="#">Semua Kategori</a>
                        </div>
                    </div>

                <h2>Pilih Lokasi</h2>


                <ul>
                    <li>
                        <a href="#">Jakarta</a>
                    </li>
                    <li>
                        <a href="#">Surabaya</a>
                    </li>
                    <li>
                        <a href="#">Bandung</a>
                    </li>
                    <li>
                        <a href="#">Semarang</a>
                    </li>
                    <li>
                        <a href="#">Yogyakarta</a>
                    </li>
                    <li>
                        <a href="#">Bali</a>
                    </li>
                    <li>
                        <a href="#">Semua Lokasi</a>
                    </li>

                </ul>

            </div>


            <!-- ISI TWEETS -->

            <div class="col-sm-7">

                </br>
                <div class="card" style="width: 400px">
                    <div class="card-body">
                        <?php
                        $tweetsearch = "https://api.twitter.com/1.1/search/tweets.json";
                        $requestMethod = "GET";
                        $getfieldsearch = '?q=diskon%20filter:twimg
                        &result_type=popular';

                        //GET LOCATION
                        //$getlocationsearch = '&geocode=';

                        $twitter = new TwitterAPIExchange($settings);
                        $tweetresponse = json_decode($twitter -> setGetfield($getfieldsearch)
                            -> buildOauth($tweetsearch,$requestMethod)
                            -> performRequest(),$assoc=TRUE);

                        //$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=php&result_type=recent&count=20');

//                        echo '<pre>';
//                        print_r($tweetresponse);
//                        echo '</pre>';

                        $counter = 0;
                        foreach ($tweetresponse as $key)
                        {
                            foreach ($key as $t)
                            {
                                if ($counter <2)
                                {

                                    $mediaTweet = $t['entities']['media']['0']['media_url'];
                                    $userArray = $t['user'];

                                    //$entitiesArray = $t['entities'];
                                    //$imageArray = $entitiesArray['urls'];

                                    echo '<img src='. $userArray['profile_image_url'] .' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                    //echo " <b>". $userArray['name'] ."</b></br>";
                                    echo " <b>". $userArray['screen_name'] ."</b></br>";

                                    if ($mediaTweet != '')
                                    {
                                        // #1 HYPERLINK FILTER The Regular Expression filter
                                        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                        if (preg_match($reg_exUrl, $mediaTweet,$url))
                                        {
                                            //#2 HYPERLINK PENGUBAHAN
                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);

                                            echo '<br><center><a href='.$url[0].'><img id="myImg" class="img-thumbnail mx-auto d-block" src='. $mediaTweet .' alt="image tweet" width="80%"></img></a></center>';

                                            // #3 HYPERLINK DISINI make the urls hyper links
                                            //echo preg_replace($reg_exUrl, "<center><small><a href=". $url[0]. ">{$url[0]}</a></small></center> ", $mediaTweet);
                                            echo "<br><br>";
                                        }
                                        else {
                                            echo $mediaTweet;
                                        }

                                    }
                                    else
                                    {
                                        echo "</br></br>";
                                    }
                                    if (preg_match($reg_exUrl, $t['text'],$url))
                                    {
                                        echo preg_replace($reg_exUrl, "<a href=". $url[0]. ">{$url[0]}</a> ", $t['text']);
                                    }
                                    else
                                    {
                                        echo "<p>". $t['text'] ."</p></br>";
                                    }
                                    echo "<hr>";
                                }
                            }
                            break;
                            echo "<hr>";
                        }
                        }
                        else
                        {
                            echo '<a href="process.php"><img src="images/login.png"/></a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
