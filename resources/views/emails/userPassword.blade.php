<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>DETALLES DE CUENTA</h1>

    <p>
        Querid@ {{ $user->name }}.
    </p>

    <p>
        <strong>Usuario: </strong> {{ $user->email }}
    </p>
    <p>
        <strong>Contraseña: </strong> {{ $clave }}
    </p>

    <p>
        <div>
            <strong>
                <h4>
                    {{ env('APP_NAME') }}
                </h4>
            </strong>
        </div>
    </p>
</body>
</html>
