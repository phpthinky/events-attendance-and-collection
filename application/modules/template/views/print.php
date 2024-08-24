<!DOCTYPE html>
<html>

<head>
  
              <style type="text/css">
                <?php include ('print.css.php'); ?>

              </style>

</head>

<body>

  <div class="page-header" style="text-align: center">
    <h4 style="padding:0;margin:0;">Student Organization Collections and Events Monitoring Sytem</h4>
    <h5 style="padding:0;margin:0;">
    Occidental Mindoro State College</h5>
    <br/>
   
  </div>

  <div class="page-footer">
     <button type="button" onClick="window.print()" style="background: royalblue;padding: 4px; font-size: 16px;margin-top: 5px;">
      Click here to print
    </button>
  </div>

  <table>

    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <!--*** CONTENT GOES HERE ***-->
         <?php $this->load->view($content); ?>
          
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="page-footer-space"></div>
        </td>
      </tr>
    </tfoot>

  </table>

</body>

</html>