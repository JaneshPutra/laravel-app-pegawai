{{-- resources/views/leaves/partials/table-row.blade.php --}}

<tr>
    <td>{{ $index + 1 }}</td>
    <td>
        <div class="d-flex align-items-center">
            @php
                $colors = ['#667eea', '#f093fb', '#4facfe', '#fa709a', '#30cfd0', '#fbc531', '#e74c3c'];
                $randomColor = $colors[array_rand($colors)];
                $initials = collect(explode(' ', $leave->employee->nama_lengkap))
                    ->map(fn($word) => strtoupper($word[0]))
                    ->take(2)
                    ->join('');
            @endphp
            <div class="avatar text-white mr-2" style="background: {{ $randomColor }};">
                {{ $initials }}
            </div>
            <div>
                <div class="font-weight-bold">{{ $leave->employee->nama_lengkap }}</div>
                <div class="text-small text-muted">
                    {{ $leave->employee->jabatan->nama_jabatan ?? '-' }}
                </div>
            </div>
        </div>
    </td>
    <td>
        @php
            $leaveTypes = [
                'sakit' => ['label' => 'Sakit', 'icon' => 'hospital', 'class' => 'warning'],
                'cuti' => ['label' => 'Cuti', 'icon' => 'plane', 'class' => 'info'],
                'izin' => ['label' => 'Izin', 'icon' => 'clipboard', 'class' => 'secondary'],
                'menikah' => ['label' => 'Menikah', 'icon' => 'heart', 'class' => 'danger'],
            ];
            $type = $leaveTypes[$leave->type] ?? ['label' => ucfirst($leave->type), 'icon' => 'file', 'class' => 'secondary'];
        @endphp
        <span class="badge badge-{{ $type['class'] }}">
            <i class="fas fa-{{ $type['icon'] }} mr-1"></i> {{ $type['label'] }}
        </span>
    </td>
    <td>
        <i class="fas fa-calendar text-muted mr-1"></i>
        {{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}
    </td>
    <td>
        <i class="fas fa-calendar text-muted mr-1"></i>
        {{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}
    </td>
    <td>
        @php
            $start = \Carbon\Carbon::parse($leave->start_date);
            $end = \Carbon\Carbon::parse($leave->end_date);
            $duration = $start->diffInDays($end) + 1;
        @endphp
        <span class="badge badge-primary">
            {{ $duration }} hari
        </span>
    </td>
    <td class="text-center">
        @if($leave->attachment)
            <a href="{{ asset('storage/' . $leave->attachment) }}" 
               target="_blank" 
               class="btn btn-info btn-sm"
               title="Lihat Lampiran">
                <i class="fas fa-paperclip"></i>
            </a>
        @else
            <span class="text-muted">-</span>
        @endif
    </td>
    <td id="status-{{ $leave->id }}">
        @if($leave->status === 'pending')
            {{-- Button Approve dan Reject untuk status pending --}}
            <div class="btn-group">
                <form action="{{ route('leaves.approve', $leave->id) }}" 
                      method="POST" 
                      class="d-inline form-approve"
                      data-id="{{ $leave->id }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" 
                            class="btn btn-success btn-sm btn-action"
                            title="Setujui">
                        <i class="fas fa-check mr-1"></i> ACC
                    </button>
                </form>
                <form action="{{ route('leaves.reject', $leave->id) }}" 
                      method="POST" 
                      class="d-inline form-reject ml-1"
                      data-id="{{ $leave->id }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" 
                            class="btn btn-danger btn-sm btn-action"
                            title="Tolak">
                        <i class="fas fa-times mr-1"></i> Tolak
                    </button>
                </form>
            </div>
        @elseif($leave->status === 'approved')
            {{-- Badge untuk status approved --}}
            <span class="badge badge-success" style="font-size: 12px; padding: 6px 12px;">
                <i class="fas fa-check-circle mr-1"></i> Disetujui
            </span>
        @elseif($leave->status === 'rejected')
            {{-- Badge untuk status rejected --}}
            <span class="badge badge-danger" style="font-size: 12px; padding: 6px 12px;">
                <i class="fas fa-times-circle mr-1"></i> Ditolak
            </span>
        @else
            <span class="badge badge-secondary" style="font-size: 12px; padding: 6px 12px;">
                {{ ucfirst($leave->status) }}
            </span>
        @endif
    </td>
    <td>
        @if($leave->approver)
            <div class="text-small">
                <i class="fas fa-user-check text-success mr-1"></i>
                {{ $leave->approver->name }}
            </div>
            <div class="text-muted" style="font-size: 11px;">
                {{ $leave->approved_at ? \Carbon\Carbon::parse($leave->approved_at)->format('d M Y H:i') : '-' }}
            </div>
        @else
            <span class="text-muted">-</span>
        @endif
        </td>
</tr>