<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f7f9fc; font-family: Arial, sans-serif;">

    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <form method="POST" action="{{ route('verify') }}"
            style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px;">

            @csrf
            <input type="hidden" name="email" value="{{ $user->email }}">

            <h2 style="margin-bottom: 20px; text-align: center; color: #333;">Verify Your Email</h2>

            <label for="verification_code"
                style="display: block; margin-bottom: 8px; font-weight: bold; color: #555;">Verification Code</label>
            <input type="text" name="verification_code" id="verification_code" required
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 12px;">

            @error('verification_code')
                <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
            @enderror

            <button type="submit"
                style="width: 100%; padding: 12px; background-color: #2d89ef; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                Verify
            </button>

        </form>
    </div>

</body>

</html>