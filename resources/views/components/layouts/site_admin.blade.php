
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>なごまちコーヒー焙煎所｜名護市の自家焙煎コーヒー豆専門店</title>
    <meta name="description" content="沖縄県名護市の自家焙煎コーヒー豆専門店。ご注文ごとに焙煎する新鮮なコーヒー豆を100gから販売しています。日常使いのコーヒーからスペシャルティコーヒー、ドリップバッグまで幅広く取り揃えています。" />
    <meta name="keywords" content="なごまちコーヒー焙煎所,名護市,沖縄,コーヒー豆,自家焙煎,スペシャルティコーヒー,珈琲,焙煎,ドリップバッグ,テイクアウト" />
    <meta name="author" content="なごまちコーヒー焙煎所" />
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="https://nagomachicoffee.com/">

    <!-- OGP -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="なごまちコーヒー焙煎所｜名護市の自家焙煎コーヒー豆専門店">
    <meta property="og:description" content="ご注文ごとに焙煎する新鮮なコーヒー豆を100gから販売。日常使いからスペシャルティコーヒーまで取り揃えています。">
    <meta property="og:url" content="https://nagomachicoffee.com/">
    {{-- <meta property="og:image" content="https://nagomachicoffee.com/images/ogp.jpg"> --}}
    <meta property="og:site_name" content="なごまちコーヒー焙煎所">
    <meta property="og:locale" content="ja_JP">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="なごまちコーヒー焙煎所">
    <meta name="twitter:description" content="沖縄県名護市の自家焙煎コーヒー豆専門店">
    {{-- <meta name="twitter:image" content="https://nagomachicoffee.com/images/ogp.jpg"> --}}

    <link rel="icon" href="/favicon.ico">

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <!--Replace with your tailwind.css once created-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
      .gradient {
        background: linear-gradient(90deg, #161617 0%, #555557 100%);
      }
    </style>
  </head>
  <body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">

    {{-- <x-header /> --}}
    <main>{{ $slot }}</main>
    {{-- <x-footer /> --}}

  <!-- jQuery if you need it
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  -->
    <script>
      var scrollpos = window.scrollY;
      var header = document.getElementById("header");
      var navcontent = document.getElementById("nav-content");
      var navaction = document.getElementById("navAction");
      var brandname = document.getElementById("brandname");
      var toToggle = document.querySelectorAll(".toggleColour");

      document.addEventListener("scroll", function () {
        /*Apply classes for slide in bar*/
        scrollpos = window.scrollY;

        if (scrollpos > 10) {
          header.classList.add("bg-white");
          navaction.classList.remove("bg-white");
          navaction.classList.add("gradient");
          navaction.classList.remove("text-gray-800");
          navaction.classList.add("text-white");
          //Use to switch toggleColour colours
          for (var i = 0; i < toToggle.length; i++) {
            toToggle[i].classList.add("text-gray-800");
            toToggle[i].classList.remove("text-white");
          }
          header.classList.add("shadow");
          navcontent.classList.remove("bg-gray-100");
          navcontent.classList.add("bg-white");
        } else {
          header.classList.remove("bg-white");
          navaction.classList.remove("gradient");
          navaction.classList.add("bg-white");
          navaction.classList.remove("text-white");
          navaction.classList.add("text-gray-800");
          //Use to switch toggleColour colours
          for (var i = 0; i < toToggle.length; i++) {
            toToggle[i].classList.add("text-white");
            toToggle[i].classList.remove("text-gray-800");
          }

          header.classList.remove("shadow");
          navcontent.classList.remove("bg-white");
          navcontent.classList.add("bg-gray-100");
        }
      });
    </script>
    <script>
      /*Toggle dropdown list*/
      /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

      var navMenuDiv = document.getElementById("nav-content");
      var navMenu = document.getElementById("nav-toggle");

      document.onclick = check;
      function check(e) {
        var target = (e && e.target) || (event && event.srcElement);

        //Nav Menu
        if (!checkParent(target, navMenuDiv)) {
          // click NOT on the menu
          if (checkParent(target, navMenu)) {
            // click on the link
            if (navMenuDiv.classList.contains("hidden")) {
              navMenuDiv.classList.remove("hidden");
            } else {
              navMenuDiv.classList.add("hidden");
            }
          } else {
            // click both outside link and outside menu, hide menu
            navMenuDiv.classList.add("hidden");
          }
        }
      }
      function checkParent(t, elm) {
        while (t.parentNode) {
          if (t == elm) {
            return true;
          }
          t = t.parentNode;
        }
        return false;
      }
    </script>
  </body>
</html>
