<x-mail::message>
# Introduction

Beste {{ $user->name }},

Je bent uitgenodigd om je aan te melden.
Via de onderstaande knop kan je je aanmelding voltooien

<x-mail::button :url="$link">
Aanmelding afronden
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
