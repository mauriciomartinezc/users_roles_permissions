@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__('Update')}} {{ __('permission') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('permissions.update', $permission) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mb-2">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ $permission->name }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="roles"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Roles') }}</label>
                                <div class="col-md-6">
                                    <select id="roles" name="roles[]"
                                            class="form-control @error('roles') is-invalid @enderror" multiple
                                            size="20">
                                        @foreach($permission->roles as $role)
                                            <option value="{{$role->id}}"
                                                {{in_array($role->id, $permission->roles->pluck('id')->toArray(), true) ? 'selected' : null}}
                                            >
                                                {{$role->name}}
                                            </option>
                                        @endforeach
                                        @foreach($roles as $role)
                                            @if(!in_array($role->id, $permission->roles->pluck('id')->toArray(), true))
                                                <option value="{{$role->id}}"
                                                    {{in_array($role->id, $permission->roles->pluck('id')->toArray(), true) ? 'selected' : null}}
                                                >
                                                    {{$role->name}}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('roles')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div
                                class="btn-group container row justify-content-center align-content-center align-items-center"
                                role="group">
                                <div class="col-2">
                                    <a href="{{route('permissions.index')}}">
                                        <button type="button" class="btn btn-danger">
                                            {{ __('Cancel') }}
                                        </button>
                                    </a>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
