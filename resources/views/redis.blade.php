<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Redis</title>

    </head>
    <body>
        <h1>Learning redis!</h1>
        <table>
            <thead>
                <th>Key</th>
                <th>Value</th>
            </thead>
            <tbody>
                @foreach($array as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
