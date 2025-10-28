<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Nieuwe Todo</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
  <header>
    <h1>Nieuwe Todo maken</h1>
    <nav><a href="{{ route('todos.index') }}">Terug naar overzicht</a></nav>
  </header>

  <main>
    @if($errors->any())
      <div style="color: red;">
        <strong>Fouten:</strong>
        <ul>
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('todos.store') }}">
      @csrf
      <div>
        <label for="title">Titel</label>
        <input id="title" name="title" value="{{ old('title') }}" required>
      </div>

      <div>
        <label for="description">Beschrijving</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
      </div>

      <button type="submit">Opslaan</button>
    </form>
  </main>
</body>
</html>
