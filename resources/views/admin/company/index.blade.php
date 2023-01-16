@extends('layouts.admin')

@section('content')
  <div id="vue-company-index">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0 text-dark">
            {{ __('admin_company.company list') }}
          </h1>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="row mb-3">
            <div class="col-sm-2 offset-sm-10">
              {{
                Html::linkRoute(
                  'admin.company.create',
                  __('common.create'),
                  null,
                  ['class' => 'btn btn-block btn-flat btn-dark']
                )
              }}
            </div>
          </div>
          <table class="table table-bordered bg-alto-0">
            <thead>
              <tr class="bg-alto-1">
                <th>{{ __('admin_company.no') }}</th>
                <th>{{ __('admin_company.name') }}</th>
                <th>{{ __('admin_company.email') }}</th>
                <th>{{ __('admin_company.logo') }}</th>
                <th>{{ __('admin_company.website') }}</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            @forelse ($companies as $company)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td><img src="{{ URL::asset('storage/' .$company->logo) }}" alt="" width="100"></td>
                <td>{{ $company->website }}</td>
                <td>
                  {{
                    Html::linkRoute(
                      'admin.company.edit',
                      __('common.edit'),
                      ['company' => $company->id],
                      ['class' => 'text-primary']
                    )
                  }}
                  <br/>
                  {{
                    Form::open([
                      'method' => 'DELETE',
                      'route' => [
                        'admin.company.destroy',
                        ['company' => $company->id]
                      ]
                    ])
                  }}
                  <a class="text-danger" href="javascript:void(0)"
                     v-on:click="openModalConfirmRemoveCompany"
                  >
                    {{ __('common.delete') }}
                  </a>
                  {{ Form::close() }}
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">{{ __('message.no item were found') }}</td>
              </tr>
            @endforelse
            </tbody>
          </table>
          {{ $companies->links('pagination.admin') }}
        </div>
      </div>
    </div>
  </div>
    @include('modal.admin_confirm')
  </div>
@endsection
@section('script')
  <script>
    window.msgConfirmRemove = "{{ __("admin_company.Are you sure to remove company?") }}";
    window.msgModalBtnYesText = "{{ __("common.yes") }}";
    window.msgModalBtnNoText = "{{ __("common.no") }}";
  </script>
  <script src="{{ mix('js/admin/company/index.js') }}" defer></script>
@endsection
