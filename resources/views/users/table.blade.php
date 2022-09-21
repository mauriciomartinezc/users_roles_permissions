<div class="row container justify-content-between align-items-center">
    <div class="col-sm-6 col-md-2">
        <a href="{{route('users.create')}}">
            <button type="button" class="btn btn-primary">
                {{__('Create')}} {{__('user')}}
            </button>
        </a>
    </div>
</div>

<table class="table table-striped" aria-label="users">
    <thead>
    <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col" class="text-center">{{__('First name')}}</th>
        <th scope="col" class="text-center">{{__('Last name')}}</th>
        <th scope="col" class="text-center">{{__('Email Address')}}</th>
        <th scope="col" class="text-center">{{__('Phone')}}</th>
        <th scope="col" class="text-center">{{__('Role')}}</th>
        <th scope="col" class="text-center">{{__('Actions')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row" class="text-center">{{$user->id}}</th>
            <td class="text-center">{{$user->first_name}}</td>
            <td class="text-center">{{$user->last_name}}</td>
            <td class="text-center">{{$user->email}}</td>
            <td class="text-center">{{$user->phone}}</td>
            <td class="text-center">{{$user->role->name}}</td>
            <td class="text-center">
                <div class="row container justify-content-between">
                    <div class="col-xs-12 col-lg-6">
                        <a href="{{route('users.show', $user)}}">
                            <button type="button" class="btn btn-primary">
                                {{__('Edit')}} {{__('user')}}
                            </button>
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <form method="POST" action="{{route('users.destroy', $user)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                {{__('Delete')}} {{__('user')}}
                            </button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@if (count($users))
    <div class="row container justify-content-center">
        {{ $users->links() }}
    </div>
@endif
