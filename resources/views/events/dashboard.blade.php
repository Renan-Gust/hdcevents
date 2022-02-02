@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus eventos</h1>
    </div>

    <div class="col-md-10-offset-md-1 dashboard-events-container">
        @if(count($events) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Participantes</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td scope="row">
                                    <a href="/events/{{ $event->id }}"></a>
                                    {{ $event->title }}
                                </td>
                                <td scope="row">
                                    {{ count($event->users) }}
                                </td>
                                <td scope="row">
                                    <a href="/events/edit/{{ $event->id }}" class="btn btn-info edit-btn">
                                        <ion-icon name="create-outline"></ion-icon> 
                                        Editar
                                    </a>
                                    <form action="/events/{{ $event->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-btn">
                                            <ion-icon name="trash-outline"></ion-icon>
                                            Deletar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>
                Você ainda não tem eventos,
                <a href="/events/create">Criar evento</a>
            </p>
        @endif

        <div class="col-md-10 offset-md-1 dashboard-title-container">
            <h1>Eventos estou participando</h1>
        </div>

        <div class="col-md-10 offset-md-1 dashboard-events-container">
            @if(count($eventsAsParticipant) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Participantes</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($eventsAsParticipant as $event)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td scope="row">
                                    <a href="/events/{{ $event->id }}"></a>
                                    {{ $event->title }}
                                </td>
                                <td scope="row">
                                    {{ count($event->users) }}
                                </td>
                                <td scope="row">
                                    <form action="/event/leave/{{ $event->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-btn">
                                            <ion-icon name="trash-outline"></ion-icon>
                                            Sair do evento
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>
                    Você ainda não está participando de nenhum eventos,
                    <a href="/">Veja todos os eventos</a>
                </p>
            @endif
        </div>
    </div>
@endsection