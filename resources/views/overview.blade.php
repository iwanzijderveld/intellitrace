@extends('intellitrace::layouts.app')
@section('content')
<h2>{{ __('intellitrace::tracing.overview') }}</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('intellitrace::tracing.ip') }}</th>
                <th>{{ __('intellitrace::tracing.isp') }}</th>
                <th>{{ __('intellitrace::tracing.city') }}</th>
                <th>{{ __('intellitrace::tracing.organisation') }}</th>
                <th>{{ __('intellitrace::tracing.postalcode') }}</th>
                <th>{{ __('intellitrace::tracing.timestamp') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $visitor->ip }}</td>
                <td>{{ $visitor->ISP }}</td>
                <td>{{ $visitor->city }}</td>
                <td>{{ $visitor->organisation }}</td>
                <td>{{ $visitor->postalcode }}</td>
                <td>{{ $visitor->timestamp->format('d-m-Y H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection