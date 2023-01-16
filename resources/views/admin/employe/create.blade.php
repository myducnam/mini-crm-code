@extends('layouts.admin')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0 text-dark">
            {{ __('admin_employe.employe') }}
          </h1>
        </div>
      </div>
    </div>
  </div>
  <div class="content" id = "vue-employe-create">
    <div class="container-fluid">
      <div>
        {{ Form::open(['route' => 'admin.employe.store', 'method' => 'POST',  'class' => 'form-horizontal']) }}
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4">
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">
                    {{ __('admin_employe.first_name') }}(*)
                  </label>
                  <div class="col-sm-4">
                    {{
                      Form::text(
                        'first_name',
                        null,
                        [
                          'class' => 'form-control',
                          'required' => 'required',
                          'autocomplete' => 'off'
                        ]
                      )
                    }}
                    @error('first_name')
                      <p class="help-block text-danger mb-2">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">
                    {{ __('admin_employe.last_name') }}(*)
                  </label>
                  <div class="col-sm-4">
                    {{
                      Form::text(
                        'last_name',
                        null,
                        [
                          'class' => 'form-control',
                          'required' => 'required',
                          'autocomplete' => 'off'
                        ]
                      )
                    }}
                    @error('last_name')
                      <p class="help-block text-danger mb-2">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">
                    {{ __('admin_employe.email') }}
                  </label>
                  <div class="col-sm-4">
                    {{
                      Form::text(
                        'email',
                        null,
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
                    {{ __('admin_employe.phone') }}
                  </label>
                  <div class="col-sm-4">
                    {{
                      Form::text(
                        'phone',
                        null,
                        [
                          'class' => 'form-control',
                          'autocomplete' => 'off'
                        ]
                      )
                    }}
                    @error('phone')
                      <p class="help-block text-danger mb-2">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">
                    {{ __('admin_employe.company') }}
                  </label>
                  <div class="col-sm-4">
                    {{
                      Form::select(
                        'company_id',
                        $configs['companies'],
                        [
                          'class' => 'form-control'
                        ]
                      )
                    }}
                    @error('company_id')
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
                 v-on:click="confirmBack('{{ route('admin.employe.index') }}')">
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
        {{ Form::close() }}
      </div>
    </div>
    @include('modal.admin_confirm')
  </div>

@endsection

@section('script')
  <script>
    window.msgConfirmBack = '{{ __('admin_employe.are you sure to return employe screen?') }}';
    window.msgModalBtnYesText = '{{ __('common.yes') }}';
    window.msgModalBtnNoText = '{{ __('common.no') }}';
  </script>
  <script src="{{ mix('js/admin/employe/create_update.js') }}" defer></script>
@endsection
