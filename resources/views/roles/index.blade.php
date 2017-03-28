@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('message'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Info:</strong> {{ session('message') }}.
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Roles</h1></div>

                    <div class="panel-body">
                        These are all of the roles for this page management<br><br>

                         @if(Auth::user()->roles->hasPermissionTo[0]('CreateRole') or Auth::user()->can('CreateRole'))
                            <a href="{{ url('/roles/create') }}" class="btn btn-success">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a><br><br>
                        @endif


                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th width="10%" colspan="3">Manage</th>
                            </tr>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a href="{{ url('roles/'.$role->id.'/permissions') }}" class="btn btn-warning">
                                            <i class="fa fa-id-card"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger"
                                                data-action="{{ url('/roles/'.$role->id) }}"
                                                data-name="{{ $role->name }}"
                                                data-toggle="modal" data-target="#confirm-delete">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-center">
                                    {{ $roles->links() }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1"
         role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">
                    <p>You really want to remove this role?</p>
                    <p class="name"></p>
                </div>
                <div class="modal-footer">
                    <form class="form-inline form-delete"
                          role="form"
                          method="POST"
                          action="{{ url('/roles/'.$role->id) }}">
                        {!! method_field('DELETE') !!}
                        {!! csrf_field() !!}
                        <button type="button"
                                class="btn btn-default"
                                data-dismiss="modal">Cancel
                        </button>
                        @if(Auth::user()->roles[0]->hasPermissionTo('DeleteRole') or Auth::user()->can('DeleteRole'))
                            <button id="delete-btn"
                                    class="btn btn-danger"
                                    title="Delete">Delete
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
