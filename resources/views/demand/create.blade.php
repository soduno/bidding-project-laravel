@extends('layouts/full')

@section('content')

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
          <h3>Create demand</h3>

          <form action="" method="post" class="layout-form">
            {{ csrf_field() }}

          <div class="row">
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="product" id="product" class="form-control" placeholder="Product" />
              </span>
            </div>
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="packaging" id="packaging" class="form-control"  placeholder="Packaging" />
              </span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="country" id="country" class="form-control"  placeholder="Country" />
              </span>
            </div>
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="pallet" id="pallet" class="form-control" placeholder="Pallet" />
              </span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="boxes" id="boxes" class="form-control" placeholder="Boxes pr pallet" />
              </span>
            </div>
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="label" id="label" class="form-control" placeholder="Label" />
              </span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-lg-6">
              <span>
                <input type="text" name="lot" id="lot" class="form-control" placeholder="Lot nr." />
              </span>
            </div>
            <div class="form-group col-lg-6">

            </div>

          </div>

          <h3>Deadline</h3>

          <div class="row">
            <div class="form-group col-lg-6">
              <span>
                <input type="date" name="ending_day" id="ending_day" class="form-control" placeholder="Ending day" />
              </span>
            </div>
            <div class="form-group col-lg-6">
              <span>
                <input type="time" name="ending_time" id="ending_time" class="form-control"  placeholder="Ending time" />
              </span>
            </div>
          </div>
          <h3>Certificates</h3>
          <div class="row certificates">
          <p>  Organic
              <input type="checkbox" name="certificates[]" value="organic" /></p> <br />

            <p>  Global gap
                <input type="checkbox" name="certificates[]" value="global_gap" /></p> <br />

            <p>    GRASP
                  <input type="checkbox" name="certificates[]" value="grasp" /></p> <br />
          </div>

          <h3>Delivery</h3>
          <div class="row">
            <div class="form-group col-lg-6">
              <span>
                <input type="date" name="delivery" id="delivery" class="form-control" placeholder="Delivery" />
              </span>
            </div>
            <div class="form-group col-lg-6">
              <span>

              </span>
            </div>

          </div>


          <h3>Describe your demand</h3>
          <div class="row">
            <div class="form-group col-lg-12">
              <span>
                <textarea name="description" id="description" class="form-control"></textarea>
              </span>
            </div>

          </div>




          <div class="row">
            <button type="submit" class="btn blue">
              <span>Create demand</span>
            </button>
          </div>
        </form>
        </div><!-- end wrapper forms-->

      </div>


</div>
@endsection

@section('scriptsFooter')

@endsection
