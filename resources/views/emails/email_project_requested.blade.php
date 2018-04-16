@component('mail::message')
    # سعادة مدير  {{$user->office->name}} وفقه الله،

السلام عليكم ورحمة الله وبركاته.
<br><span>ترجو مؤسسة سالم أحمد بالحمر وعائلته الخيرية  تزويدنا بـ: </span> <span><strong> {{$project->requested_detail}} </strong></span>.
<span>حتى يتم النظر في مشروعكم: </span>
<strong>{{$project->name}}.</strong>
<br><span>يمكنكم التواصل معنا عبر الرسائل الداخلية في البوابة.</span>
@component('mail::button', ['url' => url('/'), 'color' => 'balahmar'])
        الذهاب للبوابة
@endcomponent

دمتم في رعاية الله...<br>
    مع تحية مجلس الأمناء بمؤسسة سالم بن أحمد بالحمر وعائلته الخيرية.
@endcomponent