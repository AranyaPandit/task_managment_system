<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Additional styles for better visual consistency */
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="file"] {
            padding: 5px;
        }

        select:focus,
        .input:focus,
        .btn-primary:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Profile</h2>
        <form method="POST" action="{{ route('update', ['id' => $user->id]) }}" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="form-group"> 
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="email">Phone</label>
                <input type="phone" name="phone" id="email" class="form-control" value="{{ $user->phone }}" required>
            </div>
            <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <label for="role">Choose the role you</label>
            <select name="role" id="role" class="form-control" required>
            <option value="1" {{ old('role', $user->role) === '1' ? 'selected' : '' }}>Admin</option>
            <option value="0" {{ old('role', $user->role) === '0' ? 'selected' : '' }}>User</option>
        </select>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</body>
</html>
