<div class="col-6">
    <img src="{{$message->image}}" alt="" class="img-thumnnail">
    <p class="card-text">
        {{$message->content}}
    </p>
    <div class="text-muted">
        Escrito por <a href="/user/{{$message->user->username}}">{{$message->user->name}}</a>
    </div>
    <p>{{$message->created_at}}</p>
    <a href="/message/{{$message->id}}">Leer mas</a>
</div>