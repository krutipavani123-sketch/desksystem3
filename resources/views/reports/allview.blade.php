@extends('layout')
@section('title', 'Reports List')

@section('main')

<div class="page-wrapper">
    <div class="card-box">

        <div class="header-bar">
            <h2>📊 Reports List</h2>
        </div>

        <table class="table table-bordered table-sm">

            <thead>
                <tr>
                    <th>No</th>
                    <th>File Name</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($reports as $report)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $report['name'] }}
                        </td>

                        <td>

                            {{-- VIEW --}}
                            <a href="{{ asset('storage/' . $report['file']) }}"
                               target="_blank"
                               class="action-btn">
                                👁 View
                            </a>

                            {{-- DOWNLOAD --}}
                            <a href="{{ asset('storage/' . $report['file']) }}"
                               download
                               class="action-btn">
                                ⬇ Download
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            No reports found
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>

@endsection