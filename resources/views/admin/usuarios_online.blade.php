@extends('layouts.admin')
@section('title', 'Usuários Online')
@section('content')


    <h2 class="text-left">Usuários Online</h2>


    <div class="py-5 mt-5">
        <div class="table-responsive">
            <table class="table table-bordered data-table mt-4 mb-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Último Acesso</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @if (Cache::has('user-is-online-' . $user->id))
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                </td>
                                <td>
                                    @if (Cache::has('user-is-online-' . $user->id))
                                        <span class="text-success">Online</span>
                                    @else
                                        <span class="text-secondary">Offline</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>

@stop
