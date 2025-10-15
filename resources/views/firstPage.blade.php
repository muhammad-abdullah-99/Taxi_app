<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e6f7ff;
            padding: 20px;
        }
        .otp-container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .otp-input {
            font-size: 20px;
            text-align: center;
            letter-spacing: 5px;
        }
        .confirm-btn {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .confirm-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="otp-container">
    <h2>تأكيد رمز OTP</h2>
    <form action="{{ route('verify.otp') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="otp" class="form-label">أدخل رمز OTP المرسل إليك</label>
            <input type="text" id="otp" name="otp" class="form-control otp-input" maxlength="6" required>
            @if ($errors->has('otp'))
                <div class="alert alert-danger mt-2">{{ $errors->first('otp') }}</div>
            @endif
        </div>
        <button type="submit" class="btn confirm-btn w-100">تأكيد</button>
        <div class="m-3">

<a class="btn btn-danger  w-200" href="{{route('logout')}}"><i class="text-danger ti-unlock"></i>تسجيل الخروج</a>
</div>
    </form>
 
</div>





</body>
</html>
