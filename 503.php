<?php

$protocol = "HTTP/1.0";
if ( "HTTP/1.1" == $_SERVER["SERVER_PROTOCOL"] )
  $protocol = "HTTP/1.1";
header( "$protocol 503 Service Unavailable", true, 503 );
header( "Retry-After: 3600" );

?>
<!DOCTYPE html>
<html lang="en">

<!--


  MAINTENANCE MODE.


--> 

<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="Art Corpus &#8211; Tattoo &amp; Piercing" />
<meta name="keywords" content="Art Corpus, tattoo, piercing, Paris" />
<meta name="robots" content="index,follow">

<link rel="shortcut icon" href="favicon.ico" />
<title>Art Corpus &#8211; Tattoo &amp; Piercing</title>

<meta property="fb:admins" content=""/>
<meta property="og:url" content="http://www.artcorpus.fr"/>
<meta property="og:title" content="Art Corpus &#8211; Tattoo &amp; Piercing"/>
<meta property="og:site_name" content="Art Corpus &#8211; Tattoo &amp; Piercing"/>
<meta property="og:description" content="Art Corpus &#8211; Tattoo &amp; Piercing"/>
<meta property="og:type" content="author"/>
<meta property="og:image" content="http://www.artcorpus.fr"/>
<meta property="og:locale" content="en_us"/>

<style type="text/css">

  /**
   * Google Font import definition,
   * see https://www.google.com/fonts#UsePlace:use/Collection:Arvo
   */
  @font-face {
    font-family: 'Arvo';
    font-style: normal;
    font-weight: 400;
    src: local('Arvo'), url(https://fonts.gstatic.com/s/arvo/v9/J0GYVYTizO1mjpT3aOcSbQ.woff2) format('woff2');
    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
  }
  
  body {
    background: #000;
    color: #FFF;
    font-family: 'Arvo', Arial, sans-serif;
    font-size: 0.8em;
    text-align: center;
  }

  h1 {
    margin-bottom: 0;
    font-weight: 400;
  }

  a, a:visited, a:active {
    color: #dc3b17;
    text-decoration: none;
  }

  section {
    max-width: 500px;
    margin:5vh auto 0 auto;
    text-align: left;
    padding: 10%;
  }

  section img {
    max-width: 100%;
  }

</style>

</head>

<body>

  <section>
    <img src="http://artcorpus.fr/maintenance/artcorpus-logo.png" alt="logo" />
    <p>
    Le site est en maintenance.<br>
    En attendant, vous pouvez nous retrouver sur <a href="https://www.facebook.com/Art-Corpus-315667035202851/">Facebook</a> &amp; <a href="https://www.instagram.com/artcorpustattoo/">Instagram</a>.
    </p>
    <p>
    <h1>Art Corpus</h1>
    79 rue Greneta - 75002 Paris<br>
    <a href="tel:00331 40 13 07 34">01 40 13 07 34</a><br>
    <a href="mailto:contact@artcorpus.fr">contact@artcorpus.fr</a><br>
    du mardi au samedi, de 12h00 à 19h30</p>

  </section>


  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-4531688-35', 'auto');
    ga('send', 'pageview');

  </script>

</body>

</html>