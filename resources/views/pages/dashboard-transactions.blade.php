@extends('layouts.dashboard')

@section('title')
  Store Dashboard Transaction
@endsection

@section('content')

<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Transaction</h2>
        <p class="dashboard-subtitle">
        Big result start from the small one
        </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12 mt-2">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item">
                  <a
                  class="nav-link active"
                  id="pills-home-tab"
                  data-toggle="pill"
                  href="#pills-home"
                  role="tab"
                  aria-controls="pills-home"
                  aria-selected="true"
                  >Sell Product</a
                  >
              </li>
              <li class="nav-item">
                  <a
                  class="nav-link"
                  id="pills-profile-tab"
                  data-toggle="pill"
                  href="#pills-profile"
                  role="tab"
                  aria-controls="pills-profile"
                  aria-selected="false"
                  >Buy Product</a
                  >
              </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div
                class="tab-pane fade show active"
                id="pills-home"
                role="tabpanel"
                aria-labelledby="pills-home-tab"
            >
            @foreach ($sellTransactions as $transaction)
              <a
                  href="{{ route('dashboard-transaction-details', $transaction->id) }}"
                  class="card card-list d-block"
              >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-1">
                        <img
                        src="{{ asset('storage/'. $transaction->product->galleries->first()->photos ?? '') }}"
                        class="w-50"
                        />
                    </div>
                    <div class="col-md-4">{{ $transaction->product->name }}</div>
                    <div class="col-md-3">{{ $transaction->product->user->name }}</div>
                    <div class="col-md-3">{{ \Carbon\Carbon::parse($transaction->created_at)->format('j F, Y H:i') ?? '' }}</div>
                    <div class="col-md-1 d-none d-md-block">
                        <img
                        src="{{ url('images/dashboard-arrow-right.svg') }}"
                        alt=""
                        />
                    </div>
                  </div>
                </div>
              </a>
              @endforeach
              </div>
              <div
                  class="tab-pane fade"
                  id="pills-profile"
                  role="tabpanel"
                  aria-labelledby="pills-profile-tab"
              >
              @foreach ($buyTransactions as $transaction)
              <a
                  href="{{ route('dashboard-transaction-details', $transaction->id) }}"
                  class="card card-list d-block"
              >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-1">
                        <img
                        src="{{ asset('storage/'.$transaction->product->galleries->first()->photos ?? '') }}"
                        class="w-50"
                        />
                    </div>
                    <div class="col-md-4">{{ $transaction->product->name }}</div>
                    <div class="col-md-3">{{ $transaction->product->user->name }}</div>
                    <div class="col-md-3">{{ \Carbon\Carbon::parse($transaction->created_at)->format('j F, Y H:i') ?? '' }}</div>
                    <div class="col-md-1 d-none d-md-block">
                        <img
                        src="{{ url('images/dashboard-arrow-right.svg') }}"
                        alt=""
                        />
                    </div>
                  </div>
                </div>
              </a>
              @endforeach
              </div>
          </div>
        </div>
      </div>
        <div class="row mt-3">
        <div class="col-12 mt-2"></div>
        </div>
    </div>
  </div>
</div>

@endsection
