<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Todo bewerken</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
  <header>
    <h1>Todo bewerken</h1>
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

    <form method="POST" action="{{ route('todos.update', $todo) }}">
      @csrf
      @method('PUT')

      <div>
        <label for="title">Titel</label>
        <input id="title" name="title" value="{{ old('title', $todo->title) }}" required>
      </div>

      <div>
        <label for="description">Beschrijving</label>
        <textarea id="description" name="description">{{ old('description', $todo->description) }}</textarea>
      </div>

      <div>
        <label for="done">Klaar?</label>
        <input id="done" type="checkbox" name="done" value="1" @if(old('done', $todo->done)) checked @endif>
      </div>

      <button type="submit">Bijwerken</button>
    </form>
  </main>
</body>
</html>
