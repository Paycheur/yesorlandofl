
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="/Assets/dashboard/js/jquery.js"></script>
    <script src="/Assets/dashboard/js/jquery-1.8.3.min.js"></script>
    <script src="/Assets/dashboard/js/bootstrap.min.js"></script>
    <script src="/Assets/dashboard/js/jquery.scrollTo.min.js"></script>
    <script src="/Assets/dashboard/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/Assets/dashboard/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="/Assets/dashboard/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="/Assets/dashboard/js/owl.carousel.js" ></script>
    <script src="/Assets/dashboard/js/jquery.customSelect.min.js" ></script>

    <!--common script for all pages-->
    <script src="/Assets/dashboard/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="/Assets/dashboard/js/sparkline-chart.js"></script>
    <script src="/Assets/dashboard/js/easy-pie-chart.js"></script>

  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
