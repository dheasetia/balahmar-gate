@component('mail::message')
 # سعادة مدير  {{$user->office->name}} وفقه الله،
 السلام عليكم ورحمة الله وبركاته. <br>
 <span>تفيدكم مؤسسة سالم أحمد بالحمر وعائلته الخيرية  بالموافقة على مشروع: </span> <span><strong>{{$project->name}} </strong>، بمبلغ قدره:  <span> <strong>{{$project->donation_approved}}</strong> ({{$project->donation_approved_in_words}} ريال سعودي)</span></span>.
@component('mail::button', ['url' => url('/'), 'color' => 'balahmar'])
الذهاب للبوابة
@endcomponent

  دمتم في رعاية الله...<br>
مع تحية مجلس الأمناء بمؤسسة سالم بن أحمد بالحمر وعائلته الخيرية.
@endcomponent