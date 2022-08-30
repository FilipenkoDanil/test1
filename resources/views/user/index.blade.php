@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card p-3">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @elseif(\Session::has('error'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{!! \Session::get('error') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('create-ticket') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Тема</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="topic" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Сообщение</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="message" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Файл</label>
                            <input class="form-control" type="file" name="file" id="formFile">
                        </div>
                        <button type="submit" class="btn btn-danger" @if($days == 0) disabled @endif>Отправить</button>
                        @if($days == 0)
                            <p class="text-danger">Заявку можно отправлять раз в сутки.</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
