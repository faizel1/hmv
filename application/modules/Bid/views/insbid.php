<body style=" background:darkgray">
<div style="text-align:center; margin-left:36%; margin-top:5%;">
  <div class="container">
         
  <div class="row" >
            <div class="col-md-5">


 
  <form action="#" method="post">
  <fieldset>
    <legend> New Bid</legend>
    <div class="form-group">

      <input type="text" class="form-control"   name="auctionid" value="<?php echo $aucid?>" placeholder="Auction ID" >
      </div>

    <div class="form-group">
      <input type="text" class="form-control" name="userid"  value="<?php echo $_SESSION['id']?>" placeholder="User Id" disabled>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="bidamount" placeholder="Bid Amount">
    </div>
   
   
    <button type="submit" name="save" value="save" class="btn btn-primary btn-block" >Submit Bidd</button>
    <?php echo anchor("index.php/auction",' Cancel ',['class'=>'btn btn-danger btn-block']);?>

  </fieldset>
</form>  

</div></div></div></div>

<br><br><br><br><br><br><br><br><br><br><br><br>

