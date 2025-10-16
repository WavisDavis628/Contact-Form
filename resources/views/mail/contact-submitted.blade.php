@php use Illuminate\Support\Str; @endphp

@component('mail::message')
# New Contact Submission

**Name:** {{ $s->name }}  
**Email:** {{ $s->email }}  
**Subject:** {{ $s->subject }}

---

**Message**

{{ $s->message }}

---

**Meta**

- IP: {{ $s->ip ?? 'n/a' }}
- User-Agent: {{ Str::limit($s->user_agent ?? '', 160) }}
- Sent at: {{ $s->created_at->toDayDateTimeString() }}

@endcomponent
