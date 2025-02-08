@extends('layouts/full')

@section('content')
<style>
<?php if($profile->avatar_url != ""): ?>
.full .avatar .profile-image{
background: url('{{$profile->avatar_url}}');
background-size: contain;
    background-repeat: no-repeat;
}
<?php endif; ?>
.uploadedCerts .certBox{
  float: left;
margin-top: 20px;
margin-right: 20px;
height: 150px;
background: #e8e8ec;
width: 200px;
}
.uploadedCerts .certBox input {
  background: #fff !important;
text-align: center;
width: 100%;
border: 1px solid #bdbdbd !important;
}
.certificates .certificate_box{
  width: 200px;
  height: 200px;
  float: left;
  margin-right: 20px;
  background: #e8e8ec;
  text-align: center;
  padding-top:80px;
  position: relative;
}
.certificate_box .remove{
  position: absolute;
  top:5px;
  right: 5px;
}
</style>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <div class="row profile-settings">
    <div class="col-lg-12">
      <div class="avatar" style="cursor:pointer" onclick="jQuery('#avatar').trigger('click');">
        <section class="profile-image small flex flex-center flex-vcenter">
          <span class="title" style="text-shadow:1px 1px 1px #000">Upload billede</span>
        </section>
      </div>
      <form method="post" enctype="multipart/form-data" style="width:0px; height:0px; overflow:hidden">
          {{ csrf_field() }}
          <input type="file" id="avatar" name="avatar"  onchange="jQuery('#avatar').parents('form')[0].submit();" />
      </form>
    </div>
  </div>

<div class="container-fluid profile-settings">

    <div class="row">
      <div class="col-lg-9">

        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        @endif

        <div class="container-fluid forms-wrapper">
          <h3>Company information</h3>

          <form action="" method="post" enctype="multipart/form-data" class="layout">
            {{ csrf_field() }}

          <div class="row">
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="cname" id="cname" class="form-control" value="{{$profile->cname}}" placeholder="Company name" />
              </span>
            </div>
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="vat" id="vat" class="form-control" value="{{$profile->vat}}" placeholder="VAT nr." />
              </span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-lg-12">
              <span>
                <input type="text" name="adress" id="adress" class="form-control" value="{{$profile->adress}}" placeholder="Address" />
              </span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="country" id="country" class="form-control" value="{{$profile->country}}" placeholder="Country" />
              </span>
            </div>
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="email" id="email" class="form-control" value="{{$profile->email}}" placeholder="E-mail" />
              </span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="phone" id="phone" class="form-control" value="{{$profile->phone}}" placeholder="Phone" />
              </span>
            </div>
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="website" id="website" class="form-control" value="{{$profile->website}}" placeholder="Website" />
              </span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-lg-12">
              <span>
                <input type="text" name="adress_invoice" id="adress_invoice" class="form-control" value="{{$profile->adress_invoice}}" placeholder="Invoice e-mail address" />
              </span>
            </div>
          </div>

          <h3>Contact person information</h3>
          <div class="row">
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="contact_name" id="contact_name" class="form-control" value="{{$profile->country}}" placeholder="Name" />
              </span>
            </div>
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="contact_phone" id="contact_phone" class="form-control" value="{{$profile->contact_email}}" placeholder="Phone" />
              </span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-lg-12">
              <span>
                <input type="text" name="contact_email" id="contact_email" class="form-control" value="{{$profile->contact_email}}" placeholder="E-mail" />
              </span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-lg-12">
              <h2>
              <span>
                <input type="radio" name="access_level" value="10" <?php if($profile->access_level == 10): echo "checked"; endif; ?>  />
              I'm customer on getthefruit.com
              </span>
            </h2>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-lg-12">
              <h2>
              <span>
                <input type="radio" name="access_level" value="20" <?php if($profile->access_level == 20): echo "checked"; endif; ?>  />
I'm supplier on getthefruit.com
              </span>
              </h2>
            </div>
          </div>


          <h3>Certificates</h3>
          <div class="row">
            <div class="certificates">

            <?php
            if(!empty($profile->certificates)):
            $count = 0;
            foreach ($profile->certificates as $item) {
                ?>

                    <div class="certificate_box">
                      <a href="/profile/removeCertificate/<?php echo $count; ?>">
                        <div class="remove" style="color:red">X</div></a>
                        <?php echo $item->name;  ?>
                  </div>

          <?php $count++; } endif; ?>
          </div>
          </div>
          <div class="row">
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


          <div class="row">
            <button type="submit" class="btn blue">
              <span>Save</span>
            </button>
          </div>
        </form>
        </div><!-- end wrapper forms-->

      </div>

      <div class="col-lg-3 profile-autofill layout-form">
        <ul>
          <li class="title" data-id="cname"><span>{{$profile->cname}}</span></li>
          <li data-id="vat">VAT nr.: <span>{{$profile->vat}}</span></li>
          <li data-id="adress">Adress: <span>{{$profile->adress}}</span></li>
          <li data-id="country"><span>{{$profile->country}}</span></li>
          <li data-id="email"><span>{{$profile->email}}</span></li>
          <li data-id="phone">Phone: <span>{{$profile->phone}}</span></li>
          <li data-id="website"><span>{{$profile->website}}</span></li>
          <li data-id="adress_invoice">Invoice: <span>{{$profile->adress_invoice}}</span> <br /><br /></li>

          <li data-id="contact_name"><span>{{$profile->contact_name}}</span></li>
          <li data-id="contact_phone"><span>{{$profile->contact_phone}}</span></li>
          <li data-id="contact_email"><span>{{$profile->contact_email}}</span></li>
        </ul>
      </div>
    </div>
</div>
@endsection

@section('scriptsFooter')
  <script>
    $(document).ready(function(){
      $('input').on('keyup', function(event){
        $.app.profileEdit.onKeyDown(event, $(this));
      });
    });

    $("#file_certificates").change(function(){
      jQuery(".uploadedCerts").html("");
      console.log($(this)[0].files);
      var length = $(this)[0].files.length;
      var files = $(this)[0].files;
      for (var i = 0; i < length; i++) {
        jQuery(".uploadedCerts").append('<div class="certBox"><p>The file is uploaded, you can change its name underneath.</p><input type="text" name="certificate_name[]" value="'+ files[i].name +'" /></div>');
      }

    });
  </script>
@endsection
