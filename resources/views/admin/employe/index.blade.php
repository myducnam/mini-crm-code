@extends('layouts.admin')

@section('content')
  <div id="vue-employe-index">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0 text-dark">
            {{ __('admin_employe.employe list') }}
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
                  'admin.employe.create',
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
                <th>{{ __('admin_employe.no') }}</th>
                <th>{{ __('admin_employe.first_name') }}</th>
                <th>{{ __('admin_employe.last_name') }}</th>
                <th>{{ __('admin_employe.email') }}</th>
                <th>{{ __('admin_employe.phone') }}</th>
                <th>{{ __('admin_employe.company_id') }}</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            @forelse ($employees as $employe)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $employe->firstName }}</td>
                 <td>{{ $employe->lastName }}</td>
                <td>{{ $employe->email }}</td>
                <td>{{ $employe->phone }}</td>
                <td>{{ $employe->company }}</td>
                <td>
                  {{
                    Html::linkRoute(
                      'admin.employe.edit',
                      __('common.edit'),
                      ['employe' => $employe->id],
                      ['class' => 'text-primary']
                    )
                  }}
                  <br/>
                  {{
                    Form::open([
                      'method' => 'DELETE',
                      'route' => [
                        'admin.employe.destroy',
                        ['employe' => $employe->id]
                      ]
                    ])
                  }}
                  <a class="text-danger" href="javascript:void(0)"
                     v-on:click="openModalConfirmRemoveEmploye"
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
          {{ $employees->links('pagination.admin') }}
        </div>
      </div>
    </div>
  </div>
    @include('modal.admin_confirm')
  </div>
@endsection
@section('script')
  <script>
    window.msgConfirmRemove = "{{ __("admin_employe.are you sure to remove employe?") }}";
    window.msgModalBtnYesText = "{{ __("common.yes") }}";
    window.msgModalBtnNoText = "{{ __("common.no") }}";
  </script>
  <script src="{{ mix('js/admin/employe/index.js') }}" defer></script>
@endsection
