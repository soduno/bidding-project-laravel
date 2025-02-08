@extends('layouts/full')

@section('content')

<div class="container-fluid" id="place-bid">

  <div class="row">

    @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
    @endif

    <div class="col-xs-12 col-sm-7 col-lg-4 order-information">
      <div class="page-title">
        <h3>Order information</h3>
      </div>

      <form action="" method="post" class="layout">
      {{ csrf_field() }}

        <div class="row">
          <div class="form-group col-lg-6">
            <span>
              <label>Product</label>
              <input type="text" name="product" id="product" class="form-control" placeholder="Product" value="{{$demand->product}}" readonly="true" />
            </span>
          </div>
          <div class="form-group col-lg-6">
            <span>
              <label>Packaging</label>
              <input type="text" name="packaging" id="packaging" class="form-control"  placeholder="Packaging" value="{{$demand->packaging}}" readonly="true" />
            </span>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-lg-6">
            <span>
              <label>Country</label>
              <input type="text" name="country" id="country" class="form-control"  placeholder="Country" value="{{$demand->country}}" readonly="true" />
            </span>
          </div>
          <div class="form-group col-lg-6">
            <span>
              <label>Pallet</label>
              <input type="text" name="pallet" id="pallet" class="form-control" placeholder="Pallet" value="{{$demand->pallet}}" readonly="true" />
            </span>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-lg-6">
            <span>
              <label>Boxes pr. pallet</label>
              <input type="text" name="boxes" id="boxes" class="form-control" placeholder="Boxes pr pallet" value="{{$demand->boxes}}" readonly="true" />
            </span>
          </div>
          <div class="form-group col-lg-6">
            <span>
              <label>Product</label>
              <input type="text" name="label" id="label" class="form-control" placeholder="Label" value="{{$demand->label}}" readonly="true" />
            </span>
          </div>
        </div>
      </form>
    </div>

    <div class="col-lg-3 client-information">
      <div class="page-title">
        <h3>Client information</h3>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 avatar">
            <div class="profile-image small">
            <img src="{{$demand->user->avatar_url}}" style="width:100%; max-height:100%;" />
            </div>
          </div>
          <div class="col-lg-9">

            <span class="author block">
              <strong>{{$demand->user->cname}}</strong>
            </span>
            <span class="text block">
              {{$demand->user->contact_email}} <br/>
              {{$demand->user->contact_phone}} <br/>
            </span>
          </div>
        </div>
        <div class="row">
          <footer class="col-lg-12">
            <button class="btn w100">
              <span>Contact client</span>
            </button>
          </footer>
        </div>
      </div>
    </div>

    @include('demand/sidebar')

    <div class="page-title comments w100">
      <form method="post" action="/demand/addcomment">
        {{ csrf_field() }}
        <h3>Comment on this demand</h3>
        <textarea id="comment" name="comment" class="comment comment-input block w100 input-text-gray"></textarea>
        <input type="hidden" name="demandId" value="{{$demand->id}}" />
        <small class="block">The comment is public. To contact the customer in private, use the button "contact seller".</small>

        <button type="submit block" class="btn">
          <span>Submit</span>
        </button>
      </form>

      <section class="comments-list">

        <?php if(!empty($demand->comments)):
              foreach ($demand->comments as $comment):
           ?>
        <div class="comment">
          <div class="row">
            <div class="col-lg-2 avatar">
              <div class="profile-image small flex flex-center flex-vcenter">
                <img src="<?php echo $comment->userDetails->avatar_url; ?>" style="    width: 100%;
    max-height: 100%;" />
              </div>
            </div>
            <div class="col-lg-10">
              <span class="author block">
                <strong><?php echo $comment->userDetails->cname; ?></strong>
              </span>
              <span class="date block"><?php $date = date_create($comment->created_at); echo date_format($date, "d/m/Y") ?></span>
              <span class="text block">
                <?php echo $comment->comment; ?>
              </span>
            </div>
          </div>
          <!--
          <div class="comment clearfix">
            <div class="row">
              <div class="col-lg-2 avatar">
                <div class="profile-image small flex flex-center flex-vcenter">
                  <img src="" />
                </div>
              </div>
              <div class="col-lg-10">
                <span class="author block">
                  <strong>Bilka frugt og grønt</strong>
                </span>
                <span class="date block">Januar 6 2019 - 17:10</span>
                <span class="text block">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed elementum lorem.
                  Phasellus faucibus sem sed massa rutrum ultricies in non ante. Donec at semper est.
                  Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                </span>
              </div>
            </div>
          </div>-->

        </div><!-- maincomment -->
      <?php endforeach;
    endif; ?>

        <div class="clearfix"></div>

      </section>
    </div>

  </div>
</div>
@endsection

@section('scriptsFooter')

@endsection
