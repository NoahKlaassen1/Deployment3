<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Todo - Overzicht</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
  <header>
    <h1>Todo App — Overzicht</h1>
    <nav>
      <a href="{{ route('todos.create') }}">Nieuwe Todo</a>
    </nav>
  </header>

  <main>
    @if(session('success'))
      <div role="status" style="color: green; margin-bottom: 1rem;">{{ session('success') }}</div>
    @endif

    @if($todos->isEmpty())
      <p>Geen todo's gevonden. Maak er één!</p>
    @else
      <ul>
        @foreach($todos as $todo)
          <li style="margin-bottom: .5rem;">
            <strong>
              <a href="{{ route('todos.show', $todo) }}">
                {{ $todo->title }}
              </a>
            </strong>
            @if($todo->done) <span style="color: green;">(klaar)</span> @endif
            <div style="margin-top:.25rem;">
              <a href="{{ route('todos.edit', $todo) }}">edit</a>
              <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline; margin-left: .5rem;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Weet je het zeker?')">verwijder</button>
              </form>
            </div>
          </li>
        @endforeach
      </ul>
    @endif
  </main>
</body>
</html>
