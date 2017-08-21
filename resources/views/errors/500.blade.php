@extends('layouts.app')

@section('content')
<div class="content">
    <div class="title">Something went wrong.</div>
    @unless (empty($sentryId))
        <!-- Sentry JS SDK 2.1.+ required -->
        <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>

        <script>
        Raven.showReportDialog({
            eventId: '{{ $sentryId }}',

            // use the public DSN (don't include your secret!)
            dsn: 'https://f24138bbf0694aadb9a764497a9a71d1@sentry.io/206321'
        });
        </script>
    @endunless
</div>
@endsection
