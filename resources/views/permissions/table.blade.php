<div class="row container justify-content-between align-items-center">
    <div class="col-sm-6 col-md-2">
        <a href="{{route('permissions.create')}}">
            <button type="button" class="btn btn-primary">
                {{__('Create')}} {{__('permission')}}
            </button>
        </a>
    </div>
</div>

<table class="table table-striped" aria-label="permissions">
    <thead>
    <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col" class="text-center">{{__('Name')}}</th>
        <th scope="col" class="text-center">{{__('Actions')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($permissions as $permission)
        <tr>
            <th scope="row" class="text-center">{{$permission->id}}</th>
            <td class="text-center">{{$permission->name}}</td>
            <td class="text-center">
                <div class="row container justify-content-between">
                    <div class="col-xs-12 col-lg-6">
                        <a href="{{route('permissions.show', $permission)}}">
                            <button type="button" class="btn btn-primary">
                                {{__('Edit')}} {{__('permission')}}
                            </button>
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <form method="POST" action="{{route('permissions.destroy', $permission)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                {{__('Delete')}} {{__('permission')}}
                            </button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@if (count($permissions) > 0)
    <div class="row container justify-content-center">
        {{ $permissions->links() }}
    </div>
@endif
