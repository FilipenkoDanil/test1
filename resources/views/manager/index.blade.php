@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Tickets</h2>
            <br>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Topic</th>
                    <th scope="col">Message</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">File</th>
                    <th scope="col">Answered</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <th scope="row">{{ $ticket->id }}</th>
                        <td>{{ $ticket->topic }}</td>
                        <td>{{ $ticket->message }}</td>
                        <td>{{ $ticket->user->name }}</td>
                        <td>{{ $ticket->user->email }}</td>
                        <td>@if($ticket->file)<a href="{{ route('download', basename($ticket->file)) }}" target="_blank">Download</a> @endif</td>
                        <td><input type="checkbox" class="form-check-input checkbox" data-id="{{ $ticket->id }}" @if($ticket->isAnswered) checked @endif"></td>
                        <td>{{ \Illuminate\Support\Carbon::parse($ticket->created_at)->diffForHumans() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

@section('custom_js')
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('.checkbox').click(function () {
                $.ajax({
                    url: "{{ route('change') }}",
                    type: "POST",
                    data: {
                        id: $(this).data('id')
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                })
            })
        })
    </script>
@endsection
