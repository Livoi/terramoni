<!DOCTYPE html>
<html>
<head>
    <title>Agent Selection</title>
    <style>
        /* Center the buttons */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Adjust this value to set the desired height */
        }

        /* Style for the buttons */
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .button-container button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="button-container">
        <button onclick="window.location.href = '{{ route('SelfRegister') }}';">Individual Agents</button>
        <button onclick="window.location.href = '{{ route('CompSelfRegister') }}';">Non-Individual Agents</button>
    </div>
</body>
</html>
