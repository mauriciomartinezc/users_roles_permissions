<div class="row container justify-content-between align-items-center">
    <div class="col-sm-6 col-md-2">

    </div>
</div>

<table class="table table-striped" aria-label="sessions">
    <thead>
    <tr>
        <th scope="col" class="text-center">{{__('IP Address')}}</th>
        <th scope="col" class="text-center">{{__('Agent')}}</th>
        <th scope="col" class="text-center">{{__('Created at')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sessions as $session)
        <tr>
            <td class="text-center">{{$session->ip_address}}</td>
            <td class="text-center">{{$session->user_agent}}</td>
            <td class="text-center">{{$session->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@if (count($sessions))
    <div class="row container justify-content-center">
        {{ $sessions->links() }}
    </div>
@endif
