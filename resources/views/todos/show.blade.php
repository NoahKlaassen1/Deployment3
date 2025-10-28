<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Todo - Bekijken</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
  <header>
    <h1>Todo bekijken</h1>
    <nav>
      <a href="{{ route('todos.index') }}">Terug naar overzicht</a>
      <a href="{{ route('todos.edit', $todo) }}" style="margin-left: .5rem;">Bewerk</a>
    </nav>
  </header>

  <main>
    <article>
      <h2>{{ $todo->title }}</h2>
      <p>{{ $todo->description }}</p>
      <p>Status: <strong>{{ $todo->done ? 'Klaar' : 'Open' }}</strong></p>
      <p>Aangemaakt: {{ $todo->created_at->format('d-m-Y H:i') }}</p>
    </article>
  </main>
</body>
</html>
