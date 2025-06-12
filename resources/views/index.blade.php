<!DOCTYPE html>
<html>
<head>
    <title>Simple CRUD</title>
</head>
<body>
    <h2>Add User</h2>
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
    <form method="POST" action="/store">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Add</button>
    </form>

    <h2>User List</h2>
    <ul>
        @foreach($users as $user)
            <li>
                {{ $user->name }} ({{ $user->email }})
                <a href="/edit/{{ $user->id }}">Edit</a>
                <a href="/delete/{{ $user->id }}">Delete</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
