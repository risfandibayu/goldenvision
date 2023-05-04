<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table class="table table--light style--two">
        <thead>
            <tr>
                <th scope="col">@lang('No.')</th>
                {{-- <th scope="col">@lang('Code')</th> --}}
                <th scope="col">@lang('Username')</th>
                <th scope="col">@lang('Gram Emas Check In 100 hari ')</th>
                <th scope="col">@lang('Equal Rupiah')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($table as $key)
                <tr>
                    <td data-label="@lang('No')">{{ $key['no'] }}</td>
                    <td data-label="@lang('user')">
                        {{ $key['username'] }}
                    </td>
                    <td data-label="@lang('user')">
                        {{ $key['gold'] }}
                    </td>
                    <td data-label="@lang('user')">
                        {{ nb($key['harga']) }}
                    </td>
                </tr>
                @foreach

        </tbody>
    </table>
</body>

</html>
