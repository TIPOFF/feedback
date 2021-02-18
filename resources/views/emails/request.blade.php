@component('mail::message')
    Hi {{ $name }},

    Win a $250 Amazon gift card and free tickets to The Great Escape Room by providing feedback below. We hope you had a great time!

    Please click a face below to provide feedback:

    @component('mail::rate', ['negative' => $negative, 'seminegative' => $seminegative, 'semipositive' => $semipositive, 'positive' => $positive])
    @endcomponent

    Thank you,

    Kirk Eppenstein, COO
@endcomponent
