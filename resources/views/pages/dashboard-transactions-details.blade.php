@extends('layouts.dashboard')

@section('title')
  Store Dashboard Transaction Detail    
@endsection

@section('content')

<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
          <h2 class="dashboard-title">{{ $transaction->code }}</h2>
          <p class="dashboard-subtitle">Transactions Details</p>
      </div>

      <div class="dashboard-content" id="transactionDetails">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <img
                    src="{{ asset('storage/'.$transaction->product->galleries->first()->photos ?? '') }}"
                    alt=""
                    class="w-100 mb-3"
                    />
                  </div>
                  <div class="col-12 col-md-8">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="product-title">Nama Customer</div>
                          <div class="product-subtitle">{{ $transaction->transaction->user->name }}</div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">Nama Product</div>
                          <div class="product-subtitle">{{ $transaction->product->name }}</div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                          Tanggal Transaksi
                          </div>
                          <div class="product-subtitle">
                            {{ \Carbon\Carbon::parse($transaction->created_at)->format('j F, Y H:i') }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">Status Pembayaran</div>
                          <div class="product-subtitle text-success">
                          {{ $transaction->transaction->transaction_status }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">Total Amount</div>
                          <div class="product-subtitle">Rp.{{ number_format($transaction->transaction->total_price) }}</div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">No. Handphone</div>
                          <div class="product-subtitle">
                          {{ $transaction->transaction->user->phone_number }}
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="row">
                    <div class="col-12 mt-4">
                        <h5>Informasi Pengiriman</h5>
                    </div>
                    <div class="col-12">
                      <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="product-title">Alamat</div>
                            <div class="product-subtitle">
                                {{ $transaction->transaction->user->address_one }}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="product-title">Provinsi</div>
                            <div class="product-subtitle">
                                {{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="product-title">Kabupaten/Kota</div>
                            <div class="product-subtitle">
                                {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="product-title">Kecamatan</div>
                            <div class="product-subtitle">
                                {{ App\Models\District::find($transaction->transaction->user->districts_id)->name ?? '' }}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">Kode Pos</div>
                          <div class="product-subtitle">{{ $transaction->transaction->user->zip_code  }}</div>
                        </div>
                        @if (Auth::user()->id !== $transaction->product->users_id)
                        <div class="col-12 col-md-6">
                          <div class="product-title">Status Pengiriman</div>
                          <div class="product-subtitle 
                            {{ $transaction->shipping_status == 'PENDING' ? 'text-warning' : '' }}
                            {{ $transaction->shipping_status == 'SHIPPING' ? 'text-info' : '' }}
                            {{ $transaction->shipping_status == 'SUCCESS' ? 'text-success' : '' }}">
                            {{ $transaction->shipping_status }}
                          </div>
                        </div>
                        <div class="col-12 col-md-8">
                          <div class="product-title">Nomor Resi</div>
                          <div class="product-subtitle">{{ $transaction->resi  }}</div>
                        </div>
                        @endif
                        <div class="col-12 col-md-6">
                          
                        </div>
                        @if (Auth::user()->id === $transaction->product->users_id)
                        <div class="col-12 col-md-3">
                          <div class="product-title">Status Pengiriman</div>
                            <select
                              name="shipping_status"
                              id="status"
                              class="form-control"
                              v-model="status"
                              {{ Auth::user()->id !== $transaction->product->users_id ? 'disabled' : '' }}
                            >
                              <option value="PENDING">Pending</option>
                              <option value="SHIPPING">Shipping</option>
                              <option value="SUCCESS">Success</option>
                            </select>
                          </div>
                          <template v-if="status == 'SHIPPING'">
                            <div class="col-md-3">
                            <div class="product-title">Input Resi</div>
                              <input
                                  type="text"
                                  class="form-control"
                                  name="resi"
                                  v-model="resi"
                                  {{ Auth::user()->id !== $transaction->product->users_id ? 'disabled' : '' }}
                              />
                            </div>
                            <div class="col-md-2">
                              <button
                                  type="submit"
                                  class="btn btn-success btn-block mt-4"
                                  {{ Auth::user()->id !== $transaction->product->users_id ? 'disabled' : '' }}
                              >
                                  Update Resi
                              </button>
                            </div>
                          </template>
                        </div>
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-12 text-right">
                        <button
                          type="submit"
                          class="btn btn-success btn-lg mt-4"
                          >
                          Save Now
                        </button>
                    </div>
                  </div>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection

@push('addon-script')
    <script src="{{ url('/vendor/vue/vue.js') }}"></script>
    <script>
      var transactionDetails = new Vue({
        el: "#transactionDetails",
        data: {
          status: "{{ $transaction->shipping_status }}",
          resi: "{{ $transaction->resi }}",
        },
      });
    </script>
@endpush
