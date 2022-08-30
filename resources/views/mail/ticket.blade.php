Имя: <b>{{ $ticket->user->name }}</b>
<br>
Почта: <b>{{ $ticket->user->email }}</b>
<br>
<h1>Тема:</h1>
{{ $ticket->topic }}
<h2>Сообщение:</h2>
{{ $ticket->message }}
