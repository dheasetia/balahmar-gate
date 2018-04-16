@component('mail::message')
 # سعادة مدير  {{$user->office->name}} وفقه الله،

 السلام عليكم ورحمة الله وبركاته. <br>
 <span>تفيدكم مؤسسة سالم أحمد بالحمر وعائلته الخيرية  بالموافقة على المساهمة قدره: </span> <span><strong>{{$project->donation_approved}} ر.س </strong> <span>({{$project->donation_approved_in_words}} ريال سعودي)</span></span>
 <span>وذلك لمشروع: </span> <span><strong> {{$project->name}} </strong></span>.
 @if($project->donation_purpose != '')
 <span>وتكون مخصصة في:  {{$project->donation_purpose}}</span>
 @endif
@component('mail::button', ['url' => url('/'), 'color' => 'balahmar'])
الذهاب للبوابة
@endcomponent

  دمتم في رعاية الله...<br>
مع تحية مجلس الأمناء بمؤسسة سالم بن أحمد بالحمر وعائلته الخيرية.
@endcomponent