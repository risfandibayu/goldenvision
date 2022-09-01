<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th scope="col">@lang('User')</th>
                <th scope="col">@lang('Username')</th>
                <th scope="col">@lang('BRO')</th>
                <th scope="col">@lang('Email')</th>
                <th scope="col">@lang('Phone')</th>
                <th scope="col">@lang('Joined At')</th>
            </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td data-label="@lang('User')">
                            <span class="name">{{$user->fullname}}</span>
                    </td>
                    <td data-label="@lang('Username')">{{ $user->username }}</td>
                    <td data-label="@lang('BRO')">
                        @if ($user->no_bro == 0)
                        <small>Not subscribed yet</small>
                        @else
                        {{ $user->no_bro }}
                        @endif
                    </td>
                    <td data-label="@lang('Email')">{{ $user->email }}</td>
                    <td data-label="@lang('Phone')">{{ $user->mobile }}</td>
                    <td data-label="@lang('Joined At')">{{ showDateTime($user->created_at) }}</td>
                </tr>
                @empty
                    <tr>
                        <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                    </tr>
                @endforelse

                </tbody>
    </table>
</body>
</html>