<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.css')
   </head>
      
   
   <!-- body -->
   <body class="main-layout">
      <!-- load screen  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- load screen -->
      <!-- header -->
      <header>
         <!-- header inner -->
         @include('home.header')
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
        @include('home.slider')
      <!-- end banner -->
      <!-- about - benefit -->
        @include('home.about')
      <!-- about - benefit -->
      <!-- list salon -->
        @include('home.listsalon')
      <!-- end list salon -->
      <!-- blog berita -->
        @include('home.berita')
      <!-- end blog -->
      <!--  contact -->
        @include('home.contact')
      <!-- end contact -->
      <!--  footer -->
      <footer>
         @include('home.footer')
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>