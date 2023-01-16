@extends('layouts.admin')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0 text-dark">
            {{ __('admin_company.company') }}
          </h1>
        </div>
      </div>
    </div>
  </div>
  <div class="content" id = "vue-company-create">
    <div class="container-fluid">
      <div>
        {{ Form::open(['route' => 'admin.company.store', 'method' => 'POST',  'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4">
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">
                    {{ __('admin_company.name') }}(*)
                  </label>
                  <div class="col-sm-4">
                    {{
                      Form::text(
                        'name',
                        $company->name,
                        [
                          'class' => 'form-control',
                          'required' => 'required',
                          'autocomplete' => 'off'
                        ]
                      )
                    }}
                    @error('name')
                      <p class="help-block text-danger mb-2">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">
                    {{ __('admin_company.email') }}
                  </label>
                  <div class="col-sm-4">
                    {{
                      Form::text(
                        'email',
                        $company->email,
                        [
                          'class' => 'form-control',
                          'autocomplete' => 'off'
                        ]
                      )
                    }}
                    @error('email')
                      <p class="help-block text-danger mb-2">{{ $message }}</p>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">
                    {{ __('admin_company.logo') }}
                  </label>
                  <div class="col-sm-4">
                    {{
                      Form::file(
                        'logo',
                        null,
                        [
                          'class' => 'form-control',
                          'autocomplete' => 'off'
                        ]
                      )
                    }}
                    @error('logo')
                      <p class="help-block text-danger mb-2">{{ $message }}</p>
                    @enderror
                    <br/>
                    <img src="{{ URL::asset('storage/' .$company->logo) }}" alt="" width="100">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">
                    {{ __('admin_company.website') }}
                  </label>
                  <div class="col-sm-4">
                    {{
                      Form::text(
                        'website',
                        $company->website,
                        [
                          'class' => 'form-control',
                          'autocomplete' => 'off'
                        ]
                      )
                    }}
                    @error('website')
                      <p class="help-block text-danger mb-2">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="d-flex justify-content-center w-100">
            <div class="col-sm-2">
              <a href="javascript:void(0)" class="btn btn-block btn-flat btn-outline-dark"
                 v-on:click="confirmBack('{{ route('admin.company.index') }}')">
                {{ __('common.cancel') }}
              </a>
            </div>
            <div class="col-sm-2">
              {{
                Form::submit(
                  __('common.register'),
                  [
                    'class' => 'btn btn-block btn-flat btn-dark'
                  ]
                )
              }}
            </div>
          </div>
        </div>
        {{ Form::hidden('id', $company->id) }}
        {{ Form::close() }}
      </div>
    </div>
    @include('modal.admin_confirm')
  </div>

@endsection

@section('script')
  <script>
    window.msgConfirmBack = '{{ __('admin_company.are you sure to return company screen?') }}';
    window.msgModalBtnYesText = '{{ __('common.yes') }}';
    window.msgModalBtnNoText = '{{ __('common.no') }}';
  </script>
  <script src="{{ mix('js/admin/company/create_update.js') }}" defer></script>
@endsection
