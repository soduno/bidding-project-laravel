@extends('layouts/full')

@section('content')
<style>
.certBox {
  width: 100%;
  height: 100%;
  background: #eee;
  font-size: 50px;
float:left;
  margin-right: 20px;
  margin-top:20px;
  text-align: center;
  padding-top: 65px;
  cursor: pointer;
}
.certBox.active{
  border:3px solid green;
}
.certCon{
  width: 200px;
  height: 200px;
  float:left;
  margin-right: 20px;
  margin-top:20px;
  text-align: center;
}

.uploadedGoods .uploadBox{
  float:left;
  width: 200px;
  height: 200px;
  border:3px solid green;
  text-align: center;
  padding-top: 90px;
  font-size: 20px;
  background:#eee;
  margin-top:20px;
  margin-right: 20px;
}

</style>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div id="place-bid">
  <form action="" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-lg-7">
      <div class="row" style="margin-bottom:30px;">
        <div class="page-title">
          <h3>Choose your certificates to send with the offer</h3>
          <div class="certificates">
            <?php if(!empty($userDetails->certificates)):
              $certificates = json_decode($userDetails->certificates);

              foreach ($certificates as $cert): ?>
              <div class="certCon">
                <div class="certBox">
                    <i class="fa fa-file"></i>
                    <input type="checkbox" value="<?php echo $cert->name ?>" name="certificates_name[]"  class="hidden"/>
                    <input type="checkbox" value="<?php echo $cert->url ?>" name="certificates_url[]"  class="hidden"/>
                </div>
                <?php echo $cert->name; ?>
              </div>
              <?php

          endforeach;
            endif;
          ?>
          </div>
        </div>
      </div>

      <div class="row" style="display:none">

          <h3>Upload new certificate</h3>
          <div class="form-group col-lg-12">
            <div style="width:0px; height:0px; overflow:hidden">
              <input id="file_certificates"  type="file" name="certificates[]" multiple>
            </div>
            <p class="text-center">Upload your certificates ( You can choose more than one at a time)</p>
            <div onclick="jQuery('#file_certificates').trigger('click');" style="cursor:pointer;background:#e8e8ec; width:100%; height:80px; text-align:center; font-size:50px; padding-top:10px;"><i class="fa fa-upload" aria-hidden="true"></i>
</div>
<div class="uploadedCerts"></div>
          </div>

      </div>

      <div class="row" style="margin-top:60px;">

          <h3>Upload images of your goods</h3>
          <div class="form-group col-lg-12">
            <div style="width:0px; height:0px; overflow:hidden">
              <input id="file_goods"  type="file" name="file_goods[]" multiple>
            </div>
            <p class="text-center">Upload your images ( You can choose more than one at a time)</p>
            <div onclick="jQuery('#file_goods').trigger('click');" style="cursor:pointer;background:#e8e8ec; width:100%; height:80px; text-align:center; font-size:50px; padding-top:10px;"><i class="fa fa-upload" aria-hidden="true"></i>
</div>
<div class="uploadedGoods"></div>
          </div>

      </div>

      <div class="row flex-column">
        <div class="page-title">
          <h3>Describe your bid</h3>
        </div>

        <div>
          <textarea name="bid_description" id="bid-description" class="input-text-gray w100" rows="8">

          </textarea>
        </div>
      </div>

      <button type="submit" class="btn">
        <span>Save</span>
      </button>
    </div>

  @include('demand/sidebar', [$static, $bidData, $demand, $bidData])
</form>

</div>




@endsection

@section('scriptsFooter')
<script>

$(".certBox").click(function(){
  var element = $(this);
  if(element.hasClass("active")){
    element.removeClass("active");
    element.find('input').prop( "checked", false );
  }
  else{
    element.addClass("active");
      element.find('input').prop( "checked", true );
  }
});


$("#file_goods").change(function(){
  jQuery(".uploadedGoods").html("");
  console.log($(this)[0].files);
  var length = $(this)[0].files.length;
  var files = $(this)[0].files;
  for (var i = 0; i < length; i++) {
    jQuery(".uploadedGoods").append('<div class="uploadBox">'+ files[i].name +'</div>');
  }

});

</script>
@endsection
