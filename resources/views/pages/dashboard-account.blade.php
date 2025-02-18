@extends('layouts.dashboard')

@section('title')
  Account Settings
@endsection

@section('content')

<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">My Account</h2>
      <p class="dashboard-subtitle">Update your current profile</p>
    </div>
    <div class="dashborad-content">
      <div class="row">
        <div class="col-12">
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error}}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-account') }}" method="POST" enctype="multipart/form-data" id="locations">
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Your Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="{{ $user->name }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Your Email</label>
                      <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        value="{{ $user->email }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="addressOne">Alamat</label>
                      <input
                        type="text"
                        class="form-control"
                        id="addressOne"
                        name="address_one"
                        value="{{ $user->address_one }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="provinces_id">Provinsi</label>
                      <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id">
                        <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                      </select>
                      <select v-else class="form-control"></select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="regencies_id">Kabupaten/Kota</label>
                      <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
                        <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                      </select>
                      <select v-else class="form-control"></select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="districts_id">Kecamatan</label>
                        <select name="districts_id" id="districts_id" class="form-control" v-if="districts" v-model="districts_id">
                          <option v-for="district in districts" :value="district.id">@{{ district.name }}</option>
                        </select>
                        <select v-else class="form-control"></select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="zip_code">Postal Code</label>
                      <input
                        type="text"
                        class="form-control"
                        id="zip_code"
                        name="zip_code"
                        value="{{ $user->zip_code }}"
                      />
                    </div>
                  </div>
                  {{-- <div class="col-md-6">
                    <div class="form-group">
                      <label for="country">Country</label>
                      <input
                        type="text"
                        class="form-control"
                        id="country"
                        name="country"
                        value="{{ $user->country }}"
                      />
                    </div>
                  </div> --}}
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="phone_number">No.Handphone</label>
                      <input
                        type="text"
                        class="form-control"
                        id="phone_number"
                        name="phone_number"
                        value="{{ $user->phone_number }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Foto Profile</label>
                          <input accept="image/*" type="file" name="profile_picture" class="form-control" />
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button type="submit" class="btn btn-success px-5">
                      Save now
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('addon-script')

<script src="{{ url('/vendor/vue/vue.js') }}"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script>
  var provincesId = @json($user->provinces_id ?? null);
  var regenciesId = @json($user->regencies_id ?? null);
  var districtsId = @json($user->districts_id ?? null);
</script>

  <script>
    var locations = new Vue({
      el: "#locations",
      mounted() {
        AOS.init();
        this.getProvincesData();
        this.getRegenciesData();
        this.getDistrictsData();
      },
      data: {
        provinces: null,
        regencies: null,
        districts: null,
        provinces_id : provincesId,
        regencies_id : regenciesId,
        districts_id: districtsId,
      },
      methods:{
        getProvincesData() {
          var self = this;
          axios.get('{{ route('api-provinces') }}')
            .then(function(response){
              self.provinces = response.data;
            })
        },
        getRegenciesData(){
          var self = this;
          axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
            .then(function(response){
              self.regencies = response.data;
            })
        },
        getDistrictsData(){
          var self = this;
          axios.get('{{ url('api/districts') }}/' + self.regencies_id)
            .then(function(response){
              self.districts = response.data;
            });
        }
      },
      watch: {
        provinces_id: function(val, oldVal) {
          this.regencies_id = null;
          this.getRegenciesData();
        },
        regencies_id: function(val, oldVal) {
          this.districts_id = null;
          this.getDistrictsData();
        }
      }
    }); 

  </script>

@endpush