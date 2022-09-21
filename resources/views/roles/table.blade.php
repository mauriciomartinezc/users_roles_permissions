<div class="row container justify-content-between align-items-center">
    <div class="col-sm-6 col-md-2">
        <a href="{{route('roles.create')}}">
            <button type="button" class="btn btn-primary">
                {{__('Create')}} {{__('role')}}
            </button>
        </a>
    </div>
</div>

<table class="table table-striped" aria-label="roles">
    <thead>
    <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col" class="text-center">{{__('Name')}}</th>
        <th scope="col" class="text-center">{{__('Actions')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <th scope="row" class="text-center">{{$role->id}}</th>
            <td class="text-center">{{$role->name}}</td>
            <td class="text-center">
                <div class="row container justify-content-between">
                    <div class="col-xs-12 col-lg-6">
                        <a href="{{route('roles.show', $role)}}">
                            <button type="button" class="btn btn-primary">
                                {{__('Edit')}} {{__('role')}}
                            </button>
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <form method="POST" action="{{route('roles.destroy', $role)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                {{__('Delete')}} {{__('role')}}
                            </button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@if (count($roles) > 0)
    <div class="row container justify-content-center">
        {{ $roles->links() }}
    </div>
@endif
